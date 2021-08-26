<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;

// untuk Data Covid
use App\Models\ClaimCovid;
use App\Models\ClaimVaksin;
use App\Models\ClaimGejala;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;


class IsolasiController extends Controller
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

        $data = ClaimCovid::where('id_user',$user->id)->get()->last();
        
        $vaksin = ClaimVaksin::where('id_user',$user->id)->get()->last();
        $gejala = ClaimGejala::where('id_user',$user->id)->get()->last();
        
        $check = ClaimCovid::where('nim_nip',$complete->nim_nip)
        ->get()->last();

        if($check == null){
            return back()->with('message','Maaf, Anda Sedang Tidak Menderita Covid !');
        }
        // return $check;

        $status_verifikasi = $check->status_verified;
         

        $isolasi = ClaimIsolasi::where('nim_nip',$complete->nim_nip)->get()->last();

        $terpusat = ClaimIsolasiTerpusat::where('nim_nip',$complete->nim_nip)->get()->last();
        $lainnya = ClaimIsolasiRSLainnya::where('nim_nip',$complete->nim_nip)->get()->last();

        return view('isolasi',compact('status_verifikasi','user','complete','data','vaksin','gejala','isolasi','terpusat','lainnya'));
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
        // return $request;
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        $covid = ClaimCovid::where('id_user',$user->id)->get()->last();
        $gejala = ClaimGejala::where('id_user',$user->id)->get()->last();
        // return $request;

        // return $gejala;

        if($request->alasan == 'lainnya'){
            ClaimIsolasi::create( 
                ['id_user'          => $complete->id_user,
                'alasan'            => $request->alasan_lain, 
                'alamat'            => $request->alamat,
                'url_map'           => $request->url,
                'butuh_bantuan'     => $request->butuh_bantuan,
                'kiriman_bantuan'   => 'belum',
                'selesai'           => 'belum'
           ]);    
           return redirect('user/isolasimandiri')->with('message','Data Sudah Di Update, Terimakasih telah melapor !!');
        }

        else if($request->alasan == 'covid'){
            if($covid == null){
                return redirect('user/isolasimandiri')->with('warning','Maaf, Mohon isi data Claim Covid dahulu !!');
            }
            if($covid->sembuh == 'belum'){
                ClaimIsolasi::create( 
                    ['id_user'          => $complete->id_user,
                    'alasan'            => 'covid', 
                    'alamat'            => $request->alamat,
                    'url_map'           => $request->url,
                    'butuh_bantuan'     => $request->butuh_bantuan,
                    'kiriman_bantuan'   => 'belum',
                    'selesai'           => 'belum'
               ]);
               return redirect('user/isolasimandiri')->with('message','Data Sudah Di Update, Terimakasih telah melapor !!');
            }
            if($covid->sembuh == 'sudah'){
                return redirect('user/isolasimandiri')->with('warning','Maaf, Mohon isi data Claim Covid dahulu  !!');
            }
        }

        else if($request->alasan == 'gejala'){
            if($gejala == null){
                return redirect('user/isolasimandiri')->with('warning','Maaf, Mohon isi data Claim Gejala dahulu  !!');
            }
            if($gejala->berhenti == 'belum'){
                ClaimIsolasi::create( 
                    ['id_user'          => $complete->id_user,
                    'alasan'            => 'gejala covid', 
                    'alamat'            => $request->alamat,
                    'url_map'           => $request->url,
                    'butuh_bantuan'     => $request->butuh_bantuan,
                    'kiriman_bantuan'   => 'belum',
                    'selesai'           => 'belum'
               ]);
               return redirect('user/isolasimandiri')->with('message','Data Sudah Di Update, Terimakasih atas Laporannya !!');
            }
            if($gejala->berhenti == 'sudah'){
                return redirect('user/isolasimandiri')->with('warning','Maaf, Mohon isi data Claim Gejala dahulu !!');
            }
        }


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
        $user = Auth::user();
        // $complete = ClaimCovid::where('id_user',$user->id)->get()->first();
        
        ClaimIsolasi::where('id',$id)->update(
                [
                        'selesai'=>'sudah'
                    ]
                );
        return redirect('user/isolasimandiri');

        // return $id;
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
