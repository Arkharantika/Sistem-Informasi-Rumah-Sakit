<?php

// -> All User
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\RoleUserController;

// -> Data Administrasi (khusus Admin)
use App\Http\Controllers\AdministrationController;


// -> Untuk Data User
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\DataPersonalController;

// -> Untuk User Covid 
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ClaimVaksinController;
use App\Http\Controllers\IsolasiController;
use App\Http\Controllers\GejalaController;

// -> Untuk Admin Covid
use App\Http\Controllers\DataCovidController;
use App\Http\Controllers\DataGejalaController;
use App\Http\Controllers\DataVaksinController;
use App\Http\Controllers\DataIsolasiController;

// Imort Data Covid
use App\Http\Controllers\ImportController;

// Controller Tatonas
use App\Http\Controllers\SensorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Auth::routes();

Route::middleware(['auth'])->group(function () {
 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [RoleAdminController::class, 'index']);
    });
 
    Route::middleware(['user'])->group(function () {
        Route::get('user', [RoleUserController::class, 'index']);
        Route::get('/user/claimpositif', [ClaimController::class, 'index']);
    });
 
    Route::get('/logout', function() {
        Auth::logout();
        return redirect()->route('login');
    });
 
});

// +---------------------------------------------------------------------------------------+ //
//                                   <<< User Role >>>
// +---------------------------------------------------------------------------------------+ //

// -> Untuk Update Data User
Route::patch('/userdata/{id}', [UserDataController::class, 'update'])->name('update');

// +---------------------------------------------------------------------------------------+ //
//                                   <<< Admin Role >>>
// +---------------------------------------------------------------------------------------+ //

// -> Untuk Data Administtasi User
Route::get('/admin/useradministration', [AdministrationController::class, 'index']);
Route::get('/admin/deletepersonal/{id}', [AdministrationController::class, 'deletePersonal'])->name('deletePersonal');
Route::get('/admin/datapersonal/{id}', [DataPersonalController::class, 'show'])->name('show');
Route::patch('/admin/datapersonal/{id}', [DataPersonalController::class, 'update'])->name('update');
Route::get('/admin/updaterole/{id}', [AdministrationController::class, 'updaterole'])->name('updatedrole');


// +---------------------------------------------------------------------------------------+ //
//                                   <<< In Charge Person Routes >>>
// +---------------------------------------------------------------------------------------+ //

// -> Untuk Check Data Pasien
Route::get('/datapersonalcovid/{id}', [DataPersonalController::class, 'showCovid'])->name('showCovid');

Route::get('/datapersonalvaksin/{id}', [DataPersonalController::class, 'showVaksin'])->name('showVaksin');

Route::get('/datapersonalgejala/{id}', [DataPersonalController::class, 'showGejala'])->name('showGejala');
Route::get('/datapersonalisolasi/{id}', [DataPersonalController::class, 'showIsolasi'])->name('showIsolasi');
Route::get('/datapersonalisolasiterpusat/{id}', [DataPersonalController::class, 'showIsolasiTerpusat'])->name('showIsolasiTerpusat');
Route::get('/datapersonalisolasirslainnya/{id}', [DataPersonalController::class, 'showIsolasiRSLainnya'])->name('showIsolasiRSLainnya');

Route::get('/verifikasicovid/{id}', [DataPersonalController::class, 'verifikasiCovid'])->name('verifikasiCovid');
Route::get('/verifikasivaksin/{id}', [DataPersonalController::class, 'verifikasiVaksin'])->name('verifikasiVaksin');

Route::get('/deletevaksin/{id}', [DataPersonalController::class, 'deleteVaksin'])->name('deleteVaksin');
Route::get('/deletecovid/{id}', [DataPersonalController::class, 'deleteCovid'])->name('deleteCovid');


// +---------------------------------------------------------------------------------------+ //
//                                   <<< All Role Routes >>>
// +---------------------------------------------------------------------------------------+ //

Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

// -> Emergency / Experiment Routes
Route::get('/chart', [HomeController::class, 'chart'])->name('chart');
Route::get('/dataloop', [HomeController::class, 'dataloop'])->name('dataloop');

// -> Import Data from Excel
Route::post('/datapositifcovid/import_excel',[ImportController::class,'import_excel'])->name('importCovid');
Route::post('/datauser/import_excel',[ImportController::class,'import_user'])->name('importUser');

// -> Fallback System
Route::get('fallback',function(){
    Artisan::call('migrate:rollback');
});


// +---------------------------------------------------------------------------------------+ //
//                                   <<< TATONAS TEST ROUTES >>>
// +---------------------------------------------------------------------------------------+ //

