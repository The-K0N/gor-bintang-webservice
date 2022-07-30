<?php

use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\BokingController;
use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// tidak perlu login dengan barear access token untuk mengakses :
Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {

    // untuk tabel members
    Route::get('member', [MemberController::class, 'index']);
    Route::get('member/{id}', [MemberController::class, 'show']);

    // untuk tabel bokings
    Route::get('boking', [BokingController::class, 'index']);
    Route::get('boking/{id}', [BokingController::class, 'show']);

    // untuk tabel pakets
    Route::get('paket', [PaketController::class, 'index']);
    Route::get('paket/{id}', [PaketController::class, 'show']);

    // // untuk tabel members
    // Route::get('member', [MemberController::class, 'index']);
    // Route::get('member/{id}', [MemberController::class, 'show']);

    // Route::post('member', [MemberController::class, 'store']);
    // Route::put('member/{id}', [MemberController::class, 'update']);
    // Route::delete('member/{id}', [MemberController::class, 'destroy']);


    // // untuk tabel bokings
    // Route::get('boking', [BokingController::class, 'index']);
    // Route::get('boking/{id}', [BokingController::class, 'show']);

    // Route::post('boking', [BokingController::class, 'store']);
    // Route::put('boking/{id}', [BokingController::class, 'update']);
    // Route::delete('boking/{id}', [BokingController::class, 'destroy']);


    // // untuk tabel pakets
    // Route::get('paket', [PaketController::class, 'index']);
    // Route::get('paket/{id}', [PaketController::class, 'show']);

    // Route::post('paket', [PaketController::class, 'store']);
    // Route::put('paket/{id}', [PaketController::class, 'update']);
    // Route::delete('paket/{id}', [PaketController::class, 'destroy']);

});

// setelah login dengan barear access token
Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function ($router) {

    // CRUD untuk tabel members
    Route::post('member', [MemberController::class, 'store']);
    Route::put('member/{id}', [MemberController::class, 'update']);
    Route::delete('member/{id}', [MemberController::class, 'destroy']);

    // CRUD untuk tabel bokings
    Route::post('boking', [BokingController::class, 'store']);
    Route::put('boking/{id}', [BokingController::class, 'update']);
    Route::delete('boking/{id}', [BokingController::class, 'destroy']);

    // CRUD untuk tabel pakets
    Route::post('paket', [PaketController::class, 'store']);
    Route::put('paket/{id}', [PaketController::class, 'update']);
    Route::delete('paket/{id}', [PaketController::class, 'destroy']);



    //tes relasi antar tabel
    Route::get('paketR', [PaketController::class, 'indexRelasi']);

    //tes relasi antar tabel
    Route::get('bokingR', [BokingController::class, 'indexRelasi']);

    // tes relasi antar tabel
    Route::get('memberR', [MemberController::class, 'indexRelasi']);

});

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('password', function () {
        return bcrypt('Test1234');
    });
});
