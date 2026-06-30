@extends('templates.dashboard')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css" rel="stylesheet">
@section('isi')
    <style>
        /* public/css/custom.css */
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            font-weight: 600;
        }

        .field-block h5 {
            color: #0d6efd;
        }

        /* Background toolbar */
        .note-toolbar {
            background: #f8f9fa !important;
            border-bottom: 1px solid #dee2e6 !important;
        }

        /* Button toolbar */
        .note-btn {
            background-color: #fff !important;
            color: #343a40 !important;
            border: 1px solid #ced4da !important;
        }

        /* Hover button */
        .note-btn:hover {
            background-color: #e9ecef !important;
            color: #000 !important;
        }

        /* Button aktif */
        .note-btn.active {
            background-color: #dee2e6 !important;
        }

        /* Editor area */
        .note-editor.note-frame {
            border: 1px solid #ced4da !important;
            border-radius: 8px;
        }

        /* Isi editor */
        .note-editable {
            background-color: white;
            color: #212529;
        }

        /* Dropdown */
        .dropdown-menu {
            border-radius: 6px;
        }
    </style>
    <div class="container my-1">
        <h3>Update Event Registration</h3>

        <form method="POST" action="{{ url('/registration/update-form/' . $data->id_events_form) }}"
            enctype="multipart/form-data" class="needs-validation mt-4" id="myForm">
            @csrf

            <!-- Informasi Event -->
            <div class="card mb-4">
                <div class="card-body row g-3">
                    <div class="card-header bg-primary text-white">Event Information</div>
                    <div class="col-md-6">
                        <label for="title" class="form-label" style="color: #888888; font-weight: 700;">Event Title <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $data->title) }}" class="form-control"
                            id="title" required>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label" style="color: #888888; font-weight: 700;">Location <span
                                class="text-danger">*</span></label>
                        <input type="text" name="location" value="{{ old('location', $data->location) }}"
                            class="form-control" id="location" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="start_date" class="form-label" style="color: #888888; font-weight: 700;">Start
                                    Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" value="{{ old('start_date', $data->start_date) }}"
                                    class="form-control input-sm" id="start_date" required>
                            </div>
                            <div class="col-sm">
                                <label for="end_date" class="form-label" style="color: #888888; font-weight: 700;">End Date
                                    <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" value="{{ old('end_date', $data->end_date) }}"
                                    class="form-control input-sm" id="end_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="start_time" class="form-label" style="color: #888888; font-weight: 700;">Start
                                    Time <span class="text-danger">*</span></label>
                                <input type="time" name="start_time" value="{{ old('start_time', $data->start_time) }}"
                                    class="form-control input-sm" id="start_time" required>
                            </div>
                            <div class="col-sm">
                                <label for="end_time" class="form-label" style="color: #888888; font-weight: 700;">End Time
                                    <span class="text-danger">*</span></label>
                                <input type="time" name="end_time" value="{{ old('end_time', $data->end_time) }}"
                                    class="form-control input-sm" id="end_time" required>
                            </div>
                            <div class="col-sm">
                                <label for="time_zone" class="form-label" style="color: #888888; font-weight: 700;">
                                    Time Zone
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="time_zone" class="form-select" id="time_zone">
                                    <optgroup label="Asia">
                                        <option value="(GMT+08:00) Singapore" {{ old('time_zone', $data->time_zone) == '(GMT+08:00) Singapore' ? 'selected' : '' }}>(GMT+08:00) Singapore</option>
                                        <option value="(GMT+07:00) Jakarta" {{ old('time_zone', $data->time_zone) == '(GMT+07:00) Jakarta' ? 'selected' : '' }}>(GMT+07:00) Jakarta</option>
                                        <option value="(GMT+08:00) Makassar" {{ old('time_zone', $data->time_zone) == '(GMT+08:00) Makassar' ? 'selected' : '' }}>(GMT+08:00) Makassar</option>
                                        <option value="(GMT+09:00) Jayapura" {{ old('time_zone', $data->time_zone) == '(GMT+09:00) Jayapura' ? 'selected' : '' }}>(GMT+09:00) Jayapura</option>
                                        <option value="(GMT+09:00) Tokyo" {{ old('time_zone', $data->time_zone) == '(GMT+09:00) Tokyo' ? 'selected' : '' }}>(GMT+09:00) Tokyo</option>
                                        <option value="(GMT+09:00) Seoul" {{ old('time_zone', $data->time_zone) == '(GMT+09:00) Seoul' ? 'selected' : '' }}>(GMT+09:00) Seoul</option>
                                        <option value="(GMT+08:00) Beijing, Shanghai" {{ old('time_zone', $data->time_zone) == '(GMT+08:00) Beijing, Shanghai' ? 'selected' : '' }}>(GMT+08:00) Beijing, Shanghai</option>
                                        <option value="(GMT+05:30) Kolkata" {{ old('time_zone', $data->time_zone) == '(GMT+05:30) Kolkata' ? 'selected' : '' }}>(GMT+05:30) Kolkata</option>
                                        <option value="(GMT+04:00) Dubai" {{ old('time_zone', $data->time_zone) == '(GMT+04:00) Dubai' ? 'selected' : '' }}>(GMT+04:00) Dubai</option>
                                    </optgroup>

                                    <optgroup label="Europe">
                                        <option value="(GMT+00:00) London" {{ old('time_zone', $data->time_zone) == '(GMT+00:00) London' ? 'selected' : '' }}>(GMT+00:00) London</option>
                                        <option value="(GMT+01:00) Paris" {{ old('time_zone', $data->time_zone) == '(GMT+01:00) Paris' ? 'selected' : '' }}>(GMT+01:00) Paris</option>
                                        <option value="(GMT+01:00) Berlin" {{ old('time_zone', $data->time_zone) == '(GMT+01:00) Berlin' ? 'selected' : '' }}>(GMT+01:00) Berlin</option>
                                    </optgroup>

                                    <optgroup label="America">
                                        <option value="(GMT-05:00) New York" {{ old('time_zone', $data->time_zone) == '(GMT-05:00) New York' ? 'selected' : '' }}>(GMT-05:00) New York</option>
                                        <option value="(GMT-06:00) Chicago" {{ old('time_zone', $data->time_zone) == '(GMT-06:00) Chicago' ? 'selected' : '' }}>(GMT-06:00) Chicago</option>
                                        <option value="(GMT-07:00) Denver" {{ old('time_zone', $data->time_zone) == '(GMT-07:00) Denver' ? 'selected' : '' }}>(GMT-07:00) Denver</option>
                                        <option value="(GMT-08:00) Los Angeles" {{ old('time_zone', $data->time_zone) == '(GMT-08:00) Los Angeles' ? 'selected' : '' }}>(GMT-08:00) Los Angeles</option>
                                    </optgroup>

                                    <optgroup label="Australia">
                                        <option value="(GMT+10:00) Sydney" {{ old('time_zone', $data->time_zone) == '(GMT+10:00) Sydney' ? 'selected' : '' }}>(GMT+10:00) Sydney</option>
                                        <option value="(GMT+08:00) Perth" {{ old('time_zone', $data->time_zone) == '(GMT+08:00) Perth' ? 'selected' : '' }}>(GMT+08:00) Perth</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="logo" class="form-label" style="color: #888888; font-weight: 700;">Logo/Picture
                            <span class="text-danger"><i>format .png .jpg .jpeg</i></label>
                        <div style="display: flex">
                            @if ($data->logo)
                                <img src="{{ asset($data->logo) }}" width="100">
                            @endif
                            <input type="file" name="logo" style="height: 47px !important;"
                                class="form-control ms-2" id="logo">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="logo_size" class="form-label" style="color: #888888; font-weight: 700;">Logo
                                    Size Web <span class="text-danger"><i>max 600px</i></span></label>
                                <input type="number" name="logo_size" value="{{ old('logo_size', $data->logo_size) }}"
                                    class="form-control input-sm" id="logo_size">
                            </div>
                            <div class="col-sm">
                                <label for="logo_size_mobile" class="form-label"
                                    style="color: #888888; font-weight: 700;">Logo Size Mobile <span
                                        class="text-danger"><i>max 350px</i></span></label>
                                <input type="number" name="logo_size_mobile"
                                    value="{{ old('logo_size_mobile', $data->logo_size_mobile) }}"
                                    class="form-control input-sm" id="logo_size_mobile">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="custome_link" class="form-label" style="color: #888888; font-weight: 700;">Custome
                            Link
                            <span class="text-danger">*</span></label>
                        <input type="text" name="custome_link" value="{{ $data->custome_link }}"
                            class="form-control" id="custome_link" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type_event" class="form-label" style="color: #888888; font-weight: 700;">Event Type
                        </label>
                        <select name="type_event" class="form-select" id="type_event">
                            <option value="Offline"
                                {{ old('type_event', $data->type_event) == 'Offline' ? 'selected' : '' }}>Offline</option>
                            <option value="Online"
                                {{ old('type_event', $data->type_event) == 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="Hybrid"
                                {{ old('type_event', $data->type_event) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label" style="color: #888888; font-weight: 700;">Description
                            Form
                        </label>
                        <textarea name="description" class="form-control" id="description" rows="3">{!! old('description', $data->description) !!}</textarea>
                    </div>
                    <div class="card-header bg-primary text-white mt-2">Setting notification email and page success</div>
                    <div class="col-md-6">
                        <label for="description" class="form-label mt-2"
                            style="color: #888888; font-weight: 700;">Subject
                        </label>
                        <input type="text" name="subject" value="{{ old('subject', $data->subject) }}"
                            class="form-control" id="subject">
                    </div>
                    @php
                        $extension = strtolower(pathinfo($data->attachment, PATHINFO_EXTENSION));

                        switch ($extension) {
                            case 'pdf':
                                $icon = 'bi-file-earmark-pdf-fill';
                                $color = 'danger';
                                break;

                            case 'doc':
                            case 'docx':
                                $icon = 'bi-file-earmark-word-fill';
                                $color = 'primary';
                                break;

                            case 'xls':
                            case 'xlsx':
                                $icon = 'bi-file-earmark-excel-fill';
                                $color = 'success';
                                break;

                            case 'png':
                            case 'jpg':
                            case 'jpeg':
                                $icon = 'bi-file-earmark-image-fill';
                                $color = 'warning';
                                break;

                            default:
                                $icon = 'bi-file-earmark-fill';
                                $color = 'secondary';
                        }
                    @endphp
                    <div class="col-md-6">
                        <label for="attachment" class="form-label mt-2" style="color: #888888; font-weight:700;">
                            Attachment for Email
                            <span class="text-danger">
                                <i>Max.10mb (.pdf .docx .xlsx .png .jpg .jpeg)</i>
                            </span>
                        </label>

                        @if ($data->attachment)
                            <div class="card shadow-sm border mb-3">
                                <div class="card-body py-2 px-3">
                                    <div class="d-flex align-items-center">

                                        <i class="bi {{ $icon }} text-{{ $color }} fs-2 me-3"></i>

                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-truncate">
                                                {{ basename($data->attachment) }}
                                            </div>

                                            <small class="text-muted">
                                                Existing attachment
                                            </small>
                                        </div>

                                        <a href="{{ asset($data->attachment) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                            Preview
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="attachment" class="form-control" id="attachment"
                            style="height:47px">
                    </div>
                    <div class="col-md-12">
                        <label for="description_notif" class="form-label"
                            style="color: #888888; font-weight: 700;">Description Notification
                        </label>
                        <textarea name="description_notif" class="form-control" id="description_notif" rows="3">{!! old('description_notif', $data->description_notif) !!}</textarea>
                    </div>

                    <div class="card-header bg-primary text-white mt-2">Check the box if necessary</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="name_field" class="form-label"
                                            style="color: #888888; font-weight: 700;">Name Field
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="req" class="form-label"
                                            style="color: #888888; font-weight: 700;">Required Field
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="wdth_box" class="form-label"
                                            style="color: #888888; font-weight: 700;">Width Box
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="orderby" class="form-label"
                                            style="color: #888888; font-weight: 700;">Order By
                                        </label>
                                    </div>
                                </div>

                                @foreach ($data_checklist as $result)
                                    <div class="row">
                                        {{-- 1. Main Checkbox (Name Field) --}}
                                        <div class="col-md-5">
                                            <div class="d-flex align-items-start">
                                                <input class="form-check-input topic-checkbox"
                                                    style="transform: scale(1.3); -webkit-transform: scale(1.3); -ms-transform: scale(1.3); flex-shrink: 0;"
                                                    type="checkbox" name="{{ $result->name_field }}"
                                                    value="{{ $result->name_field }}" id="{{ $result->name_field }}"
                                                    {{ old($result->name_field, $data->{$result->name_field}) ? 'checked' : '' }}
                                                    @if ($result->name_field === 'salutation' || $result->name_field === 'fullname' || $result->name_field === 'email') required @endif>

                                                <label class="form-check-label ms-2"
                                                    style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                    for="{{ $result->name_field }}">
                                                    {{ $result->label_field }}
                                                    @if ($result->name_field == 'salutation' || $result->name_field == 'fullname' || $result->name_field === 'email')
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                        {{-- 2. Required Checkbox --}}
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-start">
                                                <input class="form-check-input topic-checkbox"
                                                    style="transform: scale(1.3); -webkit-transform: scale(1.3); -ms-transform: scale(1.3); flex-shrink: 0;"
                                                    type="checkbox" name="{{ $result->required_field }}"
                                                    value="required"
                                                    {{ old($result->required_field, $data->{$result->required_field}) ? 'checked' : '' }}
                                                    id="{{ $result->required_field }}">

                                                <label class="form-check-label ms-2"
                                                    style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                    for="{{ $result->required_field }}">
                                                    Required?
                                                </label>
                                            </div>
                                        </div>

                                        {{-- 3. Width Select Box --}}
                                        <div class="col-md-2 mb-2">
                                            <select name="{{ $result->width_box }}" class="form-select"
                                                id="{{ $result->width_box }}" style="height: 43px !important;">
                                                {{-- Gunakan logika ternary untuk mengecek apakah datanya '6' atau '12' --}}
                                                <option value="6"
                                                    {{ old($result->width_box, $data->{$result->width_box}) == '6' ? 'selected' : '' }}>
                                                    Half</option>
                                                <option value="12"
                                                    {{ old($result->width_box, $data->{$result->width_box}) == '12' ? 'selected' : '' }}>
                                                    Full</option>
                                            </select>
                                        </div>

                                        {{-- 4. Order By Select Box --}}
                                        <div class="col-md-2 mb-2">
                                            <select name="{{ $result->order_by }}" class="form-select order-select"
                                                id="{{ $result->order_by }}" style="height: 43px !important;">
                                                <option disabled selected value="">-</option>
                                                @for ($i = 1; $i <= 35; $i++)
                                                    {{-- Cocokkan angka loop dengan nilai database --}}
                                                    <option value="{{ $i }}"
                                                        {{ old($result->order_by, $data->{$result->order_by}) == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="salutation" value="Salutation" required
                                                {{ old('salutation', $data->salutation) ? 'checked' : '' }}
                                                id="salutation">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="salutation">
                                                Salutation <span class="text-danger">*</span></label>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="salutation_required" value="required"
                                                {{ old('salutation_required', $data->salutation_required) ? 'checked' : '' }}
                                                id="salutation_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="salutation_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="fullname" value="Full Name" required
                                                {{ old('fullname', $data->fullname) ? 'checked' : '' }} id="fullname">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="fullname">
                                                Full Name <span class="text-danger">*</span></label>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="fullname_required" value="required"
                                                {{ old('fullname_required', $data->fullname_required) ? 'checked' : '' }}
                                                id="fullname_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="fullname_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="email" value="Email" required
                                                {{ old('email', $data->email) ? 'checked' : '' }} id="email">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="email">
                                                Email <span class="text-danger">*</span></label>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="email_required" value="required"
                                                {{ old('email_required', $data->email_required) ? 'checked' : '' }}
                                                id="email_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="email_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="sex" value="Sex"
                                                {{ old('sex', $data->sex) ? 'checked' : '' }} id="sex">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="sex">
                                                Sex
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="sex_required" value="required"
                                                {{ old('sex_required', $data->sex_required) ? 'checked' : '' }}
                                                id="sex_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="sex_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="phone" value="Phone Number"
                                                {{ old('phone', $data->phone) ? 'checked' : '' }} id="phone">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="phone">
                                                Phone Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="phone_required" value="required"
                                                {{ old('phone_required', $data->phone_required) ? 'checked' : '' }}
                                                id="phone_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="phone_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="institution" value="Institution/Organization"
                                                {{ old('institution', $data->institution) ? 'checked' : '' }}
                                                id="institution">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="institution">
                                                Institution/Organization
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="institution_required" value="required"
                                                {{ old('institution_required', $data->institution_required) ? 'checked' : '' }}
                                                id="institution_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="institution_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="position" value="Position"
                                                {{ old('position', $data->position) ? 'checked' : '' }} id="position">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="position">
                                                Position
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="position_required" value="required"
                                                {{ old('position_required', $data->position_required) ? 'checked' : '' }}
                                                id="position_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="position_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="sector" value="Sector"
                                                {{ old('sector', $data->sector) ? 'checked' : '' }} id="sector">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="sector">
                                                Sector
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="sector_required" value="required"
                                                {{ old('sector_required', $data->sector_required) ? 'checked' : '' }}
                                                id="sector_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="sector_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="field" value="Field"
                                                {{ old('field', $data->field) ? 'checked' : '' }} id="field">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="field">
                                                Field
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="field_required" value="required"
                                                {{ old('field_required', $data->field_required) ? 'checked' : '' }}
                                                id="field_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="field_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="socialmedia" value="Social Media"
                                                {{ old('socialmedia', $data->socialmedia) ? 'checked' : '' }}
                                                id="socialmedia">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="socialmedia">
                                                Social Media
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="socialmedia_required" value="required"
                                                {{ old('socialmedia_required', $data->socialmedia_required) ? 'checked' : '' }}
                                                id="socialmedia_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="socialmedia_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="linkedin" value="LinkedIn"
                                                {{ old('linkedin', $data->linkedin) ? 'checked' : '' }} id="linkedin">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="linkedin">
                                                LinkedIn
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="linkedin_required" value="required"
                                                {{ old('linkedin_required', $data->linkedin_required) ? 'checked' : '' }}
                                                id="linkedin_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="linkedin_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="citylived" value="City Lived"
                                                {{ old('citylived', $data->citylived) ? 'checked' : '' }} id="citylived">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="citylived">
                                                City Lived
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="citylived_required" value="required"
                                                {{ old('citylived_required', $data->citylived_required) ? 'checked' : '' }}
                                                id="citylived_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="citylived_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="country" value="Country"
                                                {{ old('country', $data->country) ? 'checked' : '' }} id="country">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="country">
                                                Country Origin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="country_required" value="required"
                                                {{ old('country_required', $data->country_required) ? 'checked' : '' }}
                                                id="country_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="country_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="birthday" value="Date of Birth"
                                                {{ old('birthday', $data->birthday) ? 'checked' : '' }} id="birthday">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="birthday">
                                                Date of Birth
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="birthday_required" value="required"
                                                {{ old('birthday_required', $data->birthday_required) ? 'checked' : '' }}
                                                id="birthday_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="birthday_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="latesteducation" value="Latest Education"
                                                {{ old('latesteducation', $data->latesteducation) ? 'checked' : '' }}
                                                id="latesteducation">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="latesteducation">
                                                Latest Education
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="latesteducation_required" value="required"
                                                {{ old('latesteducation_required', $data->latesteducation_required) ? 'checked' : '' }}
                                                id="latesteducation_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="latesteducation_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="englishproficiency" value="English Proficiency"
                                                {{ old('englishproficiency', $data->englishproficiency) ? 'checked' : '' }}
                                                id="englishproficiency">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="englishproficiency">
                                                English Proficiency
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="englishproficiency_required" value="required"
                                                {{ old('englishproficiency_required', $data->englishproficiency_required) ? 'checked' : '' }}
                                                id="englishproficiency_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="englishproficiency_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="uploadfile" value="Upload CV"
                                                {{ old('uploadfile', $data->uploadfile) ? 'checked' : '' }}
                                                id="uploadfile">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="uploadfile">
                                                Upload CV
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="uploadfile_required" value="required"
                                                {{ old('uploadfile_required', $data->uploadfile_required) ? 'checked' : '' }}
                                                id="uploadfile_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="uploadfile_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="fellowship"
                                                value="How do you know about this Fellowship"
                                                {{ old('fellowship', $data->fellowship) ? 'checked' : '' }}
                                                id="fellowship">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="fellowship">
                                                How do you know about this Fellowship
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="fellowship_required" value="required"
                                                {{ old('fellowship_required', $data->fellowship_required) ? 'checked' : '' }}
                                                id="fellowship_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="fellowship_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="essay" value="Essay"
                                                {{ old('essay', $data->essay) ? 'checked' : '' }} id="essay">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="essay">
                                                Essay
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="essay_required" value="required"
                                                {{ old('essay_required', $data->essay_required) ? 'checked' : '' }}
                                                id="essay_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="essay_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="roleworkshop"
                                                value="Role in Workshop (if session-specific or track-based)"
                                                {{ old('roleworkshop', $data->roleworkshop) ? 'checked' : '' }}
                                                id="roleworkshop">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="roleworkshop">
                                                Role in Workshop (if session-specific or track-based)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="roleworkshop_required" value="required"
                                                {{ old('roleworkshop_required', $data->roleworkshop_required) ? 'checked' : '' }}
                                                id="roleworkshop_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="roleworkshop_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group col-md-12 mt-3">
                                <label for="" class="form-label" style="color: #ffffff; font-weight: 700;">Check
                                    the
                                    box if necessary</label>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="attendance" value="Attendance Type"
                                                {{ old('attendance', $data->attendance) ? 'checked' : '' }}
                                                id="attendance">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="attendance">
                                                Attendance Type
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="attendance_required" value="required"
                                                {{ old('attendance_required', $data->attendance_required) ? 'checked' : '' }}
                                                id="attendance_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="attendance_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="allergy" value="Food Allergy"
                                                {{ old('allergy', $data->allergy) ? 'checked' : '' }} id="allergy">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="allergy">
                                                Food Allergy
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="allergy_required" value="required"
                                                {{ old('allergy_required', $data->allergy_required) ? 'checked' : '' }}
                                                id="allergy_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="allergy_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="meal" value="Meal Type"
                                                {{ old('meal', $data->meal) ? 'checked' : '' }} id="meal">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="meal">
                                                Meal Type
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="meal_required" value="required"
                                                {{ old('meal_required', $data->meal_required) ? 'checked' : '' }}
                                                id="meal_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="meal_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="disability"
                                                value="Need Support for Disability / Access Requirement"
                                                {{ old('disability', $data->disability) ? 'checked' : '' }}
                                                id="disability">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="disability">
                                                Need Support for Disability / Access Requirement
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="disability_required" value="required"
                                                {{ old('disability_required', $data->disability_required) ? 'checked' : '' }}
                                                id="disability_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="disability_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="language"
                                                value="Preferred Language for On-site Support"
                                                {{ old('language', $data->language) ? 'checked' : '' }} id="language">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="language">
                                                Preferred Language for On-site Support
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="language_required" value="required"
                                                {{ old('language_required', $data->language_required) ? 'checked' : '' }}
                                                id="language_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="language_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="picture"
                                                value="Upload Professional Picture (Headshot)"
                                                {{ old('picture', $data->picture) ? 'checked' : '' }} id="picture">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="picture">
                                                Upload Professional Picture (Headshot)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="picture_required" value="required"
                                                {{ old('picture_required', $data->picture_required) ? 'checked' : '' }}
                                                id="picture_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="picture_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="bio" value="Short Bio"
                                                {{ old('bio', $data->bio) ? 'checked' : '' }} id="bio">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="bio">
                                                Short Bio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="bio_required" value="required"
                                                {{ old('bio_required', $data->bio_required) ? 'checked' : '' }}
                                                id="bio_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="bio_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="iconsent"
                                                value="I consent to be contacted to arrange in-depth conversations related to the program with the Faculty."
                                                {{ old('iconsent', $data->iconsent) ? 'checked' : '' }} id="iconsent">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="iconsent">
                                                I consent to be contacted to arrange in-depth conversations related to the
                                                program
                                                with the Faculty.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="iconsent_required" value="required"
                                                {{ old('iconsent_required', $data->iconsent_required) ? 'checked' : '' }}
                                                id="iconsent_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="iconsent_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="privacy"
                                                value="Data Privacy and Confidentiality Assurance"
                                                {{ old('privacy', $data->privacy) ? 'checked' : '' }} id="privacy">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="privacy">
                                                Data Privacy and Confidentiality Assurance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="privacy_required" value="required"
                                                {{ old('privacy_required', $data->privacy_required) ? 'checked' : '' }}
                                                id="privacy_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="privacy_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="availdoc"
                                                value="Availability for Documentation and Use of Publication by the Organization"
                                                {{ old('availdoc', $data->availdoc) ? 'checked' : '' }} id="availdoc">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="availdoc">
                                                Availability for Documentation and Use of Publication by the Organization
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start">
                                            <input class="form-check-input topic-checkbox"
                                                style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                                type="checkbox" name="availdoc_required" value="required"
                                                {{ old('availdoc_required', $data->availdoc_required) ? 'checked' : '' }}
                                                id="availdoc_required">

                                            <label class="form-check-label ms-2"
                                                style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                                for="availdoc_required">
                                                Required?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                    </div>

                    {{-- Custome --}}
                    <label for="" class="form-label" style="color: #888888; font-weight: 700;">Custome Field
                        Dynamic</label>
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="row">
                            <div class="col-md-5">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                        type="checkbox" name="custome_{{ $i }}" value="custome"
                                        {{ old("custome_{$i}", $json_data[$i]['custome'] ?? null) == 'custome' ? 'checked' : '' }}
                                        id="custome_{{ $i }}">

                                    <label class="form-check-label ms-2"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="custome_{{ $i }}">
                                        Custome {{ $i }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);
                                        flex-shrink: 0;"
                                        type="checkbox" name="custome_required_{{ $i }}" value="required"
                                        {{ old("custome_required_{$i}", $json_data[$i]['custome_required'] ?? null) == 'required' ? 'checked' : '' }}
                                        id="custome_required_{{ $i }}">

                                    <label class="form-check-label ms-2"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="custome_{{ $i }}_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 mb-2">
                                <select name="width_{{ $i }}" class="form-select"
                                    id="width_{{ $i }}" style="height: 43px !important;">

                                    {{-- Parameter 1: 'width_'.$i (nama input) --}}
                                    {{-- Parameter 2: $json_data[$i]['width'] (nilai dari database) --}}
                                    <option value="6"
                                        {{ old('width_' . $i, $json_data[$i]['width'] ?? '') == '6' ? 'selected' : '' }}>
                                        Half
                                    </option>
                                    <option value="12"
                                        {{ old('width_' . $i, $json_data[$i]['width'] ?? '') == '12' ? 'selected' : '' }}>
                                        Full
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <select name="orderby_{{ $i }}" class="form-select order-select"
                                    id="orderby_{{ $i }}" style="height: 43px !important;">
                                    <option disabled selected value="">-</option>

                                    @for ($index = 1; $index <= 35; $index++)
                                        {{-- Lakukan hal yang sama untuk orderby --}}
                                        <option value="{{ $index }}"
                                            {{ old('orderby_' . $i, $json_data[$i]['orderby'] ?? '') == $index ? 'selected' : '' }}>
                                            {{ $index }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                        </div>
                        <div class="container" id="show_custome_{{ $i }}" style="display:none;">
                            <div class="col-md-12">
                                <label for="label_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">Label Field <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="label_{{ $i }}"
                                    value="{{ $json_data[$i]['label'] ?? '' }}" class="form-control"
                                    placeholder="Example: Full Name" id="label_{{ $i }}">
                            </div>
                            {{-- <div class="col-md-12 mt-2">
                                    <label for="width_{{ $i }}" class="form-label"
                                        style="color: #888888; font-weight: 700;">Width <span
                                            class="text-danger">*</span></label>
                                    <select name="width_{{ $i }}" class="form-select form-control"
                                        id="width_{{ $i }}">
                                        <option value="" disabled>--Select--</option>
                                        <option value="6"
                                            {{ ($json_data[$i]['width'] ?? '') == '6' ? 'selected' : '' }}>
                                            Half</option>
                                        <option value="12"
                                            {{ ($json_data[$i]['width'] ?? '') == '12' ? 'selected' : '' }}>
                                            Full</option>
                                    </select>
                                </div> --}}
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="type_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">Input Type <span
                                        class="text-danger">*</span></label>
                                <select name="type_{{ $i }}" class="form-select form-control"
                                    id="type_{{ $i }}">
                                    <option value="" disabled>--Select--</option>
                                    <option value="text"
                                        {{ ($json_data[$i]['type'] ?? '') == 'text' ? 'selected' : '' }}>
                                        Text</option>
                                    <option value="file"
                                        {{ ($json_data[$i]['type'] ?? '') == 'file' ? 'selected' : '' }}>
                                        File</option>
                                    <option value="email"
                                        {{ ($json_data[$i]['type'] ?? '') == 'email' ? 'selected' : '' }}>Email
                                    </option>
                                    <option value="date"
                                        {{ ($json_data[$i]['type'] ?? '') == 'date' ? 'selected' : '' }}>
                                        Date</option>
                                    <option value="time"
                                        {{ ($json_data[$i]['type'] ?? '') == 'time' ? 'selected' : '' }}>
                                        Time</option>
                                    <option value="number"
                                        {{ ($json_data[$i]['type'] ?? '') == 'number' ? 'selected' : '' }}>Number
                                    </option>
                                    <option value="textarea"
                                        {{ ($json_data[$i]['type'] ?? '') == 'textarea' ? 'selected' : '' }}>
                                        Textarea
                                    </option>
                                    <option value="select"
                                        {{ ($json_data[$i]['type'] ?? '') == 'select' ? 'selected' : '' }}>Select
                                    </option>
                                    <option value="checkbox"
                                        {{ ($json_data[$i]['type'] ?? '') == 'checkbox' ? 'selected' : '' }}>
                                        Checkbox
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-2 mb-3" id="options_{{ $i }}" style="display:none;">
                                <label for="options_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">Options (separate with pipe) <span
                                        class="text-danger">*</span></label>
                                <textarea name="options_{{ $i }}" class="form-control" id="options_{{ $i }}" rows="3"
                                    placeholder="Example: Group 1|Group 2|Group 3" style="height: 100px;">{{ $json_data[$i]['options'] ?? '' }}</textarea>
                                {{-- <input type="text" name="options_{{ $i }}"
                                            value="{{ $json_data[$i]['options'] ?? '' }}" class="form-control"
                                            placeholder="Group 1,Group 2,Group 3"> --}}
                            </div>

                            <div class="col-md-12 mt-2 mb-3" id="custome_check_{{ $i }}"
                                style="display:none;">
                                <label for="custome_check_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">How Many Check? <span
                                        class="text-danger"><i>(If empty, default multiple
                                            check)</i></span></label>
                                <input type="number" name="custome_check_{{ $i }}"
                                    value="{{ $json_data[$i]['custome_check'] ?? '' }}" class="form-control"
                                    placeholder="Default multiple check">
                            </div>

                            <div class="col-md-12 mt-2" id="file_{{ $i }}" style="display:none;">
                                <label for="custome_size_{{ $i }}" class="form-label"
                                    style="color: #888888; font-weight: 700;">
                                    Custome Max Size <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" id="custome_size_{{ $i }}"
                                        name="custome_size_{{ $i }}" class="form-control"
                                        value="{{ $size_data[$i] ?? 0 }}" placeholder="0">
                                    <span class="input-group-text" style="color: #888888; font-weight: 700;">MB</span>
                                </div>
                                <label for="custome_size_{{ $i }}" class="form-label mt-2"
                                    style="color: #888888; font-weight: 700;">
                                    Allowed Extensions <span class="text-danger">*</span>
                                </label>
                                <div class="row mb-3">
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="png"
                                            {{ in_array('png', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .png
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="jpg"
                                            {{ in_array('jpg', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .jpg
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="jpeg"
                                            {{ in_array('jpeg', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .jpeg
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="pdf"
                                            {{ in_array('pdf', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .pdf
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="docx"
                                            {{ in_array('docx', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .docx
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="xlsx"
                                            {{ in_array('xlsx', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .xlsx
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="pptx"
                                            {{ in_array('pptx', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_{{ $i }}">
                                            .pptx
                                        </label>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-start">
                                        <input class="form-check-input topic-checkbox"
                                            style="transform: scale(1.3);
                                                -webkit-transform: scale(1.3);
                                                -ms-transform: scale(1.3);
                                                flex-shrink: 0;"
                                            type="checkbox" name="extensions_{{ $i }}[]" value="txt"
                                            {{ in_array('txt', $json_data[$i]['extensions'] ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label ms-2"
                                            style="color: #888888; font-weight: 700; font-size: 14px; margin-left: 5px;"
                                            for="extensions_1">
                                            .txt
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    {{-- Custome --}}

                </div>

            </div>
    </div>

    <!-- Builder Field Dinamis -->
    {{-- <div class="card mb-4">
                <div class="card-header bg-color-white text-white d-flex justify-content-between align-items-center">
                    <span style="font-size: 14px;">Dynamic Registration Form</span>
                    <button type="button" class="btn btn-primary btn-sm" onclick="addField()">+ Add Field</button>
                </div>
                <div class="card-body bg-color-gray" id="fields-container"></div>
            </div> --}}

    <div class="tombol mt-1 mb-4">
        <button type="submit" id="submitBtn" class="btn btn-primary w-100" style="height: 50px;">
            <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update</span>
            <span id="btnSpinner" class="spinner-border d-none" role="status" aria-hidden="true"></span>
        </button>
    </div>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#description').summernote({
                height: 200,
                placeholder: 'Write description here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'video', 'table']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['history', ['undo', 'redo']]
                ]
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            $('#description_notif').summernote({
                height: 200,
                placeholder: 'Write description here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'video', 'table']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['history', ['undo', 'redo']]
                ]
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Ambil semua checkbox yang ID-nya dimulai dengan "custome_"
            const checkboxes = document.querySelectorAll('[id^="custome_"]');

            checkboxes.forEach(function(checkbox) {
                // Ambil angka index dari ID (misal dari "custome_1" diambil angka "1")
                const index = checkbox.id.split('_')[1];

                // Cari elemen target pasangannya
                const targetDiv = document.getElementById('show_custome_' + index);

                // Jika targetDiv tidak ditemukan di HTML, lewati agar tidak error
                if (!targetDiv) return;

                function toggleField() {
                    if (checkbox.checked) {
                        targetDiv.style.display = 'block';
                    } else {
                        targetDiv.style.display = 'none';

                        // Opsional: Kosongkan input di dalamnya saat di-uncheck
                        const inputs = targetDiv.querySelectorAll('input, select, textarea');
                        inputs.forEach(input => {
                            if (input.type === 'checkbox' || input.type === 'radio') {
                                // input.checked = false;
                            } else {
                                // input.value = '';
                            }
                        });
                    }
                }

                // Jalankan saat user klik / ganti pilihan
                checkbox.addEventListener('change', toggleField);

                // Jalankan otomatis saat halaman pertama kali dibuka (Mode Edit)
                toggleField();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen select yang ID-nya diawali dengan "type_" (type_1 sampai type_6)
            const typeSelects = document.querySelectorAll('[id^="type_"]');

            typeSelects.forEach(function(select) {
                // Ambil angka indeks dari ID select (misal dari "type_1" didapat "1")
                const index = select.id.split('_')[1];

                // Cari elemen target pasangan berdasarkan indeksnya
                const options = document.getElementById('options_' + index);
                const check = document.getElementById('custome_check_' + index);
                const file = document.getElementById('file_' + index);

                function toggleType() {
                    // Pastikan elemen ada di HTML sebelum mengubah style agar tidak error
                    if (!options || !check || !file) return;

                    // Sembunyikan semua terlebih dahulu (Reset)
                    options.style.display = 'none';
                    check.style.display = 'none';
                    file.style.display = 'none';

                    // Kondisikan berdasarkan value yang terpilih
                    if (select.value === 'select') {
                        options.style.display = 'block';
                    } else if (select.value === 'checkbox') {
                        options.style.display = 'block';
                        check.style.display = 'block';
                    } else if (select.value === 'file') {
                        file.style.display = 'block';
                    }
                }

                // Jalankan saat user mengubah pilihan di select option
                select.addEventListener('change', toggleType);

                // Jalankan otomatis saat halaman pertama kali dibuka (Sangat penting untuk form EDIT)
                toggleType();
            });
        });
    </script>

    <script>
        function updateOrderOptions() {
            let selectedValues = [];

            // Ambil semua nilai yang sudah dipilih
            document.querySelectorAll('.order-select').forEach(select => {
                if (select.value !== '') {
                    selectedValues.push(select.value);
                }
            });

            // Update semua option
            document.querySelectorAll('.order-select').forEach(select => {
                let currentValue = select.value;

                select.querySelectorAll('option').forEach(option => {
                    if (option.value === '') return;

                    // Disable jika sudah dipilih dropdown lain
                    option.disabled =
                        selectedValues.includes(option.value) &&
                        option.value !== currentValue;
                });
            });
        }

        // Jalankan saat ada perubahan
        document.querySelectorAll('.order-select').forEach(select => {
            select.addEventListener('change', updateOrderOptions);
        });

        // Jalankan saat halaman pertama kali dibuka (mode edit)
        updateOrderOptions();
    </script>

    <script>
        let fieldIndex = 0;

        function addField() {
            const container = document.getElementById('fields-container');
            const html = `
        <div class="border rounded p-3 mb-3 bg-light" style="color: black;">
            <h5>Field #${fieldIndex+1}</h5>
            <div class="mb-2">
                <label class="form-label">Label Field <span class="text-danger">*</span></label>
                <input type="text" name="fields[${fieldIndex}][label]" class="form-control" placeholder="example: Full Name" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Key Field (unique) <span class="text-danger">*</span></label>
                <input type="text" name="fields[${fieldIndex}][name]" class="form-control" placeholder="example: name" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Input Type <span class="text-danger">*</span></label>
                <select name="fields[${fieldIndex}][type]" class="form-select" onchange="toggleOptions(this, ${fieldIndex})" required>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>
            <div class="mb-2" id="options-${fieldIndex}" style="display:none;">
                <label class="form-label">Options (separate with commas)</label>
                <input type="text" name="fields[${fieldIndex}][options]" class="form-control" placeholder="Mr,Mrs,Ms">
            </div>
            <div class="form-check mb-2">
                <input type="checkbox" name="fields[${fieldIndex}][required]" value="1" class="form-check-input" id="req-${fieldIndex}">
                <label class="form-check-label" for="req-${fieldIndex}">Required?</label>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeField(this)">Delete Field</button>
        </div>
    `;
            container.insertAdjacentHTML('beforeend', html);
            fieldIndex++;
        }

        function toggleOptions(select, index) {
            const optionsDiv = document.getElementById('options-' + index);
            if (select.value === 'select' || select.value === 'checkbox') {
                optionsDiv.style.display = 'block';
            } else {
                optionsDiv.style.display = 'none';
            }
        }

        function removeField(btn) {
            btn.closest('.border').remove();
        }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
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
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif
@endsection
