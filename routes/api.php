<?php

use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\ResponsableController;
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
Route::resource('offres', OffreController::class);
Route::resource('projets', ProjetController::class);
Route::resource('quartiers',QuartierController::class);
Route::resource('regions', RegionController::class);
Route::resource('communes', CommuneController::class);
Route::resource('departements', DepartementController::class);
Route::resource('responsables',ResponsableController::class);
Route::resource('secteurs', secteursController::class);