//  <--- INDEX --->
Route::get('/findsensor', [HomeController::class, 'indexFindSensor'])->name('indexFindSensor');
Route::get('/mastersensor', [SensorController::class, 'indexMasterSensor'])->name('indexMasterSensor');
Route::get('/hardware', [SensorController::class, 'indexHardware'])->name('indexHardware');
Route::get('/hardwaredetail', [SensorController::class, 'indexHardwareDetail'])->name('indexHardwareDetail');
Route::get('/transaction', [SensorController::class, 'indexTransaction'])->name('indexTransaction');
Route::get('/transactiondetail', [SensorController::class, 'indexTransactionDetail'])->name('indexTransactionDetail');

//  <--- DELETES --->
Route::get('/softdeletemastersensor/{id}', [SensorController::class, 'SoftDeleteMasterSensor'])->name('SoftDeleteMasterSensor');
Route::get('/deletemastersensor/{id}', [SensorController::class, 'DeleteMasterSensor'])->name('DeleteMasterSensor');

Route::get('/softdeletehardware/{id}', [SensorController::class, 'SoftDeleteHardware'])->name('SoftDeleteHardware');
Route::get('/deletehardware/{id}', [SensorController::class, 'DeleteHardware'])->name('DeleteHardware');

Route::get('/softdeletehardwaredetail/{id}', [SensorController::class, 'SoftDeleteHardwareDetail'])->name('SoftDeleteHardwareDetail');
Route::get('/deletehardwaredetail/{id}', [SensorController::class, 'DeleteHardwareDetail'])->name('DeleteHardwareDetail');

Route::get('/softdeletetransaction/{id}', [SensorController::class, 'SoftDeleteTransaction'])->name('SoftDeleteTransaction');
Route::get('/deletetransaction/{id}', [SensorController::class, 'DeleteTransaction'])->name('DeleteTransaction');

Route::get('/softdeletetransactiondetail/{id}', [SensorController::class, 'SoftDeleteTransactionDetail'])->name('SoftDeleteTransactionDetail');
Route::get('/deletetransactiondetail/{id}', [SensorController::class, 'DeleteTransactionDetail'])->name('DeleteTransactionDetail');

//  <--- ADD DATA --->
Route::get('/mastersensor/tambahdata', [SensorController::class, 'FormTambahMasterSensor'])->name('FormTambahMasterSensor');
Route::post('/mastersensor/createdata', [SensorController::class, 'createMasterSensor'])->name('createMasterSensor');

Route::get('/hardware/tambahdata', [SensorController::class, 'FormTambahHardware'])->name('FormTambahHardware');
Route::post('/hardware/createdata', [SensorController::class, 'createHardware'])->name('createHardware');

Route::get('/hardwaredetail/tambahdata', [SensorController::class, 'FormTambahHardwareDetail'])->name('FormTambahHardwareDetail');
Route::post('/hardwaredetail/createdata', [SensorController::class, 'createHardwareDetail'])->name('createHardwareDetail');

Route::get('/transaction/tambahdata', [SensorController::class, 'FormTambahTransaction'])->name('FormTambahTransaction');
Route::post('/transaction/createdata', [SensorController::class, 'createTransaction'])->name('createTransaction');

Route::get('/transactiondetail/tambahdata', [SensorController::class, 'FormTambahTransactionDetail'])->name('FormTambahTransactionDetail');
Route::post('/transactiondetail/createdata', [SensorController::class, 'createTransactionDetail'])->name('createTransactionDetail');

//  <--- UPDATE --->
Route::get('/editmastersensor/{id}', [SensorController::class, 'FormEditMasterSensor'])->name('FormEditMasterSensor');
Route::patch('/editmastersensor/{id}', [SensorController::class, 'updateMasterSensor'])->name('updateMasterSensor');

Route::get('/edithardware/{id}', [SensorController::class, 'FormEditHardware'])->name('FormEditHardware');
Route::patch('/edithardware/{id}', [SensorController::class, 'updateHardware'])->name('updateHardware');

Route::get('/edithardwaredetail/{id}', [SensorController::class, 'FormEditHardwareDetail'])->name('FormEditHardwareDetail');
Route::patch('/edithardwaredetail/{id}', [SensorController::class, 'updateHardwareDetail'])->name('updateHardwareDetail');

Route::get('/edittransaction/{id}', [SensorController::class, 'FormEditTransaction'])->name('FormEditTransaction');
Route::patch('/edittransaction/{id}', [SensorController::class, 'updateTransaction'])->name('updateTransaction');

Route::get('/edittransactiondetail/{id}', [SensorController::class, 'FormEditTransactionDetail'])->name('FormEditTransactionDetail');
Route::patch('/edittransactiondetail/{id}', [SensorController::class, 'updateTransactionDetail'])->name('updateTransactionDetail');

//  <--- LOAD DATA ---> 
Route::post('/loaddata', [HomeController::class, 'LoadData'])->name('LoadData');