<!DOCTYPE html>
<html lang="en">

<head>

    @php
        $settings = App\Models\settings::first();
    @endphp
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific Metas -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Install Apps HRIS R-Tech</title>
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('/storage/' . $settings->logo) }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/storage/' . $settings->logo) }}" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
    {{-- select picker --}}
    <link rel="stylesheet"
        href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css') }}">

    {{-- timepicker --}}
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" /> --}}
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/storage/' . $settings->logo) }}">
    @stack('style')

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
            background: #f5f5f5;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
            /* max-width: 400px; */
            width: 100%;
            text-align: center;
        }

        .btn {
            padding: 12px 18px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 12px;
        }

        .btn:hover {
            background: #148d30;
            color: white;
        }

        .btn-ios {
            background: #28a745;
        }

        .ios-instructions {
            background: #d2e8ff;
            color: #0055b0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 15px;
            line-height: 1.5;
        }

        .close-btn {
            margin-top: 10px;
            cursor: pointer;
            color: #007bff;
            font-weight: bold;
        }
    </style>

    <link rel="manifest" href="manifest.json">
</head>

<body>
    <div class="card">
        <h3><b>Install Apps HRIS</b></h3>
        <p>Pilih metode instalasi sesuai perangkat handphone kamu.</p>

        <!-- Tombol Android -->
        <button id="androidInstall" class="btn"><b>Install untuk Android <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M452.5 317.9C465.8 317.9 476.5 328.6 476.5 341.9C476.5 355.2 465.8 365.9 452.5 365.9C439.2 365.9 428.5 355.2 428.5 341.9C428.5 328.6 439.2 317.9 452.5 317.9zM187.4 317.9C200.7 317.9 211.4 328.6 211.4 341.9C211.4 355.2 200.7 365.9 187.4 365.9C174.1 365.9 163.4 355.2 163.4 341.9C163.4 328.6 174.1 317.9 187.4 317.9zM461.1 221.4L509 138.4C509.8 137.3 510.3 136 510.5 134.6C510.7 133.2 510.7 131.9 510.4 130.5C510.1 129.1 509.5 127.9 508.7 126.8C507.9 125.7 506.9 124.8 505.7 124.1C504.5 123.4 503.2 123 501.8 122.8C500.4 122.6 499.1 122.8 497.8 123.2C496.5 123.6 495.3 124.3 494.2 125.1C493.1 125.9 492.3 127.1 491.7 128.3L443.2 212.4C404.4 195 362.4 186 319.9 186C277.4 186 235.4 195 196.6 212.4L148.2 128.4C147.6 127.2 146.7 126.1 145.7 125.2C144.7 124.3 143.4 123.7 142.1 123.3C140.8 122.9 139.4 122.8 138.1 122.9C136.8 123 135.4 123.5 134.2 124.2C133 124.9 132 125.8 131.2 126.9C130.4 128 129.8 129.3 129.5 130.6C129.2 131.9 129.2 133.3 129.4 134.7C129.6 136.1 130.2 137.3 130.9 138.5L178.8 221.5C96.5 266.2 40.2 349.5 32 448L608 448C599.8 349.5 543.5 266.2 461.1 221.4z"/></svg></b></button>

        <!-- Tombol iOS -->
        {{-- <button id="iosInstall" class="btn btn-ios">Install untuk iOS</button> --}}

        <!-- Instruksi iOS -->
        <div class="ios-instructions" id="iosBox">
            <strong>Instruksi Install untuk iPhone<svg style="margin-top: -9px; margin-left: -3px;" xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#0055b0" d="M447.1 332.7C446.9 296 463.5 268.3 497.1 247.9C478.3 221 449.9 206.2 412.4 203.3C376.9 200.5 338.1 224 323.9 224C308.9 224 274.5 204.3 247.5 204.3C191.7 205.2 132.4 248.8 132.4 337.5C132.4 363.7 137.2 390.8 146.8 418.7C159.6 455.4 205.8 545.4 254 543.9C279.2 543.3 297 526 329.8 526C361.6 526 378.1 543.9 406.2 543.9C454.8 543.2 496.6 461.4 508.8 424.6C443.6 393.9 447.1 334.6 447.1 332.7zM390.5 168.5C417.8 136.1 415.3 106.6 414.5 96C390.4 97.4 362.5 112.4 346.6 130.9C329.1 150.7 318.8 175.2 321 202.8C347.1 204.8 370.9 191.4 390.5 168.5z"/></svg>:</strong><br>
            1. Tekan tombol <img src="{{ asset('assets/icon-image/share.png') }}" style="width: 25px; margin-top: -9px;"> (Share)<br>
            2. Pilih <strong>Add to Home Screen</strong><br>

            {{-- <div class="close-btn" id="closeIos">Tutup</div> --}}
        </div>
    </div>

    <script>
        let deferredPrompt;

        // Tangkap event untuk Android
        window.addEventListener("beforeinstallprompt", (e) => {
            e.preventDefault();
            deferredPrompt = e;

            document.getElementById("androidInstall").onclick = async () => {
                deferredPrompt.prompt();
                await deferredPrompt.userChoice;
                deferredPrompt = null;
            };
        });

        // Tombol iOS membuka instruksi
        document.getElementById("iosInstall").onclick = () => {
            document.getElementById("iosBox").style.display = "block";
        };

        // Tutup instruksi iOS
        document.getElementById("closeIos").onclick = () => {
            document.getElementById("iosBox").style.display = "none";
        };
    </script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/password-addon.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
    {{-- selectpicker --}}
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js') }}">
    </script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>

    <script>
        $(function() {
            $('form').on('submit', function() {
                $(':input[type="submit"]').prop('disabled', true);
            })
        })
    </script>
    @stack('script')
    @include('sweetalert::alert')
</body>

</html>
