@extends('templates.app')
@section('container')
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form class="tf-form p-4" method="post" action="{{ url('/cuti/tambah') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="group-input" style="margin-top: 20px;">
                        <label for="user_id" style="z-index:1000">Name</label>
                        <select id="user_id" name="user_id" id="">
                            <option value="{{ $data_user->id }}">{{ $data_user->name }}</option>
                        </select>
                    </div>
                    <div class="group-input" style="margin-top: 20px;">
                        @php
                            $izin_cuti = $data_user->izin_cuti;
                            $izin_ro = $data_user->izin_ro;
                            $izin_lainnya = $data_user->izin_lainnya;
                            $izin_telat = $data_user->izin_telat;
                            $izin_pulang_cepat = $data_user->izin_pulang_cepat;

                            $data_cuti = [
                                [
                                    'nama' => 'Cuti',
                                    'nama_cuti' => 'Cuti (' . $izin_cuti . ')',
                                ],
                                [
                                    'nama' => 'Replace Off',
                                    'nama_cuti' => 'Replace Off (' . $izin_ro . ')',
                                ],
                                [
                                    'nama' => 'Sakit',
                                    'nama_cuti' => 'Sakit',
                                ],
                            ];
                        @endphp
                        <label for="nama_cuti" style="z-index:1000">Type of Leave</label>
                        <select class="@error('nama_cuti') is-invalid @enderror" id="nama_cuti" name="nama_cuti"
                            data-live-search="true">
                            <option value="" disabled selected>Select Leave</option>
                            @foreach ($data_cuti as $dc)
                                @if (old('nama_cuti') == $dc['nama'])
                                    <option value="{{ $dc['nama'] }}" selected>{{ $dc['nama_cuti'] }}</option>
                                @else
                                    <option value="{{ $dc['nama'] }}">{{ $dc['nama_cuti'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('nama_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="group-input" style="margin-top: 20px;">
                        <label for="tanggal_mulai">Start Date</label>
                        <input type="datetime" class="@error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai"
                            id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group-input" style="margin-top: 20px;">
                        <label for="tanggal_akhir">End Date</label>
                        <input type="datetime" class="@error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir"
                            id="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                        @error('tanggal_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="tanggal">

                    <div class="group-input" style="margin-top: 20px;">
                        <input type="file" name="foto_cuti" style="height: 50px;" id="foto_cuti"
                            class="form-control @error('foto_cuti') is-invalid @enderror">
                        @error('foto_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group-input" style="margin-top: 20px;">
                        <label for="alasan_cuti">Reason for Leave</label>
                        <input type="text" class="form-control @error('alasan_cuti') is-invalid @enderror"
                            id="alasan_cuti" name="alasan_cuti" value="{{ old('alasan_cuti') }}">
                        @error('alasan_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="status_cuti">
                    <button type="submit" class="btn btn-primary mt-3"
                        style="height: 50px; font-weight: bold;">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <form action="{{ url('/cuti') }}">
                <div class="row">
                    <div class="col-4">
                        <input type="datetime" name="mulai" placeholder="Start Date" id="mulai"
                            value="{{ request('mulai') }}">
                    </div>
                    <div class="col-4">
                        <input type="datetime" name="akhir" placeholder="End Date" id="akhir"
                            value="{{ request('akhir') }}">
                    </div>
                    <div class="col-4">
                        <button type="submit" id="search" class="form-control btn" style="width: 25px"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table class="table table-striped" id="tablePayroll">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Type of Leave</th>
                        <th>Date</th>
                        <th>Reason for Lave</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>User Approval</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_cuti_user as $key => $dcu)
                        <tr>
                            <td>{{ ($data_cuti_user->currentpage() - 1) * $data_cuti_user->perpage() + $key + 1 }}.</td>
                            <td>{{ $dcu->User->name ?? '-' }}</td>
                            <td>{{ $dcu->nama_cuti ?? '-' }}</td>
                            <td>{{ $dcu->tanggal ?? '-' }}</td>
                            <td>{{ $dcu->alasan_cuti ?? '-' }}</td>
                            <td>
                                <img src="{{ url('storage/' . $dcu->foto_cuti) }}" style="width:150px" alt="">
                            </td>
                            <td>
                                @if ($dcu->status_cuti == 'Diterima')
                                    <span class="badge bg-primary">{{ $dcu->status_cuti ?? '-' }}</span>
                                @elseif($dcu->status_cuti == 'Ditolak')
                                    <span class="badge bg-danger">{{ $dcu->status_cuti ?? '-' }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $dcu->status_cuti ?? 'Pending' }}</span>
                                @endif
                            </td>
                            <td>
                                <ol class="mb-0">
                                    <li>
                                        1.
                                        @if (!empty($dcu->ua->name))
                                            {{ $dcu->ua->name }}
                                        @else
                                            <span class="badge bg-warning">
                                                Pending
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        2.
                                        @if (!empty($dcu->name_leader_approval))
                                            {{ $dcu->name_leader_approval }}
                                        @else
                                            <span class="badge bg-warning">
                                                Pending
                                            </span>
                                        @endif
                                    </li>
                                </ol>
                            </td>
                            <td>{{ $dcu->catatan ?? '-' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    {{-- @if ($dcu->status_cuti == 'Diterima')
                                        Approved
                                    @else
                                        <a href="{{ url('/cuti/edit/' . $dcu->id) }}"
                                            class="btn btn-sm btn-warning btn-circle"><i
                                                class="fa fa-solid fa-edit"></i></a>
                                    @endif --}}

                                    @if ($dcu->status_cuti == 'Diterima')
                                        <span class="badge bg-primary">Diterima</span>
                                    @elseif ($dcu->status_cuti == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <a href="{{ url('/cuti/edit/' . $dcu->id) }}"
                                            class="btn btn-sm btn-warning btn-circle"><i
                                                class="fa fa-solid fa-edit"></i></a>
                                        <form action="{{ url('/cuti/delete/' . $dcu->id) }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger btn-circle" style="width: 30px"
                                                onClick="return confirm('Are You Sure')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data_cuti_user->links() }}
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    @push('script')
        <script>
            $('select').select2();
        </script>
    @endpush
@endsection
