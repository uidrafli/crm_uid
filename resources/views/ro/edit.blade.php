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
                <form method="post" action="{{ url('/pengajuan_ro/edit_proses/' . $data->id) }}" class="p-4" id="myForm">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="user_id">Nama Pegawai</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $data->user_name }}" id="user_id">
                        </div>
                        <div class="col mb-4">
                            <label for="subject">Subject</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $data->subject }}" id="subject">
                        </div>
                        <div class="col mb-4">
                            <label for="nama_cuti">Nama Acara</label>
                            <input type="text" class="form-control" value="{{ $data->nama_acara }}"
                                id="nama_cuti" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime" class="form-control @error('tanggal') is-invalid @enderror"
                                name="tanggal" id="tanggal" value="{{ $data->tanggal_acara }}" disabled>
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="alasan_cuti">Durasi (Jam)</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $data->durasi }} Jam">
                        </div>
                    </div>
                    <div class="form-row">
                        @php
                            $status = [
                                [
                                    'status' => 'Pending',
                                ],
                                [
                                    'status' => 'Ditolak',
                                ],
                                [
                                    'status' => 'Diterima',
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
                            <label for="jumlah_ro">Input Jumlah RO Yang Diberikan</label>
                            <input type="number" class="form-control @error('jumlah_ro') is-invalid @enderror" name="jumlah_ro"
                                id="jumlah_ro" value="1">
                            @error('jumlah_ro')
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
                    <button class="btn btn-danger btn-reject" style="width: 117px;" data-id="{{ $data->id }}">Reject</button>
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
