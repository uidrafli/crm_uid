@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/data-cuti') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{ url('/data-cuti/edit-proses/' . $data_cuti_karyawan->id) }}" class="p-4"
                    id="myForm">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="user_id">Nama Pegawai</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $data_cuti_karyawan->User->name }}" id="user_id">
                        </div>
                        <div class="col mb-4">
                            <label for="nama_cuti">Nama Cuti</label>
                            <input type="text" class="form-control" value="{{ $data_cuti_karyawan->nama_cuti }}"
                                id="nama_cuti" disabled>
                            <input type="hidden" name="nama_cuti" value="{{ $data_cuti_karyawan->nama_cuti }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="datetime" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                name="tanggal_mulai" id="tanggal_mulai" value="{{ $data_cuti_karyawan->tanggal_mulai }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="datetime" class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                name="tanggal_akhir" id="tanggal_akhir" value="{{ $data_cuti_karyawan->tanggal_akhir }}">
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="alasan_cuti">Alasan Cuti</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $data_cuti_karyawan->alasan_cuti }}">
                        </div>
                    </div>
                    <div class="form-row">
                        @php
                            $status_cuti = [
                                [
                                    'status_cuti' => 'Pending',
                                ],
                                [
                                    'status_cuti' => 'Ditolak',
                                ],
                                [
                                    'status_cuti' => 'Diterima',
                                ],
                            ];
                        @endphp
                        {{-- <div class="col mb-4">
                            <label for="status_cuti">Status Cuti</label>
                            <select name="status_cuti" class="form-control @error('status_cuti') is-invalid @enderror selectpicker" data-live-search="true" id="status_cuti">
                                @foreach ($status_cuti as $sc)
                                    @if (old('status_cuti', $data_cuti_karyawan->status_cuti) == $sc['status_cuti'])
                                        <option value="{{ $sc["status_cuti"] }}" selected>{{ $sc["status_cuti"] }}</option>
                                    @else
                                        <option value="{{ $sc["status_cuti"] }}">{{ $sc["status_cuti"] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        <div class="col mb-4">
                            <label for="catatan">Catatan</label>
                            <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                                id="catatan" value="{{ old('catatan', $data_cuti_karyawan->catatan) }}">
                            @error('catatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="jam_absen">
                    <input type="hidden" name="telat">
                    <input type="hidden" name="lat_absen">
                    <input type="hidden" name="long_absen">
                    <input type="hidden" name="jarak_masuk">
                    <input type="hidden" name="foto_jam_absen">
                    <input type="hidden" name="jam_pulang">
                    <input type="hidden" name="pulang_cepat">
                    <input type="hidden" name="foto_jam_pulang">
                    <input type="hidden" name="foto_jam_pulang">
                    <input type="hidden" name="lat_pulang">
                    <input type="hidden" name="long_pulang">
                    <input type="hidden" name="jarak_pulang">
                    <input type="hidden" name="status_absen">
                    <input type="hidden" name="izin_cuti">
                    <input type="hidden" name="izin_lainnya">
                    <input type="hidden" name="izin_telat">
                    <input type="hidden" name="izin_pulang_cepat">
                    <button type="submit" id="submitBtn" class="btn btn-primary">
                        <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Approve</span>
                        <span id="btnSpinner" class="spinner-border d-none" role="status" aria-hidden="true"></span>
                    </button>
                    {{-- <button type="submit" class="btn btn-primary">Approve</button> --}}
                </form>
                <div style="margin-bottom: 25px; margin-top: -10px; margin-left: 25px">
                    <button class="btn btn-danger btn-reject" style="width: 130px;"
                        data-id="{{ $data_cuti_karyawan->id }}"><i class="fa fa-paper-plane" aria-hidden="true"></i> Reject</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ambil semua tombol approve
            document.querySelectorAll('.btn-reject').forEach(function(button) {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id'); // ambil id dari attribute data-id

                    Swal.fire({
                        title: 'Reject Cuti?',
                        text: "Apakah kamu yakin ingin reject cuti ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // redirect ke link dengan id
                            window.location.href = "/admin-reject/" + id;
                        }
                    });
                });
            });
        });
    </script>
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
