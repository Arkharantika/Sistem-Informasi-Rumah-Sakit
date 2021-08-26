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
                    <li class="breadcrumb-item active" aria-current="page">Data Vaksin</li>
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
    
    <!-- Donnut Chart -->
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
    
    <!-- end of Donnut Chart -->
    
    <!-- Page Break -->
    <hr />
    <p class="mb-0 text-uppercase display-6 text-center">Data user yang sudah vaksin covid-19</p>
    <hr />
    <!-- end of Page Break -->
    
    <!-- Stat -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div id="chart9"></div>
            </div>
        </div>
    </div>
    <!-- end of Stat -->
    
    <!-- Main Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Dosis ke</th>
                            <th>link kartu vaksin</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                            <!-- <th>Updated at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_lengkap}}</td>
                            <td>{{$row->dosis_ke}}</td>
                            <td><a href="">{{$row->link}}</a></td>
                            <td>{{$row->keterangan}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>
                                <a href="{{url('/datapersonalvaksin/'.$row->id)}}" class="btn btn-sm btn-primary "><i
                                        class="lni lni-eye" data-toggle="tooltip" title="Lihat Data"></i></a>
                                @if((Auth::user()->role ?? '') == 'admin' || (Auth::user()->role ?? '') == 'operator' )
                                        <a href="{{url('/verifikasivaksin/'.$row->id)}}" class="btn btn-sm btn-success "><i
                                        class="bx bx-check" data-toggle="tooltip" title="Verifikasi Data"></i></a>
                                        <a href="{{url('/deletevaksin/'.$row->id)}}" class="btn btn-sm btn-danger "><i
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
</div>
<!-- end of Main Table -->
@endsection

@section('CustomScripts')
<script src="{{asset('js/datavaksin.js')}}"></script>
@endsection
