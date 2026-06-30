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
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4>{{ $title }}</h4>
                    </div>

                    <div class="col-md-6 d-flex justify-content-md-end mt-2 mt-md-0">
                        <form action="{{ url('/data-center/import') }}" id="form-import" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="d-flex">
                                <input type="file" name="import" class="form-control">

                                {{-- <button type="submit" class="btn btn-primary ms-2">
                                    Import
                                </button> --}}
                                <button type="submit" id="submitBtn-import" class="btn btn-primary ms-2">
                                    <span id="btnText-import">Import</span>
                                    <span id="btnSpinner-import" class="spinner-border d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
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
                                {{-- <h5>List of Data Center</h5> --}}
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
                                                    <option value="" disabled selected>--Select Sector--</option>
                                                    <option value="Government">Government</option>
                                                    <option value="Business">Business</option>
                                                    <option value="Civil Society">Civil Society</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="field" class="form-label"
                                                    style="color: #888888; font-weight: 700;">Field</label>
                                                <select class="form-select form-control" name="field" id="field">
                                                    <option value="" disabled selected>--Select Field--</option>
                                                    <option value="Leadership">Leadership</option>
                                                    <option value="Forestry">Forestry</option>
                                                    <option value="Technology">Technology</option>
                                                    <option value="Creative Economy & Industry">Creative Economy & Industry
                                                    </option>
                                                    <option value="Education, Capacity Building, and Youth Empowerment">
                                                        Education, Capacity
                                                        Building,
                                                        and Youth Empowerment</option>
                                                    <option value="Blended & Sustainable Finance">Blended & Sustainable
                                                        Finance</option>
                                                    <option value="Energy">Energy</option>
                                                    <option value="Equality & Inclusion">Equality & Inclusion</option>
                                                    <option value="Health, Wellbeing & Sports">Health, Wellbeing & Sports
                                                    </option>
                                                    <option value="Good Governance & Leadership">Good Governance &
                                                        Leadership</option>
                                                    <option value="MSME & Entrepreneurship">MSME & Entrepreneurship
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
                                                <select class="form-select form-control" name="type_of_database" id="type_of_database">
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
                                <table id="tabel" class="table table-bordered nowrap display">
                                    <a href="{{ route('data_center.export', request()->all()) }}" id="exportBtn"
                                        class="btn btn-success">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Export Excel</span>
                                    </a>

                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Salutation</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Events</th>
                                            <th>Fellows Program</th>
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
                                            <th>Custome 1</th>
                                            <th>Custome 2</th>
                                            <th>Custome 3</th>
                                            <th>Custome 4</th>
                                            <th>Custome 5</th>
                                            <th>Custome 6</th>
                                            <th>Type of Dtabase</th>
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
                                                <td>{{ $result['salutation'] ?? '-' }}</td>
                                                <td>{{ $result['fullname'] ?? '-' }}</td>
                                                <td>{{ $result['email'] ?? '-' }}</td>
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
                                                        {{-- @foreach ($result['name_events'] as $index => $name_events)
                                                                <li class="d-flex justify-content-between">
                                                                    <span>{{ $name_events }}</span>

                                                                    <span class="ms-2 text-secondary">
                                                                        {{ isset($form[$result['key_events'][$index]])
                                                                            ? \Carbon\Carbon::parse($form[$result['key_events'][$index]])->format('d F Y')
                                                                            : '-' }}
                                                                    </span>
                                                                </li>
                                                            @endforeach --}}
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['fellows_program'] as $fellows_program)
                                                            <li>{{ $fellows_program ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{-- {{ $result->institution ?? '-' }} --}}
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
                                                    <ul>
                                                        @foreach ($result['socialmedia'] as $socialmedia)
                                                            <li>{{ $socialmedia ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['linkedin'] as $linkedin)
                                                            <li>{{ $linkedin ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['citylived'] as $citylived)
                                                            <li>{{ $citylived ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['country'] as $country)
                                                            <li>{{ $country ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['birthday'] as $birthday)
                                                            <li>{{ $birthday ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['latesteducation'] as $latesteducation)
                                                            <li>{{ $latesteducation ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['englishproficiency'] as $englishproficiency)
                                                            <li>{{ $englishproficiency ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['uploadfile'] as $uploadfile)
                                                            <li>
                                                                @if ($uploadfile)
                                                                    <!-- Tombol View PDF -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModalCv{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-file-pdf-o"
                                                                            aria-hidden="true"></i>
                                                                        <b>View PDF</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal PDF -->
                                                                <div class="modal fade"
                                                                    id="pdfModalCv{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="pdfModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">

                                                                    <div
                                                                        class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title fw-bold"
                                                                                    id="pdfModalLabel{{ $result['id_data_center'] }}">
                                                                                    Document CV {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>

                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body p-0">

                                                                                <iframe src="{{ asset($uploadfile) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border:none;">
                                                                                </iframe>

                                                                            </div>

                                                                            <div class="modal-footer">

                                                                                <a href="{{ asset($uploadfile) }}"
                                                                                    class="btn btn-primary" download>
                                                                                    <i class="fa fa-download"></i>
                                                                                    Download PDF
                                                                                </a>

                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">
                                                                                    <b>Close</b>
                                                                                </button>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['fellowship'] as $fellowship)
                                                            <li>{{ $fellowship ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['essay'] as $essay)
                                                            <li>
                                                                @if ($essay)
                                                                    <!-- Tombol View PDF -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModalEssay{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-file-pdf-o"
                                                                            aria-hidden="true"></i>
                                                                        <b>View PDF</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal PDF -->
                                                                <div class="modal fade"
                                                                    id="pdfModalEssay{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="pdfModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">

                                                                    <div
                                                                        class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title fw-bold"
                                                                                    id="pdfModalLabel{{ $result['id_data_center'] }}">
                                                                                    Document Essay
                                                                                    {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>

                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body p-0">

                                                                                <iframe src="{{ asset($essay) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border:none;">
                                                                                </iframe>

                                                                            </div>

                                                                            <div class="modal-footer">

                                                                                <a href="{{ asset($essay) }}"
                                                                                    class="btn btn-primary" download>
                                                                                    <i class="fa fa-download"></i>
                                                                                    Download PDF
                                                                                </a>

                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">
                                                                                    <b>Close</b>
                                                                                </button>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['roleworkshop'] as $roleworkshop)
                                                            <li>{{ $roleworkshop ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['attendance'] as $attendance)
                                                            <li>{{ $attendance ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['allergy'] as $allergy)
                                                            <li>{{ $allergy ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['meal'] as $meal)
                                                            <li>{{ $meal ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['disability'] as $disability)
                                                            <li>{{ $disability ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['language'] as $language)
                                                            <li>{{ $language ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['picture'] as $picture)
                                                            <li>
                                                                @if ($picture)
                                                                    <!-- Tombol View Photo -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#photoModal{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-paper-plane"
                                                                            aria-hidden="true"></i>
                                                                        <b>View</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="photoModal{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="photoModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    style="font-weight: 700 !important;"
                                                                                    id="photoModalLabel{{ $result['id_data_center'] }}">
                                                                                    Photo
                                                                                    {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <img src="{{ asset($picture) }}"
                                                                                    alt="Photo" class="img-fluid mb-3"
                                                                                    style="max-height:400px;">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <a href="{{ asset($picture) }}"
                                                                                    class="btn btn-primary" download><i
                                                                                        class="fa fa-download"
                                                                                        aria-hidden="true"></i>
                                                                                    Download Photo</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['bio'] as $bio)
                                                            <li>{{ $bio ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['iconsent'] as $iconsent)
                                                            <li>{{ $iconsent ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['privacy'] as $privacy)
                                                            <li>{{ $privacy ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['availdoc'] as $availdoc)
                                                            <li>{{ $availdoc ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_1'] as $custome_1)
                                                            <li>{{ $custome_1 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_2'] as $custome_2)
                                                            <li>{{ $custome_2 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_3'] as $custome_3)
                                                            <li>{{ $custome_3 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_4'] as $custome_4)
                                                            <li>{{ $custome_4 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_5'] as $custome_5)
                                                            <li>{{ $custome_5 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_6'] as $custome_6)
                                                            <li>{{ $custome_6 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $result['type_of_database'] ?? '-' }}</td>
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
                                                                class="fa fa-power-off" aria-hidden="true"></i> <b>Non
                                                                Active</b>
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
                                            <th>Custome 1</th>
                                            <th>Custome 2</th>
                                            <th>Custome 3</th>
                                            <th>Custome 4</th>
                                            <th>Custome 5</th>
                                            <th>Custome 6</th>
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
                                                <td>{{ $result->socialmedia ?? '-' }}</td>
                                                <td>{{ $result->linkedin ?? '-' }}</td>
                                                <td>{{ $result->citylived ?? '-' }}</td>
                                                <td>{{ $result->country ?? '-' }}</td>
                                                <td>{{ $result->birthday ?? '-' }}</td>
                                                <td>{{ $result->latesteducation ?? '-' }}</td>
                                                <td>{{ $result->englishproficiency ?? '-' }}</td>
                                                <td>
                                                    @if ($result->uploadfile)
                                                        <!-- Tombol View PDF -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#pdfModalCvOri{{ $result->id_data_center }}">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                            <b>View PDF</b>
                                                        </button>

                                                        <!-- Modal PDF -->
                                                        <div class="modal fade"
                                                            id="pdfModalCvOri{{ $result->id_data_center }}"
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
                                                                            width="100%" height="700px"
                                                                            style="border:none;">
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
                                                    @else
                                                        <div>-</div>
                                                    @endif
                                                </td>
                                                <td>{{ $result->fellowship ?? '-' }}</td>
                                                <td>
                                                    @if ($result->essay)
                                                        <!-- Tombol View PDF -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#pdfModalEssayOri{{ $result->id_data_center }}">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                            <b>View PDF</b>
                                                        </button>

                                                        <!-- Modal PDF -->
                                                        <div class="modal fade"
                                                            id="pdfModalEssayOri{{ $result->id_data_center }}"
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
                                                                            width="100%" height="700px"
                                                                            style="border:none;">
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
                                                    @else
                                                        <div>-</div>
                                                    @endif
                                                </td>
                                                <td>{{ $result->roleworkshop ?? '-' }}</td>
                                                <td>{{ $result->attendance ?? '-' }}</td>
                                                <td>{{ $result->allergy ?? '-' }}</td>
                                                <td>{{ $result->meal ?? '-' }}</td>
                                                <td>{{ $result->disability ?? '-' }}</td>
                                                <td>{{ $result->language ?? '-' }}</td>
                                                <td>
                                                    @if ($result->picture)
                                                        <!-- Tombol View Photo -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#photoModalOri{{ $result->id_data_center }}">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                            <b>View</b>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="photoModalOri{{ $result->id_data_center }}"
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
                                                                            {{ $result->salutation }}
                                                                            {{ $result->fullname }}
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
                                                                                class="fa fa-download"
                                                                                aria-hidden="true"></i>
                                                                            Download Photo</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>-</div>
                                                    @endif
                                                </td>
                                                <td>{{ $result->bio ?? '-' }}</td>
                                                <td>{{ $result->iconsent ?? '-' }}</td>
                                                <td>{{ $result->privacy ?? '-' }}</td>
                                                <td>{{ $result->availdoc ?? '-' }}</td>
                                                <td>{{ $result->custome_1 ?? '-' }}</td>
                                                <td>{{ $result->custome_2 ?? '-' }}</td>
                                                <td>{{ $result->custome_3 ?? '-' }}</td>
                                                <td>{{ $result->custome_4 ?? '-' }}</td>
                                                <td>{{ $result->custome_5 ?? '-' }}</td>
                                                <td>{{ $result->custome_6 ?? '-' }}</td>
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
                                                        class="btn btn-warning"><span id="btnText"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></span>
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
                                            <th>Custome 1</th>
                                            <th>Custome 2</th>
                                            <th>Custome 3</th>
                                            <th>Custome 4</th>
                                            <th>Custome 5</th>
                                            <th>Custome 6</th>
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
                                                        {{-- @foreach ($result['name_events'] as $index => $name_events)
                                                                <li class="d-flex justify-content-between">
                                                                    <span>{{ $name_events }}</span>

                                                                    <span class="ms-2 text-secondary">
                                                                        {{ isset($form[$result['key_events'][$index]])
                                                                            ? \Carbon\Carbon::parse($form[$result['key_events'][$index]])->format('d F Y')
                                                                            : '-' }}
                                                                    </span>
                                                                </li>
                                                            @endforeach --}}
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{-- {{ $result->institution ?? '-' }} --}}
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
                                                    <ul>
                                                        @foreach ($result['socialmedia'] as $socialmedia)
                                                            <li>{{ $socialmedia ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['linkedin'] as $linkedin)
                                                            <li>{{ $linkedin ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['citylived'] as $citylived)
                                                            <li>{{ $citylived ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['country'] as $country)
                                                            <li>{{ $country ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['birthday'] as $birthday)
                                                            <li>{{ $birthday ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['latesteducation'] as $latesteducation)
                                                            <li>{{ $latesteducation ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['englishproficiency'] as $englishproficiency)
                                                            <li>{{ $englishproficiency ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['uploadfile'] as $uploadfile)
                                                            <li>
                                                                @if ($uploadfile)
                                                                    <!-- Tombol View PDF -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModalCvNon{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-file-pdf-o"
                                                                            aria-hidden="true"></i>
                                                                        <b>View PDF</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal PDF -->
                                                                <div class="modal fade"
                                                                    id="pdfModalCvNon{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="pdfModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">

                                                                    <div
                                                                        class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title fw-bold"
                                                                                    id="pdfModalLabel{{ $result['id_data_center'] }}">
                                                                                    Document CV
                                                                                    {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>

                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body p-0">

                                                                                <iframe src="{{ asset($uploadfile) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border:none;">
                                                                                </iframe>

                                                                            </div>

                                                                            <div class="modal-footer">

                                                                                <a href="{{ asset($uploadfile) }}"
                                                                                    class="btn btn-primary" download>
                                                                                    <i class="fa fa-download"></i>
                                                                                    Download PDF
                                                                                </a>

                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">
                                                                                    <b>Close</b>
                                                                                </button>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['fellowship'] as $fellowship)
                                                            <li>{{ $fellowship ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['essay'] as $essay)
                                                            <li>
                                                                @if ($essay)
                                                                    <!-- Tombol View PDF -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModalEssayNon{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-file-pdf-o"
                                                                            aria-hidden="true"></i>
                                                                        <b>View PDF</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal PDF -->
                                                                <div class="modal fade"
                                                                    id="pdfModalEssayNon{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="pdfModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">

                                                                    <div
                                                                        class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title fw-bold"
                                                                                    id="pdfModalLabel{{ $result['id_data_center'] }}">
                                                                                    Document Essay
                                                                                    {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>

                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body p-0">

                                                                                <iframe src="{{ asset($essay) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border:none;">
                                                                                </iframe>

                                                                            </div>

                                                                            <div class="modal-footer">

                                                                                <a href="{{ asset($essay) }}"
                                                                                    class="btn btn-primary" download>
                                                                                    <i class="fa fa-download"></i>
                                                                                    Download PDF
                                                                                </a>

                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">
                                                                                    <b>Close</b>
                                                                                </button>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['roleworkshop'] as $roleworkshop)
                                                            <li>{{ $roleworkshop ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['attendance'] as $attendance)
                                                            <li>{{ $attendance ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['allergy'] as $allergy)
                                                            <li>{{ $allergy ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['meal'] as $meal)
                                                            <li>{{ $meal ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['disability'] as $disability)
                                                            <li>{{ $disability ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['language'] as $language)
                                                            <li>{{ $language ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['picture'] as $picture)
                                                            <li>
                                                                @if ($picture)
                                                                    <!-- Tombol View Photo -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#photoModalNon{{ $result['id_data_center'] }}">
                                                                        <i class="fa fa-paper-plane"
                                                                            aria-hidden="true"></i>
                                                                        <b>View</b>
                                                                    </button>
                                                                @else
                                                                    <div>-</div>
                                                                @endif

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="photoModalNon{{ $result['id_data_center'] }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="photoModalLabel{{ $result['id_data_center'] }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    style="font-weight: 700 !important;"
                                                                                    id="photoModalLabel{{ $result['id_data_center'] }}">
                                                                                    Photo
                                                                                    {{ $result['salutation'] }}
                                                                                    {{ $result['fullname'] }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <img src="{{ asset($picture) }}"
                                                                                    alt="Photo" class="img-fluid mb-3"
                                                                                    style="max-height:400px;">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <a href="{{ asset($picture) }}"
                                                                                    class="btn btn-primary" download><i
                                                                                        class="fa fa-download"
                                                                                        aria-hidden="true"></i>
                                                                                    Download Photo</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['bio'] as $bio)
                                                            <li>{{ $bio ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['iconsent'] as $iconsent)
                                                            <li>{{ $iconsent ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['privacy'] as $privacy)
                                                            <li>{{ $privacy ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['availdoc'] as $availdoc)
                                                            <li>{{ $availdoc ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_1'] as $custome_1)
                                                            <li>{{ $custome_1 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_2'] as $custome_2)
                                                            <li>{{ $custome_2 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_3'] as $custome_3)
                                                            <li>{{ $custome_3 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_4'] as $custome_4)
                                                            <li>{{ $custome_4 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_5'] as $custome_5)
                                                            <li>{{ $custome_5 ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($result['custome_6'] as $custome_6)
                                                            <li>{{ $custome_6 ?? '-' }}</li>
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
                                                                class="fa fa-power-off" aria-hidden="true"></i> <b>Non
                                                                Active</b>
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
            document.getElementById('form-import').addEventListener('submit', function() {
                let btn = document.getElementById('submitBtn-import');
                let text = document.getElementById('btnText-import');
                let spinner = document.getElementById('btnSpinner-import');

                // Sembunyikan teks, tampilkan spinner
                text.classList.add('d-none');
                spinner.classList.remove('d-none');

                // Disable tombol agar tidak bisa diklik lagi
                btn.disabled = true;
            });
        </script>
        <script>
            document.getElementById('filters').addEventListener('submit', function() {
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
            document.getElementById('exportBtn').addEventListener('click', async function(e) {
                e.preventDefault();

                let btn = this;
                let url = btn.href;

                // Simpan isi awal
                let originalContent = btn.innerHTML;

                // Disable + spinner
                btn.style.pointerEvents = 'none';
                btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Exporting...`;

                try {
                    // Ambil file
                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error('Export gagal');
                    }

                    const blob = await response.blob();

                    // Buat link download sementara
                    const downloadUrl = window.URL.createObjectURL(blob);

                    const a = document.createElement('a');
                    a.href = downloadUrl;
                    a.download = "data_center.xlsx";
                    document.body.appendChild(a);
                    a.click();

                    a.remove();
                    window.URL.revokeObjectURL(downloadUrl);

                } catch (error) {
                    console.log(error);
                    alert('Export gagal');
                }

                // Kembalikan tombol normal
                btn.style.pointerEvents = 'auto';
                btn.innerHTML = originalContent;
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
                    title: 'Success',
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
