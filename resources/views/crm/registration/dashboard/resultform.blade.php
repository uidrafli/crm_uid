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
                                @if ((optional($row)->salutation && optional($row)->fullname != null) || optional($row)->custome_1 != null)
                                    <tr>
                                        <th>No. Attendance</th>
                                        @if ($data->whereNotNull('salutation')->count() && $data->whereNotNull('fullname')->count())
                                            <th>Name</th>
                                        @endif
                                        @if ($data->whereNotNull('email')->count())
                                            <th>Email</th>
                                        @endif
                                        @if ($data->whereNotNull('phone')->count())
                                            <th>Phone Number</th>
                                        @endif
                                        @if ($data->whereNotNull('institution')->count())
                                            <th>Institutuin/Organization</th>
                                        @endif
                                        @if ($data->whereNotNull('position')->count())
                                            <th>Role/Position</th>
                                        @endif
                                        @if ($data->whereNotNull('sector')->count())
                                            <th>Sector</th>
                                        @endif
                                        @if ($data->whereNotNull('field')->count())
                                            <th>Field</th>
                                        @endif
                                        @if ($data->whereNotNull('socialmedia')->count())
                                            <th>Social Media</th>
                                        @endif
                                        @if ($data->whereNotNull('linkedin')->count())
                                            <th>LinkedIn</th>
                                        @endif
                                        @if ($data->whereNotNull('citylived')->count())
                                            <th>City Lived</th>
                                        @endif
                                        @if ($data->whereNotNull('country')->count())
                                            <th>Country Origin</th>
                                        @endif
                                        @if ($data->whereNotNull('birtday')->count())
                                            <th>Date of Birth</th>
                                        @endif
                                        @if ($data->whereNotNull('latesteducation')->count())
                                            <th>Latest Education</th>
                                        @endif
                                        @if ($data->whereNotNull('englishproficiency')->count())
                                            <th>English Proficiency</th>
                                        @endif
                                        @if ($data->whereNotNull('uploadfile')->count())
                                            <th>Upload CV</th>
                                        @endif
                                        @if ($data->whereNotNull('fellowship')->count())
                                            <th>Fellowship</th>
                                        @endif
                                        @if ($data->whereNotNull('essay')->count())
                                            <th>Essay</th>
                                        @endif
                                        @if ($data->whereNotNull('roleworkshop')->count())
                                            <th>Role in Workshop</th>
                                        @endif
                                        @if ($data->whereNotNull('attendance')->count())
                                            <th>Attendance Type</th>
                                        @endif
                                        @if ($data->whereNotNull('allergy')->count())
                                            <th>Food Allergy</th>
                                        @endif
                                        @if ($data->whereNotNull('meal')->count())
                                            <th>Meal Type</th>
                                        @endif
                                        @if ($data->whereNotNull('disability')->count())
                                            <th>Support Disability</th>
                                        @endif
                                        @if ($data->whereNotNull('language')->count())
                                            <th>Preferred Language</th>
                                        @endif
                                        @if ($data->whereNotNull('picture')->count())
                                            <th>Professional Picture</th>
                                        @endif
                                        @if ($data->whereNotNull('bio')->count())
                                            <th>Short Bio</th>
                                        @endif
                                        @if ($data->whereNotNull('iconsent')->count())
                                            <th>I consent</th>
                                        @endif
                                        @if ($data->whereNotNull('privacy')->count())
                                            <th>Data Privacy</th>
                                        @endif
                                        @if ($data->whereNotNull('availdoc')->count())
                                            <th>Availability for Documentation</th>
                                        @endif
                                        @if ($data->whereNotNull('label_1')->count())
                                            <th>{{ $data->firstWhere('label_1', '!=', null)->label_1 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_2')->count())
                                            <th>{{ $data->firstWhere('label_2', '!=', null)->label_2 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_3')->count())
                                            <th>{{ $data->firstWhere('label_3', '!=', null)->label_3 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_4')->count())
                                            <th>{{ $data->firstWhere('label_4', '!=', null)->label_4 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_5')->count())
                                            <th>{{ $data->firstWhere('label_5', '!=', null)->label_5 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_6')->count())
                                            <th>{{ $data->firstWhere('label_6', '!=', null)->label_6 }}</th>
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
                                        <th>Events</th>
                                        <th>Institutuin/Organization</th>
                                        <th>Role/Position</th>
                                        <th>Sector</th>
                                        <th>Field</th>
                                        <th>Social Media</th>
                                        <th>LinkedIn</th>
                                        <th>City Lived</th>
                                        <th>Country Origin</th>
                                        <th>Date of Birth</th>
                                        <th>Latest Education</th>
                                        <th>English Proficiency</th>
                                        <th>Upload CV</th>
                                        <th>Fellowship</th>
                                        <th>Essay</th>
                                        <th>Role in Workshop</th>
                                        <th>Attendance Type</th>
                                        <th>Food Allergy</th>
                                        <th>Meal Type</th>
                                        <th>Support Disability</th>
                                        <th>Preferred Language</th>
                                        <th>Professional Picture</th>
                                        <th>Short Bio</th>
                                        <th>I consent</th>
                                        <th>Data Privacy</th>
                                        <th>Availability for Documentation</th>
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
                                        @if ($data->whereNotNull('salutation')->count() && $data->whereNotNull('fullname')->count())
                                            <td>{{ $result->salutation ?: '-' }} {{ $result->fullname ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('email')->count())
                                            <td>{{ $result->email ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('phone')->count())
                                            <td>{{ $result->phone ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('institution')->count())
                                            <td>{{ $result->institution ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('position')->count())
                                            <td>{{ $result->position ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('sector')->count())
                                            <td>{{ $result->sector ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('field')->count())
                                            <td>{{ $result->field ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('socialmedia')->count())
                                            <td>{{ $result->socialmedia ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('linkedin')->count())
                                            <td>{{ $result->linkedin ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('citylived')->count())
                                            <td>{{ $result->citylived ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('country')->count())
                                            <td>{{ $result->country ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('birthday')->count())
                                            <td>{{ $result->birthday ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('latesteducation')->count())
                                            <td>{{ $result->latesteducation ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('englishproficiency')->count())
                                            <td>{{ $result->englishproficiency ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('uploadfile')->count())
                                            @if ($result->uploadfile)
                                                <td>
                                                    <!-- Tombol View PDF -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModalCv{{ $result->id_data_center }}">
                                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                        <b>View PDF</b>
                                                    </button>

                                                    <!-- Modal PDF -->
                                                    <div class="modal fade" id="pdfModalCv{{ $result->id_data_center }}"
                                                        tabindex="-1"
                                                        aria-labelledby="pdfModalLabel{{ $result->id_data_center }}"
                                                        aria-hidden="true">

                                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold"
                                                                        id="pdfModalLabel{{ $result->id_data_center }}">
                                                                        Document CV {{ $result->salutation }}
                                                                        {{ $result->fullname }}
                                                                    </h5>

                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body p-0">

                                                                    <iframe src="{{ asset($result->uploadfile) }}"
                                                                        width="100%" height="700px" style="border:none;">
                                                                    </iframe>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <a href="{{ asset($result->uploadfile) }}"
                                                                        class="btn btn-primary" download>
                                                                        <i class="fa fa-download"></i>
                                                                        Download PDF
                                                                    </a>

                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                        <b>Close</b>
                                                                    </button>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif

                                        @if ($data->whereNotNull('fellowship')->count())
                                            <td>{{ $result->fellowship ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('essay')->count())
                                            @if ($result->essay)
                                                <td>
                                                    <!-- Tombol View PDF -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModalEssay{{ $result->id_data_center }}">
                                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                        <b>View PDF</b>
                                                    </button>

                                                    <!-- Modal PDF -->
                                                    <div class="modal fade" id="pdfModalEssay{{ $result->id_data_center }}"
                                                        tabindex="-1"
                                                        aria-labelledby="pdfModalLabel{{ $result->id_data_center }}"
                                                        aria-hidden="true">

                                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold"
                                                                        id="pdfModalLabel{{ $result->id_data_center }}">
                                                                        Document Essay {{ $result->salutation }}
                                                                        {{ $result->fullname }}
                                                                    </h5>

                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body p-0">

                                                                    <iframe src="{{ asset($result->essay) }}"
                                                                        width="100%" height="700px" style="border:none;">
                                                                    </iframe>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <a href="{{ asset($result->essay) }}"
                                                                        class="btn btn-primary" download>
                                                                        <i class="fa fa-download"></i>
                                                                        Download PDF
                                                                    </a>

                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                        <b>Close</b>
                                                                    </button>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif

                                        @if ($data->whereNotNull('roleworkshop')->count())
                                            <td>{{ $result->roleworkshop ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('attendance')->count())
                                            <td>{{ $result->attendance ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('allergy')->count())
                                            <td>{{ $result->allergy ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('meal')->count())
                                            <td>{{ $result->meal ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('disability')->count())
                                            <td>{{ $result->disability ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('language')->count())
                                            <td>{{ $result->language ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('picture')->count())
                                            @if ($result->picture)
                                                <td>
                                                    <!-- Tombol View Photo -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#photoModal{{ $result->id_data_center }}">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> <b>View</b>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="photoModal{{ $result->id_data_center }}"
                                                        tabindex="-1"
                                                        aria-labelledby="photoModalLabel{{ $result->id_data_center }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        style="font-weight: 700 !important;"
                                                                        id="photoModalLabel{{ $result->id_data_center }}">
                                                                        Photo
                                                                        {{ $result->salutation }} {{ $result->fullname }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset($result->picture) }}"
                                                                        alt="Photo" class="img-fluid mb-3"
                                                                        style="max-height:400px;">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ asset($result->picture) }}"
                                                                        class="btn btn-primary" download><i
                                                                            class="fa fa-download" aria-hidden="true"></i>
                                                                        Download Photo</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif

                                        @if ($data->whereNotNull('bio')->count())
                                            <td>{{ $result->bio ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('iconsent')->count())
                                            <td>{{ $result->iconsent ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('privacy')->count())
                                            <td>{{ $result->privacy ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('availdoc')->count())
                                            <td>{{ $result->availdoc ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_1')->count())
                                            <td>{{ $result->custome_1 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_2')->count())
                                            <td>{{ $result->custome_2 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_3')->count())
                                            <td>{{ $result->custome_3 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_4')->count())
                                            <td>{{ $result->custome_4 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_5')->count())
                                            <td>{{ $result->custome_5 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_6')->count())
                                            <td>{{ $result->custome_6 ?: '-' }}</td>
                                        @endif
                                        <td>
                                            <!-- Tombol View Photo -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#photoModal{{ $result->id_data_center }}">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> <b>Visit</b>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="photoModal{{ $result->id_data_center }}"
                                                tabindex="-1"
                                                aria-labelledby="photoModalLabel{{ $result->id_data_center }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: 700 !important;"
                                                                id="photoModalLabel{{ $result->id_data_center }}">QR Code
                                                                {{ $result->salutation }} {{ $result->fullname }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                                @if ((optional($row)->salutation && optional($row)->fullname != null) || optional($row)->custome_1 != null)
                                    <tr>
                                        <th>No.</th>
                                        @if ($data->whereNotNull('salutation')->count() && $data->whereNotNull('fullname')->count())
                                            <th>Name</th>
                                        @endif
                                        @if ($data->whereNotNull('email')->count())
                                            <th>Email</th>
                                        @endif
                                        @if ($data->whereNotNull('phone')->count())
                                            <th>Phone Number</th>
                                        @endif
                                        @if ($data->whereNotNull('institution')->count())
                                            <th>Institutuin/Organization</th>
                                        @endif
                                        @if ($data->whereNotNull('position')->count())
                                            <th>Role/Position</th>
                                        @endif
                                        @if ($data->whereNotNull('sector')->count())
                                            <th>Sector</th>
                                        @endif
                                        @if ($data->whereNotNull('field')->count())
                                            <th>Field</th>
                                        @endif
                                        @if ($data->whereNotNull('socialmedia')->count())
                                            <th>Social Media</th>
                                        @endif
                                        @if ($data->whereNotNull('linkedin')->count())
                                            <th>LinkedIn</th>
                                        @endif
                                        @if ($data->whereNotNull('citylived')->count())
                                            <th>City Lived</th>
                                        @endif
                                        @if ($data->whereNotNull('country')->count())
                                            <th>Country Origin</th>
                                        @endif
                                        @if ($data->whereNotNull('birtday')->count())
                                            <th>Date of Birth</th>
                                        @endif
                                        @if ($data->whereNotNull('latesteducation')->count())
                                            <th>Latest Education</th>
                                        @endif
                                        @if ($data->whereNotNull('englishproficiency')->count())
                                            <th>English Proficiency</th>
                                        @endif
                                        @if ($data->whereNotNull('uploadfile')->count())
                                            <th>Upload CV</th>
                                        @endif
                                        @if ($data->whereNotNull('fellowship')->count())
                                            <th>Fellowship</th>
                                        @endif
                                        @if ($data->whereNotNull('essay')->count())
                                            <th>Essay</th>
                                        @endif
                                        @if ($data->whereNotNull('roleworkshop')->count())
                                            <th>Role in Workshop</th>
                                        @endif
                                        @if ($data->whereNotNull('attendance')->count())
                                            <th>Attendance Type</th>
                                        @endif
                                        @if ($data->whereNotNull('allergy')->count())
                                            <th>Food Allergy</th>
                                        @endif
                                        @if ($data->whereNotNull('meal')->count())
                                            <th>Meal Type</th>
                                        @endif
                                        @if ($data->whereNotNull('disability')->count())
                                            <th>Support Disability</th>
                                        @endif
                                        @if ($data->whereNotNull('language')->count())
                                            <th>Preferred Language</th>
                                        @endif
                                        @if ($data->whereNotNull('picture')->count())
                                            <th>Professional Picture</th>
                                        @endif
                                        @if ($data->whereNotNull('bio')->count())
                                            <th>Short Bio</th>
                                        @endif
                                        @if ($data->whereNotNull('iconsent')->count())
                                            <th>I consent</th>
                                        @endif
                                        @if ($data->whereNotNull('privacy')->count())
                                            <th>Data Privacy</th>
                                        @endif
                                        @if ($data->whereNotNull('availdoc')->count())
                                            <th>Availability for Documentation</th>
                                        @endif
                                        @if ($data->whereNotNull('label_1')->count())
                                            <th>{{ $data->firstWhere('label_1', '!=', null)->label_1 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_2')->count())
                                            <th>{{ $data->firstWhere('label_2', '!=', null)->label_2 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_3')->count())
                                            <th>{{ $data->firstWhere('label_3', '!=', null)->label_3 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_4')->count())
                                            <th>{{ $data->firstWhere('label_4', '!=', null)->label_4 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_5')->count())
                                            <th>{{ $data->firstWhere('label_5', '!=', null)->label_5 }}</th>
                                        @endif

                                        @if ($data->whereNotNull('label_6')->count())
                                            <th>{{ $data->firstWhere('label_6', '!=', null)->label_6 }}</th>
                                        @endif
                                    </tr>
                                @else
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
                                        <th>Social Media</th>
                                        <th>LinkedIn</th>
                                        <th>City Lived</th>
                                        <th>Country Origin</th>
                                        <th>Date of Birth</th>
                                        <th>Latest Education</th>
                                        <th>English Proficiency</th>
                                        <th>Upload CV</th>
                                        <th>Fellowship</th>
                                        <th>Essay</th>
                                        <th>Role in Workshop</th>
                                        <th>Attendance Type</th>
                                        <th>Food Allergy</th>
                                        <th>Meal Type</th>
                                        <th>Support Disability</th>
                                        <th>Preferred Language</th>
                                        <th>Professional Picture</th>
                                        <th>Short Bio</th>
                                        <th>I consent</th>
                                        <th>Data Privacy</th>
                                        <th>Availability for Documentation</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($data2 as $result)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if ($data->whereNotNull('salutation')->count() && $data->whereNotNull('fullname')->count())
                                            <td>{{ $result->salutation ?: '-' }} {{ $result->fullname ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('email')->count())
                                            <td>{{ $result->email ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('phone')->count())
                                            <td>{{ $result->phone ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('institution')->count())
                                            <td>{{ $result->institution ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('position')->count())
                                            <td>{{ $result->position ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('sector')->count())
                                            <td>{{ $result->sector ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('field')->count())
                                            <td>{{ $result->field ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('socialmedia')->count())
                                            <td>{{ $result->socialmedia ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('linkedin')->count())
                                            <td>{{ $result->linkedin ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('citylived')->count())
                                            <td>{{ $result->citylived ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('country')->count())
                                            <td>{{ $result->country ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('birthday')->count())
                                            <td>{{ $result->birthday ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('latesteducation')->count())
                                            <td>{{ $result->latesteducation ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('englishproficiency')->count())
                                            <td>{{ $result->englishproficiency ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('uploadfile')->count())
                                            <td>{{ $result->uploadfile ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('fellowship')->count())
                                            <td>{{ $result->fellowship ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('essay')->count())
                                            <td>{{ $result->essay ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('roleworkshop')->count())
                                            <td>{{ $result->roleworkshop ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('attendance')->count())
                                            <td>{{ $result->attendance ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('allergy')->count())
                                            <td>{{ $result->allergy ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('meal')->count())
                                            <td>{{ $result->meal ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('disability')->count())
                                            <td>{{ $result->disability ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('language')->count())
                                            <td>{{ $result->language ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('picture')->count())
                                            <td>{{ $result->picture ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('bio')->count())
                                            <td>{{ $result->bio ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('iconsent')->count())
                                            <td>{{ $result->iconsent ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('privacy')->count())
                                            <td>{{ $result->privacy ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('availdoc')->count())
                                            <td>{{ $result->availdoc ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_1')->count())
                                            <td>{{ $result->custome_1 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_2')->count())
                                            <td>{{ $result->custome_2 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_3')->count())
                                            <td>{{ $result->custome_3 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_4')->count())
                                            <td>{{ $result->custome_4 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_5')->count())
                                            <td>{{ $result->custome_5 ?: '-' }}</td>
                                        @endif

                                        @if ($data->whereNotNull('label_6')->count())
                                            <td>{{ $result->custome_6 ?: '-' }}</td>
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
