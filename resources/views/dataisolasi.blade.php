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
                    <li class="breadcrumb-item active" aria-current="page">Data Pasien Karantina</li>
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
    <!--end breadcrumb-->

    <!-- Page Break -->
    <hr />
    <p class="mb-0 text-uppercase display-6 text-center">Data user yang sedang karantina covid-19</p>
    <hr />
    <!-- end of Page Break -->

    <!--  -->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Pasien Isolasi Mandiri </p>
                            <h4 class="my-1">{{$totalMandiri}}</h4>
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
                            <p class="mb-0 text-secondary">Pasien Isolasi Terpusat</p>
                            <h4 class="my-1">{{$totalTerpusat}}</h4>
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
                            <p class="mb-0 text-secondary">Pasien Isolasi RS Lain </p>
                            <h4 class="my-1">{{$totalLainnya}}</h4>
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
    <!--  -->

    <!-- Main Table -->
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">User Yang Isolasi Mandiri</h6>
            <hr />
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM / NIP</th>
                            <th>Status Covid</th>
                            <!-- <th>Alamat</th> -->
                            <th>Url G-Maps</th>
                            <!-- <th>Sudah Diberi Bantuan ? (dari UNS)</th> -->
                            <th>Sudah Selesai ?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nim_nip}}</td>
                            <td>
                                @if($row->status_verified == 0)
                                <span class="text-danger">Belum Diverifikasi</span>
                                @elseif($row->status_verified == 1)
                                <span class="text-primary">Sudah Terverifikasi</span>
                                @endif
                            </td>
                            <!-- <td>{{$row->alamat}}</td> -->
                            <td>{{$row->url_map}}</td>
                            <!-- <td>{{$row->kiriman_bantuan}}</td> -->
                            <td>{{$row->selesai}}</td>
                            <!-- <td>{{$row->butuh_bantuan}}</td> -->
                            <!-- <td>{{$row->created_at}}</td> -->
                            <td>
                                <a href="{{url('/datapersonalisolasi/'.$row->id)}}" class="btn btn-sm btn-warning "><i
                                        class="bx bxs-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">User Yang Isolasi Rumah Sehat UNS</h6>
            <hr />
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM / NIP</th>
                            <th>Status Covid</th>
                            <th>Dirawat Di ?</th>
                            <th>Sudah Selesai ?</th>
                            <!-- <th>Tanggal Lapor</th> -->
                            <th>Action</th>
                            <!-- <th>Updated at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($dataTerpusat as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nim_nip}}</td>
                            <td>
                                @if($row->status_verified == 0)
                                <span class="text-danger">Belum Diverifikasi</span>
                                @elseif($row->status_verified == 1)
                                <span class="text-primary">Sudah Terverifikasi</span>
                                @endif
                            </td>
                            <td>{{$row->rumah_sehat}}</td>
                            <td>{{$row->selesai}}</td>
                            <!-- <td>{{$row->created_at}}</td> -->
                            <td>
                                <a href="{{url('/datapersonalisolasiterpusat/'.$row->id)}}" class="btn btn-sm btn-warning "><i
                                        class="bx bxs-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">User Yang Isolasi Di Rumah Sakit / Klinik Lain</h6>
            <hr />
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM / NIP</th>
                            <th>Status Covid</th>
                            <th>Nama Tempat</th>
                            <th>Alamat Tempat</th>
                            <th>Url-GMaps</th>
                            <!-- <th>Tanggal Lapor</th> -->
                            <th>Sudah Selesai ?</th>
                            <th>Action</th>
                            <!-- <th>Updated at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($dataLainnya as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nim_nip}}</td>
                            <td>
                                @if($row->status_verified == 0)
                                <span class="text-danger">Belum Diverifikasi</span>
                                @elseif($row->status_verified == 1)
                                <span class="text-primary">Sudah Terverifikasi</span>
                                @endif
                            </td>
                            <td>{{$row->nama_tempat}}</td>
                            <td>{{$row->alamat_tempat}}</td>
                            <td>{{$row->url_tempat}}</td>
                            <!-- <td>{{$row->created_at}}</td> -->
                            <td>{{$row->selesai}}</td>
                            <td>
                                <a href="{{url('/datapersonalisolasirslainnya/'.$row->id)}}" class="btn btn-sm btn-warning "><i
                                        class="bx bxs-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of Main Table -->
</div>
@endsection
