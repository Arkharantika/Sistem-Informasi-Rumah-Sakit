<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ClaimCovid;
use App\Imports\CovidImport;
use App\Imports\UserImport;
use App\Http\Controllers\Controller;
use Session;

use App\Models\UserData;
use App\Models\User;
// use App\Models\ClaimCovid;
use App\Models\ClaimCovidHistory;

class ImportController extends Controller
{
    //
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// import data
		Excel::import(new CovidImport, $file);

		// notifikasi dengan session
		Session::flash('sukses','Data Covid Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('admin/datapositifcovid');
	}
	public function import_user(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// import data
		Excel::import(new UserImport, $file);

		// notifikasi dengan session
		Session::flash('sukses','Data Covid Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('admin/useradministration');
	}
}
