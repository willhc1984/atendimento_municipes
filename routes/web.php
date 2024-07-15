<?php

use App\Http\Controllers\MunicipeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index-municipes', [MunicipeController::class, 'index'])->name('municipe.index');
Route::get('/create-municipes', [MunicipeController::class, 'create'])->name('municipe.create');
Route::post('/store-municipes', [MunicipeController::class, 'store'])->name('municipe.store');
Route::get('/edit-municipes/{municipe}', [MunicipeController::class, 'edit'])->name('municipe.edit');
Route::put('/edit-municipes/{municipe}', [MunicipeController::class, 'update'])->name('municipe.update');
Route::delete('/destroy-municipes/{municipe}', [MunicipeController::class, 'destroy'])->name('municipe.destroy');