<?php

use App\Http\Controllers\StaffKasirController;
use App\Http\Controllers\StaffGudangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Staff Kasir Login & Register
Route::get('/kasir/login', [UserController::class, 'KasirLoginForm'])->name('kasir.login');
Route::post('/kasir/login', [UserController::class, 'KasirLogin'])->name('kasir.login.submit');
Route::get('/kasir/register', [UserController::class, 'KasirRegistrationForm'])->name('kasir.register');
Route::post('/kasir/register', [UserController::class, 'KasirRegister'])->name('kasir.register.submit');
Route::get('/kasir/logout', [UserController::class, 'KasirLogout'])->name('kasir.logout');

// Staff Gudang Login & Register
Route::get('/gudang/login', [UserController::class, 'GudangLoginForm'])->name('gudang.login');
Route::post('/gudang/login', [UserController::class, 'GudangLogin'])->name('gudang.login.submit');
Route::get('/gudang/register', [UserController::class, 'GudangRegistrationForm'])->name('gudang.register');
Route::post('/gudang/register', [UserController::class, 'GudangRegister'])->name('gudang.register.submit');
Route::get('/gudang/logout', [UserController::class, 'GudangLogout'])->name('gudang.logout');

// Staff Kasir Content
Route::prefix('gudang')->name('gudang.')->group(function () {
    Route::get('/', [StaffGudangController::class, 'index'])->name('index');
    Route::get('/barang/display', [StaffGudangController::class, 'displayBarang'])->name('barang_display');
    Route::get('/barang/detail/{id}', [StaffGudangController::class, 'detailBarang'])->name('barang_detail');
    Route::get('/barang/create', [StaffGudangController::class, 'createBarang'])->name('barang_create');
    Route::post('/barang/create', [StaffGudangController::class, 'storeBarang'])->name('barang_store');
    Route::get('/barang/edit/{id}', [StaffGudangController::class, 'editBarang'])->name('barang_edit');
    Route::put('/barang/edit/{id}', [StaffGudangController::class, 'updateBarang'])->name('barang_update');
    Route::get('/barang/delete/{id}', [StaffGudangController::class, 'deleteBarang'])->name('barang_delete');
});

// Staff Gudang Content
Route::prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/', [StaffKasirController::class, 'index'])->name('index');
});
