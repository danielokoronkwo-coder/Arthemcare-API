<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\PatientController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function() {

    Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
        Route::post('register-as-doctor', [AuthController::class, 'registerAsDoctor']);
        Route::post('register-as-nurse', [AuthController::class, 'registerAsNurse']);
        Route::post('register-as-staff', [AuthController::class, 'registerAsStaff']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('profile',[AuthController::class, 'profile']);
        Route::get('create-roles',[AuthController::class, 'createRoles']);
    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'patients'], function() {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'store']);
        Route::get('/{patient}', [PatientController::class, 'show']);
        Route::put('/{patient}', [PatientController::class, 'update']);
        Route::delete('/{patient}', [PatientController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'nextofkin'], function() {
        Route::get('/', [NextOfKinController::class, 'index']);
        Route::post('/', [NextOfKinController::class, 'store']);
        Route::get('/{nextofkin}', [NextOfKinController::class, 'show']);
        Route::put('/{nextofkin}', [NextOfKinController::class, 'update']);
        Route::delete('/{nextofkin}', [NextOfKinController::class, 'destroy']);
    });
});

