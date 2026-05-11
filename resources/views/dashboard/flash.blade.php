@extends('templates.app')
@section('container')
    <!-- Splash screen -->
    <div id="splash">
        <style>
            /* Splash screen style */
            #splash {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            }

            #splash img {
                max-width: 350px;
                /* ukuran logo di desktop */
                width: 350px;
                /* responsif di mobile */
                height: auto;
            }

            /* Konten dashboard disembunyikan dulu */
            #content {
                display: none;
            }

            /* Responsif tambahan */
            @media (max-width: 768px) {
                #splash img {
                    max-width: 250px;
                    /* lebih kecil di layar mobile */
                    width: 250px;
                    height: auto;
                }
            }
        </style>

        <!-- Ganti src dengan path logo kamu -->
        <img src="{{ asset('assets/logo/R-Tech-New.png') }}" style="margin-top: -80px;" alt="Logo">

        <script>
            // Setelah halaman load, sembunyikan splash dan tampilkan konten
            window.addEventListener('load', function() {
                setTimeout(function() {
                    document.getElementById('splash').style.display = 'none';
                    window.location.href = "/dashboard";
                    // document.getElementById('content-after-splash').style.display = 'block';
                }, 2000); // 2000ms = 2 detik
            });
        </script>
    </div>
    <style>
        .row {
            display: flex;
            align-items: stretch;
        }

        .separator {
            width: 1px;
            background-color: #ccc;
            margin: 0 10px;
        }
    </style>
    <div class="content-after-splash">
        <div class="card-secton">
        <div class="tf-container">
            <div class="tf-balance-box" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="balance">
                    <div class="row">
                        <div class="col-4 br-right">
                            <center>
                                <h4>Check In</h4>
                                <span>{{ $shift_karyawan->jam_absen ?? '-' }}</span>
                            </center>
                        </div>
                        <div class="col-4 br-right">
                            <center>
                                <h4>Location</h4>
                                <span>{{ auth()->user()->Lokasi->nama_lokasi }}</span>
                            </center>
                        </div>
                        <div class="col-4">
                            <center>
                                <h4>Check Out</h4>
                                <span>{{ $shift_karyawan->jam_pulang ?? '-' }}</span>
                            </center>
                        </div>
                    </div>
                </div>
                @php
                    $tahun_skrg = date('Y');
                    $bulan_skrg = date('m');
                    $jmlh_bulan = cal_days_in_month(CAL_GREGORIAN, $bulan_skrg, $tahun_skrg);
                    $tgl_mulai = date('Y-m-01');
                    $tgl_akhir = date('Y-m-' . $jmlh_bulan);
                    $sisa_reimbursement = auth()
                        ->user()
                        ->reimbursement->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])
                        ->where('status', 'Approved')
                        ->sum('sisa');
                    $fee_reimbursement = App\Models\ReimbursementsItem::whereHas('reimbursement', function (
                        $query,
                    ) use ($tgl_mulai, $tgl_akhir) {
                        $query->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->where('status', 'Approved');
                    })
                        ->where('user_id', auth()->user()->id)
                        ->sum('fee');
                    $total_reimbursement = $sisa_reimbursement + $fee_reimbursement;

                    $total_kasbon = App\Models\Kasbon::where('user_id', auth()->user()->id)
                        ->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])
                        ->where('status', 'Acc')
                        ->sum('nominal');
                @endphp
                <div class="wallet-footer">
                    <ul class="d-flex justify-content-between align-items-center">
                        <li class="wallet-card-item">
                            {{-- <a href="{{ url('/payroll') }}" class="fw_6 text-center">
                                <ul class="icon icon-group-transfers">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                </ul>
                                Payroll
                            </a> --}}
                            <a href="{{ url('/cuti') }}" style="font-size: 13px;">
                                {{-- <div class="icon-box bg_color_2">
                                    <img src="{{ asset('assets/icon-image/rest.png') }}" style="padding: 5px;"
                                        alt="Sisa Cuti">
                                </div> --}}
                                Sisa Cuti
                                <p class="text-primary"><b>{{ auth()->user()->izin_cuti }}</b></p>
                            </a>
                        </li>
                        {{-- <li class="wallet-card-item">
                            <a href="{{ url('/reimbursement') }}">
                                <div class="icon-box">
                                    <img src="{{ asset('assets/icon-image/bank.png') }}" style="width: 35px; height: auto;"
                                        alt="Bank">
                                </div>
                                <p>Reimbursement</p>
                                <p style="color: green">Rp {{ number_format($total_reimbursement) }}</p>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ url('/pengajuan_ro/create') }}">
                                <img src="{{ asset('assets/icon-image/add-task.png') }}"
                                    style="width: 35px; height: auto; margin-left: 13px;" alt="Face Detection">
                                <p>Tambah RO</p>
                            </a>
                        </li>

                        <li class="wallet-card-item">
                            {{-- <a class="fw_6" href="{{ url('/kasbon') }}">
                                <ul class="icon icon-group-credit-card">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                </ul>
                                <p>Kasbon</p>
                                <p style="color: green">Rp {{ number_format($total_kasbon) }}</p>
                            </a> --}}
                            <a href="{{ url('/cuti') }}" style="font-size: 13px;">
                                {{-- <div class="icon-box bg_color_2">
                                    <img src="{{ asset('assets/icon-image/rest.png') }}" style="padding: 5px;"
                                        alt="Sisa Cuti">
                                </div> --}}
                                Sisa RO
                                <p class="text-primary"><b>{{ auth()->user()->izin_ro }}</b></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5">
        <div class="tf-container">
            <div class="tf-title d-flex justify-content-between">
                <h3 class="fw_6">Layanan</h3>
            </div>
            <ul class="box-service mt-3">
                <li>
                    <a href="{{ url('/absen') }}">
                        <div class="icon-box bg_service-2">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.45831 5.67188C6.07 5.67188 5.75519 5.98669 5.75519 6.375C5.75519 6.76331 6.07 7.07812 6.45831 7.07812C6.84663 7.07812 7.16144 6.76331 7.16144 6.375C7.16144 5.98669 6.84663 5.67188 6.45831 5.67188ZM3.64581 11.2969C3.2575 11.2969 2.94269 11.6117 2.94269 12C2.94269 12.3883 3.2575 12.7031 3.64581 12.7031H6.45831C6.84663 12.7031 7.16144 12.3883 7.16144 12C7.16144 11.6117 6.84663 11.2969 6.45831 11.2969H3.64581ZM2.94269 3.5625V9.1875C2.94269 9.57581 3.2575 9.89062 3.64581 9.89062H9.27081C9.65913 9.89062 9.97394 9.57581 9.97394 9.1875V3.5625C9.97394 3.17419 9.65913 2.85938 9.27081 2.85938H3.64581C3.2575 2.85938 2.94269 3.17419 2.94269 3.5625ZM4.34894 4.26562H8.56769V8.48438H4.34894V4.26562ZM8.56769 12C8.56769 12.3883 8.8825 12.7031 9.27081 12.7031H14.8958C15.2841 12.7031 15.5989 12.3883 15.5989 12C15.5989 11.6117 15.2841 11.2969 14.8958 11.2969H12.7864L12.7864 3.5625C12.7864 3.17419 12.4716 2.85938 12.0833 2.85938C11.695 2.85938 11.3802 3.17419 11.3802 3.5625L11.3801 11.2969H9.27081C8.8825 11.2969 8.56769 11.6117 8.56769 12ZM14.8958 4.26562H19.8177V9.1875C19.8177 9.57581 20.1325 9.89062 20.5208 9.89062C20.9091 9.89062 21.2239 9.57581 21.2239 9.1875V3.5625C21.2239 3.17419 20.9091 2.85938 20.5208 2.85938H14.8958C14.5075 2.85938 14.1927 3.17419 14.1927 3.5625C14.1927 3.95081 14.5075 4.26562 14.8958 4.26562ZM17.0052 6.375C17.0052 6.76331 17.32 7.07812 17.7083 7.07812C18.0966 7.07812 18.4114 6.76331 18.4114 6.375C18.4114 5.98669 18.0966 5.67188 17.7083 5.67188C17.32 5.67188 17.0052 5.98669 17.0052 6.375ZM20.5208 11.2969H17.7083C17.32 11.2969 17.0052 11.6117 17.0052 12C17.0052 12.3883 17.32 12.7031 17.7083 12.7031H20.5208C20.9091 12.7031 21.2239 12.3883 21.2239 12C21.2239 11.6117 20.9091 11.2969 20.5208 11.2969ZM14.8958 9.89062H17.7083C18.0966 9.89062 18.4114 9.57581 18.4114 9.1875C18.4114 8.79919 18.0966 8.48438 17.7083 8.48438H15.5989V6.375C15.5989 5.98669 15.2841 5.67188 14.8958 5.67188C14.5075 5.67188 14.1927 5.98669 14.1927 6.375V9.1875C14.1927 9.57581 14.5075 9.89062 14.8958 9.89062ZM21.9739 0H19.1614C18.7731 0 18.4583 0.314812 18.4583 0.703125C18.4583 1.09144 18.7731 1.40625 19.1614 1.40625H21.9739C22.3616 1.40625 22.6771 1.72167 22.6771 2.10938V4.92188C22.6771 5.31019 22.9919 5.625 23.3802 5.625C23.7685 5.625 24.0833 5.31019 24.0833 4.92188V2.10938C24.0833 0.946266 23.137 0 21.9739 0ZM21.2239 20.4375V14.8125C21.2239 14.4242 20.9091 14.1094 20.5208 14.1094H14.8958C14.5075 14.1094 14.1927 14.4242 14.1927 14.8125V20.4375C14.1927 20.8258 14.5075 21.1406 14.8958 21.1406H20.5208C20.9091 21.1406 21.2239 20.8258 21.2239 20.4375ZM19.8177 19.7344H15.5989V15.5156H19.8177V19.7344ZM12.0833 14.1094C11.695 14.1094 11.3802 14.4242 11.3802 14.8125V20.4375C11.3802 20.8258 11.695 21.1406 12.0833 21.1406C12.4716 21.1406 12.7864 20.8258 12.7864 20.4375V14.8125C12.7864 14.4242 12.4716 14.1094 12.0833 14.1094ZM17.7083 18.3281C18.0966 18.3281 18.4114 18.0133 18.4114 17.625C18.4114 17.2367 18.0966 16.9219 17.7083 16.9219C17.32 16.9219 17.0052 17.2367 17.0052 17.625C17.0052 18.0133 17.32 18.3281 17.7083 18.3281ZM23.3802 18.375C22.9919 18.375 22.6771 18.6898 22.6771 19.0781V21.8906C22.6771 22.2783 22.3616 22.5938 21.9739 22.5938H19.1614C18.7731 22.5938 18.4583 22.9086 18.4583 23.2969C18.4583 23.6852 18.7731 24 19.1614 24H21.9739C23.137 24 24.0833 23.0537 24.0833 21.8906V19.0781C24.0833 18.6898 23.7685 18.375 23.3802 18.375ZM6.45831 18.3281C6.84663 18.3281 7.16144 18.0133 7.16144 17.625C7.16144 17.2367 6.84663 16.9219 6.45831 16.9219C6.07 16.9219 5.75519 17.2367 5.75519 17.625C5.75519 18.0133 6.07 18.3281 6.45831 18.3281ZM9.27081 14.1094H3.64581C3.2575 14.1094 2.94269 14.4242 2.94269 14.8125V20.4375C2.94269 20.8258 3.2575 21.1406 3.64581 21.1406H9.27081C9.65913 21.1406 9.97394 20.8258 9.97394 20.4375V14.8125C9.97394 14.4242 9.65913 14.1094 9.27081 14.1094ZM8.56769 19.7344H4.34894V15.5156H8.56769V19.7344ZM5.00519 22.5938H2.19269C1.80498 22.5938 1.48956 22.2783 1.48956 21.8906V19.0781C1.48956 18.6898 1.17475 18.375 0.786438 18.375C0.398125 18.375 0.083313 18.6898 0.083313 19.0781V21.8906C0.083313 23.0537 1.02958 24 2.19269 24H5.00519C5.3935 24 5.70831 23.6852 5.70831 23.2969C5.70831 22.9086 5.3935 22.5938 5.00519 22.5938ZM0.786438 5.625C1.17475 5.625 1.48956 5.31019 1.48956 4.92188V2.10938C1.48956 1.72167 1.80498 1.40625 2.19269 1.40625H5.00519C5.3935 1.40625 5.70831 1.09144 5.70831 0.703125C5.70831 0.314812 5.3935 0 5.00519 0H2.19269C1.02958 0 0.083313 0.946266 0.083313 2.10938V4.92188C0.083313 5.31019 0.398125 5.625 0.786438 5.625Z"
                                    fill="url(#paint0_linear_4552_4954)" />
                                <defs>
                                    <linearGradient id="paint0_linear_4552_4954" x1="12.0833" y1="24"
                                        x2="12.0833" y2="0" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#5558FF" />
                                        <stop offset="1" stop-color="#00C0FF" />
                                    </linearGradient>
                                </defs>
                            </svg>

                        </div>
                        Absensi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/cuti') }}">
                        <div class="icon-box bg_color_2">
                            <img src="{{ asset('assets/icon-image/rest.png') }}" style="padding: 5px;" alt="Leave">
                        </div>
                        Cuti/RO
                    </a>
                </li>

                <li>
                    <a href="{{ url('/cuti-data-apps') }}">
                        <div class="icon-box bg_surface_color">
                            <img src="{{ asset('assets/icon-image/list.png') }}" style="padding: 6px;" alt="Employee">
                        </div>
                        List Cuti
                    </a>
                </li>

                <li>
                    <a href="{{ url('/data-ro-apps') }}">
                        <div class="icon-box bg_color_5">
                            <img src="{{ asset('assets/icon-image/to-do-list.png') }}" style="padding: 7px;"
                                alt="Face Detection">
                        </div>
                        List RO
                    </a>
                </li>

                <li>
                    <a href="{{ url('/lembur') }}">
                        <div class="icon-box bg_color_4">
                            <img src="{{ asset('assets/icon-image/overtime.png') }}" style="padding: 4px;" alt="Overtime">
                        </div>
                        Overtime
                    </a>
                </li>

                <li>
                    <a href="{{ url('/my-absen') }}">
                        <div class="icon-box bg_color_3">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.87511 1.25C5.49974 1.24954 5.1266 1.30757 4.76911 1.422C4.00043 1.65173 3.32708 2.12475 2.85029 2.76998C2.37349 3.4152 2.11901 4.19775 2.12511 5V10C2.12564 10.7292 2.41554 11.4284 2.93115 11.944C3.44676 12.4596 4.14592 12.7495 4.87511 12.75H8.87511C9.07402 12.75 9.26479 12.671 9.40544 12.5303C9.54609 12.3897 9.62511 12.1989 9.62511 12V5C9.62379 4.00585 9.22827 3.05279 8.5253 2.34981C7.82232 1.64684 6.86926 1.25133 5.87511 1.25Z"
                                    fill="#DA9B00" />
                                <path
                                    d="M23.6248 6.00002V20C23.625 20.3612 23.5541 20.7189 23.416 21.0527C23.2779 21.3865 23.0753 21.6897 22.8199 21.9452C22.5645 22.2006 22.2612 22.4031 21.9275 22.5412C21.5937 22.6793 21.236 22.7503 20.8748 22.75H10.8748C10.5136 22.7503 10.1558 22.6793 9.82208 22.5412C9.48831 22.4031 9.18505 22.2006 8.92964 21.9452C8.67422 21.6897 8.47167 21.3865 8.33356 21.0527C8.19545 20.7189 8.1245 20.3612 8.12477 20V4.25002C8.12328 3.54389 7.87275 2.86092 7.41729 2.32131C6.96182 1.78171 6.33062 1.42006 5.63477 1.30002C5.70929 1.26345 5.79184 1.24626 5.87477 1.25002H18.8748C20.1342 1.25108 21.3418 1.75186 22.2324 2.64243C23.1229 3.533 23.6237 4.74057 23.6248 6.00002Z"
                                    fill="#FECC0E" />
                                <path
                                    d="M15.875 8.75H12.875C12.6761 8.75 12.4853 8.67098 12.3447 8.53033C12.204 8.38968 12.125 8.19891 12.125 8C12.125 7.80109 12.204 7.61032 12.3447 7.46967C12.4853 7.32902 12.6761 7.25 12.875 7.25H15.875C16.0739 7.25 16.2647 7.32902 16.4053 7.46967C16.546 7.61032 16.625 7.80109 16.625 8C16.625 8.19891 16.546 8.38968 16.4053 8.53033C16.2647 8.67098 16.0739 8.75 15.875 8.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 11.75H12.875C12.6761 11.75 12.4853 11.671 12.3447 11.5303C12.204 11.3897 12.125 11.1989 12.125 11C12.125 10.8011 12.204 10.6103 12.3447 10.4697C12.4853 10.329 12.6761 10.25 12.875 10.25H18.875C19.0739 10.25 19.2647 10.329 19.4053 10.4697C19.546 10.6103 19.625 10.8011 19.625 11C19.625 11.1989 19.546 11.3897 19.4053 11.5303C19.2647 11.671 19.0739 11.75 18.875 11.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 14.75H12.875C12.6761 14.75 12.4853 14.671 12.3447 14.5303C12.204 14.3897 12.125 14.1989 12.125 14C12.125 13.8011 12.204 13.6103 12.3447 13.4697C12.4853 13.329 12.6761 13.25 12.875 13.25H18.875C19.0739 13.25 19.2647 13.329 19.4053 13.4697C19.546 13.6103 19.625 13.8011 19.625 14C19.625 14.1989 19.546 14.3897 19.4053 14.5303C19.2647 14.671 19.0739 14.75 18.875 14.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 17.75H12.875C12.6761 17.75 12.4853 17.671 12.3447 17.5303C12.204 17.3897 12.125 17.1989 12.125 17C12.125 16.8011 12.204 16.6103 12.3447 16.4697C12.4853 16.329 12.6761 16.25 12.875 16.25H18.875C19.0739 16.25 19.2647 16.329 19.4053 16.4697C19.546 16.6103 19.625 16.8011 19.625 17C19.625 17.1989 19.546 17.3897 19.4053 17.5303C19.2647 17.671 19.0739 17.75 18.875 17.75Z"
                                    fill="white" />
                            </svg>

                        </div>
                        History
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ url('/face-recognition') }}">
                        <div class="icon-box bg_color_5">
                            <img src="{{ asset('assets/icon-image/face-detection.png') }}" style="padding: 7px;"
                                alt="Face Detection">
                        </div>
                        Face Recognition
                    </a>
                </li> --}}

                <li>
                    <a href="{{ url('/my-profile/edit-password') }}">
                        <div class="icon-box bg_service-6">
                            <img src="{{ asset('assets/icon-image/reset-password.png') }}" style="padding: 7px;"
                                alt="Ganti Password">
                        </div>
                        Password
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}">
                        <div class="icon-box bg_surface_color">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.00012 7H2.00012C0.895522 7 0.00012207 6.1046 0.00012207 5V2C0.00012207 0.8954 0.895522 0 2.00012 0H5.00012C6.10472 0 7.00012 0.8954 7.00012 2V5C7.00012 6.1046 6.10472 7 5.00012 7ZM16.0001 3.5C16.0001 1.567 14.4331 0 12.5001 0C10.5671 0 9.00012 1.567 9.00012 3.5C9.00012 5.433 10.5671 7 12.5001 7C14.4331 7 16.0001 5.433 16.0001 3.5ZM16.0001 14V11C16.0001 9.8954 15.1047 9 14.0001 9H11.0001C9.89552 9 9.00012 9.8954 9.00012 11V14C9.00012 15.1046 9.89552 16 11.0001 16H14.0001C15.1047 16 16.0001 15.1046 16.0001 14ZM7.00012 14V11C7.00012 9.8954 6.10472 9 5.00012 9H2.00012C0.895522 9 0.00012207 9.8954 0.00012207 11V14C0.00012207 15.1046 0.895522 16 2.00012 16H5.00012C6.10472 16 7.00012 15.1046 7.00012 14Z"
                                    fill="url(#paint0_linear_4516_5717)" />
                                <defs>
                                    <linearGradient id="paint0_linear_4516_5717" x1="12.8241" y1="-0.355"
                                        x2="2.90212" y2="16.83" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFF3B0" />
                                        <stop offset="1" stop-color="#CA26FF" />
                                    </linearGradient>
                                </defs>
                            </svg>

                        </div>
                        Other
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-5 mb-9">
        <div class="tf-container">
            <div class="mt-5">
                <div class="d-flex justify-content-between">
                    <h3>Berita</h3> <a href="{{ url('/berita-user') }}" class="primary_color fw_6">View All</a>
                </div>
                <div class="swiper-container banner-tes">
                    <div class="swiper-wrapper">
                        @foreach ($berita as $ber)
                            <div class="swiper-slide">
                                <img src="{{ url('/storage/' . $ber->berita_file_path) }}"
                                    alt="{{ $ber->berita_file_name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="d-flex justify-content-between">
                    <h3>Informasi</h3> <a href="{{ url('/informasi-user') }}" class="primary_color fw_6">View
                        All</a>
                </div>
                <div class="swiper-container banner-tes">
                    <div class="swiper-wrapper">
                        @foreach ($informasi as $inf)
                            <div class="swiper-slide">
                                <img src="{{ url('/storage/' . $inf->berita_file_path) }}"
                                    alt="{{ $inf->berita_file_name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
