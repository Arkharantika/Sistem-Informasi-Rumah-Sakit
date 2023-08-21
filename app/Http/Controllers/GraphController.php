<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;
use App\Models\ClaimVaksin;
use App\Models\ClaimVaksinHistory;
use App\Models\UserData;

// Model Untuk Sensor Dan Hardware
use App\Models\MasterSensor;
use App\Models\Hardware;
use App\Models\HardwareDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class GraphController extends Controller
{
    // Daily Positive Case Graph
    public function graphPositif(){
        $number = new Collection();
        $healthy = new Collection();
        $day = new Collection();
        $date = new Collection();
        for($i=1;$i<=31;$i++){
            $data = ClaimCovid::whereDay('tanggal_confirmed',$i)->where('status_verified',1)->where('sembuh','belum')->pluck('tanggal_confirmed');
            $data2 = ClaimCovid::whereDay('tanggal_confirmed',$i)->where('status_verified',1)->where('sembuh','sudah')->pluck('tanggal_confirmed');
            $count = count($data);
            $count2 = count($data2);
            if($count != null && $count2 != null){
                $number->push($count);
                $healthy->push($count2);
                $day->push($data[0]);
            }
            else if($count != null && $count2 == null){
                $number->push($count);
                $healthy->push(0);
                $day->push($data[0]);
            }
            else if($count == null && $count2 != null){
                $number->push(0);
                $healthy->push($count2);
                $day->push($data2[0]);
            }
        }
        for($i=0;$i<count($day);$i++){
            $d = Carbon::parse($day[$i])->format('M/d/Y');
            $date->push($d);
        }
        return ['number' => $number, 'healthy' => $healthy, 'day' => $date];
    }

    public function graphVaccine(){
        $data = new Collection();
        $labels = new Collection();
        $max = ClaimVaksinHistory::pluck('dosis')->max();
        for($i=1;$i<=$max;$i++){
            $vaksin = ClaimVaksinHistory::where('dosis',$i)->pluck('dosis');
            $count = count($vaksin);
            $data->push($count);
            $label = "Dosis ke-" . $i;
            $labels->push($label);
        }
        $novaksin = UserData::leftJoin('claim_vaksin_history','user_data.id_user','=','claim_vaksin_history.id_user')
                    ->select('user_data.*','claim_vaksin_history.dosis')->whereNull('dosis')->get();
        $data->push(count($novaksin));
        $labels->push("Belum Vaksin");
        return['number' => $data, 'labels' => $labels];
    }

    public function graphSensor()
    {
        
    }
}
