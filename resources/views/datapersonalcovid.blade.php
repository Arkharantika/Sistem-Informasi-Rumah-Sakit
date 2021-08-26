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
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
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

    <h4 class="mb-0 text-uppercase text-center">Data Personal Specific User Covid</h4>
    <hr />
    <!--end breadcrumb-->

    <!--end breadcrumb-->

    <div class="main-body">
        <div class="row">
            <div class="col mx-auto">
                <br>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"><i class="bx bxs-user-circle font-50"></i>
                            @if(($data ?? '' != null))
                            <h4 class="form-label ">Suspect : {{$data->nama_lengkap}}</h4>
                            @else
                            <h4 class="form-label ">Suspect : belum ada data user</h4>
                            @endif
                            <!-- <p>Silahkan Isi Data ID dan Password Anda<a href="authentication-signup.html"></a> -->
                        </div>
                        <div class="login-separater text-center mb-4">
                            <hr />
                        </div>

                        @if($check_status == 0)
                        <div class="mb-3">
                                <button class="btn btn-outline-danger" disabled>
                                    Data User Ini Belum Diverifikasi
                                </button>
                            </div>
                            @else
                            <div class="mb-3">
                                <button class="btn btn-outline-success" disabled>
                                    Data User Ini Sudah Diverifikasi
                                </button>
                            </div>
                        @endif

                        <form method="post" action="{{url('/admin/updatecovid/'.$specific->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">NIM / NIP / NIK :</label>
                                <input type="text" class="form-control" value="{{$specific->nim_nip}}" name="nim_nip"
                                    id="nim_nip">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan :</label>
                                <input type="text" class="form-control" value="{{$specific->keterangan}}"
                                    name="keterangan" id="keterangan">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Terkonfirmasi Positif :</label>
                                <input type="text" class="form-control" value="{{$specific->tanggal_confirmed}}"
                                    name="tanggal_confirmed" id="nim_nip">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lapor Terkena Covid (Ke Aplikasi UNS Care) :</label>
                                <input type="text" class="form-control" value="{{$specific->created_at}}"
                                    name="tanggal_lapor" id="nim_nip">
                            </div>
                            <div class="mb-3"><i class="bx bx-caret-right"></i>
                                @if(($specific->gambar_hasiltest ?? '') != null)
                                <label class="form-label"> Gambar Hasil Test Antigen :</label><br>
                                <img src="{{asset('folder_covid/'.$specific->gambar_hasiltest)}}" alt=""
                                    style="width:350px;height:300px;">
                                @endif
                                @if(($specific->gambar_hasiltest ?? '') == null)
                                Belum Upload Gambar Test Antigen
                                @endif
                            </div>
                            <div class="mb-3"><i class="bx bx-caret-right"></i>
                                @if(($specific->gambar_pcr ?? '') != null)
                                <label class="form-label">Gambar Hasil Test PCR :</label><br>
                                <img src="{{asset('folder_covid/'.$specific->gambar_pcr)}}" alt=""
                                    style="width:350px;height:300px;">
                                @endif
                                @if(($specific->gambar_pcr ?? '') == null)
                                Belum Upload Gambar Test PCR
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label" id="rslabel">Sekarang Sudah Sembuh ? :</label>
                                <select name="sembuh" class="form-select form-select-sm mb-3" id="" required>
                                    <option value="">{{$specific->sembuh }} (pilih salah satu)</option>
                                    <option value="sudah">Sudah</option>
                                    <option value="belum">Belum</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" id="rslabel">Opsi Perawatan :</label>
                                <select class="form-select form-select-sm mb-3" name="opsi_perawatan" id="rs"
                                    placeholder="{{$specific->pilihan_isolasi }}" required>
                                    <option value="">[{{$specific->pilihan_isolasi }}] &nbsp;->&nbsp; (pilih salah satu)</option>
                                    @foreach ($lokasi as $mks)
                                    <option value="{{ $mks->id }}">
                                        {{ $mks->nama_lokasi }} &nbsp;->&nbsp; [{{ $mks->id }}]</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(($specific->updated_at ) != $specific->created_at && 
                            ($specific->sembuh ) == 'sudah')
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lapor Sembuh :</label>
                                <input type="text" class="form-control" value="{{$specific->updated_at}}" name="nim_nip"
                                    id="nim_nip" readonly>
                            </div>
                            @endif
                            <br>
                            <div class="mb-3">
                                <a href="{{url('/verifikasicovid/'.$specific->id)}}" class="btn btn-outline-primary"
                                data-toggle="tooltip" title="Verifikasi Data"><i
                                        class="bx bx-check"></i>
                                    Verifikasi Data Ini
                                    </a>
                            </div>
                            <div class="mb-3">
                                <!-- <div class="d-grid"> -->
                                <button type="submit" class="btn btn-success btn-lg px-5"><i class="bx bxs-edit"></i>
                                    Update Data </button>
                                <!-- </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





@endsection
