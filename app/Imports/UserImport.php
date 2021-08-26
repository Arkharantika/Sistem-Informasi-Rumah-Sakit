<?php

namespace App\Imports;

use App\Models\ClaimCovid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\Hash;

use App\Models\UserData;
use App\Models\User;
// use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;
use App\Models\ClaimIsolasi;
use App\Models\ClaimIsolasiTerpusat;
use App\Models\ClaimIsolasiRSLainnya;

class UserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $user = User::updateOrCreate(
            ['name' => $row['nama_lengkap']],
            ['email'=>$row['email'],
            'role' => $row['role'],
            'password' => Hash::make($row['password'])
        ]);

       
 
        return UserData::updateOrCreate(['id_user' => $user->id],[
            // 'id_user' => null,
            'nama_lengkap' => $row['nama_lengkap'],
            'nim_nip' => strtoupper($row['nim_nip']),
            'no_telp' => $row['no_telp'],
            'status' => $row['status'],
            'alamat' => $row['alamat'],
            'verified' => $row['verified']
        ]);
    }
}
