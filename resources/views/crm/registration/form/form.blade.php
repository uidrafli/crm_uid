<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/logo/R-Tech-New.png') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <title>UID - Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
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
            height: 130px;
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
            width: 250px;
            margin-right: 20px;
        }

        /* Tengah Bawah */
        .img-2 {
            bottom: 0;
            left: 50%;
            width: {{ $data->logo_size ?? 300 }}px;
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
                height: 70px;
            }

            .triangle-img {
                max-width: 350px;
                width: 30%;
            }

            .img-1 {
                width: 150px;
            }

            .img-2 {
                width: {{ $data->logo_size_mobile ?? 300 }}px;
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
    </style>
</head>

<body>
    <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
        echo $_SESSION['info'];
    }
    unset($_SESSION['info']); ?>"></div>
    <div class="container">
        <div class="form-container">
            <div class="container position-relative triangle-image-wrapper my-1">
                <!-- Gambar 1: Kiri Atas -->
                {{-- <img src="{{ asset('assets/img/registration/siri.png') }}" class="triangle-img img-1" alt="Image 1"> --}}

                <!-- Gambar 3: Kanan Atas -->
                {{-- <img src="{{ asset('assets/img/registration/uid.png') }}" class="triangle-img img-3" alt="Image 3"> --}}

                <!-- Gambar 2: Tengah Bawah -->
                <img src="{{ asset($data->logo) }}" class="triangle-img img-2" alt="Image 2">
            </div>
            <div class="mt-3 text-center">
                <div style="max-width: 700px; margin: 0 auto;">
                    <label class="thk" style="font-size: 20px; color: rgb(0, 134, 217)">
                        <b>
                            {{ $data->title }}
                        </b>
                    </label>
                    <p class="mt-3">
                        Time: {{ $data->start_time }} - {{ $data->end_time }} WITA<br>
                        Date: {{ \Carbon\Carbon::parse($data->start_date)->format('l, d F Y') }}<br>
                        Location: {{ $data->location }}
                    </p>
                </div>
            </div>

            <form id="myForm" class="hdx-form" style="margin-top: 40px;" role="form"
                action="{{ url('/registration/submit-form') }}" method="post" enctype="multipart/form-data"
                class="mt-5">
                @csrf
                <div class="inventory-grup row g-3 mt-1">
                    <input type="hidden" name="key_events" class="form-control" value="{{ $data->key_events }}"
                        id="key_events">
                    <input type="hidden" name="name_events" class="form-control" value="{{ $data->title }}"
                        id="name_events">
                    @if ($data->salutation != null)
                        <div class="col-lg-6">
                            <label for="salutation" class="form-label"
                                style="color: #888888; font-weight: 700;">Salutation
                                @if ($data->salutation_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="salutation" {{ $data->salutation_required }}
                                id="salutation">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->fullname != null)
                        <div class="col-lg-6">
                            <label for="fullname" class="form-label" style="color: #888888; font-weight: 700;">Full Name
                                @if ($data->fullname_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="fullname" class="form-control"
                                placeholder="Please input your full name" {{ $data->fullname_required }}
                                id="fullname">
                        </div>
                    @endif

                    @if ($data->email != null)
                        <div class="col-lg-6">
                            <label for="email" class="form-label" style="color: #888888; font-weight: 700;">Email
                                Address
                                @if ($data->email_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Please input your email" {{ $data->email_required }} id="email">
                        </div>
                    @endif

                    @if ($data->phone != null)
                        <div class="col-lg-6">
                            <label for="phone" class="form-label" style="color: #808080; font-weight: 700;">Phone
                                Number
                                @if ($data->phone_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label><br>
                            <input type="tel" id="phone" name="phones" class="form-control required wajib"
                                placeholder="Please input your phone number that is connected to WhatsApp"
                                {{ $data->phone_required }}>
                            <input type="hidden" name="phone" id="full_phone">
                        </div>
                    @endif

                    @if ($data->institution != null)
                        <div class="col-lg-6">
                            <label for="institution" class="form-label"
                                style="color: #888888; font-weight: 700;">Institution/Organixation
                                @if ($data->institution_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="institution" class="form-control required"
                                placeholder="Please input your company or institution"
                                {{ $data->institution_required }} id="institution">
                        </div>
                    @endif

                    @if ($data->position != null)
                        <div class="col-lg-6">
                            <label for="position" class="form-label" style="color: #888888; font-weight: 700;">Role or
                                Position
                                @if ($data->position_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="position" class="form-control required"
                                placeholder="Please input your position or role in your company or institution"
                                {{ $data->position_required }} id="position">
                        </div>
                    @endif

                    @if ($data->sector != null)
                        <div class="col-lg-6">
                            <label for="sector" class="form-label" style="color: #888888; font-weight: 700;">Sector
                                @if ($data->sector_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="sector" {{ $data->sector_required }}
                                id="sector">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Government">Government</option>
                                <option value="Business">Business</option>
                                <option value="Civil Society">Civil Society</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->field != null)
                        <div class="col-lg-6">
                            <label for="field" class="form-label" style="color: #888888; font-weight: 700;">Field
                                @if ($data->field_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="field" {{ $data->field_required }}
                                id="field">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Leadership">Leadership</option>
                                <option value="Forestry">Forestry</option>
                                <option value="Technology">Technology</option>
                                <option value="Creative Economy & Industry">Creative Economy & Industry</option>
                                <option value="Education, Capacity Building, and Youth Empowerment">Education, Capacity Building, and Youth Empowerment</option>
                                <option value="Blended & Sustainable Finance">Blended & Sustainable Finance</option>
                                <option value="Energy">Energy</option>
                                <option value="Equality & Inclusion">Equality & Inclusion</option>
                                <option value="Health, Wellbeing & Sports">Health, Wellbeing & Sports</option>
                                <option value="Good Governance & Leadership">Good Governance & Leadership</option>
                                <option value="MSME & Entrepreneurship">MSME & Entrepreneurship</option>
                                <option value="Regenerative Landscape and Community Livelihood">Regenerative Landscape and Community Livelihood</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->country != null)
                        <div class="col-lg-12">
                            <label for="country" class="form-label"
                                style="color: #888888; font-weight: 700;">Country Origin
                                @if ($data->country_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="country" style="width: 100%;">
                                <option value="" disabled selected>--Select a Country--</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}">
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- <div class="col-lg-6">
                        <label for="instagram" class="form-label">Instagram Username : </label>
                        <input type="text" name="instagram" class="form-control required"
                            placeholder="Please input your instagram" id="instagram">
                    </div>
                    
                    <div class="col-lg-6">
                        <label for="linkedin" class="form-label">LinkedIn Username : </label>
                        <input type="text" name="linkedin" class="form-control required"
                            placeholder="Please input your linkedin" id="linkedin">
                    </div>

                    <div class="col-lg-12">
                        <label for="join_melali" class="form-label">Will you join us on UID Melali - Workshop in
                            Serangan Plastic Recylce Center on Tuesday, 31st March 2026? <span
                                class="text-danger"><i>Limited for 30 participants, selected participants will be
                                    contacted via email</i></span> :</label>
                        <select class="form-select form-control" name="join_melali" id="join_melali">
                            <option value="" disabled selected>--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-lg-12">
                        <label for="desc_interested" class="form-label">Why are you interested in learning about
                            Plastic Recycling Process? <span class="text-danger"><i>(100 words answer max)</i></span> :
                        </label>
                        <textarea type="text" style="height: 75px;" name="desc_interested" class="form-control required"
                            placeholder="Please input your answer" id="desc_interested"></textarea>
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label">
                            Choose your Workshop Sharing Circle Group: <span class="text-danger">*</span>
                        </label>

                        <div class="form-check mt-1 align-items-start">

                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout" value="Circle 1 - Fix Your CV Before It Fixes You"
                                id="topic1" required>

                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic1" style="line-height:1.4;">
                                Circle 1 - Fix Your CV Before It Fixes You
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 2 - Ace the Interview: Say It Right, Stand Out" id="topic2" required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic2" style="line-height:1.4;">
                                Circle 2 - Ace the Interview: Say It Right, Stand Out
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 3 - Building and Showcasing Your Professional Portfolio" id="topic3"
                                required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic3" style="line-height:1.4;">
                                Circle 3 - Building and Showcasing Your Professional Portfolio
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 4 - Mapping Your Career: From Confused to Clear" id="topic4"
                                required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic4" style="line-height:1.4;">
                                Circle 4 - Mapping Your Career: From Confused to Clear
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 5 - What They Don’t Teach You About Work" id="topic5" required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic5" style="line-height:1.4;">
                                Circle 5 - What They Don’t Teach You About Work
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 6 - Breaking Into Your First Job with Robi Kurnia - Marketing Communication Manager UID Foundation"
                                id="topic6" required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic6" style="line-height:1.4;">
                                Circle 6 - Breaking Into Your First Job with Robi Kurnia - Marketing Communication
                                Manager UID Foundation
                            </label>
                        </div>

                        <div class="form-check mt-1 align-items-start">
                            <input class="form-check-input me-2 topic-checkbox required"
                                style="transform: scale(1.3);
           -webkit-transform: scale(1.3);
           -ms-transform: scale(1.3);"
                                type="checkbox" name="breakout"
                                value="Circle 7 -  Tell Your Story: Crafting Your Personal Narrative with Anak Agung Istri Putri Dwijayanti - Marketing and Public Relations Manager at LSPR Institute of Communication & Business Bali"
                                id="topic7" required>
                            <label class="form-check-label" style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;" for="topic7" style="line-height:1.4;">
                                Circle 7 - Tell Your Story: Crafting Your Personal Narrative with Anak Agung Istri Putri
                                Dwijayanti - Marketing and Public Relations Manager at LSPR Institute of Communication &
                                Business Bali
                            </label>
                        </div>

                    </div> --}}

                    <div class="col-lg-12" style="margin-top: 40px; text-align: center;">
                        <label for="" style="font-size: 16px;"><b>Data Privacy and Confidentiality
                                Assurance</b></label>
                        <p>
                            We are committed to safeguarding the personal information of all applicants. We will not
                            misuse, share, or disclose participant data without clear consent. All information provided
                            will be handled with the utmost care, in a discreet and responsible manner, solely for the
                            purpose of program development, and communication.
                        </p>
                    </div>
                    <div class="tombol mt-1">
                        <button type="submit" id="submitBtn" class="btn btn-primary w-100" style="height: 50px;">
                            <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <b>Submit</b></span>
                            <span id="btnSpinner" class="spinner-border d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const phoneInput = document.querySelector("#phone");
        const fullPhoneInput = document.querySelector("#full_phone");

        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "id",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Saat form disubmit, gabungkan kode negara dan nomor
        phoneInput.form.addEventListener("submit", function() {
            const dialCode = iti.getSelectedCountryData().dialCode;
            const phoneNumber = phoneInput.value.trim();
            const fullPhone = `+${dialCode} ${phoneNumber}`;
            fullPhoneInput.value = fullPhone;
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
                        title: 'You can only choose up to 1 group sessions.',
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
    <script>
        // Cek apakah session 'info' ada dan nilainya 'Success'
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'success'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Thank you for filling out the registation form!',
            text: 'We will process your request as soon as possible!',
            allowOutsideClick: false,
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['alert']); // Hapus session info setelah ditampilkan
        ?>
        <?php endif; ?>
    </script>
    <script>
        // Cek apakah session 'info' ada dan nilainya 'Success'
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'error'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Room is booked, find another room!',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['alert']); // Hapus session info setelah ditampilkan
        ?>
        <?php endif; ?>
    </script>
    <script>
        // Cek apakah session 'info' ada dan nilainya 'Success'
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'errorPdo'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Server network error, please try again!',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['alert']); // Hapus session info setelah ditampilkan
        ?>
        <?php endif; ?>
    </script>
</body>

</html>
