<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="icon" href="{{ asset('assets/logo/R-Tech-New.png') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
    <title>UID - Success Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('../assets/background/backgrounduid.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .form-container {
            width: 100%;
            /* atau max-width: 600px misalnya */
            max-width: 800px;
            margin: 0 auto;
            /* untuk center horizontal */
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
        }

        .form-control {
            height: 50px;
        }

        .btn {
            height: 50px;
        }

        .container {
            margin-top: 5vh;
            margin-bottom: 5vh;
        }

        .logoo {
            width: 350px !important;
            height: auto;
            margin-right: 20px;
        }

        /* Responsive styles */
        @media (max-width: 576px) {
            .logoo {
                width: 200px !important;
                height: auto;
                margin-top: 0 !important;
                margin-right: 20px;
            }

            h4 {
                font-size: 1rem;
            }

            .thk {
                font-size: 18px !important;
            }

            .form {
                font-size: 15px !important;
            }
        }

        .triangle-image-wrapper {
            height: 90px;
            position: relative;
        }

        .triangle-img {
            position: absolute;
            max-width: 600px;
            width: 25%;
            height: auto;
        }

        /* Kiri Atas */
        .img-1 {
            top: 0;
            left: 0;
            width: 280px;
            margin-top: 25px;
        }

        /* Kanan Atas */
        .img-3 {
            top: 0;
            right: 0;
            width: 230px;
            margin-right: 20px;
        }

        /* Tengah Bawah */
        .img-2 {
            bottom: 0;
            left: 50%;
            width: {{ session('logo_size') ?? 300 }}px;
            transform: translateX(-50%);
        }

        .powered {
            margin-top: 5px !important;
        }

        .powered p {
            font-size: 10px;
            color: #939393;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 576px) {
            .triangle-image-wrapper {
                height: 40px;
            }

            .triangle-img {
                max-width: 350px;
                width: 30%;
            }

            .img-1 {
                width: 150px;
            }

            .img-2 {
                width: {{ session('logo_size_mobile') ?? 200 }}px;
            }

            .img-3 {
                width: 100px;
                margin-right: 20px;
                margin-top: 19px;
            }

            .powered {
                margin-top: 14px;
            }

            .powered p {
                font-size: 9px;
                color: #939393;
            }
        }

        .iti {
            width: 100% !important;
        }

        svg {
            width: 100px;
            height: 100px;
            stroke: yellowgreen;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            {{-- <div class="container position-relative triangle-image-wrapper my-1">
                @if (session('logo'))
                    <img src="{{ asset(session('logo')) }}" class="triangle-img img-2" alt="Image 2">
                @else
                    <img src="{{ asset('assets/background/uid.png') }}" class="triangle-img img-2" alt="Image 2">
                @endif
            </div> --}}
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg> <br>
                @if (session('subject'))
                    <label class="thk" style="font-size: 20px; color: rgb(47, 129, 206)">
                        <b>{{ session('subject') }}</b>
                    </label>
                @else
                    <label class="thk" style="font-size: 20px; color: rgb(47, 129, 206)">
                        <b>Thank you for your registration</b>
                    </label>
                @endif
                <div style="max-width: 700px; margin: 0 auto; margin-top: 10px;">
                    @if (session('description_notif'))
                        {!! session('description_notif') !!}
                    @else
                        <p>
                            We will be sending a confirmation of your registration with further details closer to date.
                            Meanwhile, should you have any questions, please do not hesitate to contact United In
                            Diversity at email:
                            <a href="mailto:contact@uid.or.id" style="text-decoration: none;">contact@uid.or.id</a>
                        </p>
                        <p>
                            Yours sincerely, <br>
                            United In Diversity
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("myForm").addEventListener("submit", function(e) {
            e.preventDefault(); // Jangan langsung submit form

            const form = this;
            const requiredFields = form.querySelectorAll("[required]");
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                }
            });

            if (isValid) {
                // Tampilkan loading swal dan submit form setelahnya
                Swal.fire({
                    html: '<img src="https://ems.uid.or.id/img/profile/logo/loading-animation.gif" style="width: 220px; height: 220px;"/>',
                    timer: 60000000,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        form.submit();
                    }
                });
            } else {
                // Optional: bisa juga tampilkan error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields.',
                });
            }
        });
    </script>
    <script>
        const checkboxes = document.querySelectorAll('.topic-checkbox');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                const checked = document.querySelectorAll('.topic-checkbox:checked');

                // Batas maksimal 2
                if (checked.length > 1) {
                    checkbox.checked = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'You can only choose up to 1 breakout group sessions.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonColor: "#0d6efd",
                        confirmButtonText: "OK",
                    });
                }

                // Atur required hanya pada checkbox pertama
                if (checked.length >= 1) {
                    checkboxes.forEach(cb => cb.required = false);
                } else {
                    checkboxes.forEach(cb => cb.required = true);
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const phoneInput = document.querySelector("#phone");
        const fullPhoneInput = document.querySelector("#full_phone");
        const form = document.querySelector("#myForm");

        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "id",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        form.addEventListener("submit", function(e) {
            const dialCode = iti.getSelectedCountryData().dialCode;
            const number = phoneInput.value.trim();

            const fullPhone = `+${dialCode}${number}`;
            fullPhoneInput.value = fullPhone;
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thank you for filling out the registation form!',
                text: 'Our committee will process your registration as soon as possible!',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: "#0d6efd",
                confirmButtonText: "OK",
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: '{{ session('error') }}',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#d33'
                confirmButtonText: "OK",
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#d33'
                confirmButtonText: "OK",
            });
        </script>
    @endif
</body>

</html>
