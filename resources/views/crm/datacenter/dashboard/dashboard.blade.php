@extends('templates.dashboard')
@section('isi')
    <style>
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
    </style>
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    {{-- <div class="col-md-3 p-0">
                        <a href="{{ url('/data-absen/export') }}{{ $_GET ? '?' . $_SERVER['QUERY_STRING'] : '' }}"
                            class="btn btn-success">Export</a>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/registration/create-form') }}" class="btn btn-success"><span id="btnText"><i
                                    class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</span></a>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <!-- TAB 1 -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                        type="button">
                        Data Center
                    </button>
                </li>

                <!-- TAB 2 -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button">
                        Data Original
                    </button>
                </li>

                <!-- TAB 3 -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button">
                        Data Non Active
                    </button>
                </li>

            </ul>
        </div>

        <div class="tab-content mt-3" id="myTabContent">

            <!-- ISI TAB 1 -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">

                <div class="cold-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <h5>List of Data Center</h5>
                                <table id="tabel" class="table table-bordered nowrap display">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Events</th>
                                            <th>Institutuin/Organization</th>
                                            <th>Role/Position</th>
                                            <th>Sector</th>
                                            <th>Field</th>
                                            <th>Country Origin</th>
                                            <th>Status Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $result)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $result['salutation'] ?? '-' }}. {{ $result['fullname'] ?? '-' }}
                                                </td>
                                                <td>{{ $result['email'] ?? '-' }}</td>
                                                <td>{{ $result['phone'] ?? '-' }}</td>
                                                <td>
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach ($result['name_events'] as $index => $name_events)
                                                            <li class="d-flex justify-content-between">
                                                                <span>{{ $name_events }}</span>

                                                                <span class="ms-2 text-secondary">
                                                                    {{ \Carbon\Carbon::parse($form[$index])->format('d F Y') }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{-- {{ $result->institution ?? '-' }} --}}
                                                    <ul>
                                                        @foreach ($result['institution'] as $institution)
                                                            <li>{{ $institution }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['position'] as $position)
                                                            <li>{{ $position }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['sector'] as $sector)
                                                            <li>{{ $sector }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['field'] as $field)
                                                            <li>{{ $field }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['country'] as $country)
                                                            <li>{{ $country }}</li>
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
                                                            data-email="{{ $result['email'] }}"><i class="fa fa-power-off"
                                                                aria-hidden="true"></i> <b>Active</b>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-warning btn-nonactive"
                                                            data-email="{{ $result['email'] }}"><i class="fa fa-power-off"
                                                                aria-hidden="true"></i> <b>Non Active</b>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ISI TAB 2 -->
            <div class="tab-pane fade" id="tab2" role="tabpanel">

                <div class="cold-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <h5>List of Data Center Original</h5>
                                <table id="dataori" class="table table-bordered nowrap display">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Events</th>
                                            <th>Institutuin/Organization</th>
                                            <th>Role/Position</th>
                                            <th>Sector</th>
                                            <th>Field</th>
                                            <th>Country Origin</th>
                                            <th>Status Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataOriginal as $result)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $result->salutation ?? '-' }}. {{ $result->fullname ?? '-' }}
                                                </td>
                                                <td>{{ $result->email ?? '-' }}</td>
                                                <td>{{ $result->phone ?? '-' }}</td>
                                                <td>{{ $result->name_events ?? '-' }}</td>
                                                <td>{{ $result->institution ?? '-' }}</td>
                                                <td>{{ $result->position ?? '-' }}</td>
                                                <td>{{ $result->sector ?? '-' }}</td>
                                                <td>{{ $result->field ?? '-' }}</td>
                                                <td>{{ $result->country ?? '-' }}</td>
                                                <td>
                                                    @if ($result->status_users == 'Active')
                                                        <span
                                                            class="badge bg-primary">{{ $result->status_users ?? '-' }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger">{{ $result->status_users ?? '-' }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('/data-center/update/' . $result->id_data_center) }}"
                                                        class="btn btn-warning"><span id="btnText"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></span>
                                                    </a>
                                                    <button class="btn btn-danger btn-delete"
                                                        data-id="{{ $result->id_data_center }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ISI TAB 3 -->
            <div class="tab-pane fade" id="tab3" role="tabpanel">

                <div class="cold-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <h5>List of Data Center Non Active</h5>
                                <table id="datanonactive" class="table table-bordered nowrap display">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Events</th>
                                            <th>Institutuin/Organization</th>
                                            <th>Role/Position</th>
                                            <th>Sector</th>
                                            <th>Field</th>
                                            <th>Country Origin</th>
                                            <th>Status Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_nonactive as $result)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $result['salutation'] ?? '-' }}. {{ $result['fullname'] ?? '-' }}
                                                </td>
                                                <td>{{ $result['email'] ?? '-' }}</td>
                                                <td>{{ $result['phone'] ?? '-' }}</td>
                                                <td>
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach ($result['name_events'] as $index => $name_events)
                                                            <li class="d-flex justify-content-between">
                                                                <span>{{ $name_events }}</span>

                                                                <span class="ms-2 text-secondary">
                                                                    {{ \Carbon\Carbon::parse($form[$index])->format('d F Y') }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{-- {{ $result->institution ?? '-' }} --}}
                                                    <ul>
                                                        @foreach ($result['institution'] as $institution)
                                                            <li>{{ $institution }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['position'] as $position)
                                                            <li>{{ $position }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['sector'] as $sector)
                                                            <li>{{ $sector }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['field'] as $field)
                                                            <li>{{ $field }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['country'] as $country)
                                                            <li>{{ $country }}</li>
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
                                                            data-email="{{ $result['email'] }}"><i class="fa fa-power-off"
                                                                aria-hidden="true"></i> <b>Active</b>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-warning btn-nonactive"
                                                            data-email="{{ $result['email'] }}"><i class="fa fa-power-off"
                                                                aria-hidden="true"></i> <b>Non Active</b>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @push('script')
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
                dom: 'Bfrtip',
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
            document.addEventListener("DOMContentLoaded", function() {
                // ambil semua tombol approve
                document.querySelectorAll('.btn-active').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let email = this.getAttribute(
                            'data-email'); // ambil id dari attribute data-email

                        Swal.fire({
                            title: 'Active data?',
                            text: "Are you sure you want to active this data?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // 🔥 tampilkan loading
                                Swal.fire({
                                    title: 'Loading...',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // 🔥 delay kecil biar loading sempat tampil
                                setTimeout(() => {
                                    window.location.href =
                                        "/data-center/active/" + email;
                                }, 1000);
                            }
                        });
                    });
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                // ambil semua tombol approve
                document.querySelectorAll('.btn-nonactive').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let email = this.getAttribute(
                            'data-email'); // ambil id dari attribute data-email

                        Swal.fire({
                            title: 'Non active data?',
                            text: "Are you sure you want to non active this data?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // 🔥 tampilkan loading
                                Swal.fire({
                                    title: 'Loading...',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // 🔥 delay kecil biar loading sempat tampil
                                setTimeout(() => {
                                    window.location.href =
                                        "/data-center/non-active/" + email;
                                }, 1000);
                            }
                        });
                    });
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                // ambil semua tombol approve
                document.querySelectorAll('.btn-delete').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute(
                            'data-id'); // ambil id dari attribute data-id

                        Swal.fire({
                            title: 'Delete data?',
                            text: "Are you sure you want to delete this data?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // 🔥 tampilkan loading
                                Swal.fire({
                                    title: 'Deleteing...',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // 🔥 delay kecil biar loading sempat tampil
                                setTimeout(() => {
                                    window.location.href =
                                        "/data-center/delete/" + id;
                                }, 1000);
                            }
                        });
                    });
                });
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
    @endpush
@endsection
