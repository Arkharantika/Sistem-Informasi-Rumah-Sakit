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
        <div class="btn btn-primary "> Sudah Vaksin ! dosis {{$vaksin->dosis_ke}} </div>
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
    <div class="alert alert-danger alert-dismissable mt-20" role="alert">
        <h4>{{ session()->get('warning') }} </h4>
    </div>
    @endif

    <!-- <h6 class="mb-0 text-uppercase">informasi perawatan karantina covid-19</h6> -->
    <hr />
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
                        @if($status_verifikasi == 0)
                        
                            <button class="btn btn-outline-danger">
                                Data anda belum diverifikasi oleh operator / admin
                            </button>
                        

                        @elseif(($isolasi->selesai ?? '') == 'belum' && ($isolasi->status_change ?? '') == 0)
                        <div class="btn btn-info "> Sedang Isolasi Mandiri </div>

                        @elseif(($terpusat->selesai ?? '') == 'belum')
                        <div class="btn btn-info "> Sedang Isolasi Di Rumah Sehat UNS !!</div>
                        
                        @elseif(($lainnya->selesai ?? '') == 'belum')
                        <div class="btn btn-info "> Sedang Isolasi Di RS Lainnya </div>
                        
                        @else
                        <div class="btn btn-success "> Sedang Tidak Menjalani Perawatan Covid Dimanapun </div>
                        @endif
                    </div>
                    
                    @if($status_verifikasi == 1)
                    @if(($isolasi->selesai ?? '') == 'belum' && ($isolasi->status_change ?? '') == 0)
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
                    @elseif(($terpusat->selesai ?? '') == 'belum')
                    <div class="mb-3">
                        <label class="form-label" id="rslabel">Rumah Sehat UNS :</label>
                        <select class="form-select form-select-sm mb-3" name="rumahsehat" id="rs"
                            placeholder="pilih salah 1" value="{{$terpusat->rumah_sehat}}" disabled>
                            <option value="RS1">Rumah Sehat UNS 1 (RS UNS)</option>
                            <option value="RS2">Rumah Sehat UNS 2 (Asrama Mahasiswa)</option>
                        </select>
                        <!-- <input class="form-control" list="datalistOptions" id="rs" placeholder="ya" name="rumahsehat" style="display:none">
                                <datalist id="datalistOptions">
                                    <option value="Rumah Sehat UNS 1 (RS UNS)">
                                    <option value="Rumah Sehat UNS 2 (Asrama Mahasiswa)">
                                </datalist> -->
                    </div>
                    @elseif(($lainnya->selesai ?? '') == 'belum')
                    <div class="mb-3">
                        <label class="form-label" id="rslainnamalabel">Nama Tempat Perawatan :</label>
                        <input type="form-control" class="form-control" placeholder="" name="nama_tempat"
                            id="rslainnama" value="{{$lainnya->nama_tempat}}" disabled></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="rslainalamatlabel">Alamat lengkap Tempat
                            Perawatan :</label>
                        <input type="form-control" class="form-control" placeholder="" name="alamat_tempat"
                            id="rslainalamat" value="{{$lainnya->alamat_tempat}}" disabled></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="rslainurllabel">URL tempat tinggal saat ini
                            (koordinat G-Map) :</label>
                        <textarea type="form-control" class="form-control" placeholder="{{$lainnya->url_tempat}}"
                            name="url_tempat" id="rslainurl" value="{{$lainnya->url_tempat}}" disabled></textarea>
                    </div>
                    @else
                    @endif
                    @endif

                </div>
            </div>


        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">

                    <div class="text-center"><i class="bx bx-disc text-dark font-50"></i>
                        <h4 class="form-label ">Lapor Isolasi Mandiri Selain Covid</h4>

                    </div>
                    <div class="login-separater text-center mb-4">
                        <hr />
                    </div>

                    @if(($isolasi->id_user ?? '') == null || ($isolasi->selesai ?? '') == 'sudah')
                    <form method="post" action="/user/isolasimandiri" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Alasan lain :</label>
                            <textarea type="form-control" class="form-control"
                                placeholder="kasih tanda - (bila tidak ada alasan lain)" name="alasan_lain"
                                id="keterangan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tinggal Sendirian ? :</label>
                            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="ya"
                                name="keterangan">
                            <datalist id="datalistOptions">
                                <option value="Ya, Saya tinggal sendirian">
                                <option value="Tidak, Ada teman/orang lain yang tinggal di tempat yang sama">
                                <option value="Lainnya">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat lengkap Kos/Asrama/Rumah sewa, disekitar UNS <br>(contoh,
                                kos
                                xx, jalan xx, gang xx, RT/RW, kelurahan, kecamatan, Surakarta) :</label>
                            <textarea type="form-control" class="form-control" placeholder="" name="alamat" id="alamat"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL tempat tinggal saat ini (koordinat G-Map) :</label>
                            <textarea type="form-control" class="form-control" placeholder="" name="url" id="url"
                                required></textarea>
                        </div>

                        <br><br><br>

                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg px-5"><i class="bx bx-sun"></i>Saya
                                    sedang Isolasi Mandiri !</button>
                            </div>
                        </div>

                    </form>
                    @endif

                    @if(($isolasi->selesai ?? '') == 'belum')
                    <form method="post" action="/user/isolasimandiri/{{$isolasi->id}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Alasan lain :</label>
                            <textarea type="form-control" class="form-control"
                                placeholder="kasih tanda - (bila tidak ada alasan lain)" name="alasan_lain"
                                id="keterangan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tinggal Sendirian ? :</label>
                            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="ya"
                                name="keterangan">
                            <datalist id="datalistOptions">
                                <option value="Ya, Saya tinggal sendirian">
                                <option value="Tidak, Ada teman/orang lain yang tinggal di tempat yang sama">
                                <option value="Lainnya">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat lengkap Kos/Asrama/Rumah sewa, disekitar UNS <br>(contoh,
                                kos
                                xx, jalan xx, gang xx, RT/RW, kelurahan, kecamatan, Surakarta) :</label>
                            <textarea type="form-control" class="form-control" placeholder="" name="alamat" id="alamat"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL tempat tinggal saat ini (koordinat G-Map) :</label>
                            <textarea type="form-control" class="form-control" placeholder="" name="url" id="url"
                                required></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg px-5"><i class="bx bx-sun"></i>Saya
                                    Sudah Selesai Isolasi !</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
