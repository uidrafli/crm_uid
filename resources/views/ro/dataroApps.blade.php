@extends('templates.app')

@section('container')
    <!-- Bootstrap 5 Card -->
    <div class="container my-3">

        <!-- Input Pencarian -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
        </div>

        <!-- Card Container -->
        <div id="cardContainer">

            @foreach ($PengajuanRo as $data)
                <div class="card mb-4 user-card">
                    <div class="card-body">
                        <!-- Name -->
                        <h3 class="card-title fw-bold mb-2">{{ $data['subject'] }}</h3>

                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Status:</div>
                            @if ($data['approval_status'] == 'Diterima')
                                <div class="col-8"><span class="badge bg-primary">Approved</span></div>
                            @elseif ($data['approval_status'] == 'Ditolak')
                                <div class="col-8"><span class="badge bg-danger">Ditolak</span></div>
                            @else
                                <div class="col-8"><span class="badge bg-warning">Pending</span></div>
                            @endif
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Nama:</div>
                            <div class="col-8">{{ $data['user_name'] }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Acara:</div>
                            <div class="col-8">{{ $data['nama_acara'] }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Tanggal:</div>
                            <div class="col-8">{{ $data['tanggal_acara'] }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Lokasi:</div>
                            <div class="col-8">{{ $data['lokasi'] }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Durasi:</div>
                            <div class="col-8">{{ $data['durasi'] }} Jam</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Deskripsi:</div>
                            <div class="col-8">{{ $data['deskripsi'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Tambahkan card lain di sini jika ada -->
        </div>
    </div>

    <style>
        .card {
            border-top: 5px solid #533DEA;
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

    <!-- Script Filter -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('#cardContainer .user-card');

            cards.forEach(function(card) {
                // Ambil semua teks di dalam card
                let text = card.textContent.toLowerCase();

                // Cek apakah teks card mengandung kata pencarian
                if (text.includes(filter)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
@endsection
