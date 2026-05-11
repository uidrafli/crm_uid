@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>

                <div class="bill-content">
                    <form action="{{ url('/notifications') }}">
                        <div class="row">
                            <div class="col-10">
                                @php
                                    $filter = [
                                        [
                                            'filter' => 'read',
                                        ],
                                        [
                                            'filter' => 'unread',
                                        ],
                                    ];
                                @endphp
                                <select name="filter" id="filter" data-live-search="true">
                                    @foreach ($filter as $fil)
                                        @if (request('filter') == $fil['filter'])
                                            <option value="{{ $fil['filter'] }}"selected>{{ $fil['filter'] }}</option>
                                        @else
                                            <option value="{{ $fil['filter'] }}">{{ $fil['filter'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tf-spacing-16"></div>
            </div>
        </div>
    </div>
    <div id="app-wrap">
        <div class="bill-content">
            <div class="tf-container">
                <ul class="mt-3 mb-5">

                    @foreach ($inboxs as $inbox)
                        @php
                            $user = App\Models\User::find($inbox->data['user_id']);

                            $informasi = '';
                            if ($inbox->data['from'] == 'Informasi') {
                                $informasi = $inbox->data['type'] . ' ' . 'Kamu Disetujui';
                            } elseif ($inbox->data['from'] == 'Ditolak') {
                                $informasi = $inbox->data['type'] . ' ' . 'Kamu Ditolak';
                            } elseif ($inbox->data['from'] == 'approve_ro') {
                                $informasi = $inbox->data['message'];
                            } else {
                                $informasi = $user->name;
                            }
                        @endphp
                        {{-- <li class="list-card-invoice tf-topbar d-flex justify-content-between align-iteinbox-center p-2" style="{{ !$inbox->read_at ? 'background-color: rgb(231, 231, 231)' : 'background-color: rgb(251, 251, 251)' }}">
                            <div class="user-info">
                                @if ($user->foto_karyawan == null)
                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                @else
                                    <img src="{{ url('/storage/'.$user->foto_karyawan) }}" alt="image">
                                @endif
                            </div>
                        </li> --}}
                        <div class="content-right">
                            <div class="container"
                                style="{{ !$inbox->read_at ? 'background-color: rgb(240, 240, 240)' : '' }}; padding-bottom: 7px; padding-top: 7px; border-bottom: 1px solid #ccc;">
                                <h4><a href="{!! !$inbox->read_at ? url('/notifications/read-message/' . $inbox->id) : url($inbox->data['action']) !!}">{{ $informasi }}
                                        <span>{{ $inbox->status_pengajuan }}</span></a></h4>
                                <p>
                                    <a style="color: rgb(130, 130, 130);" href="{!! !$inbox->read_at ? url('/notifications/read-message/' . $inbox->id) : url($inbox->data['action']) !!}">
                                        {{ $inbox->data['message'] }}
                                        @if ($inbox->data['validation'] == 'to_user')
                                            <span class="float-end">
                                                @if ($inbox->data['from'] == 'approve_ro')
                                                    <b class="text-success">+ {{ $inbox->data['amount'] }}</b>
                                                @elseif ($inbox->data['type'] == 'Sakit')
                                                    <span class="float-end"></span>
                                                @else
                                                    <b class="text-danger">- {{ $inbox->data['amount'] }}</b>
                                                @endif
                                                @if ($inbox->data['type'] == 'Sakit')
                                                    <span class="float-end"></span>
                                                @else
                                                    &nbsp;{{ $inbox->data['type'] }}
                                                @endif
                                            </span>
                                        @else
                                            <span class="float-end"></span>
                                        @endif
                                        <br>
                                        <span>{{ date('d M Y H:i', strtotime($inbox->created_at)) }}</span>
                                    </a>
                                </p>
                                <p><a style="color: rgb(130, 130, 130)"
                                        href="{!! !$inbox->read_at ? url('/notifications/read-message/' . $inbox->id) : url($inbox->data['action']) !!}">{{ $inbox->deskripsi }}</a></p>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="content-right mb-3">
                        <div class="container" style="{{ !$inbox->read_at ? 'background-color: rgb(240, 240, 240)' : '' }}; padding-bottom: 7px; padding-top: 7px; border-bottom: 1px solid #ccc;">
                            <h4><a href="">Rafli <span>Cuti</span></a></h4>
                            <p><a style="color: rgb(130, 130, 130);" href="">Butuh approval <br><span>{{ date('d M Y H:i',strtotime('2025-12-19 13:49:44')) }}</span></a></p>
                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $inboxs->links() }}
                    </div>
                </ul>

            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection
