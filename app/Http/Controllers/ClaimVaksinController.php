<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\UserData;
use App\Models\ClaimCovid;
use App\Models\ClaimVaksin;
use App\Models\ClaimVaksinHistory;

class ClaimVaksinController extends Controller
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

        // return $vaksin;

        $history = ClaimVaksin::where('id_user',$user->id)->get();

        return view('claimvaksin',compact('history','user','complete','data','vaksin'));
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
        $user = Auth::user();
        $lengkap = UserData::where('id_user',$user->id)->get()->first();
        $complete = ClaimCovid::where('id_user',$user->id)->get()->first();
        $check = ClaimVaksin::where('id_user',$user->id)->get()->last();

        if($check == null){
            ClaimVaksin::Create([
                'id_user'       => $user->id,
                'nim_nip'       => $lengkap->nim_nip,
                'dosis_ke'      => $request->dosis,
                'keterangan'    => $request->keterangan,
                'link'          => $request->link
            ]);
            ClaimVaksinHistory::Create([
                'id_user'       => $user->id,
                'nim_nip'       => $lengkap->nim_nip,
                'dosis'         => $request->dosis
            ]);
            return redirect('user/claimvaksin')->with('message','Data Sudah Di Update, Terimakasih telah melapor !!');
        }

        if($check->dosis_ke == $request->dosis){
            return redirect('user/claimvaksin')->with('warning','Maaf, anda sudah pernah vaksin dosis ke '.$request->dosis);
        }

        if($check->dosis_ke != $request->dosis){
            ClaimVaksin::Create([
                'id_user'       => $user->id,
                'nim_nip'       => $lengkap->nim_nip,
                'dosis_ke'      => $request->dosis,
                'keterangan'    => $request->keterangan,
                'link'          => $request->link
            ]);
            // ClaimVaksinHistory::where('id_user',$user->id)->update([
            //     'dosis'         => $request->dosis
            // ]);
            return redirect('user/claimvaksin')->with('message','Data Sudah Di Update, Terimakasih telah melapor !!');
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
        $complete = ClaimCovid::where('id_user',$user->id)->get()->first();

        ClaimVaksin::updateOrCreate(['id_user' => $id],[
            'dosis_ke' => $request->dosis,
            'keterangan' => $request->keterangan,
            'link'        => $request->link
        ]);

        return redirect('user/claimvaksin');
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
