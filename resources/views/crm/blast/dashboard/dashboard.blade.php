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

        .dt-button.btn-export-excel {
            background-color: #61ae41 !important;
            color: white !important;
            border: none !important;
            font-size: 13px !important;
            padding: 6px 12px;
            border-radius: 8px !important;
            font-weight: bold;
            height: 40px;
        }

        .dt-button.btn-export-excel:hover {
            background-color: #4c8933 !important;
        }

        .svg {
            width: 50px;
            height: 50px;
            margin-left: 30px;
            stroke: yellowgreen;
        }

        .form-check-input {
            width: 20px !important;
            height: 20px !important;
        }
    </style>
    <div class="container my-1">
        <h3>Campaign Send Blast</h3>



        <!-- Informasi Event -->
        <div class="card mb-4">
            <div class="card-body row g-3">
                <div class="card-header bg-primary text-white">Database Information</div>

                <!-- ISI TAB 1 -->
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">

                    <div class="cold-md-12">
                        <div class="col-md-12 mb-4">
                            <form method="GET" id="filters" action="{{ url('/data-center') }}">
                                <div class="inventory-grup row g-3">
                                    <div class="col-lg-3">
                                        <label for="name_events" class="form-label"
                                            style="color: #888888; font-weight: 700;">Name
                                            Events / Program</label>
                                        <input type="text" name="name_events" class="form-control"
                                            placeholder="Name Events / Program" id="name_events">
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="sector" class="form-label"
                                            style="color: #888888; font-weight: 700;">Sector</label>
                                        <select class="form-select form-control" name="sector" id="sector">
                                            <option value="" disabled selected>--Select Sector--
                                            </option>
                                            <option value="Government">Government</option>
                                            <option value="Business">Business</option>
                                            <option value="Civil Society">Civil Society</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="field" class="form-label"
                                            style="color: #888888; font-weight: 700;">Field</label>
                                        <select class="form-select form-control" name="field" id="field">
                                            <option value="" disabled selected>--Select Field--
                                            </option>
                                            <option value="Leadership">Leadership</option>
                                            <option value="Forestry">Forestry</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Creative Economy & Industry">Creative Economy
                                                & Industry
                                            </option>
                                            <option value="Education, Capacity Building, and Youth Empowerment">
                                                Education, Capacity
                                                Building,
                                                and Youth Empowerment</option>
                                            <option value="Blended & Sustainable Finance">Blended &
                                                Sustainable
                                                Finance</option>
                                            <option value="Energy">Energy</option>
                                            <option value="Equality & Inclusion">Equality & Inclusion
                                            </option>
                                            <option value="Health, Wellbeing & Sports">Health, Wellbeing
                                                & Sports
                                            </option>
                                            <option value="Good Governance & Leadership">Good Governance
                                                &
                                                Leadership</option>
                                            <option value="MSME & Entrepreneurship">MSME &
                                                Entrepreneurship
                                            </option>
                                            <option value="Regenerative Landscape and Community Livelihood">
                                                Regenerative Landscape and
                                                Community
                                                Livelihood</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="type_of_database" class="form-label"
                                            style="color: #888888; font-weight: 700;">Type of Database</label>
                                        <select class="form-select form-control" name="type_of_database"
                                            id="type_of_database">
                                            <option value="" disabled selected>--Select Type--</option>
                                            <option value="Fellows">Fellows</option>
                                            <option value="Participant">Participant</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="tombol mt-3">
                                    <button type="submit" id="submitBtn" class="btn btn-primary w-100"
                                        style="height: 43px;">
                                        <span id="btnText"><i class="fa fa-search" aria-hidden="true"></i>
                                            Filter</span>
                                        <span id="btnSpinner" class="spinner-border d-none" role="status"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <form method="POST" action="{{ url('/send-blast-post') }}" enctype="multipart/form-data"
                            class="needs-validation" id="myForm">
                            @csrf
                            <div class="table-responsive">

                                <table id="tabel" class="table table-bordered nowrap display">

                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Select Recipients</th>
                                            <th>Salutation</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Events</th>
                                            <th>Institutuin/Organization</th>
                                            <th>Role/Position</th>
                                            <th>Sector</th>
                                            <th>Field</th>
                                            <th>Status Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $result)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                    @if ($result['type_of_database'] == 'Fellows')
                                                        <i class="fa fa-star" aria-hidden="true" style="color: #ffbf00"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input topic-checkbox" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" type="checkbox"
                                                            name="recipients[]" value="{{ $result['email'] }}"
                                                            id="recipient_{{ $loop->index }}">
                                                        <label class="form-check-label ms-2 mt-3"
                                                            for="recipient_{{ $loop->index }}" style="font-size: 16px;">
                                                            {{ $result['email'] }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{ $result['salutation'] ?? '-' }}</td>
                                                <td>{{ $result['fullname'] ?? '-' }}</td>
                                                <td>{{ $result['phone'] ?? '-' }}</td>
                                                <td>
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach ($result['name_events'] as $key => $name_events)
                                                            <li class="d-flex justify-content-between">
                                                                <span>{{ $name_events ?? '-' }}</span>

                                                                <span class="ms-2 text-secondary">
                                                                    {{ isset($result['date_events'][$key])
                                                                        ? \Carbon\Carbon::parse($result['date_events'][$key])->format('d F Y')
                                                                        : '-' }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['institution'] as $institution)
                                                            <li>{{ $institution ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['position'] as $position)
                                                            <li>{{ $position ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['sector'] as $sector)
                                                            <li>{{ $sector ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['field'] as $field)
                                                            <li>{{ $field ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    @if ($result['status_users'] == 'Active')
                                                        <span
                                                            class="badge bg-primary">{{ $result['status_users'] ?? '-' }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger">{{ $result['status_users'] ?? '-' }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($result['status_users'] == 'Non Active')
                                                        <button class="btn btn-primary btn-active"
                                                            data-email="{{ $result['email'] }}"><i
                                                                class="fa fa-power-off" aria-hidden="true"></i>
                                                            <b>Active</b>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-warning btn-nonactive"
                                                            data-email="{{ $result['email'] }}"><i
                                                                class="fa fa-power-off" aria-hidden="true"></i>
                                                            <b>Non
                                                                Active</b>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header bg-primary text-white mt-4">Setting Draft Blast</div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="subject" class="form-label mt-2"
                                        style="color: #888888; font-weight: 700;">Subject
                                    </label>
                                    <input type="text" name="subject" value="" class="form-control"
                                        id="subject">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="attachment" class="form-label mt-2"
                                        style="color: #888888; font-weight: 700;">Attachment<span
                                            class="text-danger"><i>Max.10mb
                                                (.pdf .docx . xlsx .png .jpg .jpeg)</i></span>
                                    </label>
                                    <input type="file" name="attachment" value="" class="form-control"
                                        style="height: 47px !important;" id="attachment">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="description" class="form-label"
                                        style="color: #888888; font-weight: 700;">Description Body
                                    </label>
                                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="tombol mt-1 mb-4">
                                <button type="submit" id="submitBtn" class="btn btn-primary w-100"
                                    style="height: 50px;">
                                    <span id="btnText"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        Send</span>
                                    <span id="btnSpinner" class="spinner-border d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>



            </div>

        </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen checkbox yang ID-nya diawali dengan "custome_" (custome_1 sampai custome_6)
            const customeCheckboxes = document.querySelectorAll('[id^="custome_"]');

            customeCheckboxes.forEach(function(checkbox) {
                // Abaikan jika ini adalah checkbox "required" (misal: custome_1_required)
                if (checkbox.id.endsWith('_required')) return;

                // Ambil angka indeks dari ID (misal dari "custome_1" didapat "1")
                const index = checkbox.id.split('_')[1];

                // Cari elemen target div yang ingin ditampilkan/disembunyikan
                const showDiv = document.getElementById('show_custome_' + index);

                function toggleCustome() {
                    // Pastikan elemen target div ada di HTML agar tidak error
                    if (!showDiv) return;

                    if (checkbox.checked) {
                        showDiv.style.display = 'block';
                        // Opsional: focus ke input pertama di dalam div tersebut jika ada
                        const firstInput = showDiv.querySelector('input, select, textarea');
                        if (firstInput) firstInput.focus();
                    } else {
                        showDiv.style.display = 'none';

                        // Kosongkan semua nilai input di dalam div tersebut saat di-uncheck
                        const inputs = showDiv.querySelectorAll('input, select, textarea');
                        inputs.forEach(input => {
                            if (input.type === 'checkbox' || input.type === 'radio') {
                                input.checked = false;
                            } else {
                                input.value = '';
                            }
                        });
                    }
                }

                // Jalankan saat user mencentang/menghilangkan centang pada checkbox
                checkbox.addEventListener('change', toggleCustome);

                // Jalankan otomatis saat halaman pertama kali dibuka (Sangat penting untuk form EDIT)
                toggleCustome();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#mulai').change(function() {
                var mulai = $(this).val();
                $('#akhir').val(mulai);
            });
        });
    </script>
    <script>
        $('#tabel').DataTable({
            dom: 'frtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export Excel',
                className: 'btn-export-excel',
                title: 'List of Data Center',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }]
        });
    </script>
    <script>
        $('#dataori').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export Excel',
                className: 'btn-export-excel',
                title: 'Attendance Record',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }]
        });
    </script>
    <script>
        $('#datanonactive').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export Excel',
                className: 'btn-export-excel',
                title: 'Attendance Record',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }]
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#tabel').DataTable();

            $('#countrySelect').select2({
                placeholder: "Select a country",
                allowClear: true
            });
            $('#countrySelect').on('change', function() {
                let value = $(this).val();
                table.column(5) // kolom "Sector" (index ke-6 dimulai dari 0)
                    .search(value)
                    .draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#tabell').DataTable();

            $('#sectorFilter').on('change', function() {
                let value = $(this).val();
                table.column(4) // kolom "Sector" (index ke-6 dimulai dari 0)
                    .search(value)
                    .draw();
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
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen select yang ID-nya diawali dengan "type_" (type_1 sampai type_6)
            const typeSelects = document.querySelectorAll('[id^="type_"]');

            typeSelects.forEach(function(select) {
                // Ambil angka indeks dari ID (misal dari "type_1" didapat "1")
                const index = select.id.split('_')[1];

                // Cari elemen target pasangan berdasarkan indeksnya
                const options = document.getElementById('options_' + index);
                const check = document.getElementById('custome_check_' + index);
                const file = document.getElementById('file_' + index);

                function toggleType() {
                    // Pastikan elemen-elemen tersebut ada di HTML agar tidak error
                    if (!options || !check || !file) return;

                    if (select.value === 'select' || select.value === 'checkbox') {
                        options.style.display = 'block';
                        file.style.display = 'none';

                        if (select.value === 'checkbox') {
                            check.style.display = 'block';
                            file.style.display = 'none';
                        } else {
                            check.style.display = 'none';
                        }
                        options.focus();
                    } else if (select.value === 'file') {
                        file.style.display = 'block';
                        options.style.display = 'none';
                        check.style.display = 'none';
                    } else {
                        // Sembunyikan semua dan kosongkan nilainya jika memilih tipe lain (seperti text, email, dll)
                        options.style.display = 'none';
                        check.style.display = 'none';
                        file.style.display = 'none';

                        options.value = '';
                        check.value = '';
                        file.value = '';
                    }
                }

                // Jalankan saat user mengubah pilihan di select option
                select.addEventListener('change', toggleType);

                // Jalankan otomatis saat halaman dibuka (Sangat penting untuk form EDIT)
                toggleType();
            });
        });
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
