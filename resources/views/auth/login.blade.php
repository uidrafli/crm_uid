@extends('templates.login')
@section('container')
    <!-- Splash screen -->
    <div id="splash">
        <style>
            /* Splash screen style */
            #splash {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            }

            #splash img {
                max-width: 350px;
                /* ukuran logo di desktop */
                width: 350px;
                /* responsif di mobile */
                height: auto;
            }

            /* Konten dashboard disembunyikan dulu */
            #content {
                display: none;
            }

            /* Responsif tambahan */
            @media (max-width: 768px) {
                #splash img {
                    max-width: 250px;
                    /* lebih kecil di layar mobile */
                    width: 250px;
                    height: auto;
                }
            }
        </style>

        <!-- Ganti src dengan path logo kamu -->
        <img src="{{ asset('assets/logo/R-Tech-New.png') }}" style="margin-top: -80px;" alt="Logo">

        <script>
            // Setelah halaman load, sembunyikan splash dan tampilkan konten
            window.addEventListener('load', function() {
                setTimeout(function() {
                    document.getElementById('splash').style.display = 'none';
                    document.getElementById('content-after-splash').style.display = 'block';
                }, 1000); // 2000ms = 2 detik
            });
        </script>
    </div>
    <style>
        .row {
            display: flex;
            align-items: stretch;
        }

        .separator {
            width: 1px;
            background-color: #ccc;
            margin: 0 10px;
        }
    </style>

    <div class="content-after-splash" style="margin-top: 110px;">
        <form class="tf-form" action="{{ url('/login-proses') }}" method="POST" id="myForm">
            @csrf
            <h1 class="text-center">Login</h1>
            <div class="group-input">
                <label>Username</label>
                <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror"
                    value="{{ old('username') }}" name="username" required>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="group-input auth-pass-input last">
                <label>Password</label>
                <input type="password" class="password-input @error('password') is-invalid @enderror" placeholder="Password"
                    name="password" required>
                <a class="icon-eye password-addon" id="password-addon"></a>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <a href="{{ url('/forgot-password') }}" class="text-decoration-none">
                    Forgot Password <i class="fa fa-key"></i>
                </a>
            </div>

            {{-- <button type="submit" class="tf-btn accent large"><b>LogIn</b></button> --}}
            <button type="submit" id="submitBtn" class="btn btn-primary w-100" style="height: 50px;">
                <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                    <b>LogIn</b></span>
                <span id="btnSpinner" class="spinner-border d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
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
