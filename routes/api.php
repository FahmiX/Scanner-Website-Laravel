<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Staff Kasir
Route::post('/kasir/login', [UserAPI::class, 'kasirLogin']);
Route::post('/kasir/register', [UserAPI::class, 'kasirRegister']);
Route::post('/kasir/logout', [UserAPI::class, 'kasirLogout']);
Route::post('/kasir/qr', [UserAPI::class, 'transaksiKasir']);

// Staff Gudang
Route::post('/gudang/login', [UserAPI::class, 'gudangLogin']);
Route::post('/gudang/register', [UserAPI::class, 'gudangRegister']);
Route::post('/gudang/logout', [UserAPI::class, 'gudangLogout']);
