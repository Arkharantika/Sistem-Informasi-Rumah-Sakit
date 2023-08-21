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
                        <div class="btn btn-outline-dark">Halaman Dashboard </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-lg ">
                    <i class='bx bxs-bell '></i> Notifications</button>
                <button type="button" class="btn btn-secondary split-bg-secondary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
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
    <p class="mb-0 text-uppercase display-5 text-center">welcome to Tatonas</p>
    <hr />
    <!-- end of Page Break -->

    <!-- Shortcut -->

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <a href="#" class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Informasi</p>
                            <h4 class="my-1">Sensor</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bx-handicap '></i>
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
                            <p class="mb-0 text-secondary">Informasi</p>
                            <h4 class="my-1">Hardware</h4>
                            <p class="mb-0 font-13 text-light"><i class='bx bxs-up-arrow align-middle'></i></p>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bx-capsule'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </a>
        <a href="#" class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Informasi</p>
                            <h4 class="my-1">Location</h4>
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

</div>

@section('CustomScripts')

@endsection


@endsection