@extends('templates.app')

@section('container')
    <!-- Bootstrap 5 Card -->
    <div class="container my-3">
        @foreach ($data_cuti as $key => $dc)
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Name -->
                    <h3 class="card-title fw-bold mb-2">{{ $dc->User->name ?? '-' }}</h3>

                    <div class="row mb-1">
                        <div class="col-4 fw-bold">Status:</div>
                        @if ($dc->leader_approval)
                            <div class="col-8"><p><span class="badge bg-primary">Approved</span></p></div>
                        @elseif($dc->status_cuti == 'Ditolak')
                            <div class="col-8"><p><span class="badge bg-danger">{{ $dc->status_cuti ?? '-' }}</span></p></div>
                        @else
                            <div class="col-8"><p><span class="badge bg-warning">{{ $dc->status_cuti ?? 'Pending' }}</p></span>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-1">
                        <div class="col-4 fw-bold">Type Cuti:</div>
                        <div class="col-8">{{ $dc->nama_cuti ?? '-' }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4 fw-bold">Tanggal:</div>
                        <div class="col-8">{{ $dc->tanggal_mulai ?? '-' }} - {{ $dc->tanggal_akhir ?? '-' }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4 fw-bold">Alasan:</div>
                        <div class="col-8">{{ $dc->alasan_cuti ?? '-' }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4 fw-bold">Dokumen:</div>
                        <div class="col-8">
                            @if ($dc->foto_cuti)
                                <a href="{{ url('/cuti-download-file', $dc->id) }}" class="btn-download btn-primary btn-sm fs-15">
                                    Download <i class="fa fa-download"></i>
                                </a>
                            @else
                                <p><span class="badge bg-info">Tidak Ada File</span></p>
                            @endif
                        </div>
                    </div>


                    @if ($dc->leader_approval or $dc->status_cuti == 'Ditolak' or $dc->status_cuti == 'Diterima')
                    @else
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-5">
                            <button class="btn btn-approve w-50 me-2" data-id="{{ $dc->id }}" id="approveBtn">
                                <span class="btn-text"><b>Approve</b></span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>

                            <button class="btn btn-reject w-50" data-id="{{ $dc->id }}" id="rejectBtn">
                                <span class="btn-text"><b>Reject</b></span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <style>
            .card {
                border-top: 5px solid #533DEA;
                /* garis aksen kiri */
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                border-radius: 10px;
            }

            .card-body p {
                font-size: 0.95rem;
                color: #555;
            }

            .card-title {
                color: #333;
            }

            .btn {
                height: 50px;
            }

            .btn-download {
                height: 30px;
            }

            .btn-approve {
                background-color: #533DEA;
                color: white;
            }

            .btn-approve:hover {
                background-color: #412ad5;
                color: white;
            }

            .btn-reject {
                background-color: #ff0000;
                color: white;
                border: none;
            }

            .btn-reject:hover {
                background-color: #ee0202;
                color: white;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Tombol Approve
                document.querySelectorAll('.btn-approve').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id'); // ambil id dari attribute data-id
                        let btn = this;
                        let text = btn.querySelector('.btn-text');
                        let spinner = btn.querySelector('.spinner-border');

                        Swal.fire({
                            title: 'Approve Cuti?',
                            text: "Apakah kamu yakin ingin approve cuti ini?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Ubah tombol jadi spinner
                                text.classList.add('d-none');
                                spinner.classList.remove('d-none');
                                btn.disabled = true;

                                // Redirect ke link dengan id
                                window.location.href = "/data-cuti-apps/edit-proses/" + id;
                            }
                        });
                    });
                });

                // Tombol Reject
                document.querySelectorAll('.btn-reject').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id'); // ambil id dari attribute data-id
                        let btn = this;
                        let text = btn.querySelector('.btn-text');
                        let spinner = btn.querySelector('.spinner-border');

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
                                text.classList.add('d-none');
                                spinner.classList.remove('d-none');
                                btn.disabled = true;

                                window.location.href = "/data-cuti-apps-reject/edit-proses/" +
                                    id;
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
