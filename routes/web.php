<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorklogController;
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


Route::get('/',[WorklogController::class,'index']);
Route::get('generate',[WorklogController::class,'genereteDummyData']);
Route::get('report',[WorklogController::class,'report']);