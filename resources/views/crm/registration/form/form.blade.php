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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- fullCalendar 2.2.5-->
    <title>UID - Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        .select2-container .select2-selection--single {
            height: 45px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px !important;
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
                @if (!empty($data->logo))
                    <img src="{{ asset($data->logo) }}" class="triangle-img img-2" alt="Image 2">
                @else
                    <img src="{{ asset('assets/background/uid.png') }}" class="triangle-img img-2" alt="Image 2">
                @endif
            </div>
            <div class="mt-3 text-center">
                <div style="max-width: 700px; margin: 0 auto;">
                    <label class="thk" style="font-size: 20px; color: rgb(0, 134, 217)">
                        <b>
                            {{ $data->title }}
                        </b>
                    </label>
                    <p class="mt-3">
                        Time: {{ $data->start_time }} - {{ $data->end_time }} {{ $data->time_zone }}<br>
                        Date: {{ \Carbon\Carbon::parse($data->start_date)->format('l, d F Y') }}<br>
                        Location: {{ $data->location }}
                    </p>
                    <p class="mt-3" style="text-align: justify;">
                        {!! $data->description !!}
                    </p>
                </div>
            </div>

            @php
                $fieldsArray = [];
                // 1. Kumpulkan semua data field ke dalam array
                $fieldsArray[] = [
                    'id' => 'salutation',
                    'is_active' => $data->salutation != null,
                    'is_required' => $data->salutation_required != null ? 'required' : '',
                    'width_box' => $data->salutation_width,
                    'order' => $data->salutation_orderby ?? 99, // Asumsi nama kolom order-nya. Angka 99 agar field yg tidak punya urutan ditaruh paling bawah
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'fullname',
                    'is_active' => $data->fullname != null,
                    'is_required' => $data->fullname_required != null ? 'required' : '',
                    'width_box' => $data->fullname_width,
                    'order' => $data->fullname_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'sex',
                    'is_active' => $data->sex != null,
                    'is_required' => $data->sex_required != null ? 'required' : '',
                    'width_box' => $data->sex_width,
                    'order' => $data->sex_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'email',
                    'is_active' => $data->email != null,
                    'is_required' => $data->email_required != null ? 'required' : '',
                    'width_box' => $data->email_width,
                    'order' => $data->email_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'phone',
                    'is_active' => $data->phone != null,
                    'is_required' => $data->phone_required != null ? 'required' : '',
                    'width_box' => $data->phone_width,
                    'order' => $data->phone_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'institution',
                    'is_active' => $data->institution != null,
                    'is_required' => $data->institution_required != null ? 'required' : '',
                    'width_box' => $data->institution_width,
                    'order' => $data->institution_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'position',
                    'is_active' => $data->position != null,
                    'is_required' => $data->position_required != null ? 'required' : '',
                    'width_box' => $data->position_width,
                    'order' => $data->position_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'sector',
                    'is_active' => $data->sector != null,
                    'is_required' => $data->sector_required != null ? 'required' : '',
                    'width_box' => $data->sector_width,
                    'order' => $data->sector_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'field',
                    'is_active' => $data->field != null,
                    'is_required' => $data->field_required != null ? 'required' : '',
                    'width_box' => $data->field_width,
                    'order' => $data->field_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'socialmedia',
                    'is_active' => $data->socialmedia != null,
                    'is_required' => $data->socialmedia_required != null ? 'required' : '',
                    'width_box' => $data->socialmedia_width,
                    'order' => $data->socialmedia_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'linkedin',
                    'is_active' => $data->linkedin != null,
                    'is_required' => $data->linkedin_required != null ? 'required' : '',
                    'width_box' => $data->linkedin_width,
                    'order' => $data->linkedin_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'citylived',
                    'is_active' => $data->citylived != null,
                    'is_required' => $data->citylived_required != null ? 'required' : '',
                    'width_box' => $data->citylived_width,
                    'order' => $data->citylived_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'country',
                    'is_active' => $data->country != null,
                    'is_required' => $data->country_required != null ? 'required' : '',
                    'width_box' => $data->country_width,
                    'order' => $data->country_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'birthday',
                    'is_active' => $data->birthday != null,
                    'is_required' => $data->birthday_required != null ? 'required' : '',
                    'width_box' => $data->birthday_width,
                    'order' => $data->birthday_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'latesteducation',
                    'is_active' => $data->latesteducation != null,
                    'is_required' => $data->latesteducation_required != null ? 'required' : '',
                    'width_box' => $data->latesteducation_width,
                    'order' => $data->latesteducation_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'englishproficiency',
                    'is_active' => $data->englishproficiency != null,
                    'is_required' => $data->englishproficiency_required != null ? 'required' : '',
                    'width_box' => $data->englishproficiency_width,
                    'order' => $data->englishproficiency_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'uploadfile',
                    'is_active' => $data->uploadfile != null,
                    'is_required' => $data->uploadfile_required != null ? 'required' : '',
                    'width_box' => $data->uploadfile_width,
                    'order' => $data->uploadfile_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'fellowship',
                    'is_active' => $data->fellowship != null,
                    'is_required' => $data->fellowship_required != null ? 'required' : '',
                    'width_box' => $data->fellowship_width,
                    'order' => $data->fellowship_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'essay',
                    'is_active' => $data->essay != null,
                    'is_required' => $data->essay_required != null ? 'required' : '',
                    'width_box' => $data->essay_width,
                    'order' => $data->essay_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'roleworkshop',
                    'is_active' => $data->roleworkshop != null,
                    'is_required' => $data->roleworkshop_required != null ? 'required' : '',
                    'width_box' => $data->roleworkshop_width,
                    'order' => $data->roleworkshop_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'attendance',
                    'is_active' => $data->attendance != null,
                    'is_required' => $data->attendance_required != null ? 'required' : '',
                    'width_box' => $data->attendance_width,
                    'order' => $data->attendance_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'allergy',
                    'is_active' => $data->allergy != null,
                    'is_required' => $data->allergy_required != null ? 'required' : '',
                    'width_box' => $data->allergy_width,
                    'order' => $data->allergy_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'meal',
                    'is_active' => $data->meal != null,
                    'is_required' => $data->meal_required != null ? 'required' : '',
                    'width_box' => $data->meal_width,
                    'order' => $data->meal_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'disability',
                    'is_active' => $data->disability != null,
                    'is_required' => $data->disability_required != null ? 'required' : '',
                    'width_box' => $data->disability_width,
                    'order' => $data->disability_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'language',
                    'is_active' => $data->language != null,
                    'is_required' => $data->language_required != null ? 'required' : '',
                    'width_box' => $data->language_width,
                    'order' => $data->language_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'bio',
                    'is_active' => $data->bio != null,
                    'is_required' => $data->bio_required != null ? 'required' : '',
                    'width_box' => $data->bio_width,
                    'order' => $data->bio_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'picture',
                    'is_active' => $data->picture != null,
                    'is_required' => $data->picture_required != null ? 'required' : '',
                    'width_box' => $data->picture_width,
                    'order' => $data->picture_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'availdoc',
                    'is_active' => $data->availdoc != null,
                    'is_required' => $data->availdoc_required != null ? 'required' : '',
                    'width_box' => $data->availdoc_width,
                    'order' => $data->availdoc_orderby ?? 99,
                    'is_custom' => false,
                ];
                $fieldsArray[] = [
                    'id' => 'iconsent',
                    'is_active' => $data->iconsent != null,
                    'is_required' => $data->iconsent_required != null ? 'required' : '',
                    'width_box' => $data->iconsent_width,
                    'order' => $data->iconsent_orderby ?? 99,
                    'is_custom' => false,
                ];

                for ($i = 1; $i <= 6; $i++) {
                    if (isset($json_data[$i]['custome'])) {
                        $fieldsArray[] = [
                            'id' => 'custome_' . $i,
                            'is_active' => true, // Selalu true karena sudah di-cek isset
                            'is_required' => $json_data[$i]['custome_required'] ?? '',
                            'order' => $json_data[$i]['orderby'] ?? 99, // Ambil nilai orderby dari JSON
                            'is_custom' => true, // Penanda INI ADALAH custom field
                            'original_index' => $i, // Simpan angka asli (1-6)
                            'custom_data' => $json_data[$i], // Simpan seluruh data JSON-nya di sini
                        ];
                    }
                }

                // 2. Filter hanya field yang aktif (!= null), lalu urutkan dari terkecil ke terbesar berdasarkan 'order'
                $sortedFields = collect($fieldsArray)->where('is_active', true)->sortBy('order');
            @endphp

            <form id="myForm" class="hdx-form" style="margin-top: 40px;" role="form"
                action="{{ url('/registration/submit-form') }}" method="post" enctype="multipart/form-data"
                class="mt-5">
                @csrf
                <div class="inventory-grup row g-3 mt-1">

                    {{-- Input Hidden --}}
                    <input type="hidden" name="key_events" class="form-control" value="{{ $data->key_events }}"
                        id="key_events">
                    <input type="hidden" name="name_events" class="form-control" value="{{ $data->title }}"
                        id="name_events">
                    <input type="hidden" name="users_role" class="form-control" value="{{ $data->users_role }}"
                        id="users_role">
                    <input type="hidden" name="date_events" class="form-control" value="{{ $data->start_date }}"
                        id="date_events">
                    <input type="hidden" name="subject" class="form-control" value="{{ $data->subject }}"
                        id="subject">
                    <input type="hidden" name="description_notif" class="form-control"
                        value="{{ $data->description_notif }}" id="description_notif">
                    <input type="hidden" name="logo" class="form-control" value="{{ $data->logo }}"
                        id="logo">
                    <input type="hidden" name="attach_email" class="form-control" value="{{ $data->attachment }}"
                        id="attach_email">
                    <input type="hidden" name="logo_size" class="form-control" value="{{ $data->logo_size }}"
                        id="logo_size">
                    <input type="hidden" name="logo_size_mobile" class="form-control"
                        value="{{ $data->logo_size_mobile }}" id="logo_size_mobile">
                    {{-- Input Hidden --}}

                    @foreach ($sortedFields as $field)

                        {{-- JIKA INI ADALAH CUSTOM FIELD (JSON) --}}
                        @if ($field['is_custom'])
                            @php
                                $i = $field['original_index'];
                                $cField = $field['custom_data'];
                            @endphp

                            <div class="col-lg-{{ $cField['width'] ?? '12' }} mb-3">
                                <input type="hidden" name="label_{{ $i }}" class="form-control"
                                    value="{{ $cField['label'] ?? '' }}" id="label_{{ $i }}">

                                <label for="custome_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">
                                    {{ $cField['label'] ?? '' }}

                                    @if (!empty($cField['custome_size']) && !empty($cField['extensions']))
                                        <span class="text-danger"><i>Max: {{ $cField['custome_size'] / 1024 }}MB
                                                (@foreach ($cField['extensions'] as $ext)
                                                    .{{ $ext }}
                                                @endforeach)
                                            </i></span>
                                    @endif

                                    @if (!empty($cField['custome_required']))
                                        <span class="text-danger"><b>*</b></span>
                                    @endif
                                </label>

                                @if ($cField['type'] == 'select')
                                    <select class="form-select form-control" name="custome_{{ $i }}"
                                        {{ $cField['custome_required'] ?? '' }} id="custome_{{ $i }}">
                                        <option value="" disabled selected>--Select--</option>
                                        @if (!empty($cField['options']))
                                            @foreach (explode('|', $cField['options']) as $option)
                                                <option value="{{ trim($option) }}">{{ trim($option) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @elseif ($cField['type'] == 'textarea')
                                    <textarea name="custome_{{ $i }}" class="form-control" id="custome_{{ $i }}" rows="3"
                                        style="height: 100px;" {{ $cField['custome_required'] ?? '' }}></textarea>
                                @elseif ($cField['type'] == 'checkbox')
                                    @if (!empty($cField['options']))
                                        <div class="checkbox-group" data-max="{{ $cField['custome_check'] ?? 1 }}">
                                            @foreach (explode('|', $cField['options']) as $index => $option)
                                                @php $option = trim($option); @endphp
                                                <div class="d-flex align-items-start mb-2">
                                                    <input
                                                        class="form-check-input mt-1 {{ empty($cField['custome_check']) ? '' : 'topic-checkbox' }}"
                                                        style="transform: scale(1.3); flex-shrink: 0;" type="checkbox"
                                                        name="custome_{{ $i }}[]"
                                                        value="{{ $option }}"
                                                        id="custome_opt_{{ $i }}_{{ $index }}"
                                                        {{ $cField['custome_required'] ?? '' }}>
                                                    <label class="form-check-label ms-2"
                                                        style="color: #888888; font-weight: 500;"
                                                        for="custome_opt_{{ $i }}_{{ $index }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @elseif ($cField['type'] == 'file')
                                    @php $extensions = is_array($cField['extensions'] ?? null) ? implode(',', $cField['extensions']) : ''; @endphp
                                    <input type="hidden" name="extensions_{{ $i }}"
                                        value="{{ $extensions }}">
                                    <input type="hidden" name="size_{{ $i }}"
                                        value="{{ $cField['custome_size'] ?? '' }}">
                                    <input type="file" name="custome_{{ $i }}" class="form-control"
                                        {{ $cField['custome_required'] ?? '' }} id="custome_{{ $i }}">
                                @else
                                    <input type="{{ $cField['type'] ?? 'text' }}" name="custome_{{ $i }}"
                                        class="form-control"
                                        placeholder="Please input your {{ $cField['label'] ?? '' }}"
                                        {{ $cField['custome_required'] ?? '' }} id="custome_{{ $i }}">
                                @endif
                            </div>

                            {{-- JIKA INI ADALAH STATIC FIELD (DATABASE UTAMA) --}}
                        @else
                            @switch($field['id'])
                                @case('salutation')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="salutation" class="form-label"
                                            style="color: #888888; font-weight: 700;">Salutation
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="salutation"
                                            {{ $field['is_required'] }} id="salutation">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="H.E.">H.E.</option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Prof.">Prof.</option>
                                            <option value="Sir.">Sir.</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Ms.">Ms.</option>
                                        </select>
                                    </div>
                                @break

                                @case('fullname')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="fullname" class="form-label"
                                            style="color: #888888; font-weight: 700;">Full Name
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="fullname" class="form-control"
                                            placeholder="Please input your full name" {{ $field['is_required'] }}
                                            id="fullname">
                                    </div>
                                @break

                                @case('sex')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="sex" class="form-label"
                                            style="color: #888888; font-weight: 700;">Sex
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="sex" {{ $field['is_required'] }}
                                            id="sex">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                @break

                                @case('email')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="email" class="form-label"
                                            style="color: #888888; font-weight: 700;">Email
                                            Address
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Please input your email" {{ $field['is_required'] }} id="email">
                                    </div>
                                @break

                                @case('phone')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="phone" class="form-label"
                                            style="color: #888888; font-weight: 700;">Phone
                                            Number
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="tel" id="phone" name="phones"
                                            class="form-control required wajib"
                                            placeholder="Please input your phone number that is connected to WhatsApp"
                                            {{ $field['is_required'] }}>
                                        <input type="hidden" name="phone" id="full_phone">
                                    </div>
                                @break

                                @case('institution')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="institution" class="form-label"
                                            style="color: #888888; font-weight: 700;">Institution/Organization
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="institution" class="form-control required"
                                            placeholder="Please input your company or institution" {{ $field['is_required'] }}
                                            id="institution">
                                    </div>
                                @break

                                @case('position')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="position" class="form-label"
                                            style="color: #888888; font-weight: 700;">Role
                                            or Position
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="position" class="form-control required"
                                            placeholder="Please input your position" {{ $field['is_required'] }}
                                            id="position">
                                    </div>
                                @break

                                @case('sector')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="sector" class="form-label"
                                            style="color: #888888; font-weight: 700;">Sector
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="sector" {{ $field['is_required'] }}
                                            id="sector">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Government">Government</option>
                                            <option value="Business">Business</option>
                                            <option value="Civil Society">Civil Society</option>
                                        </select>
                                    </div>
                                @break

                                @case('field')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="field" class="form-label"
                                            style="color: #888888; font-weight: 700;">Field
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="field" {{ $field['is_required'] }}
                                            id="field">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Leadership">Leadership</option>
                                            <option value="Forestry">Forestry</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Creative Economy & Industry">Creative Economy & Industry</option>
                                            <option value="Education, Capacity Building, and Youth Empowerment">Education,
                                                Capacity
                                                Building, and Youth Empowerment</option>
                                            <option value="Blended & Sustainable Finance">Blended & Sustainable Finance
                                            </option>
                                            <option value="Energy">Energy</option>
                                            <option value="Equality & Inclusion">Equality & Inclusion</option>
                                            <option value="Health, Wellbeing & Sports">Health, Wellbeing & Sports</option>
                                            <option value="Good Governance & Leadership">Good Governance & Leadership</option>
                                            <option value="MSME & Entrepreneurship">MSME & Entrepreneurship</option>
                                            <option value="Regenerative Landscape and Community Livelihood">Regenerative
                                                Landscape
                                                and Community Livelihood</option>
                                        </select>
                                    </div>
                                @break

                                @case('socialmedia')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="socialmedia" class="form-label"
                                            style="color: #888888; font-weight: 700;">Social Media
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="socialmedia" class="form-control required"
                                            placeholder="Please input your socialmedia" {{ $field['is_required'] }}
                                            id="socialmedia">
                                    </div>
                                @break

                                @case('linkedin')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="linkedin" class="form-label"
                                            style="color: #888888; font-weight: 700;">LinkedIn
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="linkedin" class="form-control required"
                                            placeholder="Please input your linkedin" {{ $field['is_required'] }}
                                            id="linkedin">
                                    </div>
                                @break

                                @case('citylived')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="citylived" class="form-label"
                                            style="color: #888888; font-weight: 700;">City
                                            Lived
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="citylived" class="form-control required"
                                            placeholder="Please input your citylived" {{ $field['is_required'] }}
                                            id="citylived">
                                    </div>
                                @break

                                @case('country')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="country" class="form-label"
                                            style="color: #888888; font-weight: 700;">Country Origin
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="country" {{ $field['is_required'] }}
                                            style="width: 100%;">
                                            <option value="" disabled selected>--Select a Country--</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}">
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @break

                                @case('birthday')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="birthday" class="form-label"
                                            style="color: #888888; font-weight: 700;">Date
                                            of Birth
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="date" name="birthday" class="form-control required"
                                            placeholder="Please input your birthday" {{ $field['is_required'] }}
                                            id="birthday">
                                    </div>
                                @break

                                @case('latesteducation')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="latesteducation" class="form-label"
                                            style="color: #888888; font-weight: 700;">Latest Education
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="latesteducation" class="form-control required"
                                            placeholder="Please input your latesteducation" {{ $field['is_required'] }}
                                            id="latesteducation">
                                    </div>
                                @break

                                @case('englishproficiency')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="englishproficiency" class="form-label"
                                            style="color: #888888; font-weight: 700;">English Proficiency
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="text" name="englishproficiency" class="form-control required"
                                            placeholder="Please input your englishproficiency" {{ $field['is_required'] }}
                                            id="englishproficiency">
                                    </div>
                                @break

                                @case('uploadfile')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="uploadfile" class="form-label"
                                            style="color: #888888; font-weight: 700;">Upload CV
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="file" name="uploadfile" style="height: 47px !important;"
                                            class="form-control required" placeholder="Please input your uploadfile"
                                            {{ $field['is_required'] }} id="uploadfile">
                                    </div>
                                @break

                                @case('fellowship')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="fellowship" class="form-label"
                                            style="color: #888888; font-weight: 700;">How
                                            do you know about this Fellowship
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="fellowship"
                                            {{ $field['is_required'] }} id="fellowship">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Social Media @uidindonesia">Social Media @uidindonesia</option>
                                            <option value="Website unitedindiversity.org">Website unitedindiversity.org
                                            </option>
                                            <option value="Reference by UID Fellows">Reference by UID Fellows</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <input type="text" class="form-control mt-1" name="other_fellowship"
                                            id="other_fellowship" id="other_fellowship_div" style="display:none;"
                                            placeholder="Please input others specify">
                                    </div>
                                @break

                                @case('essay')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="essay" class="form-label"
                                            style="color: #888888; font-weight: 700;">Upload
                                            Essay
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="file" name="essay" style="height: 47px !important;"
                                            class="form-control required" placeholder="Please input your essay"
                                            {{ $field['is_required'] }} id="essay">
                                    </div>
                                @break

                                @case('roleworkshop')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="roleworkshop" class="form-label"
                                            style="color: #888888; font-weight: 700;">Role in Workshop
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="roleworkshop"
                                            {{ $field['is_required'] }} id="roleworkshop">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Speaker / Panelist">Speaker / Panelist</option>
                                            <option value="Moderator">Moderator</option>
                                            <option value="Session Participant (invite-only)">Session Participant (invite-only)
                                            </option>
                                            <option value="Delegation Lead">Delegation Lead</option>
                                            <option value="Media Representative">Media Representative</option>
                                            <option value="Observer">Observer</option>
                                            <option value="B2B Meeting Participant">B2B Meeting Participant</option>
                                            <option value="Workshop Facilitator">Workshop Facilitator</option>
                                            <option value="Exhibitor / Innovation Pavilion">Exhibitor / Innovation Pavilion
                                            </option>
                                        </select>
                                    </div>
                                @break

                                @case('attendance')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="attendance" class="form-label"
                                            style="color: #888888; font-weight: 700;">Attendance Type
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="attendance"
                                            {{ $field['is_required'] }} id="attendance">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Full Access (Plenary + Closed Sessions)">Full Access (Plenary +
                                                Closed
                                                Sessions)</option>
                                            <option value="Media Pass">Media Pass</option>
                                            <option value="Partner / Sponsor Access">Partner / Sponsor Access</option>
                                            <option value="Day Pass (specific date)">Day Pass (specific date)</option>
                                            <option value="Virtual Participant">Virtual Participant</option>
                                            <option value="Side Event Only">Side Event Only</option>
                                        </select>
                                    </div>
                                @break

                                @case('allergy')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="allergy" class="form-label"
                                            style="color: #888888; font-weight: 700;">Food
                                            Allergy / Intolerance
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="allergy" {{ $field['is_required'] }}
                                            id="allergy">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="None">None</option>
                                            <option value="Peanuts">Peanuts</option>
                                            <option value="Tree nuts (e.g., almond, walnut, cashew)">Tree nuts (e.g., almond,
                                                walnut, cashew)</option>
                                            <option value="Shellfish (e.g., shrimp, crab, lobster)">Shellfish (e.g., shrimp,
                                                crab,
                                                lobster)</option>
                                            <option value="Fish">Fish</option>
                                            <option value="Milk / Dairy">Milk / Dairy</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <input type="text" class="form-control mt-1" name="other_allergy"
                                            id="other_allergy" style="display:none;"
                                            placeholder="Please input others specify">
                                    </div>
                                @break

                                @case('meal')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="meal" class="form-label"
                                            style="color: #888888; font-weight: 700;">Meal
                                            Type
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="meal" {{ $field['is_required'] }}
                                            id="meal">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Regular (no restrictions)">Regular (no restrictions)</option>
                                            <option value="Vegetarian">Vegetarian</option>
                                            <option value="Vegan">Vegan</option>
                                            <option value="Halal">Halal</option>
                                            <option value="Kosher">Kosher</option>
                                            <option value="Gluten-free (medical)">Gluten-free (medical)</option>
                                            <option value="Dairy-free">Dairy-free</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <input type="text" class="form-control mt-1" name="other_meal" id="other_meal"
                                            style="display:none;" placeholder="Please input others specify">
                                    </div>
                                @break

                                @case('disability')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="disability" class="form-label"
                                            style="color: #888888; font-weight: 700;">Need
                                            Support for Disability
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="disability"
                                            {{ $field['is_required'] }} id="disability">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Regular (no restrictions)">Regular (no restrictions)</option>
                                            <option value="Vegetarian">Vegetarian</option>
                                            <option value="Vegan">Vegan</option>
                                            <option value="Halal">Halal</option>
                                            <option value="Kosher">Kosher</option>
                                            <option value="Gluten-free (medical)">Gluten-free (medical)</option>
                                            <option value="Dairy-free">Dairy-free</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <input type="text" class="form-control mt-1" name="other_disability"
                                            id="other_disability" style="display:none;"
                                            placeholder="Please input others specify">
                                    </div>
                                @break

                                @case('language')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="language" class="form-label"
                                            style="color: #888888; font-weight: 700;">Preferred Language for On-site Support
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="language" {{ $field['is_required'] }}
                                            id="language">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Bahasa">Bahasa</option>
                                            <option value="English">English</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <input type="text" class="form-control mt-1" name="other_language"
                                            id="other_language" style="display:none;"
                                            placeholder="Please input others specify">
                                    </div>
                                @break

                                @case('bio')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="bio" class="form-label"
                                            style="color: #888888; font-weight: 700;">Short
                                            Bio
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <textarea name="bio" class="form-control" id="bio" rows="3" style="height: 100px;"
                                            {{ $field['is_required'] }}></textarea>
                                    </div>
                                @break

                                @case('picture')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="picture" class="form-label"
                                            style="color: #888888; font-weight: 700;">Upload
                                            Professional Picture (Headshot)
                                            <span>
                                                Please upload a recent professional headshot (face clearly visible, neutral
                                                background, business attire). This will be used for: <br>
                                                - Event badge <br>
                                                - Participant directory <br>
                                                - Session materials (if applicable) <br>
                                                - Internal organizer records
                                            </span> <br>
                                            <span class="text-danger"><i>Max 10MB (.png .jpg .jpeg)</i></span>
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <input type="file" name="picture" style="height: 47px !important;"
                                            class="form-control required" placeholder="Please input your picture"
                                            {{ $field['is_required'] }} id="picture">
                                    </div>
                                @break

                                @case('availdoc')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <label for="availdoc" class="form-label"
                                            style="color: #888888; font-weight: 700;">Availability for Documentation and Use of
                                            Publication by the Organization
                                            @if ($field['is_required'])
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <select class="form-select form-control" name="availdoc" {{ $field['is_required'] }}
                                            id="availdoc">
                                            <option value="" disabled selected>--Select--</option>
                                            <option
                                                value="Yes – for external publication (social media, website, reports, promotional materials)">
                                                Yes – for external publication (social media, website, reports, promotional
                                                materials)</option>
                                            <option value="Yes – for internal organizational use only">Yes – for internal
                                                organizational use only</option>
                                            <option value="No – do not publish my documentation">No – do not publish my
                                                documentation</option>
                                            <option value="Depends (please explain in text box)">Depends (please explain in
                                                text
                                                box)</option>
                                        </select>
                                    </div>
                                @break

                                @case('iconsent')
                                    <div class="col-lg-{{ $field['width_box'] }}">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input mt-1"
                                                style="transform: scale(1.3);
                                    -webkit-transform: scale(1.3);
                                    -ms-transform: scale(1.3);
                                    flex-shrink: 0;"
                                                type="checkbox" name="iconsent"
                                                value="I consent to be contacted to arrange in-depth conversations related to the program with the Faculty."
                                                id="iconsent" {{ $field['is_required'] }}>

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px;" for="iconsent">
                                                I consent to be contacted to arrange in-depth conversations related to the
                                                program
                                                with the Faculty.
                                                @if ($field['is_required'])
                                                    <span class="text-danger"><b>*</b></span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @break
                            @endswitch
                        @endif
                    @endforeach

                    {{-- @if ($data->salutation != null)
                        <div class="col-lg-6">
                            <label for="salutation" class="form-label"
                                style="color: #888888; font-weight: 700;">Salutation
                                @if ($data->salutation_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="salutation"
                                {{ $data->salutation_required }} id="salutation">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->fullname != null)
                        <div class="col-lg-6">
                            <label for="fullname" class="form-label" style="color: #888888; font-weight: 700;">Full
                                Name
                                @if ($data->fullname_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="fullname" class="form-control"
                                placeholder="Please input your full name" {{ $data->fullname_required }}
                                id="fullname">
                        </div>
                    @endif

                    @if ($data->sex != null)
                        <div class="col-lg-6">
                            <label for="sex" class="form-label" style="color: #888888; font-weight: 700;">Sex
                                @if ($data->sex_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="sex" {{ $data->sex_required }}
                                id="sex">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
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
                            <label for="position" class="form-label" style="color: #888888; font-weight: 700;">Role
                                or
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
                                <option value="Education, Capacity Building, and Youth Empowerment">Education, Capacity
                                    Building, and Youth Empowerment</option>
                                <option value="Blended & Sustainable Finance">Blended & Sustainable Finance</option>
                                <option value="Energy">Energy</option>
                                <option value="Equality & Inclusion">Equality & Inclusion</option>
                                <option value="Health, Wellbeing & Sports">Health, Wellbeing & Sports</option>
                                <option value="Good Governance & Leadership">Good Governance & Leadership</option>
                                <option value="MSME & Entrepreneurship">MSME & Entrepreneurship</option>
                                <option value="Regenerative Landscape and Community Livelihood">Regenerative Landscape
                                    and Community Livelihood</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->socialmedia != null)
                        <div class="col-lg-6">
                            <label for="socialmedia" class="form-label"
                                style="color: #888888; font-weight: 700;">Social Media
                                @if ($data->socialmedia_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="socialmedia" class="form-control required"
                                placeholder="Please input your socialmedia" {{ $data->socialmedia_required }}
                                id="socialmedia">
                        </div>
                    @endif

                    @if ($data->linkedin != null)
                        <div class="col-lg-6">
                            <label for="linkedin" class="form-label"
                                style="color: #888888; font-weight: 700;">LinkedIn
                                @if ($data->linkedin_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="linkedin" class="form-control required"
                                placeholder="Please input your linkedin" {{ $data->linkedin_required }}
                                id="linkedin">
                        </div>
                    @endif

                    @if ($data->citylived != null)
                        <div class="col-lg-6">
                            <label for="citylived" class="form-label" style="color: #888888; font-weight: 700;">City
                                Lived
                                @if ($data->citylived_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="citylived" class="form-control required"
                                placeholder="Please input your citylived" {{ $data->citylived_required }}
                                id="citylived">
                        </div>
                    @endif

                    @if ($data->country != null)
                        <div class="col-lg-6">
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

                    @if ($data->birthday != null)
                        <div class="col-lg-6">
                            <label for="birthday" class="form-label" style="color: #888888; font-weight: 700;">Date
                                of Birth
                                @if ($data->birthday_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="date" name="birthday" class="form-control required"
                                placeholder="Please input your birthday" {{ $data->birthday_required }}
                                id="birthday">
                        </div>
                    @endif

                    @if ($data->latesteducation != null)
                        <div class="col-lg-6">
                            <label for="latesteducation" class="form-label"
                                style="color: #888888; font-weight: 700;">Latest Education
                                @if ($data->latesteducation_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="latesteducation" class="form-control required"
                                placeholder="Please input your latesteducation" {{ $data->latesteducation_required }}
                                id="latesteducation">
                        </div>
                    @endif

                    @if ($data->englishproficiency != null)
                        <div class="col-lg-6">
                            <label for="englishproficiency" class="form-label"
                                style="color: #888888; font-weight: 700;">English Proficiency
                                @if ($data->englishproficiency_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="text" name="englishproficiency" class="form-control required"
                                placeholder="Please input your englishproficiency"
                                {{ $data->englishproficiency_required }} id="englishproficiency">
                        </div>
                    @endif

                    @if ($data->uploadfile != null)
                        <div class="col-lg-6">
                            <label for="uploadfile" class="form-label"
                                style="color: #888888; font-weight: 700;">Upload CV
                                <span class="text-danger"><i>Max 5MB (.pdf)</i></span>
                                @if ($data->uploadfile_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="file" name="uploadfile" style="height: 47px !important;"
                                class="form-control required" placeholder="Please input your answer"
                                {{ $data->uploadfile_required }} id="uploadfile">
                        </div>
                    @endif

                    @if ($data->fellowship != null)
                        <div class="col-lg-6">
                            <label for="fellowship" class="form-label" style="color: #888888; font-weight: 700;">How
                                do you know about this Fellowship
                                @if ($data->fellowship_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="fellowship"
                                {{ $data->fellowship_required }} id="fellowship">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Social Media @uidindonesia">Social Media @uidindonesia</option>
                                <option value="Website unitedindiversity.org">Website unitedindiversity.org</option>
                                <option value="Reference by UID Fellows">Reference by UID Fellows</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" name="other_fellowship" id="other_fellowship"
                                id="other_fellowship_div" style="display:none;"
                                placeholder="Please input others specify">
                        </div>
                    @endif

                    @if ($data->essay != null)
                        <div class="col-lg-6">
                            <label for="essay" class="form-label" style="color: #888888; font-weight: 700;">Essay
                                <span class="text-danger"><i>Max 5MB (.pdf)</i></span>
                                @if ($data->essay_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="file" name="essay" style="height: 47px !important;"
                                class="form-control required" placeholder="Please input your answer"
                                {{ $data->essay_required }} id="essay">
                        </div>
                    @endif

                    @if ($data->roleworkshop != null)
                        <div class="col-lg-6">
                            <label for="roleworkshop" class="form-label"
                                style="color: #888888; font-weight: 700;">Role in Workshop
                                @if ($data->roleworkshop_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="roleworkshop"
                                {{ $data->roleworkshop_required }} id="roleworkshop">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Speaker / Panelist">Speaker / Panelist</option>
                                <option value="Moderator">Moderator</option>
                                <option value="Session Participant (invite-only)">Session Participant (invite-only)
                                </option>
                                <option value="Delegation Lead">Delegation Lead</option>
                                <option value="Media Representative">Media Representative</option>
                                <option value="Observer">Observer</option>
                                <option value="B2B Meeting Participant">B2B Meeting Participant</option>
                                <option value="Workshop Facilitator">Workshop Facilitator</option>
                                <option value="Exhibitor / Innovation Pavilion">Exhibitor / Innovation Pavilion
                                </option>
                            </select>
                        </div>
                    @endif

                    @if ($data->attendance != null)
                        <div class="col-lg-6">
                            <label for="attendance" class="form-label"
                                style="color: #888888; font-weight: 700;">Attendance Type
                                @if ($data->attendance_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="attendance"
                                {{ $data->attendance_required }} id="attendance">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Full Access (Plenary + Closed Sessions)">Full Access (Plenary + Closed
                                    Sessions)</option>
                                <option value="Media Pass">Media Pass</option>
                                <option value="Partner / Sponsor Access">Partner / Sponsor Access</option>
                                <option value="Day Pass (specific date)">Day Pass (specific date)</option>
                                <option value="Virtual Participant">Virtual Participant</option>
                                <option value="Side Event Only">Side Event Only</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->allergy != null)
                        <div class="col-lg-6">
                            <label for="allergy" class="form-label" style="color: #888888; font-weight: 700;">Food
                                Allergy / Intolerance
                                @if ($data->allergy_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="allergy" {{ $data->allergy_required }}
                                id="allergy">
                                <option value="" disabled selected>--Select--</option>
                                <option value="None">None</option>
                                <option value="Peanuts">Peanuts</option>
                                <option value="Tree nuts (e.g., almond, walnut, cashew)">Tree nuts (e.g., almond,
                                    walnut, cashew)</option>
                                <option value="Shellfish (e.g., shrimp, crab, lobster)">Shellfish (e.g., shrimp, crab,
                                    lobster)</option>
                                <option value="Fish">Fish</option>
                                <option value="Milk / Dairy">Milk / Dairy</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" name="other_allergy" id="other_allergy"
                                style="display:none;" placeholder="Please input others specify">
                        </div>
                    @endif

                    @if ($data->meal != null)
                        <div class="col-lg-6">
                            <label for="meal" class="form-label" style="color: #888888; font-weight: 700;">Meal
                                Type
                                @if ($data->meal_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="meal" {{ $data->meal_required }}
                                id="meal">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Regular (no restrictions)">Regular (no restrictions)</option>
                                <option value="Vegetarian">Vegetarian</option>
                                <option value="Vegan">Vegan</option>
                                <option value="Halal">Halal</option>
                                <option value="Kosher">Kosher</option>
                                <option value="Gluten-free (medical)">Gluten-free (medical)</option>
                                <option value="Dairy-free">Dairy-free</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" name="other_meal" id="other_meal"
                                style="display:none;" placeholder="Please input others specify">
                        </div>
                    @endif

                    @if ($data->disability != null)
                        <div class="col-lg-6">
                            <label for="disability" class="form-label" style="color: #888888; font-weight: 700;">Need
                                Support for Disability
                                @if ($data->disability_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="disability"
                                {{ $data->disability_required }} id="disability">
                                <option value="" disabled selected>--Select--</option>
                                <option value="No disability support needed">No disability support needed</option>
                                <option value="Mobility (wheelchair user)">Mobility (wheelchair user)</option>
                                <option value="Mobility (limited walking, need seating priority)">Mobility (limited
                                    walking, need seating priority)</option>
                                <option value="Visual impairment (blind / low vision)">Visual impairment (blind / low
                                    vision)</option>
                                <option value="Hearing impairment (deaf / hard of hearing)">Hearing impairment (deaf /
                                    hard of hearing)</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" name="other_disability" id="other_disability"
                                style="display:none;" placeholder="Please input others specify">
                        </div>
                    @endif

                    @if ($data->language != null)
                        <div class="col-lg-12">
                            <label for="language" class="form-label" style="color: #888888; font-weight: 700;">
                                Preferred Language for On-site Support
                                @if ($data->language_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="language" {{ $data->language_required }}
                                id="language">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Bahasa">Bahasa</option>
                                <option value="English">English</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" class="form-control" name="other_language" id="other_language"
                                style="display:none;" placeholder="Please input others specify">
                        </div>
                    @endif

                    @if ($data->bio != null)
                        <div class="col-lg-12">
                            <label for="bio" class="form-label" style="color: #888888; font-weight: 700;">Short
                                Bio
                                @if ($data->bio_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <textarea name="bio" class="form-control" id="bio" rows="3" style="height: 100px;"
                                {{ $data->bio_required }}></textarea>
                        </div>
                    @endif

                    @if ($data->picture != null)
                        <div class="col-lg-12">
                            <label for="picture" class="form-label" style="color: #888888; font-weight: 700;">Upload
                                Professional Picture (Headshot)
                                <span>
                                    Please upload a recent professional headshot (face clearly visible, neutral
                                    background, business attire). This will be used for: <br>
                                    - Event badge <br>
                                    - Participant directory <br>
                                    - Session materials (if applicable) <br>
                                    - Internal organizer records
                                </span> <br>
                                <span class="text-danger"><i>Max 10MB (.png .jpg .jpeg)</i></span>
                                @if ($data->picture_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <input type="file" name="picture" style="height: 47px !important;"
                                class="form-control required" placeholder="Please input your answer"
                                {{ $data->picture_required }} id="picture">
                        </div>
                    @endif

                    @if ($data->availdoc != null)
                        <div class="col-lg-12">
                            <label for="availdoc" class="form-label" style="color: #888888; font-weight: 700;">
                                Availability for Documentation and Use of Publication by the Organization
                                @if ($data->availdoc_required != null)
                                    <span class="text-danger"><b>*</b></span>
                                @endif
                            </label>
                            <select class="form-select form-control" name="availdoc" {{ $data->availdoc_required }}
                                id="availdoc">
                                <option value="" disabled selected>--Select--</option>
                                <option
                                    value="Yes – for external publication (social media, website, reports, promotional materials)">
                                    Yes – for external publication (social media, website, reports, promotional
                                    materials)</option>
                                <option value="Yes – for internal organizational use only">Yes – for internal
                                    organizational use only</option>
                                <option value="No – do not publish my documentation">No – do not publish my
                                    documentation</option>
                                <option value="Depends (please explain in text box)">Depends (please explain in text
                                    box)</option>
                            </select>
                        </div>
                    @endif

                    @if ($data->iconsent != null)
                        <div class="col-lg-12">
                            <div class="d-flex align-items-start">
                                <input class="form-check-input mt-1"
                                    style="transform: scale(1.3);
                                    -webkit-transform: scale(1.3);
                                    -ms-transform: scale(1.3);
                                    flex-shrink: 0;"
                                    type="checkbox" name="iconsent"
                                    value="I consent to be contacted to arrange in-depth conversations related to the program with the Faculty."
                                    id="iconsent" {{ $data->iconsent_required }}>

                                <label class="form-check-label ms-2"
                                    style="color: #888888; font-weight: 500; font-size: 16px;" for="iconsent">
                                    I consent to be contacted to arrange in-depth conversations related to the program
                                    with the Faculty.
                                    @if ($data->iconsent_required != null)
                                        <span class="text-danger"><b>*</b></span>
                                    @endif
                                </label>
                            </div>
                        </div>
                    @endif

                    @if ($data->privacy != null)
                        <div class="col-lg-12">
                            <div class="d-flex align-items-start">
                                <input class="form-check-input mt-1"
                                    style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                    type="checkbox" name="privacy" value="Data Privacy and Confidentiality Assurance"
                                    id="privacy" {{ $data->privacy_required }}>

                                <label class="form-check-label ms-2"
                                    style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                    for="privacy">
                                    Data Privacy and Confidentiality Assurance
                                    @if ($data->privacy_required != null)
                                        <span class="text-danger"><b>*</b></span>
                                    @endif
                                </label>
                            </div>
                        </div>
                    @endif --}}

                    {{-- Custome --}}
                    {{-- @for ($i = 1; $i <= 6; $i++)
                        @if (isset($json_data[$i]['custome']))
                            <div class="col-lg-{{ $json_data[$i]['width'] ?? '12' }}">
                                <input type="hidden" name="label_{{ $i }}" class="form-control"
                                    value="{{ $json_data[$i]['label'] ?? '' }}" id="label_{{ $i }}">
                                <label for="custome" class="form-label"
                                    style="color: #888888; font-weight: 700;">{{ $json_data[$i]['label'] ?? '' }}
                                    @if (!empty($json_data[$i]['custome_size']) && !empty($json_data[$i]['extensions']))
                                        <span class="text-danger"><i>Max:
                                                @php
                                                    $maxSize = '';
                                                    $maxSize = $json_data[$i]['custome_size'] / 1024;
                                                @endphp
                                                {{ $maxSize ?? '' }}MB
                                                (
                                                @foreach ($json_data[$i]['extensions'] as $ext)
                                                    .{{ $ext }}
                                                @endforeach
                                                )
                                            </i></span>
                                    @endif
                                    @if (!empty($json_data[$i]['custome_required']))
                                        <span class="text-danger"><b>*</b></span>
                                    @endif
                                </label>
                                @if ($json_data[$i]['type'] == 'select')
                                    <select class="form-select form-control" name="custome_{{ $i }}"
                                        {{ $json_data[$i]['custome_required'] ?? '' }}
                                        id="custome_{{ $i }}">

                                        <option value="" disabled selected>--Select--</option>

                                        @if (!empty($json_data[$i]['options']))
                                            @php
                                                // Pecah string berdasarkan tanda koma menjadi Array
                                                $optionsArray = explode('|', $json_data[$i]['options']);
                                            @endphp

                                            @foreach ($optionsArray as $option)
                                                @php
                                                    // Trim untuk menghapus spasi di awal/akhir kata
                                                    $option = trim($option);
                                                @endphp

                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                @elseif ($json_data[$i]['type'] == 'textarea')
                                    <textarea name="custome_{{ $i }}" class="form-control" id="custome_{{ $i }}"
                                        rows="3" style="height: 100px;" {{ $json_data[$i]['custome_required'] ?? '' }}></textarea>
                                @elseif ($json_data[$i]['type'] == 'checkbox')
                                    @if (!empty($json_data[$i]['options']))
                                        @php
                                            // Pecah string berdasarkan tanda koma menjadi Array
                                            $optionsArray = explode('|', $json_data[$i]['options']);
                                        @endphp

                                        <div class="checkbox-group"
                                            data-max="{{ $json_data[$i]['custome_check'] ?? 1 }}">
                                            @foreach ($optionsArray as $index => $option)
                                                @php
                                                    // Trim untuk menghapus spasi yang tidak sengaja ada di depan/belakang teks
                                                    $option = trim($option);
                                                    $topic_checkbox = '';
                                                    if ($json_data[$i]['custome_check'] == null) {
                                                        $topic_checkbox = '';
                                                    } else {
                                                        $topic_checkbox = 'topic-checkbox';
                                                    }
                                                @endphp

                                                <div class="d-flex align-items-start mb-2">
                                                    <input class="form-check-input mt-1 {{ $topic_checkbox }}"
                                                        style="transform: scale(1.3); -webkit-transform: scale(1.3); -ms-transform: scale(1.3); flex-shrink: 0;"
                                                        type="checkbox" name="custome_{{ $i }}[]"
                                                        value="{{ $option }}"
                                                        id="custome_{{ $i }}"
                                                        {{ $json_data[$i]['custome_required'] ?? '' }}>

                                                    <label class="form-check-label ms-2"
                                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                        for="custome_opt_2_{{ $index }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @elseif ($json_data[$i]['type'] == 'file')
                                    @php
                                        // Ambil data array extensions, gunakan array kosong [] sebagai default jika data null
                                        $extArray = $json_data[$i]['extensions'] ?? [];

                                        // Gabungkan array menjadi string yang dipisahkan oleh koma
                                        $extensions = is_array($extArray) ? implode(',', $extArray) : '';
                                    @endphp
                                    <input type="hidden" name="extensions_{{ $i }}"
                                        class="form-control" value="{{ $extensions }}"
                                        id="extensions_{{ $i }}">
                                    <input type="hidden" name="size_{{ $i }}" class="form-control"
                                        value="{{ $json_data[$i]['custome_size'] ?? '' }}"
                                        id="size_{{ $i }}">
                                    <input type="{{ $json_data[$i]['type'] ?? '' }}"
                                        name="custome_{{ $i }}" class="form-control required"
                                        placeholder="Please input your {{ $json_data[$i]['label'] ?? '' }}"
                                        {{ $json_data[$i]['custome_required'] ?? '' }}
                                        id="custome_{{ $i }}">
                                @else
                                    <input type="{{ $json_data[$i]['type'] ?? '' }}"
                                        name="custome_{{ $i }}" class="form-control required"
                                        placeholder="Please input your {{ $json_data[$i]['label'] ?? '' }}"
                                        {{ $json_data[$i]['custome_required'] ?? '' }}
                                        id="custome_{{ $i }}">
                                @endif
                            </div>
                        @endif
                    @endfor --}}
                    {{-- Custome --}}

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
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Cari semua grup checkbox di dalam form
            const checkboxGroups = document.querySelectorAll('.checkbox-group');

            checkboxGroups.forEach((group) => {
                // 2. Ambil nilai "custome_check" dari atribut data-max pada div pembungkus
                // Gunakan parseInt agar nilainya dibaca sebagai angka (bukan string)
                const maxLimit = parseInt(group.getAttribute('data-max')) || 1;

                // 3. Cari checkbox HANYA di dalam grup ini (mencegah bentrok dengan grup lain)
                const checkboxes = group.querySelectorAll('.topic-checkbox');

                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener('change', () => {
                        // Hitung jumlah yang dicentang HANYA pada grup ini
                        const checkedCount = group.querySelectorAll(
                            '.topic-checkbox:checked').length;

                        // Batas maksimal dinamis (menggunakan maxLimit)
                        if (checkedCount > maxLimit) {
                            checkbox.checked = false; // Batalkan centangan

                            Swal.fire({
                                icon: 'warning',
                                // Gunakan backtick (`) agar bisa memasukkan variabel ke dalam teks
                            title: `You can only choose up to ${maxLimit} group sessions.`,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                confirmButtonColor: "#0d6efd",
                                confirmButtonText: "OK",
                            });
                        }

                        // Atur required dinamis
                        // Cari kembali jumlah checked setelah ada pembatalan di atas
                        const finalCheckedCount = group.querySelectorAll(
                            '.topic-checkbox:checked').length;

                        if (finalCheckedCount >= 1) {
                            checkboxes.forEach(cb => cb.required = false);
                        } else {
                            // Jika ada data 'custome_required' dari database, aktifkan kembali required-nya
                            // (Anda bisa menyesuaikan logika required ini sesuai kebutuhan form)
                            checkboxes.forEach(cb => cb.required = true);
                        }
                    });
                });
            });
        });
    </script>
    {{-- <script>
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
    </script> --}}
    <script>
        document.getElementById('fellowship').addEventListener('change', function() {

            const otherInput = document.getElementById('other_fellowship');
            const fellow = document.getElementById('fellowship');

            if (this.value === 'Others') {
                otherInput.style.display = 'block';
                // fellow.style.display = 'none';
                otherInput.focus();
            } else {
                otherInput.style.display = 'none';
                otherInput.value = '';
            }
        });

        document.getElementById('allergy').addEventListener('change', function() {

            const otherAllergy = document.getElementById('other_allergy');
            const allergy = document.getElementById('allergy');

            if (this.value === 'Others') {
                otherAllergy.style.display = 'block';
                // allergy.style.display = 'none';
                otherAllergy.focus();
            } else {
                otherAllergy.style.display = 'none';
                otherAllergy.value = '';
            }
        });

        document.getElementById('meal').addEventListener('change', function() {

            const otherMeal = document.getElementById('other_meal');
            const meal = document.getElementById('meal');

            if (this.value === 'Others') {
                otherMeal.style.display = 'block';
                // meal.style.display = 'none';
                otherMeal.focus();
            } else {
                otherMeal.style.display = 'none';
                otherMeal.value = '';
            }
        });

        document.getElementById('disability').addEventListener('change', function() {

            const otherDisability = document.getElementById('other_disability');
            const disability = document.getElementById('disability');

            if (this.value === 'Others') {
                otherDisability.style.display = 'block';
                // disability.style.display = 'none';
                otherDisability.focus();
            } else {
                otherDisability.style.display = 'none';
                otherDisability.value = '';
            }
        });

        document.getElementById('language').addEventListener('change', function() {

            const otherLanguage = document.getElementById('other_language');
            const language = document.getElementById('language');

            if (this.value === 'Others') {
                otherLanguage.style.display = 'block';
                // language.style.display = 'none';
                otherLanguage.focus();
            } else {
                otherLanguage.style.display = 'none';
                otherLanguage.value = '';
            }
        });
    </script>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Failed!',
                html: `
                <ul style="text-align: left; list-style-position: inside;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>

</html>
