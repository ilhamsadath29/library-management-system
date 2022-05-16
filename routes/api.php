<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RackLocationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteUserController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/setting', SettingController::class)->middleware('super_admin');
    Route::resource('{site_id}/site-user', SiteUserController::class)->middleware('super_admin', 'check_site_exist');

    Route::resource('/rack', RackLocationController::class, ['only' => ['index']]);
    Route::resource('/author', AuthorController::class, ['only' => ['index']]);
    Route::resource('/category', CategoryController::class, ['only' => ['index']]);

    Route::group(['middleware' => 'admin'], function() {
        Route::resource('/rack', RackLocationController::class, ['except' => ['index']]);
        Route::resource('/author', AuthorController::class, ['except' => ['index']]);
        Route::resource('/category', CategoryController::class, ['except' => ['index']]);
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);