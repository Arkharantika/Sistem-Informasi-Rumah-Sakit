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
        <div class="breadcrumb-title pe-3">Form</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-list-ul"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Transaction</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-md ">settings</button>
                <button type="button"
                    class="btn btn-secondary split-bg-outline-secondary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="main-body">
        <div class="row">
            <div class="col mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"><i class="bx bx-transfer-alt text-dark font-50"></i>
                            <h4 class="form-label ">Form Tambah Transaction</h4>
                            <!-- <p>Silahkan Isi Data ID dan Password Anda<a href="authentication-signup.html"></a> -->
                        </div>
                        <div class="login-separater text-center mb-4">
                            <hr />
                        </div>

                        <form method="post" action="{{url('/transaction/createdata')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Hardware</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="" name="hardware" id="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parameter</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{[isi data dari alat]}" name="parameter" id="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Hardware Creator</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="" name="created_by" id="" required>
                                </div>
                            </div>

                            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                                <button type="submit" id="covid" class="btn btn-outline-success"
                                    onclick="return confirm('Yakin data sudah benar?')">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection