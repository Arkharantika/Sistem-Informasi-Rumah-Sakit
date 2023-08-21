<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;

// Model Untuk Sensor Dan Hardware
use App\Models\MasterSensor;
use App\Models\Hardware;
use App\Models\HardwareDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;


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
        
        $sensorValues = [];
        $datasets = [];
        $labels = [];
        $chartData = [];
        $simplifiedData=[];
        $latitude=[];
        $longitude=[];

        return view('home', compact('complete','user','sensorValues','datasets','labels','chartData','simplifiedData','latitude','longitude'));
 
    }
    public function profile()
    {
        $Role = Auth::user()->role;
        $Check = UserData::where('id_user',Auth::user()->id)->first();

        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        
        return view('profile', compact('complete','user'));
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

    public function chart(){
        return view('chart');
    }

    public function indexFindSensor()
    {
        $Role = Auth::user()->role;
        $Check = UserData::where('id_user',Auth::user()->id)->first();

        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        
        $sensorValues = [];
        $datasets = [];
        $labels = [];
        $chartData = [];
        $simplifiedData=[];
        $latitude=[];
        $longitude=[];

        return view('homefindsensor', compact('complete','user','sensorValues','datasets','labels','chartData','simplifiedData','latitude','longitude'));
    }

    public function LoadData(Request $request)
    {
        $records = TransactionDetail::join('hardware', 'transaction_detail.hardware', '=', 'hardware.hardware')
        ->join('transaction','transaction_detail.trans_id', '=', 'transaction.id')
        ->where('hardware.hardware', $request->hardware)
        ->whereBetween('transaction.created_at', [$request->start_date, $request->end_date])
        ->get();

        $groupedCollection = $records->groupBy(function ($item) {
            // Convert the 'created_at' timestamp to just the date format (Y-m-d)
            return substr($item['created_at'], 0, 10);
        });

        if ($records->isEmpty()) {
            // return '0';
            return redirect('findsensor')->with('warning','Tidak ada data !');
        }

        $latitude = $records->first()->latitude;
        $longitude = $records->first()->longitude; 
        $sensorValues= [];
        $datasets= [];
        $labels=[];

        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $chartData = [];
        $simplifiedData = [];

            // Iterate through the $groupedCollection
            foreach ($groupedCollection as $date => $entries) {
                // Initialize an empty array for each date
                $dateData = [];

                // Iterate through the entries for this date
                foreach ($entries as $entry) {
                    // Extract the required fields for each entry
                    $entryData = [
                        'hardware' => $entry['hardware'],
                        'sensor' => $entry['sensor'],
                        'value' => $entry['value'],
                    ];

                    // Add this entry data to the date's array
                    $dateData[] = $entryData;
                }

                // Add the date's data to the simplifiedData array
                $simplifiedData[$date] = $dateData;
            }

        return view('sensorhome', compact('complete','user','sensorValues','datasets','labels','chartData','simplifiedData','latitude','longitude'));
    }
}
