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
                <button type="button"
                    class="btn btn-secondary split-bg-outline-secondary dropdown-toggle dropdown-toggle-split"
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
    <p class="mb-0 text-uppercase display-5 text-center">papan informasi</p>
    <hr />
    <!-- end of Page Break -->

    <style>
        textarea:disabled,
        textarea[disabled] {
            /* border: 1px solid #999999; */
            background-color: #ffffff !important;
            /* color: #666990; */
        }
    </style>

    <div class="card radius-10">
        <div class="card-body">
            <hr />
            @if($user->role == 'admin' || $user->role == 'operator' )
            <form method="post" action="{{url('/editinformasi')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <textarea rows="25" cols="100" type="form-control" class="form-control" placeholder=""
                        name="isitext" id="link">{{$informasi}}
					</textarea>
                </div>
                <div class="col-12">
                    <!-- <div class="d-grid"> -->
                        <button type="submit" class="btn btn-outline-secondary btn-lg px-5"><i
                                class="bx bx-edit"></i>Simpan Perubahan</button>
                    <!-- </div> -->
                </div>
            </form>
            @else
            <div class="mb-3">
                <textarea disabled rows="25" cols="100" type="form-control" class="form-control" placeholder=""
                    name="isitext" id="link">{{$informasi}}
					</textarea>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
