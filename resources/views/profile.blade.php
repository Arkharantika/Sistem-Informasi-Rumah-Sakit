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
    <p class="mb-0 text-uppercase display-5 text-center">My Profile</p>
    <hr />
    <!-- end of Page Break -->

    <!-- Main Body -->
    <div class="main-body">
        <div class="row">
            <div class="col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <form method="post" action="userdata/{{$user->id}}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $complete->nama_lengkap }}"
                                        name="nama_lengkap" id="nama_lengkap">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIM / NIP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $complete->nim_nip}}"
                                        name="nim_nip" id="nim_nip">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. Telp</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $complete->no_telp}}"
                                        name="no_telp" id="no_telp">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea type="form-control" class="form-control"
                                        placeholder="{{ $complete->alamat}}" name="alamat" id="alamat"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example"
                                        name="option" id="option" value="{{ $complete->status}}">
                                        <option value="dokter">dokter</option>
                                        <option value="tenaga medis">tenaga medis</option>
                                        <option value="biasa">biasa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Foto KTP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" class="form-control" id="file_ktp" name="file_ktp"
                                        data-toggle="custom-file-input" multiple required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                                <h4>{{ $complete->nama_lengkap }}</h4>
                                <p class="text-secondary mb-1">{{ $complete->nim_nip}}</p>
                                <p class="text-muted font-size-sm">{{ $complete->alamat}}</p>
                                <button class="btn btn-primary">{{ $complete->status}}</button>
                                <button class="btn btn-outline-primary">Message</button>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">
                        </ul>
                        <div class="d-flex flex-column align-items-center text-center">
                            @if($complete->gambar_ktp ?? '' != null)
                            <img src="{{asset('folder_ktp/'.$complete->gambar_ktp)}}" alt=""
                                style="width:350px;height:300px;">
                            @else
                            <button class="btn btn-outline-secondary">Anda Belum Upload Gambar KTP</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <!--  -->
        <!--  -->

        @endsection
