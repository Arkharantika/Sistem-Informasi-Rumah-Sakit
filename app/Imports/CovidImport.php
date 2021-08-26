<?php

namespace App\Imports;

use App\Models\ClaimCovid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\UserData;
use App\Models\User;
// use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;

class CovidImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // if($row->status)
        if($row['pilihan_isolasi'] == 1 || $row['pilihan_isolasi'] == 2){
            if($row['pilihan_isolasi'] == 1){
    
                $kampret = ClaimCovid::updateOrCreate([
                    'nim_nip' => strtoupper($row['nim_nip'])],[
                    'id_user' => null,
                    'gambar_hasiltest' => null,
                    'gambar_pcr' => null,
                    'keterangan' => $row['keterangan'],
                    'tanggal_confirmed' => $row['tanggal'],
                    'status_verified' => $row['status'],
                    'sembuh' => $row['sembuh'],
                    'pilihan_isolasi' => $row['pilihan_isolasi']
                ]);
                
                ClaimIsolasi::create([
                    'id_covid' => $kampret->id,
                    'nim_nip'  => strtoupper($row['nim_nip']),
                    'alasan'	 => $row['sendirian'], 
                    'url_map'	 => $row['url_gmaps'], 
                    'alamat'	 => $row['alamat_tempat'], 
                    'selesai'	=>'belum'
                ]);      
                
            }
            else if($row['pilihan_isolasi'] == 2){
                $kampret = ClaimCovid::updateOrCreate([
                    'nim_nip' =>strtoupper($row['nim_nip'])],[
                    'id_user' => null,
                    'gambar_hasiltest' => null,
                    'gambar_pcr' => null,
                    'keterangan' => $row['keterangan'],
                    'tanggal_confirmed' => $row['tanggal'],
                    'status_verified' => $row['status'],
                    'sembuh' => $row['sembuh'],
                    'pilihan_isolasi' => $row['pilihan_isolasi']
                ]);
    
                ClaimIsolasiRSLainnya::create([
                    'id_covid' => $kampret->id,
                    'nim_nip'  =>  strtoupper($row['nim_nip']),
                    'nama_tempat'	 => $row['nama_tempat'], 
                    'url_tempat'	 => $row['url_gmaps'], 
                    'alamat_tempat'	 => $row['alamat_tempat'], 
                    'selesai'	=>'belum'
                ]);     
            }
        }

        else if($row['pilihan_isolasi'] == 3){
            $kampret = ClaimCovid::updateOrCreate([
                'nim_nip' => strtoupper($row['nim_nip'])],[
                'id_user' => null,
                'gambar_hasiltest' => null,
                'gambar_pcr' => null,
                'keterangan' => $row['keterangan'],
                'tanggal_confirmed' => $row['tanggal'],
                'status_verified' => $row['status'],
                'sembuh' => $row['sembuh'],
                'pilihan_isolasi' => $row['pilihan_isolasi']
            ]);

             ClaimIsolasiTerpusat::create([
                'id_covid' => $kampret->id,
                'nim_nip'  =>strtoupper($row['nim_nip']),
                'rumah_sehat' => 'RS1', 
				'selesai'	=>'belum'
            ]);        
        }
        else if($row['pilihan_isolasi'] == 4){
            $kampret = ClaimCovid::updateOrCreate([
                'nim_nip' =>strtoupper($row['nim_nip'])],[
                'id_user' => null,
                'gambar_hasiltest' => null,
                'gambar_pcr' => null,
                'keterangan' => $row['keterangan'],
                'tanggal_confirmed' => $row['tanggal'],
                'status_verified' => $row['status'],
                'sembuh' => $row['sembuh'],
                'pilihan_isolasi' => $row['pilihan_isolasi']
            ]);

             ClaimIsolasiTerpusat::create([
                'id_covid' => $kampret->id,
                'nim_nip'  => strtoupper($row['nim_nip']),
                'rumah_sehat' => 'RS2', 
				'selesai'	=>'belum'
            ]);   
        }

        return ClaimCovidHistory::updateOrCreate(['nim_nip' =>strtoupper($row['nim_nip'])],[
            
            'sembuh' => $row['sembuh']
        ]);
    }
}
