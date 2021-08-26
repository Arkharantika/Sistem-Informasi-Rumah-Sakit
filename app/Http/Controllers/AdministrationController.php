<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;
use App\Models\User;

// untuk Data Covid
use App\Models\ClaimCovid;
use App\Models\ClaimVaksin;
use App\Models\ClaimGejala;
use App\Models\ClaimIsolasi;

class AdministrationController extends Controller
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
        $data = UserData::join('users','users.id','=','user_data.id_user')->get();

        return view('listuser',compact('user','complete','data'));
    }

    public function updaterole($id)
    {
        // return $id;
        $user = Auth::user();
        // $complete = UserData::where('id_user',$user->id)->get()->first();
        // $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        User::where('id',$id)->update(
                [
                        'role'=>'operator',
                    ]
                );

        return redirect('admin/useradministration')->with('message','Data Berhasil Di Update !');
    }

    public function deletePersonal($id)
    {
        // return $id;
        $user = Auth::user();
        // $complete = UserData::where('id_user',$user->id)->get()->first();
        // $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        User::where('id',$id)->delete();

        return redirect('admin/useradministration')->with('message','Data Berhasil Di Delete !');
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

    public function askbantuan()
    {
        return 0;
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
