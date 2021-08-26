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
    </div>

    @if(session()->get('message'))
    <div class="alert alert-info alert-dismissable mt-20" role="alert">
        <h4>{{ session()->get('message') }} </h4>
    </div>
    @endif

    @if(session()->get('warning'))
    <div class="alert alert-danger alert-dismissable mt-20 text-center" role="alert">
        <h4>{{ session()->get('warning') }} </h4>
    </div>
    @endif

    <!-- <h6 class="mb-0 text-uppercase">claim positif covid-19</h6> -->
    <hr />
    <!--end breadcrumb-->

    <div class="row row-cols-1 row-cols-xl-2">
        <div class="col d-flex">

            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="bx bx-notepad text-dark font-50"></i>
                        <h4 class="form-label ">History Positif Covid Saya</h4>
                    </div>
                    <div class="login-separater text-center mb-4">
                        <hr />
                    </div>
                    @if($data ?? '' != null)
                    <!-- <form method="post" action="/user/claimvaksin/{{$user->id}}" enctype="multipart/form-data" > -->
                    <div class="table-responsive">
                        <table id="cilik" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Nama Lengkap</th> -->
                                    <th>Keterangan</th>
                                    <th>Sudah Sembuh ?</th>
                                    <th>Tanggal Lapor</th>
                                    <th>Status Isolasi</th>
                                    <!-- <th>Updated at</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($history as $row)

                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->sembuh}}</td>
                                    <!-- <td></td> -->
                                    <td>{{$row->created_at}}</td>
                                    <td>{{$row->pilihan_isolasi}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @elseif($data ?? '' == null)
                    <div class="text-center">
                        <!-- <i class="bx bx-notepad text-dark font-50"></i> -->
                        <span class="falign-middle">Maaf, anda belum pernah melaporkan positif covid</span>
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">

                    @if(($data ?? '') == null)
                    <div class="text-center"><i class="bx bx-disc text-dark font-50"></i>
                        <h4 class="form-label ">Lapor Positif Covid - 19</h4>
                        @endif
                        @if(($data->sembuh ?? '') == 'belum')
                        <div class="text-center"><i class="bx bx-disc text-dark font-50"></i>
                            <h4 class="form-label ">Lapor Sudah Sehat</h4>
                            @endif
                            @if(($data->sembuh ?? '') == 'sudah')
                            <div class="text-center"><i class="bx bx-disc text-dark font-50"></i>
                                <h4 class="form-label ">Lapor Positif Covid - 19</h4>
                                @endif

                            </div>
                            <div class="login-separater text-center mb-4">
                                <hr />
                            </div>

                            <form method="post" action="claimcovid" enctype="multipart/form-data">
                                @csrf

                                @if(($data ?? '') == null || ($data->sembuh ?? '') == 'sudah')
                                <div class="mb-3">
                                    <label class="form-label"><i class="bx bx-caret-right"></i>Keterangan :</label>
                                    <textarea type="form-control" class="form-control" placeholder="" name="keterangan"
                                        id="" required></textarea>
                                </div>
                                <!-- <div class="mb-3">
                                    <input type="text" class="form-control" name="Name" size="20" maxlength="20"
                                        style="text-transform:uppercase" />
                                </div> -->
                                <div class="mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAntigen"
                                        onclick="myFunction()">
                                    <label class="form-label" for="flexCheckChecked"> Upload File Antigen </label>
                                </div>
                                <div class="mb-3">
                                    <!-- <label class="form-label">Hasil Test Positif Covid <span>(SWAB Antigen)</span> :</label> -->
                                    <input type="file" class="form-control" id="antigen" name="file_hasil"
                                        style="display:none" data-toggle="custom-file-input" multiple>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="checkPCR"
                                        onclick="myFunction2()">
                                    <label class="form-label" for="flexCheckChecked"> Upload File PCR </label>
                                </div>
                                <div class="mb-3">
                                    <!-- <label class="form-label">Hasil Test Positif Covid <span>(SWAB PCR)</span> :</label> -->
                                    <input type="file" class="form-control" id="PCR" name="file_pcr"
                                        style="display:none" data-toggle="custom-file-input" multiple>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="bx bx-caret-right"></i>Tanggal Terkonfirmasi
                                        Covid
                                        :</label>
                                    <input type="date" class="form-control" name="tanggal_confirmed" required>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label class="form-label"><i class="bx bx-caret-right"></i>Opsi Perawatan :</label>
                                    <!-- <input type="date" class="form-control"> -->
                                </div>

                                <!-- Check Radio Button -->
                                <div class="mb-3 form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio1" id="inlineRadio1"
                                        value="milih_covid" onclick="isomanFunction()">
                                    <label class="form-check-label" for="inlineRadio1">Isolasi Mandiri</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio1" id="inlineRadio2"
                                        value="milih_rumahsehat" onclick="rsFunction()">
                                    <label class="form-check-label" for="inlineRadio2">Rumah Sehat UNS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio1" id="inlineRadio3"
                                        value="milih_rslain" onclick="rslainFunction()">
                                    <label class="form-check-label" for="inlineRadio3">RS / Klinik Lain</label>
                                </div>
                                <!--  -->

                                <!-- Separator -->
                                <div class="login-separater text-center mb-4">
                                    <hr />
                                </div>
                                <!-- end of Separator -->

                                <!-- Radio for Isoman Option  -->
                                <div class="mb-3">
                                    <label class="form-label" id="isomansendirilabel" style="display:none">Tinggal
                                        Sendirian
                                        ? :</label>
                                    <input class="form-control" list="datalistOptions" id="isomansendiri"
                                        placeholder="ya" name="sendirian" style="display:none">
                                    <datalist id="datalistOptions">
                                        <option value="Ya, Saya tinggal sendirian">
                                        <option value="Tidak, Ada teman/orang lain yang tinggal di tempat yang sama">
                                        <option value="Lainnya">
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="isomanalamatlabel" style="display:none">Alamat lengkap
                                        Kos/Asrama/Rumah sewa, disekitar UNS <br>(contoh, kos xx, jalan xx, gang xx,
                                        RT/RW,
                                        kelurahan, kecamatan, Surakarta) :</label>
                                    <textarea type="form-control" class="form-control" placeholder="" name="alamat"
                                        id="isomanalamat" style="display:none"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="isomanurllabel" style="display:none">URL tempat
                                        tinggal
                                        saat ini (koordinat G-Map) :</label>
                                    <textarea type="form-control" class="form-control" placeholder="" name="url"
                                        id="isomanurl" style="display:none"></textarea>
                                </div>
                                <!-- end of Isoman  -->

                                <!-- Radio for Rumah Sehat  -->
                                <div class="mb-3">
                                    <label class="form-label" id="rslabel" style="display:none">Rumah Sehat UNS
                                        :</label>
                                    <select class="form-select form-select-sm mb-3" name="rumahsehat" id="rs"
                                        placeholder="pilih salah 1" style="display:none">
                                        <option value="RS1">Rumah Sehat UNS 1 (RS UNS)</option>
                                        <option value="RS2">Rumah Sehat UNS 2 (Asrama Mahasiswa)</option>
                                    </select>
                                </div>
                                <!-- end of Rumah Sehat  -->

                                <!-- Radio for Rs Lain  -->
                                <div class="mb-3">
                                    <label class="form-label" id="rslainnamalabel" style="display:none">Nama Tempat
                                        Perawatan :</label>
                                    <input type="form-control" class="form-control" placeholder="" name="nama_tempat"
                                        id="rslainnama" style="display:none"></input>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="rslainalamatlabel" style="display:none">Alamat lengkap
                                        Tempat Perawatan :</label>
                                    <input type="form-control" class="form-control" placeholder="" name="alamat_tempat"
                                        id="rslainalamat" style="display:none"></input>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="rslainurllabel" style="display:none">URL tempat
                                        tinggal
                                        saat ini (koordinat G-Map) :</label>
                                    <textarea type="form-control" class="form-control" placeholder="" name="url_tempat"
                                        id="rslainurl" style="display:none"></textarea>
                                </div>
                                <!-- end of Rs Lain  -->

                                <!-- INI TOMBOLNYAA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" id="covid" class="btn btn-danger btn-lg px-5"><i
                                                class="bx bx-sun"></i>Saya Positif Covid 19</button>
                                    </div>
                                </div>
                                @endif

                            </form>


                            <!-- INI BATAS ANTARA POSiTIF DAN NEGATIF -->
                            @if(($data->id_user ?? '') != null)
                            <form method="post" action="claimcovid/{{$data->id}}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                @if(($data->sembuh ?? '') == 'belum')
                                <div class="mb-3">
                                    <label class="form-label">Keterangan :</label>
                                    <textarea type="form-control" class="form-control" placeholder="" name="keterangan"
                                    id="" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Surat Keterangan Sehat :</label>
                                    <input type="file" class="form-control" id="upload" name="file_hasil"
                                    style="display:none" data-toggle="custom-file-input" required multiple>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="myCheck"
                                    onclick="myFunction3()" required>
                                    <label class="form-label" for="flexCheckChecked"> Saya menkonfirmasi bahwa saya
                                        sudah
                                        sembuh</label>
                                    </div>
                                    @if(($data->status_verified ?? '') == 1)
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success btn-lg px-5"><i
                                            class="bx bx-sun"></i>Saya Sudah Sembuh !</button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-outline-danger btn-lg px-5" disabled>
                                                Data Anda Belum Diverifikasi Oleh Operator</button>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var checkBox = document.getElementById("checkAntigen");
        var text = document.getElementById("antigen");
        if (checkBox.checked == true) {
            text.style.display = "block";
            document.getElementById("covid").disabled = false;
        } else {
            text.style.display = "none";
        }
    }

    function myFunction2() {
        var checkBox2 = document.getElementById("checkPCR");
        var text2 = document.getElementById("PCR");
        if (checkBox2.checked == true) {
            text2.style.display = "block";
            document.getElementById("covid").disabled = false;
        } else {
            text2.style.display = "none";
        }
    }

    // Untuk lapor Sembuh !
    function myFunction3() {
        var checkBox3 = document.getElementById("myCheck");
        var text3 = document.getElementById("upload");
        if (checkBox3.checked == true) {
            text3.style.display = "block";
        } else {
            text3.style.display = "none";
        }
    }

    // Untuk Opsi Isoman

    var isomanlabel1 = document.getElementById("isomansendirilabel");
    var isomanlabel2 = document.getElementById("isomanalamatlabel");
    var isomanlabel3 = document.getElementById("isomanurllabel");
    var isomantext1 = document.getElementById("isomansendiri");
    var isomantext2 = document.getElementById("isomanalamat");
    var isomantext3 = document.getElementById("isomanurl");

    var rslabel1 = document.getElementById("rslabel");
    var rstext1 = document.getElementById("rs");

    var rslainlabel1 = document.getElementById("rslainnamalabel");
    var rslainlabel2 = document.getElementById("rslainalamatlabel");
    var rslainlabel3 = document.getElementById("rslainurllabel");
    var rslaintext1 = document.getElementById("rslainnama");
    var rslaintext2 = document.getElementById("rslainalamat");
    var rslaintext3 = document.getElementById("rslainurl");



    function isomanFunction() {
        var checkBox3 = document.getElementById("inlineRadio1");
        if (checkBox3.checked == true) {
            isomantext1.style.display = "block";
            isomantext2.style.display = "block";
            isomantext3.style.display = "block";
            isomanlabel1.style.display = "block";
            isomanlabel2.style.display = "block";
            isomanlabel3.style.display = "block";

            rslabel1.style.display = "none";
            rstext1.style.display = "none";

            rslainlabel1.style.display = "none";
            rslainlabel2.style.display = "none";
            rslainlabel3.style.display = "none";
            rslaintext1.style.display = "none";
            rslaintext2.style.display = "none";
            rslaintext3.style.display = "none";
        }
    }

    function rsFunction() {
        var checkBox3 = document.getElementById("inlineRadio2");
        if (checkBox3.checked == true) {
            isomantext1.style.display = "none";
            isomantext2.style.display = "none";
            isomantext3.style.display = "none";
            isomanlabel1.style.display = "none";
            isomanlabel2.style.display = "none";
            isomanlabel3.style.display = "none";

            rslabel1.style.display = "block";
            rstext1.style.display = "block";

            rslainlabel1.style.display = "none";
            rslainlabel2.style.display = "none";
            rslainlabel3.style.display = "none";
            rslaintext1.style.display = "none";
            rslaintext2.style.display = "none";
            rslaintext3.style.display = "none";
        }
    }

    function rslainFunction() {
        var checkBox3 = document.getElementById("inlineRadio3");
        if (checkBox3.checked == true) {
            isomantext1.style.display = "none";
            isomantext2.style.display = "none";
            isomantext3.style.display = "none";
            isomanlabel1.style.display = "none";
            isomanlabel2.style.display = "none";
            isomanlabel3.style.display = "none";

            rslabel1.style.display = "none";
            rstext1.style.display = "none";

            rslainlabel1.style.display = "block";
            rslainlabel2.style.display = "block";
            rslainlabel3.style.display = "block";
            rslaintext1.style.display = "block";
            rslaintext2.style.display = "block";
            rslaintext3.style.display = "block";
        }
    }

</script>
@endsection
