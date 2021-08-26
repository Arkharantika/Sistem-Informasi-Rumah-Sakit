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
                    <li class="breadcrumb-item active" aria-current="page">List Data User</li>
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



    <p class="mb-0 text-uppercase display-6 text-center">List User UNS Care</p>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if((Auth::user()->role ?? '') == 'admin')
                <table cellspacing="5" cellpadding="5" border="0">
                    <tbody>
                        <tr>
                            <div class="col-sm-9 text-secondary">
                                <!-- <input type="submit" class="btn btn-success px-4" value="Import Data" /> -->
                                <button type="button" class="btn btn-success mr-5" data-toggle="modal"
                                    data-target="#importCovid">
                                    Import Data
                                </button>
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
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>NIM / NIP</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Verivikasi Status</th>
                            <th style="width:10%">Action</th>
                            <!-- <th>Updated at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_lengkap}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->nim_nip}}</td>
                            <td>{{$row->no_telp}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->status}}</td>
                            <td>{{$row->role}}</td>
                            <td>{{$row->verified}}</td>
                            <td class="text-center">
                                <a href="datapersonal/{{$row->id}}" class="btn btn-sm btn-warning mr-5 mb-5"><i
                                        class="bx bx-edit-alt"></i></a>
                                <a href="deletepersonal/{{$row->id}}" class="btn btn-sm btn-danger mr-5 mb-5"><i
                                        class="bx bx-eraser"></i></a>
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
            <form method="post" action="{{ route('importUser') }}" enctype="multipart/form-data">
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
@endsection
