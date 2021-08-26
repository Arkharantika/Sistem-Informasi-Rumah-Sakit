<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\UserData;
use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;
use App\Models\ClaimVaksinHistory;
use App\Models\ClaimVaksin;
use App\Models\ClaimGejala;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;
use App\Models\LokasiCovid;

class DataPersonalController extends Controller
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
        //
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
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::where('id_user',$id)->get()->first();
        $covid = UserData::join('claim_covid','claim_covid.id_user','=','user_data.id_user')->where('claim_covid.id_user',$id)->get()->all();
        $vaksin = UserData::join('claim_vaksin','claim_vaksin.id_user','=','user_data.id_user')->where('claim_vaksin.id_user',$id)->get()->all();
        $gejala = UserData::join('claim_gejala','claim_gejala.id_user','=','user_data.id_user')->where('claim_gejala.id_user',$id)->get()->all();
        $isolasi = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id_user',$id)->get()->all();

        return view('datapersonalcomplete',compact('specific','complete','covid','vaksin','gejala','isolasi','user'));
    }

    public function showCovid($id)
    {
        $user = Auth::user();
        $check = ClaimCovid::where('id',$id)->get()->first();
        $check_status = $check->status_verified;

        // return $check_status;

        $nim_nip = $check->nim_nip;

        $complete = UserData::where('id_user',$user->id)->get()->first();
        
        $data = UserData::where('nim_nip',$nim_nip)->get()->first();

        $specific = ClaimCovid::where('id',$id)->get()->first();

        // return $specific;
        $lokasi = LokasiCovid::all();

        return view('datapersonalcovid',compact('check_status','data','lokasi','complete','specific','user','check'));
    }

    public function showVaksin($id)
    {
        // return $id;
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::join('claim_vaksin','claim_vaksin.id_user','=','user_data.id_user')->where('claim_vaksin.id',$id)->get()->first();

        return view('datapersonalvaksin',compact('complete','specific','user'));
    }
    
    public function showGejala($id)
    {
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::join('claim_gejala','claim_gejala.id_user','=','user_data.id_user')->where('claim_gejala.id',$id)->get()->first();
        
        return view('datapersonalgejala',compact('complete','specific','user'));
    }
    
    public function showIsolasi($id)
    {
        // return 'kampret euy';
        $user = Auth::user();
        $check = ClaimIsolasi::where('id',$id)->get()->first();
        $cred = ClaimCovid::where('id',$check->id_covid)->get()->first();
        // $last_check = $cred->pilihan_isolasi

        // return $check;
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();

        $status_karantina = $cred->pilihan_isolasi;

        // return $status_karantina;
         

        $isolasi = ClaimIsolasi::where('nim_nip',$complete->nim_nip)->get()->last();

        $terpusat = ClaimIsolasiTerpusat::where('nim_nip',$complete->nim_nip)->get()->last();
        $lainnya = ClaimIsolasiRSLainnya::where('nim_nip',$complete->nim_nip)->get()->last();


        return view('datapersonalisolasi',compact('cred','status_karantina','complete','specific','user'));
    }

    public function showIsolasiTerpusat($id)
    {
        // return 'kampret euy';
        $user = Auth::user();
        $check = ClaimIsolasiTerpusat::where('id',$id)->get()->first();
        $cred = ClaimCovid::where('id',$check->id_covid)->get()->first();

        $status_karantina = $cred->pilihan_isolasi;

        // return $status_karantina;

        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        
        $check = ClaimCovid::where('nim_nip',$complete->nim_nip)
        ->get()->last();
        
        // $status_verifikasi = $check->status_verified;
        
        
        $isolasi = ClaimIsolasi::where('nim_nip',$complete->nim_nip)->get()->last();
        
        $terpusat = ClaimIsolasiTerpusat::where('nim_nip',$complete->nim_nip)->get()->last();
        $lainnya = ClaimIsolasiRSLainnya::where('nim_nip',$complete->nim_nip)->get()->last();
        
        
        return view('datapersonalisolasi',compact('cred','complete','specific','user','status_karantina'));
    }
    public function showIsolasiRSLainnya($id)
    {
        // return 'kampret euy';
        $user = Auth::user();
        $check = ClaimIsolasiRSLainnya::where('id',$id)->get()->first();
        $cred = ClaimCovid::where('id',$check->id_covid)->get()->first();
        
        $status_karantina = $cred->pilihan_isolasi;

        // return $status_karantina;

        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        
        $check = ClaimCovid::where('nim_nip',$complete->nim_nip)
        ->get()->last();
        
        // $status_verifikasi = $check->status_verified;
        
        
        $isolasi = ClaimIsolasi::where('nim_nip',$complete->nim_nip)->get()->last();
        
        $terpusat = ClaimIsolasiTerpusat::where('nim_nip',$complete->nim_nip)->get()->last();
        $lainnya = ClaimIsolasiRSLainnya::where('nim_nip',$complete->nim_nip)->get()->last();


        return view('datapersonalisolasi',compact('cred','status_karantina','complete','specific','user'));
    }

    public function verifikasiCovid($id)
    {
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $specific = ClaimCovid::where('id',$id)->get()->first();
        $check = ClaimCovid::where('id',$id)->get()->pluck('nim_nip');

        $duplicate = ClaimCovid::where('nim_nip',$check)->count();

        ClaimCovid::where('id',$id)->update(
                [
                        'status_verified'=>1,
                    ]
                );

        if($duplicate == 1){
            ClaimCovidHistory::updateOrCreate( 
                ['nim_nip'         => $specific->nim_nip],
                ['sembuh'           => 'belum'
            ]);
            return redirect('admin/datapositifcovid')->with('message','Data Berhasil Di Update !');
        }

        return redirect('admin/datapositifcovid')->with('message','Data Berhasil Di Update !');
    }

    public function verifikasiVaksin($id)
    {
        // return $id;
        $user = Auth::user();
        // $complete = UserData::where('id_user',$user->id)->get()->first();
        // $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        ClaimVaksin::where('id',$id)->update(
                [
                        'status_verified'=>1,
                    ]
                );

        return redirect('admin/datavaksin')->with('message','Data Berhasil Di Update !');
    }

    public function deleteVaksin($id)
    {
        // return $id;
        $user = Auth::user();
        $complete = ClaimVaksin::where('id',$id)->get()->first();
        $check = $complete->nim_nip;

        $check2 = ClaimVaksin::where('nim_nip','k808020')->get();
        $m = ClaimVaksinHistory::where('nim_nip','k808020')->get();

        // return $check2;
        // return $m;

        $x= 0;
        foreach($check2 as $row){
            $x = $x+1;
        }

        if($x >1){
            ClaimVaksin::where('id',$id)->delete();
        }else{
            ClaimVaksin::where('id',$id)->delete();
            ClaimVaksinHistory::where('nim_nip',$check)->delete();
        }

        return redirect('admin/datavaksin')->with('message','Data Berhasil Di Hapus !');
    }
    
    public function deleteCovid($id)
    {
        // return $id;
        $user = Auth::user();
        // $complete = UserData::where('id_user',$user->id)->get()->first();
        // $specific = UserData::join('claim_isolasi','claim_isolasi.id_user','=','user_data.id_user')->where('claim_isolasi.id',$id)->get()->first();
        
        ClaimCovid::where('id',$id)->delete();

        return redirect('admin/datapositifcovid')->with('message','Data Berhasil Di Hapus !');
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
        UserData::where('id_user',$id)->update([
            'verified'     => 'yes',
        ]);

        return redirect('admin/useradministration')->with('message','Data Berhasil Di Update !');
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
