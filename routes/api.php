<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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

Route::get('user/', [UserController::class, 'ListUser'])->name('user');

//Route::controller(AuthController::class)->group(function() {
//    Route::post('/signup', 'signup');
//    Route::post('/login', 'login');
//    Route::post('/login/{provider}', 'authSocial');
//
//    Route::middleware('auth:sanctum')->group(function () {
//        Route::post('/logout', 'logout');
//    });
//$user->createToken(config('app.name'))->plainTextToken
//});

