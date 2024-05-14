<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardFarmasiController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardFarmasiController::class, 'index'])->name('dashboard.farmasi');
Route::get('/dashboard/farmasi/{page}', [DashboardFarmasiController::class, 'showPage'])->name('dashboard.page');
Route::get('/farmasi', [DashboardFarmasiController::class, 'goToFarmasiView'])->name('farmasi.view');
Route::get('/adminFarmasi', [DashboardFarmasiController::class, 'adminFarmasi'])->name('adminFarmasi.view');
Route::get('/userFarmasi', [DashboardFarmasiController::class, 'userFarmasi'])->name('userFarmasi.view');

