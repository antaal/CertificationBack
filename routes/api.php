<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\SecteurController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::resource('offres', OffreController::class);
Route::resource('projets', ProjetController::class);
Route::resource('quartiers',QuartierController::class);
Route::resource('regions', RegionController::class);
Route::resource('communes', CommuneController::class);
Route::resource('departements', DepartementController::class);
Route::resource('responsables',ResponsableController::class);
Route::resource('/secteurs', SecteurController::class)->middleware('auth:sanctum');