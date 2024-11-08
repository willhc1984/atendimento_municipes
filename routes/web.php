<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\MunicipeController;
use App\Http\Controllers\VereadorController;
use App\Models\Vereador;
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

//Municipes
Route::get('/index-municipes', [MunicipeController::class, 'index'])->name('municipe.index');
Route::get('/create-municipes', [MunicipeController::class, 'create'])->name('municipe.create');
Route::post('/store-municipes', [MunicipeController::class, 'store'])->name('municipe.store');
Route::get('/edit-municipes/{municipe}', [MunicipeController::class, 'edit'])->name('municipe.edit');
Route::put('/update-municipes/{municipe}', [MunicipeController::class, 'update'])->name('municipe.update');
Route::delete('/destroy-municipes/{municipe}', [MunicipeController::class, 'destroy'])->name('municipe.destroy');

//Vereadores
Route::get('/index-vereadores', [VereadorController::class, 'index'])->name('vereador.index');
Route::get('/create-vereadores', [VereadorController::class, 'create'])->name('vereador.create');
Route::post('/store-vereadores', [VereadorController::class, 'store'])->name('vereador.store');
Route::get('/edit-vereadores/{vereador}', [VereadorController::class, 'edit'])->name('vereador.edit');
Route::put('/update-vereadores/{vereador}', [VereadorController::class, 'update'])->name('vereador.update');
Route::delete('/destroy-vereadores/{vereador}', [VereadorController::class, 'destroy'])->name('vereador.destroy');

//Atendimentos
Route::get('/index-atendimentos', [AtendimentoController::class, 'all'])->name('atendimento.all');
Route::get('/index-atendimentos/{municipe}', [AtendimentoController::class, 'index'])->name('atendimento.index');
Route::get('/create-atendimentos/{municipe}', [AtendimentoController::class, 'create'])->name('atendimento.create');
Route::post('/store-atendimentos', [AtendimentoController::class, 'store'])->name('atendimento.store');
Route::get('/edit-atendimentos/{atendimento}', [AtendimentoController::class, 'edit'])->name('atendimento.edit');
Route::put('/update-atendimentos/{atendimento}', [AtendimentoController::class, 'update'])->name('atendimento.update');
Route::delete('/destroy-atendimentos/{atendimento}', [AtendimentoController::class, 'destroy'])->name('atendimento.destroy');