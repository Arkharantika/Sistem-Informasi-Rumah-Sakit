<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\UserData;
use App\Models\ClaimCovid;
use App\Models\ClaimVaksin;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;

class DataIsolasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // $data = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->get();
        $data = ClaimIsolasi::all();
        $dataTerpusat = ClaimIsolasiTerpusat::all();
        $dataLainnya = ClaimIsolasiRSLainnya::all();

        $totalMandiri = ClaimIsolasi::where('selesai','belum')->where('status_verified',1)->count();
        $totalTerpusat = ClaimIsolasiTerpusat::where('selesai','belum')->where('status_verified',1)->count();
        $totalLainnya = ClaimIsolasiRSLainnya::where('selesai','belum')->where('status_verified',1)->count();

        // return $data;
        return view('dataisolasi',compact('dataTerpusat','user','complete','data',
        'dataLainnya','totalLainnya','totalMandiri','totalTerpusat',));
    }

    public function isomanTerpusat()
    {
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $data = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->get();

        // return $data;
        return view('dataisolasi',compact('user','complete','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
