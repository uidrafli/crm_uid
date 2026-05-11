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
        <div class="cold-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <h5>List of Registered Participants</h5>
                        <table id="tabel" class="table table-bordered nowrap display">
                            <thead>
                                @if (optional($row)->salutation and optional($row)->fullname != null)
                                    <tr>
                                        <th>No. Attendance</th>
                                        @if (optional($row)->salutation and optional($row)->fullname != null)
                                            <th>Name</th>
                                        @endif
                                        @if (optional($row)->email != null)
                                            <th>Email</th>
                                        @endif
                                        @if (optional($row)->phone != null)
                                            <th>Phone Number</th>
                                        @endif
                                        @if (optional($row)->institution != null)
                                            <th>Institutuin/Organization</th>
                                        @endif
                                        @if (optional($row)->position != null)
                                            <th>Role/Position</th>
                                        @endif
                                        @if (optional($row)->sector != null)
                                            <th>Sector</th>
                                        @endif
                                        @if (optional($row)->field != null)
                                            <th>Field</th>
                                        @endif
                                        @if (optional($row)->country != null)
                                            <th>Country Origin</th>
                                        @endif
                                        <th>QR Code</th>
                                        <th>Action</th>
                                    </tr>
                                @else
                                    <tr>
                                        <th>No. Attendance</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Institutuin/Organization</th>
                                        <th>Role/Position</th>
                                        <th>Sector</th>
                                        <th>Field</th>
                                        <th>Country Origin</th>
                                        <th>QR Code</th>
                                        <th>Action</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($data as $result)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                            @if ($result->presence == 'absent')
                                                <a href="{{ url('/registration/absent/' . $result->id_data_center) }}"
                                                    class="btn btn-primary ms-2"><span id="btnText"><i
                                                            class="fa fa-paper-plane" aria-hidden="true"></i> Confirm</span>
                                                </a>
                                            @endif
                                        </td>
                                        @if ($row->salutation && $row->fullname)
                                            <td>{{ $result->salutation }}. {{ $result->fullname }}</td>
                                        @endif

                                        @if ($row->email)
                                            <td>{{ $result->email ?? '-' }}</td>
                                        @endif

                                        @if ($row->phone)
                                            <td>{{ $result->phone ?? '-' }}</td>
                                        @endif

                                        @if ($row->institution)
                                            <td>{{ $result->institution ?? '-' }}</td>
                                        @endif

                                        @if ($row->position)
                                            <td>{{ $result->position ?? '-' }}</td>
                                        @endif

                                        @if ($row->sector)
                                            <td>{{ $result->sector ?? '-' }}</td>
                                        @endif

                                        @if ($row->field)
                                            <td>{{ $result->field ?? '-' }}</td>
                                        @endif

                                        @if ($row->country)
                                            <td>{{ $result->country ?? '-' }}</td>
                                        @endif
                                        <td>
                                            <!-- Tombol View Photo -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#photoModal{{ $result->id_data_center }}">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> <b>Visit</b>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="photoModal{{ $result->id_data_center }}"
                                                tabindex="-1" aria-labelledby="photoModalLabel{{ $result->id_data_center }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: 700 !important;"
                                                                id="photoModalLabel{{ $result->id_data_center }}">QR Code
                                                                {{ $result->salutation }} {{ $result->fullname }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset($result->qrcode_registration) }}"
                                                                alt="Photo" class="img-fluid mb-3"
                                                                style="max-height:400px;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ asset($result->qrcode_registration) }}"
                                                                class="btn btn-primary" download><i class="fa fa-download"
                                                                    aria-hidden="true"></i>
                                                                Download QRCode</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ url('/registration/update-results/' . $result->id_data_center) }}"
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

        <div class="cold-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <h5>Attendance Record</h5>
                        <table id="tabel2" class="table table-bordered nowrap display">
                            <thead>
                                @if (optional($row)->salutation and optional($row)->fullname != null)
                                    <tr>
                                        <th>No.</th>
                                        @if (optional($row)->salutation and optional($row)->fullname != null)
                                            <th>Name</th>
                                        @endif
                                        @if (optional($row)->email != null)
                                            <th>Email</th>
                                        @endif
                                        @if (optional($row)->phone != null)
                                            <th>Phone Number</th>
                                        @endif
                                        @if (optional($row)->institution != null)
                                            <th>Institutuin/Organization</th>
                                        @endif
                                        @if (optional($row)->position != null)
                                            <th>Role/Position</th>
                                        @endif
                                        @if (optional($row)->sector != null)
                                            <th>Sector</th>
                                        @endif
                                        @if (optional($row)->field != null)
                                            <th>Field</th>
                                        @endif
                                        @if (optional($row)->country != null)
                                            <th>Country Origin</th>
                                        @endif
                                    </tr>
                                @else
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Institutuin/Organization</th>
                                        <th>Role/Position</th>
                                        <th>Sector</th>
                                        <th>Field</th>
                                        <th>Country Origin</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($data2 as $result)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if ($row->salutation && $row->fullname)
                                            <td>{{ $result->salutation }}. {{ $result->fullname }}</td>
                                        @endif

                                        @if ($row->email)
                                            <td>{{ $result->email ?? '-' }}</td>
                                        @endif

                                        @if ($row->phone)
                                            <td>{{ $result->phone ?? '-' }}</td>
                                        @endif

                                        @if ($row->institution)
                                            <td>{{ $result->institution ?? '-' }}</td>
                                        @endif

                                        @if ($row->position)
                                            <td>{{ $result->position ?? '-' }}</td>
                                        @endif

                                        @if ($row->sector)
                                            <td>{{ $result->sector ?? '-' }}</td>
                                        @endif

                                        @if ($row->field)
                                            <td>{{ $result->field ?? '-' }}</td>
                                        @endif

                                        @if ($row->country)
                                            <td>{{ $result->country ?? '-' }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    title: 'List of Registered Participants',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }]
            });
        </script>
        <script>
            $('#tabel2').DataTable({
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
                document.querySelectorAll('.btn-delete').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id'); // ambil id dari attribute data-id

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
                                    title: 'Deleting...',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // 🔥 delay kecil biar loading sempat tampil
                                setTimeout(() => {
                                    window.location.href =
                                        "/registration/delete-result/" + id;
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
        {{-- @if (session('success'))
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
        @endif --}}
    @endpush
@endsection
