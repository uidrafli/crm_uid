@extends('templates.app')

@section('container')
    <div class="container my-1">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="" style="margin-bottom: 75px;">
                    <div class="card-body">
                        <form method="POST" action="{{ url('/cuti/tambah') }}" enctype="multipart/form-data" id="myForm">
                            @csrf

                            <div class="group-input">
                                <label for="user_id">Nama Lengkap <span class="text-danger">*</span></label>
                                <select id="user_id" name="user_id" id="">
                                    <option value="{{ $data_user->id }}">{{ $data_user->name }}</option>
                                </select>
                            </div>
                            <div class="group-input">
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
                                <label for="nama_cuti">Type Cuti <span class="text-danger">*</span></label>
                                <select class="@error('nama_cuti') is-invalid @enderror" id="nama_cuti" name="nama_cuti"
                                    data-live-search="true" required>
                                    <option value="" disabled selected>--Pilih Cuti--</option>
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

                            <div class="group-input">
                                <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="datetime" class="@error('tanggal_mulai') is-invalid @enderror form-control"
                                    name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="tanggal_akhir">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="datetime" class="@error('tanggal_akhir') is-invalid @enderror form-control"
                                    name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required>
                                @error('tanggal_akhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="tanggal">

                            <div class="group-input">
                                <label for="foto_cuti" class="text-danger"><i>Upload surat dokter jika sakit</i></label>
                                <input type="file" name="foto_cuti" style="height: 50px;" id="foto_cuti"
                                    class="form-control @error('foto_cuti') is-invalid @enderror form-control" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                @error('foto_cuti')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="alasan_cuti">Keterangan Cuti</label>
                                <input type="text"
                                    class="form-control @error('alasan_cuti') is-invalid @enderror form-control"
                                    id="alasan_cuti" name="alasan_cuti" value="{{ old('alasan_cuti') }}">
                                @error('alasan_cuti')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="status_cuti">

                            <!-- Submit -->
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-3" style="height: 50px;">
                                <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i> <b>Kirim</b></span>
                                <span id="btnSpinner" class="spinner-border d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('myForm').addEventListener('submit', function() {
            let btn = document.getElementById('submitBtn');
            let text = document.getElementById('btnText');
            let spinner = document.getElementById('btnSpinner');

            // Sembunyikan teks, tampilkan spinner
            text.classList.add('d-none');
            spinner.classList.remove('d-none');

            // Disable tombol agar tidak bisa diklik lagi
            btn.disabled = true;
        });
    </script>
@endsection
