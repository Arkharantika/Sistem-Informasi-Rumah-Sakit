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
        <div class="breadcrumb-title pe-3">Information</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User Info</li>
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
    <hr />
    <h4 class="mb-0  text-center">Data Karantina User : {{$cred->nim_nip}}</h4>
    <hr />
    <!--end breadcrumb-->

    <!--end breadcrumb-->

    <div class="row row-cols-1 row-cols-xl-2">
        <div class="col d-flex">

            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="bx bx-handicap text-dark font-50"></i>
                        <h4 class="form-label ">Status Perawatan Saat ini </h4>
                    </div>
                    <div class="login-separater text-center mb-4">
                        <hr />
                    </div>
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="font 50">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <div class="btn btn-light ">Status Perawatan Saat ini : </div>
                                    </li>
                                </ol>
                            </nav>
                        </div>&nbsp;&nbsp;
                        <!-- <button class="btn btn-outline-danger">
                                Data anda belum diverifikasi oleh operator / admin
                            </button> -->
                        @if($status_karantina == 1)
                        <div class="btn btn-outline-primary "> Sedang Isolasi Mandiri </div>

                        @elseif($status_karantina > 2)
                        <div class="btn btn-outline-primary "> Sedang Isolasi Di Rumah Sehat UNS !!</div>

                        @elseif($status_karantina == 2)
                        <div class="btn btn-outline-primary "> Sedang Isolasi Di RS Lainnya </div>

                        @else
                        <div class="btn btn-success "> Sedang Tidak Menjalani Perawatan Covid Dimanapun </div>
                        @endif

                    </div>


                    @if($status_karantina == 1)
                    <div class="mb-3">
                        <label class="form-label" id="isomansendirilabel">Tinggal Sendirian ? :</label>
                        <input class="form-control" list="datalistOptions" id="isomansendiri" placeholder="ya"
                            name="sendirian?">
                        <datalist id="datalistOptions">
                            <option value="Ya, Saya tinggal sendirian">
                            <option value="Tidak, Ada teman/orang lain yang tinggal di tempat yang sama">
                            <option value="Lainnya">
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="isomanalamatlabel">Alamat lengkap
                            Kos/Asrama/Rumah sewa, disekitar UNS <br>(contoh, kos xx, jalan xx, gang xx, RT/RW,
                            kelurahan,
                            kecamatan, Surakarta) :</label>
                        <textarea type="form-control" class="form-control" placeholder="" name="alamat"
                            id="isomanalamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="isomanurllabel">URL tempat tinggal saat ini
                            (koordinat G-Map) :</label>
                        <textarea type="form-control" class="form-control" placeholder="" name="url"
                            id="isomanurl"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <a href="" class="btn btn-outline-success btn-lg px-5"><i class="bx bxs-edit"></i>
                                Update Data</a>
                        </div>
                    </div>
                    @elseif($status_karantina > 2)
                    <div class="mb-3">
                        <label class="form-label" id="rslabel">Rumah Sehat UNS :</label>
                        <select disabled class="form-select form-select-sm mb-3" name="rumahsehat" id="rs"
                            placeholder="pilih salah 1" value="">
                            <option value="RS1">Rumah Sehat UNS 1 (RS UNS)</option>
                            <option value="RS2">Rumah Sehat UNS 2 (Asrama Mahasiswa)</option>
                        </select>
                    </div>
                    @elseif($status_karantina == 2)
                    <div class="mb-3">
                        <label class="form-label" id="rslainnamalabel">Nama Tempat Perawatan :</label>
                        <input type="form-control" class="form-control" placeholder="" name="nama_tempat"
                            id="rslainnama" value=""></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="rslainalamatlabel">Alamat lengkap Tempat
                            Perawatan :</label>
                        <input type="form-control" class="form-control" placeholder="" name="alamat_tempat"
                            id="rslainalamat" value=""></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="rslainurllabel">URL tempat tinggal saat ini
                            (koordinat G-Map) :</label>
                        <textarea type="form-control" class="form-control" placeholder="" name="url_tempat"
                            id="rslainurl" value=""></textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <a href="" class="btn btn-outline-success btn-lg px-5"><i class="bx bxs-edit"></i>
                                Update Data</a>
                        </div>
                    </div>
                    @else
                    @endif

                </div>
            </div>


        </div>
    </div>



</div>
@endsection
