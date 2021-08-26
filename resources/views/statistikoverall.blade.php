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
<div class="container">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-list-ul"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Covid Overall</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-md ">settings</button>
                <button type="button" class="btn btn-secondary split-bg-outline-secondary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <!-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div> -->
            </div>
        </div>
    </div>
    <!--end of breadcrumb-->

    @if(session()->get('message'))
    <div class="alert alert-info alert-dismissable text-center mt-20" role="alert">
        <h4>{{ session()->get('message') }} </h4>
    </div>
    @endif

    @if(session()->get('warning'))
    <div class="alert alert-danger alert-dismissable mt-20 text-center" role="alert">
        <h4>{{ session()->get('warning') }} </h4>
    </div>
    @endif

    <!-- Page Break -->
    <hr />
    <p class="mb-0 text-uppercase display-6 text-center">Data Statistik Covid-19</p>
    <hr />
    <!-- end of Page Break -->

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Pasien Sembuh </p>
                            <h4 class="my-1">{{$sembuhCovid}}</h4>
                            <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$34 Since
                                last
                                week</p>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-capsule'></i>
                        </div>
                    </div>
                    <!-- <div id="chart1"></div> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total User Yang Pernah Positif</p>
                            <h4 class="my-1">{{$pernahCovid}}</h4>
                            <p class="mb-0 font-13 text-warning"><i class='bx bxs-up-arrow align-middle'></i>14% Since
                                last
                                week</p>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Pasien Positif Saat Ini </p>
                            <h4 class="my-1">{{$totalCovid}}</h4>
                            <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>12.4%
                                Since
                                last week</p>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-virus'></i>
                        </div>
                    </div>
                    <!-- <div id="chart3"></div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Pasien Isolasi Mandiri </p>
                            <h4 class="my-1">{{$totalMandiri}}</h4>
                            <p class="mb-0 font-13 text-info"><i class='bx bxs-up-arrow align-middle'></i>$34 Since
                                last
                                week</p>
                        </div>
                        <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-body'></i>
                        </div>
                    </div>
                    <!-- <div id="chart1"></div> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Pasien Isolasi Terpusat</p>
                            <h4 class="my-1">{{$totalTerpusat}}</h4>
                            <p class="mb-0 font-13 text-primary"><i class='bx bxs-up-arrow align-middle'></i>14% Since
                                last
                                week</p>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class='bx bx-unite'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Pasien Isolasi RS Lain </p>
                            <h4 class="my-1">{{$totalLainnya}}</h4>
                            <p class="mb-0 font-13 text-secondary"><i class='bx bxs-down-arrow align-middle'></i>12.4%
                                Since
                                last week</p>
                        </div>
                        <div class="widgets-icons bg-light-secondary text-secondary ms-auto"><i class='bx bxs-home'></i>
                        </div>
                    </div>
                    <!-- <div id="chart3"></div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- DEBUG -->

    <!-- <div class="card">
        <div>
            <h3 id="debug">DEBUG</h3>
        </div>
    </div> -->

    <!-- Stat -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="mb-0 text-uppercase">Grafik Covid</h6>
            <hr />
                <div id="chart3"></div>
            </div>
        </div>
    </div>
    <!-- end of Stat -->

    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="mb-0 text-uppercase">Grafik Vaksin</h6>
            <hr />
                <div id="chart9"></div>
            </div>
        </div>
    </div>

    <!-- Main Table -->

    <!-- end of Main Table -->
</div>
@endsection

@section('CustomScripts')
<script src="{{asset('js/datacovidoverall.js')}}"></script>
@endsection
