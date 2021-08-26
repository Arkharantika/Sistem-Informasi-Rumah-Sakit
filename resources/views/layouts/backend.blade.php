<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('CostumStyle/images/medicine_a.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('CostumStyle/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('CostumStyle/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('CostumStyle/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('CostumStyle/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('CostumStyle/plugins/datatable/css/dataTables.dateTime.min.css')}}" rel="stylesheet" />
    <link href="{{asset('CostumStyle/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('CostumStyle/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('CostumStyle/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('CostumStyle/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('CostumStyle/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('CostumStyle/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('CostumStyle/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('CostumStyle/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('CostumStyle/css/header-colors.css')}}" />
    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{asset('CostumStyle/style.css')}}">
    <!-- Page Title -->
    <title>UNS CARE</title>
</head>

<!-- Bagian Body Semua Berawal Dari Sini -->

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper (Bagian SideBar)-->
        <div class="sidebar-wrapper" data-simplebar="true">

            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <div>
                    <!-- <i class='lni lni-heart logo-icon'></i> -->
                    <img src="{{asset('CostumStyle/images/medicine.png')}}" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <br>
                    <a href="{{url('/home')}}">
                        <h4 class="logo-text">UNS CARE</h4>
                    </a>
                    <br>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-chevron-left-circle font-35'></i>
                </div>
            </div>

            <!--Navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{url('/home')}}" class="">
                        <div class="parent-icon"><i class='bx bxs-home'></i>
                        </div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/profile')}}" class="">
                        <div class="parent-icon"><i class='bx bxs-user'></i>
                        </div>
                        <div class="menu-title">My Profile</div>
                    </a>
                </li>

                @if((Auth::user()->role ?? '') == 'admin')
                <li>
                    <a href="javascript:;" class="">
                        <div class="parent-icon"><i class='bx bx-notepad'></i>
                        </div>
                        <div class="menu-title">Data User Administration</div>
                    </a>
                    <ul>
                        <li> <a href="{{url('/admin/useradministration')}}"><i class="bx bx-right-arrow-alt"></i>List
                                User</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if((Auth::user()->role ?? '') == 'user' || (Auth::user()->role ?? '') == 'admin'
                || (Auth::user()->role ?? '') == 'operator')
                <li>
                    <a href="javascript:;" class="">
                        <div class="parent-icon"><i class='bx bxs-virus'></i>
                        </div>
                        <div class="menu-title">Layanan Covid UNS</div>
                    </a>
                    <ul>
                        <li> <a href="{{url('/user/claimcovid')}}"><i class="bx bx-right-arrow-alt"></i>Lapor Positif
                                Covid</a>
                        </li>
                        <li> <a href="{{url('/user/claimvaksin')}}"><i class="bx bx-right-arrow-alt"></i>lapor Sudah
                                Vaksin</a>
                        </li>
                        <li> <a href="{{url('/user/isolasimandiri')}}"><i class="bx bx-right-arrow-alt"></i>Info
                                Perawatan Covid</a>
                        </li>
                        <li> <a href="{{url('/user/askbantuan')}}"><i class="bx bx-right-arrow-alt"></i>Bantuan Terdampak Covid</a>
                        </li>
                    </ul>
                </li>
                @endif
                
                <li>
                    <a href="javascript:;" class="">
                        <div class="parent-icon"><i class='bx bx-list-ul'></i>
                        </div>
                        <div class="menu-title">Data Covid UNS</div>
                    </a>
                    <ul>
                        <li> <a href="{{url('/datacovidoverall')}}"><i class="bx bx-right-arrow-alt"></i>Data Covid
                                Overall</a>
                        </li>
                        @if(($complete->status ?? '') == 'dokter' && ($complete->verified ?? '') == 'yes'||
                        (Auth::user()->role ?? '') == 'admin'||(Auth::user()->role ?? '') == 'operator' ||
                        ($complete->status ?? '') == 'koas dokter' && ($complete->verified ?? '') == 'yes' ||
                        ($complete->status ?? '') == 'tenaga medis' && ($complete->verified ?? '') == 'yes')
                        <li> <a href="{{url('/admin/datapositifcovid')}}"><i class="bx bx-right-arrow-alt"></i>Data
                                Positif Covid</a>
                        </li>

                        <li> <a href="{{url('/admin/datavaksin')}}"><i class="bx bx-right-arrow-alt"></i>Data
                                Vaksinasi</a>
                        </li>
                        <!-- <li> <a href="{{url('/admin/datagejala')}}"><i class="bx bx-right-arrow-alt"></i>Data User Bergejala Covid</a>
                            </li> -->
                        <li> <a href="{{url('/admin/dataisolasi')}}"><i class="bx bx-right-arrow-alt"></i>Data User
                                Yang Sedang Isolasi</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if((Auth::user()->role == 'admin') || (Auth::user()->role == 'operator'))
                <li>
                    <a href="{{url('/databantuan')}}" class="">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">Data Bantuan Covid</div>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{url('/chatify')}}" class="">
                        <div class="parent-icon"><i class='bx bxs-chat'></i>
                        </div>
                        <div class="menu-title">Layanan Konsultasi Pribadi</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/informasi')}}" class="">
                        <div class="parent-icon"><i class='bx bxs-info-square'></i>
                        </div>
                        <div class="menu-title">Informasi Dan Kontak Penting</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->

        </div>
        <!--end sidebar wrapper -->

        <!--start header (Bagian Atas (Topbar)) -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                    </a>
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                    </a>
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bxs-user-circle text-secondary font-50"></i>
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">@yield('data')</p>
                                <p class="designattion mb-0">@yield('status')</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:;"><i
                                        class="bx bx-user"></i><span>Profile</span></a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;"><i
                                        class="bx bx-cog"></i><span>Settings</span></a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;"><i
                                        class='bx bx-home-circle'></i><span>Dashboard</span></a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;"><i
                                        class='bx bx-dollar-circle'></i><span>Earnings</span></a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;"><i
                                        class='bx bx-download'></i><span>Downloads</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" href="{{url('logout')}}"><i
                                        class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

        <!--start page wrapper (Bagian Isi Utama)-->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <!-- <footer class="page-footer">
                <p class="mb-0 ">Copyright © 2021 <a href="#" class="font-italic"> Dr. Paradise</a></p>
            </footer> -->
    </div>
    <!--end wrapper-->

    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
            <hr />
            <h6 class="mb-0">Sidebar Backgrounds</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->

    <!-- Additional Css -->
    <!-- <script src="{{asset('CostumStyle/script.js')}}"></script> -->
    <!-- Bootstrap JS -->
    <script src="{{asset('CostumStyle/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('CostumStyle/js/jquery.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/datatable/js/dataTables.dateTime.min.js')}}"></script>
    <script src="{{asset('CostumStyle/plugins/datatable/js/moment.min.js')}}"></script>
    <script src="{{asset('CostumStyle/js/table-datatable.js')}}"></script>
    <!--app JS-->
    <script src="{{asset('CostumStyle/js/app.js')}}"></script>

    <script src="{{asset('CostumStyle/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- <script src="{{asset('CostumStyle/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script> -->
    @yield('CustomScripts')
    <!-- <script src="{{asset('CostumStyle/js/index.js')}}"></script> -->



</body>

</html>