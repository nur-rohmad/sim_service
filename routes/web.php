<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardConroller;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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
// route login / logout
Route::get('/', function () {
    return view('auth/login');
})->name('login')->middleware('guest');
Route::post('actionlogin', [loginController::class, 'proceslogin'])->name('proses_login');
Route::get('/logouth', [loginController::class, 'logouth']);
// route Dashboard
Route::get('/dashboard', [DashboardConroller::class, 'index'])->middleware('auth');
// route service
Route::resource('service', ServiceController::class);
Route::post('/tambahJasa', [ServiceController::class, 'tambahJasa'])->middleware('auth');
Route::post('/hapusJasa', [ServiceController::class, 'hapusJasa'])->middleware('auth');
Route::get('/cetak-invoice/{id}', [ServiceController::class, 'cetakInvoice'])->middleware('auth');
// route Profile
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth');
Route::post('/updateProfileImage', [ProfileController::class, 'updateImageProfile'])->middleware('auth');
// route barang
Route::resource('barang', BarangController::class)->middleware('auth');
Route::post('/getBarang', [BarangController::class, 'getBarang'])->middleware('auth');
// route dashboard
Route::post('/getGrafikBarang', [DashboardConroller::class, 'getGrafikBarang'])->middleware('auth');
// report route
Route::get('/report', [ReportController::class, 'index'])->middleware('auth');
// fileter route
Route::post('/searchReport', [ReportController::class, 'filterhReport'])->middleware('auth');
// get all data report
Route::get('/getAllReport', [ReportController::class, 'getReportData'])->middleware('auth');
