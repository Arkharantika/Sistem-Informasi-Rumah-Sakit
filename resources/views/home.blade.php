<!-- Halaman Ini Sudah Sesuai Tata Penulisan -->

@extends('layouts.backend')

@section('data')
{{ $complete->nama_lengkap }}
@endsection

@if(($complete->status ?? '') != 'biasa' && ($complete->verified ?? '') == 'yes')
@section('status')
{{ $complete->status }} &nbsp;&&nbsp; {{ $user->role }}
@endsection
@else
@section('status')
{{ $user->role }}
@endsection
@endif

@section('content')
<!--Container-->
<div class="container">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="font 50">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">
                        <div class="btn btn-outline-dark">Status saat ini </div>
                    </li>
                </ol>
            </nav>
        </div>&nbsp;&nbsp;

        @if(($data ?? '') == null)
        <div class="btn btn-primary "> Belum Ada </div>
        @endif
        @if(($data->sembuh ?? '') == 'belum')
        <div class="btn btn-danger "> Terinfeksi Covid 19 !!</div>
        @endif
        @if(($data->sembuh ?? '') == 'sudah')
        <div class="btn btn-success "> Sudah Sembuh ! </div>
        @endif

        &nbsp;&nbsp;

        @if(($vaksin ?? '') != null)
        <div class="btn btn-primary "> Sudah Vaksin ! dosis {{$vaksin->dosis_ke}}</div>
        @endif
        @if(($vaksin ?? '') == null)
        <div class="btn btn-warning "> Belum Vaksin Covid ! </div>
        @endif

        &nbsp;&nbsp;

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-lg ">
                    @if((Auth::user()->role ?? '') == 'admin'
                    || (Auth::user()->role ?? '') == 'operator')                    
                    @if($total_notification > 0)
                    <span class="alert-count">
                    {{$total_notification}}</span>
                    @endif    
                    @endif
                    <i class='bx bxs-bell '></i> Notifications</button>
                <button type="button" class="btn btn-secondary split-bg-secondary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                @if((Auth::user()->role ?? '') == 'admin'
                || (Auth::user()->role ?? '') == 'operator')
                <div class="nav-item dropdown dropdown-large dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{url('/admin/datapositifcovid')}}">
                        <div class="d-flex align-items-center">
                            <div class="notify bg-light-primary text-primary"><i class="bx bxs-virus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">{{$notification_isoman}} user melaporkan covid
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="msg-time float-end"></span></h6>
                                <p class="msg-info">Butuh Konfirmasi Segera !</p>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="{{url('/admin/datavaksin')}}">
                        <div class="d-flex align-items-center">
                            <div class="notify bg-light-danger text-danger"><i class="bx bxs-capsule"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="msg-name">{{$notification_vaksin}} user melaporkan vaksin
                                    <span class="msg-time float-end"></span></h6>
                                <p class="msg-info">Butuh Konfirmasi Segera !</p>
                            </div>
                        </div>
                    </a>
                    <!-- <div class="dropdown-divider"></div> -->
                    <a href="javascript:;">
                        <div class="text-center msg-footer">View All Notifications</div>
                    </a>
                    <!-- <a class="dropdown-item" href="javascript:;">Separated link</a> -->
                </div>
                @else
                <div class="nav-item dropdown dropdown-large dropdown-menu dropdown-menu-end">
                    <!-- <div class="dropdown-divider"></div> -->
                    <a href="javascript:;">
                        <div class="text-center msg-footer">Anda tidak memiliki notifikasi apapun</div>
                    </a>
                    <!-- <a class="dropdown-item" href="javascript:;">Separated link</a> -->
                </div>
                @endif
            </div>
        </div>
        <!--end breadcrumb-->
    </div>
    <!--end Container-->

    @if(session()->get('message'))
    <div class="alert alert-info alert-dismissable mt-20" role="alert">
        <h4>{{ session()->get('message') }} </h4>
    </div>
    @endif

    <!-- Page Break -->
    <hr />
    <p class="mb-0 text-uppercase display-5 text-center">wellcome to uns care</p>
    <hr />
    <!-- end of Page Break -->

    <!-- Shortcut -->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <a href="{{url('/user/isolasimandiri')}}" class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Informasi</p>
                            <h4 class="my-1">Isolasi Covid-19</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bx-handicap '></i>
                        </div>
                    </div>
                    <!-- <div id="chart1"></div> -->
                </div>
            </div>
        </a>
        <a href="{{url('/user/claimvaksin')}}" class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Lapor</p>
                            <h4 class="my-1">Sudah Vaksin</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bx-capsule'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </a>
        <a href="{{url('/user/claimcovid')}}" class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Lapor</p>
                            <h4 class="my-1">Positif Covid</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-virus'></i>
                        </div>
                    </div>
                    <!-- <div id="chart3"></div> -->
                </div>
            </div>
        </a>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <a href="{{url('/datacovidoverall')}}" class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Informasi</p>
                            <h4 class="my-1">Data Statistik</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class='bx bx-stats'></i>
                        </div>
                    </div>
                    <!-- <div id="chart1"></div> -->
                </div>
            </div>
        </a>
        <a href="#" class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Layanan</p>
                            <h4 class="my-1">Konsultasi</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-secondary text-secondary ms-auto"><i class='bx bxs-chat'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </a>
        <a class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Layanan</p>
                            <h4 class="my-1">Bantuan Isoman</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-dollar'></i>
                        </div>
                    </div>
                    <!-- <div id="chart3"></div> -->
                </div>
            </div>
        </a>
    </div>
</div>
<!-- end Shortcut -->

@endsection
