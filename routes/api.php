<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TravelController::class)->prefix('travels')->group(function () {
    Route::get('/', 'index')->name('travels.index');
    Route::post('/', 'store')->name('travels.store')->middleware(['auth:sanctum', "role:" . RoleEnum::ADMIN->value. "|" . RoleEnum::SUPER_ADMIN->value]);
    Route::put('/{travel}/update','update')->name('travels.update')->middleware(['auth:sanctum', "role:" . RoleEnum::EDITOR->value."|".RoleEnum::SUPER_ADMIN->value]);
});

Route::controller(TourController::class)->group(function () {
    Route::get('/travels/{travel:slug}/tours', 'index')->name('travels-tours.index');
    Route::post('{travel}/tours', 'store')->name('travels-tours.store')->middleware(['auth:sanctum', "role:" . RoleEnum::ADMIN->value. "|" . RoleEnum::SUPER_ADMIN->value]);
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
});
