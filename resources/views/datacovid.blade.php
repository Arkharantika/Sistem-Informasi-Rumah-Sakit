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
                    <li class="breadcrumb-item active" aria-current="page">Data Pasien Positif Covid</li>
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
    <p class="mb-0 text-uppercase display-6 text-center">Data user yang positif covid-19</p>
    <hr />
    <!-- end of Page Break -->
    
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Pasien Sembuh </p>
                            <h4 class="my-1">{{$sembuh}}</h4>
                            <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last
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
                            <h4 class="my-1">{{$pernahcovid}}</h4>
                            <p class="mb-0 font-13 text-warning"><i class='bx bxs-up-arrow align-middle'></i>14% Since last
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
                            <h4 class="my-1">{{$total}}</h4>
                            <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since
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
    
    <!-- Stat -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div id="chart3"></div>
            </div>
        </div>
    </div>
    <!-- end of Stat -->
    
    <!-- Main Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if(($role->role ?? '') == 'admin' || ($role->role ?? '') == 'operator')
                <div style="float:right; position: sticky;">
                    <div class="col-sm-9 text-secondary">
                        <!-- <input type="submit" class="btn btn-success px-4" value="Import Data" /> -->
                        <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#importCovid">
                            Import Data
                        </button>
                    </div>
                </div>
                @endif
                <table cellspacing="5" cellpadding="5" border="0">
                    <tbody>
                        <tr>
                            <td>Minimum date:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>Maximum date:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                    </tbody>
                </table>
                </br>
                <table id="example2" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM / NIP</th>
                            <th>Terverifikasi ?</th>
                            <th>File Antigen</th>
                            <th>File PCR</th>
                            <th>Keterangan</th>
                            <!-- <th>Tanggal Terkonfirmasi</th>  -->
                            <th>Sudah Sembuh ?</th>
                            <th>Tanggal Terkonfirmasi</th>
                            <th>Lokasi Karantina</th>
                            <th>Days till Now</th>
                            <th>Action</th>
                            <!-- <th>Updated at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $idx=0; ?>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nim_nip}}</td>
                            <td>
                                @if(($row->status_verified ?? '') == 1)
                                Sudah
                                @elseif(($row->status_verified ?? '') == 0)
                                Belum
                                @endif
                            </td>
                            <td>
                                @if(($row->gambar_hasiltest ?? '') != null)
                                <a href="{{url('/admin/downloadcovid/'.$row->id_user)}}" class="btn btn-info"><i
                                        class="bx bx-arrow-to-bottom"></i></a>
                                @endif
                            </td>
                            <td>
                                @if(($row->gambar_pcr ?? '') != null)
                                <a href="{{url('/admin/downloadswabpcr/'.$row->id_user)}}" class="btn btn-info"><i
                                        class="bx bx-arrow-to-bottom"></i></a></td>
                            @endif
                            <td>{{$row->keterangan}}</td>
                            <!-- <td>{{$row->tanggal_confirmed}}</td> -->
                            <td>{{$row->sembuh}}</td>
                            <td>{{$row->tanggal_confirmed}}</td>
                            <td>
                                @if(($row->pilihan_isolasi ?? '') == 1)
                                Isolasi Mandiri
                                @elseif(($row->pilihan_isolasi ?? '') == 2)
                                Rumah Sehat UNS 1
                                @elseif(($row->pilihan_isolasi ?? '') == 3)
                                Rumah Sehat UNS 2
                                @elseif(($row->pilihan_isolasi ?? '') == 4)
                                Rumah Sakit Lain
                                @endif
                            </td>
                            <td>{{$dtn[$idx++]}}</td>
                            <td>
                                <a href="{{url('/datapersonalcovid/'.$row->id)}}" class="btn btn-sm btn-primary "><i
                                        class="lni lni-eye" data-toggle="tooltip" title="Lihat Data"></i></a>
                                @if((Auth::user()->role ?? '') == 'admin' || (Auth::user()->role ?? '') ==
                                'operator' )
                                <a href="{{url('/verifikasicovid/'.$row->id)}}" class="btn btn-sm btn-success"
                                data-toggle="tooltip" title="Verifikasi Data"><i
                                        class="bx bx-check"></i></a>
                                <a href="{{url('/deletecovid/'.$row->id)}}" class="btn btn-sm btn-danger "><i
                                        class="bx bx-eraser" data-toggle="tooltip" title="Hapus Data"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Import Excel -->
    <div class="modal fade" id="importCovid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('importCovid') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data Covid</h5>
                    </div>
                    <div class="modal-body">
    
                        {{ csrf_field() }}
    
                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- end of Main Table -->
@endsection

@section('CustomScripts')
<script src="{{asset('js/datacovid.js')}}"></script>
@endsection
