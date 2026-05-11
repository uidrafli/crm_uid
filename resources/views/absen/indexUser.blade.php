@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section mb-5">
        <div class="tf-container">
            <div class="tf-balance-box" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Date</span>
                    </div>
                    <span>{{ $shift_karyawan->tanggal ?? '-' }}</span> --}}

                    <p style="font-size: 15px; font-weight: bold">
                        @if (!$shift_karyawan)
                            @php
                                $tanggal = date('d-m-Y');
                            @endphp
                            {{ $tanggal }}
                        @else
                            {{ \Carbon\Carbon::parse($shift_karyawan->tanggal)->format('l, M d') ?? '-' }}
                            <span id="jam" class="ms-1"></span>:<span id="menit">
                        @endif
                    </p>
                </div>
                @if (!$shift_karyawan)
                @else
                    @if ($shift_karyawan->jam_absen == null or $shift_karyawan->jam_pulang == null)
                    @else
                        <div class="container" style="width: auto; height: 30px;"></div>
                    @endif
                @endif
                {{-- <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Shift</span>
                    </div>
                    <span>{{ $shift_karyawan->Shift->nama_shift ?? '' }} ({{ $shift_karyawan->Shift->jam_masuk ?? '' }} -
                        {{ $shift_karyawan->Shift->jam_keluar ?? '' }})</span>
                </div> --}}
                <style>
                    .jam-digital-malasngoding {
                        overflow: hidden;
                        float: center;
                        width: 100px;
                        margin: 2px auto;
                        border: 0px solid #efefef;
                    }

                    .kotak {
                        float: left;
                        width: 30px;
                        height: 30px;
                        background-color: #189fff;
                    }

                    .jam-digital-malasngoding p {
                        color: #fff;
                        font-size: 16px;
                        text-align: center;
                        margin-top: 3px;
                    }
                </style>

                {{-- <div class="jam-digital-malasngoding">
                    <div class="kotak">
                        <p id="jam"></p>
                    </div>
                    <div class="kotak">
                        <p id="menit"></p>
                    </div>
                    <div class="kotak">
                        <p id="detik"></p>
                    </div>
                </div> --}}

                @php
                    use App\Models\User;

                    $user = Auth::user(); // object user yang login
                    $id = $user->id; // ambil ID

                    $data_user = User::findOrFail($id);
                @endphp

                <script>
                    window.setTimeout("waktu()", 1000);

                    function waktu() {
                        var waktu = new Date();
                        setTimeout("waktu()", 1000);
                        document.getElementById("jam").innerHTML = waktu.getHours();
                        document.getElementById("menit").innerHTML = waktu.getMinutes();
                        document.getElementById("detik").innerHTML = waktu.getSeconds();
                    }
                </script>

                @if (!$shift_karyawan)
                @else
                    @if ($shift_karyawan->jam_absen == null or $shift_karyawan->jam_pulang == null)
                        <p id="address" class="mb-1 mt-2" style="font-size: 15px;">Loading address...</p>
                        <p id="coords" class="mb-4" style="font-size: 15px;">Loading...</p>
                        <div id="map" style="width:100%;height:200px;"></div>
                    @else
                    @endif
                @endif
                <script>
                    var map = L.map('map').setView([0, 0], 17);
                    var radius = {{ $data_user->Lokasi->radius }};

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    // buat marker & circle sekali saja
                    var marker = L.marker([0, 0]).addTo(map);
                    var circle = L.circle([0, 0], {
                        color: '#533dea',
                        fillColor: '#533dea',
                        fillOpacity: 0.5,
                        radius: radius
                    }).addTo(map);

                    marker.bindPopup("<b>Your Location</b>").openPopup();
                    circle.bindPopup("<b>Radius {{ $data_user->Lokasi->nama_lokasi ?? '' }}</b>");

                    // fungsi ambil lokasi
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } else {
                            alert("Geolocation is not supported by this browser.");
                        }
                    }

                    function showPosition(position) {
                        var lat = position.coords.latitude;
                        var long = position.coords.longitude;

                        var lat_kantor = {{ $data_user->Lokasi->lat_kantor }};
                        var long_kantor = {{ $data_user->Lokasi->long_kantor }};

                        // Panggil API Nominatim untuk reverse geocoding
                        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${long}&format=json`)
                            .then(response => response.json())
                            .then(data => {
                                // Ambil detail alamat
                                var addr = data.address;
                                var kodePos = addr.postcode || "-";
                                var kecamatan = addr.suburb || addr.village || "-";
                                var kota = addr.city || addr.town || addr.county || "-";
                                var provinsi = addr.state || "-";
                                var negara = addr.country || "-";

                                // Tampilkan ke HTML
                                document.getElementById("address").innerHTML =
                                    `${kodePos},
                                     ${kecamatan},
                                     ${kota},
                                     ${provinsi},
                                     ${negara}`;
                            })
                            .catch(err => {
                                document.getElementById("address").innerHTML = "Gagal mengambil alamat.";
                                console.error(err);
                            });

                        // tampilkan ke <h3>
                        document.getElementById("coords").innerHTML = lat + ", " + long;

                        // isi ke input
                        $('#lat').val(lat);
                        $('#lat2').val(lat);
                        $('#long').val(long);
                        $('#long2').val(long);

                        // update marker & circle ke posisi baru
                        marker.setLatLng([lat, long]);
                        circle.setLatLng([lat_kantor, long_kantor]);

                        // optional: geser view map ke lokasi terbaru
                        map.setView([lat, long], 17);
                    }

                    // jalankan tiap 1 detik
                    setInterval(getLocation, 5000);
                </script>
            </div>
        </div>
    </div>



    {{-- <div class="d-flex justify-content-center mb-4">
        <form action="{{ url('/my-location') }}" method="get">
            @csrf
            <input type="hidden" name="lat" id="lat2">
            <input type="hidden" name="long" id="long2">
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <button type="submit" class="btn btn-success">Lihat Lokasi Saya</button>
        </form>
    </div> --}}

    {{-- <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <h3 class="mb-4 text-gray-800">-8.6736896, 115.2155648</h3>
                <div id="map" style="width:100%;height:200px;"></div>
                   <script>
                       var map = L.map('map').setView([-8.6736896, 115.2155648], 18);
                       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                       maxZoom: 19,
                       attribution: '© OpenStreetMap'
                       }).addTo(map);
                       var marker = L.marker([-8.6736896, 115.2155648]).addTo(map);
                       var circle = L.circle([-8.6736896, 115.2155648], {
                       color: 'red',
                       fillColor: '#f03',
                       fillOpacity: 0.5,
                       radius: 200
                       }).addTo(map);

                       marker.bindPopup("<b>Lokasi Saya</b>").openPopup();
                       circle.bindPopup("<b>Radius {{ $data_user->Lokasi->nama_lokasi ?? '' }}</b>");
                   </script>
            </div>
        </div>
    </div> --}}

    <div class="transfer-content">
        @if (!$shift_karyawan)
            <center>
                <img src="{{ asset('assets/icon-image/help-desk.png') }}" alt="Rest"
                style="width: 35%; height: auto; margin-top: 15px;">
                <h3 class="mt-5">Hubungi Admin untuk input shift Absen</h3>
            </center>
        @elseif($shift_karyawan->status_absen == 'Libur')
            <center>
                <img src="{{ asset('assets/icon-image/rest.png') }}" alt="Rest"
                style="width: 35%; height: auto; margin-top: 15px;">
                <h2 class="mt-5">Hari ini Libur</h2>
            </center>
        @elseif($shift_karyawan->status_absen == 'Cuti')
            <center>
                <img src="{{ asset('assets/icon-image/rest.png') }}" alt="Rest"
                style="width: 35%; height: auto; margin-top: 15px;">
                <h2 class="mt-5">Hari ini kamu Cuti</h2>
            </center>
        @elseif($shift_karyawan->status_absen == 'Replace Off')
            <center>
                <img src="{{ asset('assets/icon-image/rest.png') }}" alt="Rest"
                style="width: 35%; height: auto; margin-top: 15px;">
                <h2 class="mt-5">Hari ini kamu RO</h2>
            </center>
        @else
            @if ($shift_karyawan->jam_absen == null)
                <form class="tf-form" action="{{ url('/absen/masuk/' . $shift_karyawan->id) }}" method="POST"
                    id="myForm">
                    @method('PUT')
                    @csrf
                    <div class="tf-container">
                        <center>
                            {{-- <h2>Absen Masuk: </h2> --}}
                            <div class="webcam" id="results"></div>
                        </center>
                        @if ($shift_karyawan->lock_location == null)
                            <div class="group-input mt-5">
                                <label>Catatan <span class="text-danger">*</span></label>
                                <textarea name="keterangan_masuk" class="@error('keterangan_masuk') is-invalid @enderror" required>{{ old('keterangan_masuk') }}</textarea>
                                @error('keterangan_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <input type="hidden" name="jam_absen">
                        <input type="hidden" name="foto_jam_absen" class="image-tag">
                        <input type="hidden" name="lat_absen" id="lat">
                        <input type="hidden" name="long_absen" id="long">
                        <input type="hidden" name="telat">
                        <input type="hidden" name="jarak_masuk">
                        <input type="hidden" name="status_absen">
                        {{-- <button type="submit" class="tf-btn accent large" onClick="take_snapshot()">Check In</button> --}}
                        <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-3" onClick="take_snapshot()"
                            style="height: 50px;">
                            <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <b>Check In</b></span>
                            <span id="btnSpinner" class="spinner-border d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
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
                <br>
                <br>
                <br>
                <br>
                <br>
                <script type="text/javascript" src="{{ url('webcamjs/webcam.min.js') }}"></script>
                <script language="JavaScript">
                    Webcam.set({
                        width: 320,
                        height: 320,
                        image_format: 'jpeg',
                        jpeg_quality: 50
                    });
                    Webcam.attach('.webcam');
                </script>
                <script language="JavaScript">
                    function take_snapshot() {
                        Webcam.snap(function(data_uri) {
                            $(".image-tag").val(data_uri);
                            document.getElementById('results').innerHTML =
                                '<img src="' + data_uri + '"/>';
                        });
                    }
                </script>
            @elseif($shift_karyawan->jam_pulang == null)
                <form class="tf-form" action="{{ url('/absen/pulang/' . $shift_karyawan->id) }}" method="POST"
                    id="myFormOut">
                    @method('PUT')
                    @csrf
                    <div class="tf-container">
                        <center>
                            {{-- <h2>Absen Pulang: </h2> --}}
                            <div class="webcam" id="results"></div>
                        </center>
                        @if ($shift_karyawan->lock_location == null)
                            <div class="group-input mt-5">
                                <label>Catatan <span class="text-danger">*</span></label>
                                <textarea name="keterangan_pulang" class="@error('keterangan_pulang') is-invalid @enderror" required>{{ old('keterangan_pulang') }}</textarea>
                                @error('keterangan_pulang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <input type="hidden" name="jam_pulang">
                        <input type="hidden" name="foto_jam_pulang" class="image-tag">
                        <input type="hidden" name="lat_pulang" id="lat">
                        <input type="hidden" name="long_pulang" id="long">
                        <input type="hidden" name="pulang_cepat">
                        <input type="hidden" name="jarak_pulang">
                        {{-- <button type="submit" class="tf-btn accent large" onClick="take_snapshot()">Check Out</button> --}}
                        <button type="submit" id="submitOutBtn" class="btn btn-primary w-100 mt-3"
                            onClick="take_snapshot()" style="height: 50px;">
                            <span id="btnOutText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <b>Check Out</b></span>
                            <span id="btnOutSpinner" class="spinner-border d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
                <script>
                    document.getElementById('myFormOut').addEventListener('submit', function() {
                        let btn = document.getElementById('submitOutBtn');
                        let text = document.getElementById('btnOutText');
                        let spinner = document.getElementById('btnOutSpinner');

                        // Sembunyikan teks, tampilkan spinner
                        text.classList.add('d-none');
                        spinner.classList.remove('d-none');

                        // Disable tombol agar tidak bisa diklik lagi
                        btn.disabled = true;
                    });
                </script>
                <br>
                <br>
                <br>
                <br>
                <br>
                <script type="text/javascript" src="{{ url('webcamjs/webcam.min.js') }}"></script>
                <script language="JavaScript">
                    Webcam.set({
                        width: 320,
                        height: 320,
                        image_format: 'jpeg',
                        jpeg_quality: 50
                    });
                    Webcam.attach('.webcam');
                </script>
                <script language="JavaScript">
                    function take_snapshot() {
                        Webcam.snap(function(data_uri) {
                            $(".image-tag").val(data_uri);
                            document.getElementById('results').innerHTML =
                                '<img src="' + data_uri + '"/>';
                        });
                    }
                </script>
            @else
                <center>
                    <img src="{{ asset('assets/icon-image/rest.png') }}" alt="Rest"
                    style="width: 35%; height: auto; margin-top: 15px;">
                    <h2 class="mt-5">Selamat Beristirahat</h2>
                </center>
            @endif
        @endif
    </div>

    @push('script')
        <script></script>
    @endpush

@endsection
