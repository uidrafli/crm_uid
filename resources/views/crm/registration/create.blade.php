@extends('templates.dashboard')
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
    </style>
    <div class="container my-1">
        <h3>Create a New Event Registration</h3>

        <form method="POST" action="{{ url('/registration/create-form') }}" enctype="multipart/form-data"
            class="needs-validation mt-4" id="myForm">
            @csrf

            <!-- Informasi Event -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Event Information</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label" style="color: #888888; font-weight: 700;">Event Title <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label" style="color: #888888; font-weight: 700;">Location <span
                                class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control" id="location" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="start_date" class="form-label" style="color: #888888; font-weight: 700;">Start
                                    Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control input-sm" id="start_date">
                            </div>
                            <div class="col-sm">
                                <label for="end_date" class="form-label" style="color: #888888; font-weight: 700;">End Date
                                    <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control input-sm" id="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="start_time" class="form-label" style="color: #888888; font-weight: 700;">Start
                                    Time <span class="text-danger">*</span></label>
                                <input type="time" name="start_time" class="form-control input-sm" id="start_time">
                            </div>
                            <div class="col-sm">
                                <label for="end_time" class="form-label" style="color: #888888; font-weight: 700;">End Time
                                    <span class="text-danger">*</span></label>
                                <input type="time" name="end_time" class="form-control input-sm" id="end_time">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="logo" class="form-label" style="color: #888888; font-weight: 700;">Logo/Picture
                            <span class="text-danger"><i>format .png .jpg .jpeg</i></span>
                            <span class="text-danger">*</span></label>
                        <input type="file" name="logo" style="height: 47px !important;" class="form-control"
                            id="logo" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="logo_size" class="form-label" style="color: #888888; font-weight: 700;">Logo Size Web <span class="text-danger"><i>max 600px</i></span> <span class="text-danger">*</span></label>
                                <input type="number" name="logo_size"
                                    class="form-control input-sm" id="logo_size">
                            </div>
                            <div class="col-sm">
                                <label for="logo_size_mobile" class="form-label" style="color: #888888; font-weight: 700;">Logo Size Mobile <span class="text-danger"><i>max 350px</i></span>
                                    <span class="text-danger">*</span></label>
                                <input type="number" name="logo_size_mobile"
                                    class="form-control input-sm" id="logo_size_mobile">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="custome_link" class="form-label" style="color: #888888; font-weight: 700;">Custome Link
                            <span class="text-danger">*</span></label>
                        <input type="text" name="custome_link" class="form-control" id="custome_link" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type_event" class="form-label" style="color: #888888; font-weight: 700;">Event Type
                        </label>
                        <select name="type_event" class="form-select" id="type_event">
                            <option value="Offline">Offline</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label" style="color: #888888; font-weight: 700;">Description
                        </label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group col-md-6 mt-3">
                            <label for="" class="form-label" style="color: #888888; font-weight: 700;">Check the
                                box if necessary</label>
                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="salutation" value="Salutation" id="salutation">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="salutation">
                                        Salutation
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="salutation_required" value="required"
                                        id="salutation_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="salutation_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="fullname" value="Full Name" id="fullname">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="fullname">
                                        Full Name
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="fullname_required" value="required"
                                        id="fullname_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="fullname_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="email" value="Email" id="email">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="email">
                                        Email
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="email_required" value="required" id="email_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="email_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="phone" value="Phone Number" id="phone">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="phone">
                                        Phone Number
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="phone_required" value="required" id="phone_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="phone_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="institution" value="Institution/Organization"
                                        id="institution">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="institution">
                                        Institution/Organization
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="institution_required" value="required"
                                        id="institution_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="institution_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="position" value="Position" id="position">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="position">
                                        Position
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="position_required" value="required"
                                        id="position_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="position_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="sector" value="Sector" id="sector">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="sector">
                                        Sector
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="sector_required" value="required"
                                        id="sector_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="sector_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="field" value="Field" id="field">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="field">
                                        Field
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="field_required" value="required"
                                        id="field_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="field_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="country" value="Country" id="country">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="country">
                                        Country Origin
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input topic-checkbox"
                                        style="transform: scale(1.3);
                                        -webkit-transform: scale(1.3);
                                        -ms-transform: scale(1.3);"
                                        type="checkbox" name="country_required" value="required"
                                        id="country_required">

                                    <label class="form-check-label"
                                        style="color: #888888; font-weight: 500; font-size: 16px; margin-left: 5px;"
                                        for="country_required">
                                        Required?
                                    </label>
                                </div>
                            </div>

                        </div>
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
                    <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</span>
                    <span id="btnSpinner" class="spinner-border d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>

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
