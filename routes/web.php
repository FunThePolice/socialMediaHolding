<?php

use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EntityController::class, 'index'])->name('index');
Route::get('/{model}', [EntityController::class, 'import'])->name('entity.import');
Route::post('/create', [EntityController::class, 'create'])->name('entity.create');
