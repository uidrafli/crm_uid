@extends('templates.dashboard')
@section('isi')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
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

        .iti {
            width: 100%;
        }
    </style>
    <div class="container my-1">
        <h3>Update Results Data Registration</h3>

        <form method="POST" action="{{ url('/registration/update-results/' . $data->id_data_center) }}"
            enctype="multipart/form-data" class="needs-validation mt-4" id="myForm">
            @csrf

            <!-- Informasi Event -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Data Information</div>
                <div class="card-body row g-3">
                    @if (optional($form)->salutation != null)
                        <div class="col-md-6">
                            <label for="salutation" class="form-label" style="color: #888888; font-weight: 700;">Salutation
                                <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="salutation" id="salutation">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Mr" {{ old('salutation', $data->salutation) == 'Mr' ? 'selected' : '' }}>
                                    Mr
                                </option>
                                <option value="Mrs"
                                    {{ old('salutation', $data->salutation) == 'Mrs' ? 'selected' : '' }}>Mrs
                                </option>
                                <option value="Ms" {{ old('salutation', $data->salutation) == 'Ms' ? 'selected' : '' }}>
                                    Ms
                                </option>
                            </select>
                        </div>
                    @endif

                    @if (optional($form)->fullname != null)
                        <div class="col-md-6">
                            <label for="fullname" class="form-label" style="color: #888888; font-weight: 700;">Full Name
                                <span class="text-danger">*</span></label>
                            <input type="text" name="fullname" value="{{ old('title', $data->fullname) }}"
                                class="form-control" id="fullname" required>
                        </div>
                    @endif

                    @if (optional($form)->email != null)
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="color: #888888; font-weight: 700;">Email Address
                                <span class="text-danger">*</span></label>
                            <input type="text" name="email" value="{{ old('title', $data->email) }}"
                                class="form-control" id="email" required>
                        </div>
                    @endif

                    @if (optional($form)->phone != null)
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="color: #888888; font-weight: 700;">Phone Number
                                <span class="text-danger">*</span></label>
                            <input type="tel" id="phone" name="phones" value="{{ old('title', $data->phone) }}"
                                class="form-control required wajib"
                                placeholder="Please input your phone number that is connected to WhatsApp">
                            <input type="hidden" name="phone" id="full_phone">
                        </div>
                    @endif

                    @if (optional($form)->institution != null)
                        <div class="col-md-6">
                            <label for="institution" class="form-label"
                                style="color: #888888; font-weight: 700;">Institution/Organixation</label>
                            <input type="text" name="institution" value="{{ old('title', $data->institution) }}"
                                class="form-control" id="institution">
                        </div>
                    @endif

                    @if (optional($form)->position != null)
                        <div class="col-md-6">
                            <label for="position" class="form-label" style="color: #888888; font-weight: 700;">Role or
                                Position</label>
                            <input type="text" name="position" value="{{ old('title', $data->position) }}"
                                class="form-control" id="position">
                        </div>
                    @endif

                    @if (optional($form)->sector != null)
                        <div class="col-md-6">
                            <label for="sector" class="form-label"
                                style="color: #888888; font-weight: 700;">Sector</label>
                            <select class="form-select form-control" name="sector" style="width: 100%;">
                                <option value="" disabled selected>--Select a Sector--</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector }}"
                                        {{ old('sector', $data->sector ?? '') == $sector ? 'selected' : '' }}>
                                        {{ $sector }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if (optional($form)->field != null)
                        <div class="col-md-6">
                            <label for="field" class="form-label" style="color: #888888; font-weight: 700;">field</label>
                            <select class="form-select form-control" name="field" style="width: 100%;">
                                <option value="" disabled selected>--Select a Field--</option>
                                @foreach ($fields as $field)
                                    <option value="{{ $field }}"
                                        {{ old('field', $data->field ?? '') == $field ? 'selected' : '' }}>
                                        {{ $field }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if (optional($form)->country != null)
                        <div class="col-md-12">
                            <label for="country" class="form-label" style="color: #888888; font-weight: 700;">Country
                                Origin</label>
                            <select class="form-select form-control" name="country" style="width: 100%;">
                                <option value="" disabled selected>--Select a Country--</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}"
                                        {{ old('country', $data->country ?? '') == $country ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

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
