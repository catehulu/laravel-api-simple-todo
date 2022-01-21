<?php

use App\Http\Controllers\TaskController;
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

Route::prefix('task')->group( function() {
    Route::get('/',[TaskController::class, 'index']);
    Route::post('/create',[TaskController::class, 'create']);
    Route::put('/update',[TaskController::class, 'update']);
    Route::delete('/delete',[TaskController::class, 'delete']);
    Route::get('/unfinished',[TaskController::class, 'viewUnfinished']);
    Route::get('/priority',[TaskController::class, 'viewPriority']);
    Route::get('/group',[TaskController::class, 'viewGroup']);
});