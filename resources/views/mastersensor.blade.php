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
        <div class="breadcrumb-title pe-3">Tabel</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-list-ul"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List Data Master Sensor</li>
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

    @if(session()->get('message'))
    <div class="alert alert-info alert-dismissable mt-20 text-center" role="alert">
        <h4>{{ session()->get('message') }} </h4>
    </div>
    @endif

    @if(session()->get('warning'))
    <div class="alert alert-danger alert-dismissable mt-20 text-center" role="alert">
        <h4>{{ session()->get('warning') }} </h4>
    </div>
    @endif

    <hr />
    <p class="mb-0 text-uppercase display-6 text-center">List Data Master Sensor</p>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if((Auth::user()->role ?? '') == 'super admin' || (Auth::user()->role ?? '') == 'admin')
                <table cellspacing="5" cellpadding="5" border="0">
                    <tbody>
                        <tr>
                            <div class="col-sm-9 text-secondary">
                                <a type="button" class="btn btn-outline-success mr-5"
                                    href="{{url('/mastersensor/tambahdata')}}">
                                    <i class='bx bx-plus'></i> Tambah Data
                                </a>
                            </div>
                        </tr>
                    </tbody>
                </table>
                <br>
                @endif
                <table id="example2" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sensor</th>
                            <th>Sensor Name</th>
                            <th>Unit</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            @if((Auth::user()->role ?? '') == 'super admin' || (Auth::user()->role ?? '') == 'admin'
                                )
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->sensor}}</td>
                            <td>{{$row->sensor_name}}</td>
                            <td>{{$row->unit}}</td>
                            <td>{{$row->created_by}}</td>
                            <td>{{$row->created_at}}</td>
                            @if((Auth::user()->role ?? '') == 'super admin' || (Auth::user()->role ?? '') == 'admin'
                                )
                            <td class="text-center">
                                <a href="editmastersensor/{{$row->id}}" class="btn btn-sm btn-warning mr-5 mb-5"><i
                                        class="bx bx-edit-alt"></i></a>
                                @if((Auth::user()->role ?? '') == 'super admin')
                                <a onclick="return confirm('Yakin untuk menghapus data ini?')"
                                    href="deletemastersensor/{{$row->id}}" class="btn btn-sm btn-danger mr-5 mb-5"><i
                                        class="bx bx-eraser"></i></a>
                                @endif
                                @if((Auth::user()->role ?? '') == 'super admin' || (Auth::user()->role ?? '') == 'admin'
                                )
                                <a onclick="return confirm('Yakin untuk menghapus data ini?')"
                                    href="softdeletemastersensor/{{$row->id}}"
                                    class="btn btn-sm btn-outline-danger mr-5 mb-5"><i class="bx bx-eraser"></i></a>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection