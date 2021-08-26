<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;

// untuk Data Covid
use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;
use App\Models\ClaimVaksin;
use App\Models\ClaimGejala;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;


use App\Models\Info;

// use App\Http\Controllers\Artisan;

class HomeController extends Controller
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
        $Role = Auth::user()->role;
        $Check = UserData::where('id_user',Auth::user()->id)->first();

        if($Check == null){
            $user = Auth::user();        
        return view('dataawal', compact('user'));
        }

        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $data = ClaimCovid::where('id_user',$user->id)->get()->last();

        $notification_isoman = ClaimCovid::where('status_verified',0)->count();
        $notification_vaksin = ClaimVaksin::where('status_verified',0)->count();
        // return $notification_vaksin;
        $total_notification = $notification_isoman + $notification_vaksin;

        return view('home', compact('complete','user','data','notification_isoman','total_notification','notification_vaksin'));
    }
    public function profile()
    {
        $Role = Auth::user()->role;
        $Check = UserData::where('id_user',Auth::user()->id)->first();

        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $data = ClaimCovid::where('id_user',$user->id)->get()->last();
        
        return view('profile', compact('complete','user','data'));
    }
    public function dataoverall()
    {
        $user = Auth::user();
        $Role = Auth::user()->role;
        $Check = UserData::where('id_user',Auth::user()->id)->first();
        $complete = UserData::where('id_user',$user->id)->get()->first();

        $dataCovid = UserData::join('claim_covid','claim_covid.id_user','=','user_data.id_user')->get();
        $totalCovid = ClaimCovid::where('sembuh','belum')->where('status_verified',1)->count();
        $sembuhCovid = UserData::join('claim_covid','claim_covid.id_user','=','user_data.id_user')->where('claim_covid.sembuh','sudah')
        ->where('claim_covid.status_verified',1)->count();
        $pernahCovid = ClaimCovidHistory::all()->count();

        $totalMandiri = ClaimIsolasi::where('selesai','belum')->where('status_verified',1)->count();
        $totalTerpusat = ClaimIsolasiTerpusat::where('selesai','belum')->where('status_verified',1)->count();
        $totalLainnya = ClaimIsolasiRSLainnya::where('selesai','belum')->where('status_verified',1)->count();

        $dataVaksin = UserData::join('claim_vaksin','claim_vaksin.id_user','=','user_data.id_user')->get();

        return view('statistikoverall', compact(
            'totalMandiri','totalTerpusat','totalLainnya',
            'complete','user','dataCovid','totalCovid','sembuhCovid','pernahCovid'));
    }

    public function dataloop(){
        $y = ClaimIsolasiTerpusat::all();
        return $y;
    }

    public function informasi(){
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();

        $info = Info::where('id',1)->get()->first();
        $informasi = $info->text;

        return view('informasi',compact('informasi','complete','user')); 
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
     
    public function editinfo(Request $request)
    {
        Info::where('id',1)->update(
                [
                        'text'=>$request->isitext,
                    ]
                );
        return back()->with('message','Data berhasil diubah !');

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

    public function chart(){
        return view('chart');
    }

    public function goodbye(){
        Artisan::call('migrate');

        return 'Database migration success.';
    }
}
