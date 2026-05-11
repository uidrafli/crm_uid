@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a class="btn btn-primary btn-sm" href="{{ url('/data-cuti/tambah') }}">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/data-ro') }}">
                        <div class="row">
                            <div class="col-3">
                                <select name="user_id" id="user_id" class="form-control selectpicker"
                                    data-live-search="true">
                                    <option value=""selected>Pilih Pegawai</option>
                                    @foreach ($users as $u)
                                        @if (request('user_id') == $u->id)
                                            <option value="{{ $u->id }}"selected>{{ $u->name }}</option>
                                        @else
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <button type="submit" id="search"class="border-0 mt-3"
                                    style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center" id="mytable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Subject</th>
                                    <th>Nama Acara</th>
                                    <th>Tanggal Acara</th>
                                    <th>Lokasi</th>
                                    <th>Durasi (Jam)</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $dc)
                                    <tr>
                                        <td>{{ ($data->currentpage() - 1) * $data->perpage() + $key + 1 }}.</td>
                                        <td>{{ $dc->user_name ?? '-' }}</td>
                                        <td>{{ $dc->subject ?? '-' }}</td>
                                        <td>{{ $dc->nama_acara ?? '-' }}</td>
                                        <td>{{ $dc->tanggal_acara ?? '-' }}</td>
                                        <td>{{ $dc->lokasi ?? '-' }}</td>
                                        <td>{{ $dc->durasi ?? '-' }} Jam</td>
                                        <td>{{ $dc->deskripsi ?? '-' }}</td>
                                        <td>
                                            @if ($dc->approval_status == 'Diterima')
                                                <span class="badge badge-primary">{{ $dc->approval_status ?? '-' }}</span>
                                            @elseif($dc->approval_status == 'Ditolak')
                                                <span class="badge badge-danger">{{ $dc->approval_status ?? '-' }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $dc->approval_status ?? 'Pending' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                @if ($dc->approval_status == 'Diterima')
                                                    <li class="me-2">
                                                        <span class="badge badge-primary">Sudah Approve</span>
                                                    </li>
                                                @elseif ($dc->approval_status == 'Ditolak')
                                                    <li class="me-2">
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ url('/pengajuan_ro/edit/' . $dc->id) }}"><i
                                                                style="color: blue" class="fas fa-edit"></i></a>
                                                    </li>

                                                    <li class="delete">
                                                        <form action="{{ url('/pengajuan_ro/delete/' . $dc->id) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="border-0" style="background-color: transparent"
                                                                onClick="return confirm('Are You Sure')"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mr-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#mulai').change(function() {
                    var mulai = $(this).val();
                    $('#akhir').val(mulai);
                });
            });
        </script>
    @endpush
@endsection
