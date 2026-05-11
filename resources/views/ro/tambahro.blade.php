@extends('templates.app')

@section('container')
    <div class="container my-1">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="" style="margin-bottom: 75px;">
                    <div class="card-body">
                        <form action="{{ '/pengajuan_ro' }}" method="POST" id="myForm">
                            @csrf

                            <!-- Subject -->
                            <div class="mb-3">
                                <label for="subject" class="form-label text-dark">Subject <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    placeholder="Isi dengan nama acara" required>
                            </div>

                            <!-- Nama Acara -->
                            <div class="mb-3">
                                <label for="nama_acara" class="form-label text-dark">Nama Acara <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_acara" name="nama_acara"
                                    placeholder="Masukkan nama acara" required>
                            </div>

                            <!-- Tanggal Acara -->
                            <div class="mb-3">
                                <label for="tanggal_acara" class="form-label text-dark">Tanggal Acara <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tanggal_acara" name="tanggal_acara"
                                    placeholder="Masukan tanggal acara" required>
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-3">
                                <label for="lokasi" class="form-label text-dark">Lokasi <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                    placeholder="Masukkan lokasi acara" required>
                            </div>

                            <!-- Durasi -->
                            <div class="mb-3">
                                <label for="durasi" class="form-label text-dark">
                                    Durasi (Jam) <span class="text-danger">*</span>
                                    <span class="text-danger"><i>Minimal 9 jam kerja untuk mendapatkan satu RO</i></span>
                                </label>
                                <input type="number" class="form-control" id="durasi" name="durasi" min="1"
                                    placeholder="Masukkan durasi jam" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label text-dark">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi"></textarea>
                            </div>

                            <!-- Submit -->
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-3" style="height: 50px;">
                                <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    <b>Kirim</b></span>
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
