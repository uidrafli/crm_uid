@extends('templates.dashboard')
@section('isi')
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
                    </div> --}}
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/registration/create-form') }}" class="btn btn-primary"><span id="btnText"><i
                                    class="fa fa-paper-plane" aria-hidden="true"></i> Create Registration Form</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cold-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <form action="{{ url('/data-absen') }}">
                        <div class="row">
                            <div class="col-3">
                                <select name="user_id" id="user_id" class="form-control selectpicker"
                                    data-live-search="true">
                                    <option value=""selected>Pilih Pegawai</option>
                                    @foreach ($user as $u)
                                        @if (request('user_id') == $u->id)
                                            <option value="{{ $u->id }}"selected>{{ $u->name }}</option>
                                        @else
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai"
                                    id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir"
                                    id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-3">
                                <button type="submit" id="search"class="border-0 mt-3"
                                    style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tabel" class="table table-bordered nowrap display">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Link Form</th>
                                    <th>Dashboard</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $result)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $result->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($result->start_date)->format('l, d F Y') }}</td>
                                        <td>
                                            @if ($result->status == 'Completed')
                                                <span class="badge bg-success">{{ $result->status ?? '-' }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $result->status ?? '-' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Tombol View Photo -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#photoModal{{ $result->id_events_form }}">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> <b>Visit</b>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="photoModal{{ $result->id_events_form }}"
                                                tabindex="-1"
                                                aria-labelledby="photoModalLabel{{ $result->id_events_form }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: 700 !important;"
                                                                id="photoModalLabel{{ $result->id_events_form }}">Link
                                                                Event & QR
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset($result->qrcode_link) }}" alt="Photo"
                                                                class="img-fluid mb-3" style="max-height:400px;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ asset($result->qrcode_link) }}"
                                                                class="btn btn-primary" download><i class="fa fa-download"
                                                                    aria-hidden="true"></i>
                                                                Download QRCode</a>
                                                            <a href="{{ url('/registration/' . $result->custome_link) }}"
                                                                class="btn btn-info" target="_blank"><i
                                                                    class="fa fa-paper-plane" aria-hidden="true"></i> Visit
                                                                Link</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ url('/registration/dashboard/' . $result->key_events) }}"
                                                class="btn btn-primary"><span id="btnText"><i class="fa fa-eye"
                                                        aria-hidden="true"></i>View</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/registration/update-form/' . $result->id_events_form) }}"
                                                class="btn btn-warning"><span id="btnText"><i class="fa fa-edit"
                                                        aria-hidden="true"></i></span>
                                            </a>
                                            <button class="btn btn-danger btn-delete"
                                                data-id="{{ $result->id_events_form }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-flex justify-content-end mt-4">
                        {{ $data->links() }}
                    </div> --}}
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
        {{-- <script>
            $(document).ready(function() {
                $('#tabel').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excel',
                        text: 'Export Excel',
                        className: 'btn-export-excel' // Kelas kustom kamu
                    }],
                    pageLength: 10,
                    ordering: true,
                    searching: true
                });
            });
        </script> --}}
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
                                        "/registration/delete-form/" + id;
                                }, 1000);
                            }
                        });
                    });
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
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `{!! implode('<br>', $errors->all()) !!}`
                });
            </script>
        @endif
    @endpush
@endsection
