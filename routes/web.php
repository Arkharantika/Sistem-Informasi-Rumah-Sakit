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

// -> Untuk CLaim Positif Covid 19
Route::get('/user/claimcovid', [ClaimController::class, 'index']);
Route::post('/user/claimcovid', [ClaimController::class, 'store'])->name('store');
Route::patch('/user/claimcovid/{id}', [ClaimController::class, 'update'])->name('update');

// -> Untuk Gejala Covid
Route::get('/user/gejalacovid', [GejalaController::class, 'index']);
Route::post('/user/gejalacovid', [GejalaController::class, 'store'])->name('store');
Route::patch('/user/gejalacovid/{id}', [GejalaController::class, 'update'])->name('update');

// -> Untuk Claim Vaksin
Route::get('/user/claimvaksin', [ClaimVaksinController::class, 'index']);
Route::post('/user/claimvaksin', [ClaimVaksinController::class, 'store'])->name('store');
Route::patch('/user/claimvaksin/{id}', [ClaimVaksinController::class, 'update'])->name('update');

// -> Untuk Isolasi Mandiri
Route::get('/user/isolasimandiri', [IsolasiController::class, 'index']);
Route::post('/user/isolasimandiri', [IsolasiController::class, 'store'])->name('store');
Route::patch('/user/isolasimandiri/{id}', [IsolasiController::class, 'update'])->name('update');


// -> Untuk Bantuan Covid
Route::get('/user/askbantuan', [AdministrationController::class, 'askbantuan'])->name('askbantuan');

// +---------------------------------------------------------------------------------------+ //
//                                   <<< Admin Role >>>
// +---------------------------------------------------------------------------------------+ //

// -> Untuk Data Administtasi User
Route::get('/admin/useradministration', [AdministrationController::class, 'index']);
Route::get('/admin/deletepersonal/{id}', [AdministrationController::class, 'deletePersonal'])->name('deletePersonal');
Route::get('/admin/datapersonal/{id}', [DataPersonalController::class, 'show'])->name('show');
Route::patch('/admin/datapersonal/{id}', [DataPersonalController::class, 'update'])->name('update');
Route::get('/admin/updaterole/{id}', [AdministrationController::class, 'updaterole'])->name('updatedrole');

// -> Untuk Data Covid
Route::get('/admin/datapositifcovid', [DataCovidController::class, 'index']);
Route::get('/admin/downloadcovid/{id}', [DataCovidController::class, 'downloadcovid'])->name('downloadcovid');
Route::get('/admin/downloadswabpcr/{id}', [DataCovidController::class, 'downloadswabpcr'])->name('downloadswabpcr');
Route::post('/admin/updatecovid/{id}', [DataCovidController::class, 'updatecovid'])->name('updatecovid');

// -> Untuk Data Vaksin
Route::get('/admin/datavaksin', [DataVaksinController::class, 'index']);

// -> Untuk Data Gejala Covid
Route::get('/admin/datagejala', [DataGejalaController::class, 'index']);

// -> Untuk Data Gejala Covid
Route::get('/admin/dataisolasi', [DataIsolasiController::class, 'index']);
Route::get('/admin/dataisolasiterpusat', [DataIsolasiController::class, 'isomanTerpusat'])->name('isomanTerpusat');



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


// -> Untuk Profile
Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
Route::post('/editinformasi', [HomeController::class, 'editinfo'])->name('editinfo');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/datacovidoverall', [HomeController::class, 'dataoverall'])->name('dataoverall');

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