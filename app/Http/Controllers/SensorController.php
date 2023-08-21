<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;
use App\Models\User;

// Model Untuk Sensor Dan Hardware
use App\Models\MasterSensor;
use App\Models\Hardware;
use App\Models\HardwareDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;


class SensorController extends Controller
{
    // <<<============ ++++++++++++++++++++++ ============>>>
    // <<<============ AUTHENTICATION CHECKER ============>>>
    // <<<============ ++++++++++++++++++++++ ============>>>

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // <<<============ ++++++++++++++++++++++ ============>>>
    // <<<============      HALAMAN INDEX     ============>>>
    // <<<============ ++++++++++++++++++++++ ============>>>

    // <<< 1. INDEX MASTER SENSOR >>>
    public function indexMasterSensor()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $data = MasterSensor::all();
        return view('mastersensor',compact('user','complete','data'));
    }

    // <<< 2. INDEX HARDWARE >>>
    public function indexHardware()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $data = Hardware::all();
        return view('hardware',compact('user','complete','data'));
    }

    // <<< 3. INDEX HARDWARE DETAIL >>>
    public function indexHardwareDetail()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $data = HardwareDetail::all();
        return view('hardwaredetail',compact('user','complete','data'));
    }

    // <<< 4. INDEX TRANSACTION >>>
    public function indexTransaction()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $data = Transaction::all();
        return view('transaction',compact('user','complete','data'));
    }

    // <<< 5. INDEX TRANSACTION DETAIL >>>
    public function indexTransactionDetail()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $data = TransactionDetail::all();
        return view('transactiondetail',compact('user','complete','data'));
    }

    // <<<============ ++++++++++++++++++++++ ============>>>
    // <<<============      FUNGSI DELETE     ============>>>
    // <<<============ ++++++++++++++++++++++ ============>>>

    // <<< 1. MASTER SENSOR >>>
    public function SoftDeleteMasterSensor($id)
    {
        $item = MasterSensor::findOrFail($id);
        $item->delete();
        return redirect('mastersensor')->with('warning','Data Berhasil Di Delete !');
    }

    public function DeleteMasterSensor($id)
    {
        $item = MasterSensor::findOrFail($id);
        $item->forceDelete(); 
        return redirect('mastersensor')->with('warning','Data Berhasil Di Delete !');
    }

    // <<< 2. HARDWARE >>>
    public function SoftDeleteHardware($id)
    {
        $item = Hardware::findOrFail($id);
        $item->delete();         
        return redirect('hardware')->with('warning','Data Berhasil Di Delete !');
    }

    public function DeleteHardware($id)
    {
        $item = Hardware::findOrFail($id);
        $item->forceDelete();         
        return redirect('hardware')->with('warning','Data Berhasil Di Delete !');
    }

    // <<< 3. HARDWARE DETAIL >>>
    public function SoftDeleteHardwareDetail($id)
    {
        $item = HardwareDetail::findOrFail($id);
        $item->delete();         
        return redirect('hardwaredetail')->with('warning','Data Berhasil Di Delete !');
    }

    public function DeleteHardwareDetail($id)
    {
        $item = HardwareDetail::findOrFail($id);
        $item->forceDelete();         
        return redirect('hardwaredetail')->with('warning','Data Berhasil Di Delete !');
    }

    // <<< 4. TRANSACTION >>>
    public function SoftDeleteTransaction($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();         
        return redirect('transaction')->with('warning','Data Berhasil Di Delete !');
    }

    public function DeleteTransaction($id)
    {
        $item = Transaction::findOrFail($id);
        $item->forceDelete();         
        return redirect('transaction')->with('warning','Data Berhasil Di Delete !');
    }

    // <<< 5. TRANSACTION DETAIL >>>
    public function SoftDeleteTransactionDetail($id)
    {
        $item = TransactionDetail::findOrFail($id);
        $item->delete();         
        return redirect('transactiondetail')->with('warning','Data Berhasil Di Delete !');
    }

    public function DeleteTransactionDetail($id)
    {
        $item = TransactionDetail::findOrFail($id);
        $item->forceDelete();         
        return redirect('transactiondetail')->with('warning','Data Berhasil Di Delete !');
    }

    // <<<============ ++++++++++++++++++++++ ============>>>
    // <<<============     FUNGSI ADD DATA    ============>>>
    // <<<============ ++++++++++++++++++++++ ============>>>


    // <<< 1. ADD MASTER SENSOR >>>
    public function FormTambahMasterSensor()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        return view('formtambahmastersensor',compact('user','complete'));
    }

    public function createMasterSensor(Request $request)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $query = MasterSensor::create([
            'sensor' => $request->sensor,
            'sensor_name' => $request->sensor_name,
            'unit' => $request->unit,
            'created_by' => $user->role,
        ]);
        return redirect('mastersensor')->with('message','Data Berhasil Di Tambah !');
    }

    // <<< 2. ADD HARDWARE >>>
    public function FormTambahHardware()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        return view('formtambahhardware',compact('user','complete'));
    }

    public function createHardware(Request $request)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $query = Hardware::create([
            'hardware' => $request->hardware,
            'location' => $request->location,
            'timezone' => $request->timezone,
            'local_time' => $request->local_time,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_by' => $user->role,
        ]);
        return redirect('hardware')->with('message','Data Berhasil Di Tambah !');
    }

    // <<< 3. ADD HARDWARE DETAIL >>>
    public function FormTambahHardwareDetail()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        return view('formtambahhardwaredetail',compact('user','complete'));
    }

    public function createHardwareDetail(Request $request)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $query = HardwareDetail::create([
            'hardware' => $request->hardware,
            'sensor' => $request->sensor,
        ]);
        return redirect('hardwaredetail')->with('message','Data Berhasil Di Tambah !');
    }

    // <<< 4. ADD TRANSACTION >>>
    public function FormTambahTransaction()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        return view('formtambahtransaction',compact('user','complete'));
    }

    public function createTransaction(Request $request)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $query = Transaction::create([
            'hardware' => $request->hardware,
            'parameter' => $request->parameter,
            'created_by' => $request->created_by,
        ]);
        return redirect('transaction')->with('message','Data Berhasil Di Tambah !');
    }

    // <<< 5. ADD TRANSACTION DETAIL >>>
    public function FormTambahTransactionDetail()
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        return view('formtambahtransactiondetail',compact('user','complete'));
    }

    public function createTransactionDetail(Request $request)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $query = TransactionDetail::create([
            'trans_id' => $request->trans_id,
            'hardware' => $request->hardware,
            'sensor' => $request->sensor,
            'value' => $request->value,
        ]);
        return redirect('transactiondetail')->with('message','Data Berhasil Di Tambah !');
    }

    // <<<============ ++++++++++++++++++++++ ============>>>
    // <<<============   FUNGSI UPDATE DATA   ============>>>
    // <<<============ ++++++++++++++++++++++ ============>>>

    // <<< 1. UPDATE MASTER SENSOR >>>
    public function FormEditMasterSensor($id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = MasterSensor::findOrFail($id);
        return view('updatemastersensor',compact('user','complete','item'));
    }

    public function updateMasterSensor(Request $request,$id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = MasterSensor::where('id',$id)->update([
            'sensor' => $request->sensor,
            'sensor_name' => $request->sensor_name,
            'unit' => $request->unit,
            'created_by' => $user->role,
        ]);
        return redirect('mastersensor')->with('message','Data Berhasil Di Update !');
    }

    // <<< 2. UPDATE HARDWARE >>>
    public function FormEditHardware($id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = Hardware::findOrFail($id);
        return view('updatehardware',compact('user','complete','item'));
    }

    public function updateHardware(Request $request,$id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = Hardware::where('id',$id)->update([
            'hardware' => $request->hardware,
            'location' => $request->location,
            'timezone' => $request->timezone,
            'local_time' => $request->local_time,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_by' => $user->role,
        ]);
        return redirect('hardware')->with('message','Data Berhasil Di Update !');
    }

    // <<< 3. UPDATE HARDWARE DETAIL >>>
    public function FormEditHardwareDetail($id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = HardwareDetail::findOrFail($id);
        return view('updatehardwaredetail',compact('user','complete','item'));
    }

    public function updateHardwareDetail(Request $request,$id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = HardwareDetail::where('id',$id)->update([
            'hardware' => $request->hardware,
            'sensor' => $request->sensor,
        ]);
        return redirect('hardwaredetail')->with('message','Data Berhasil Di Update !');
    }

    // <<< 4. UPDATE TRANSACTION >>>
    public function FormEditTransaction($id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = Transaction::findOrFail($id);
        return view('updatetransaction',compact('user','complete','item'));
    }

    public function updateTransaction(Request $request,$id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = Transaction::where('id',$id)->update([
            'hardware' => $request->hardware,
            'parameter' => $request->parameter,
            'created_by' => $request->created_by,
        ]);
        return redirect('transaction')->with('message','Data Berhasil Di Update !');
    }

    // <<< 5. UPDATE TRANSACTION DETAIL >>>
    public function FormEditTransactionDetail($id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = TransactionDetail::findOrFail($id);
        return view('updatetransactiondetail',compact('user','complete','item'));
    }

    public function updateTransactionDetail(Request $request,$id)
    {
        // <-- Default --> 
        $user = Auth::user();
        $complete = UserData::where('id_user',$user->id)->get()->first();
        // <-- End Default -->

        $item = TransactionDetail::where('id',$id)->update([
            'trans_id' => $request->trans_id,
            'hardware' => $request->hardware,
            'sensor' => $request->sensor,
            'value' => $request->value,
        ]);
        return redirect('transactiondetail')->with('message','Data Berhasil Di Update !');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
