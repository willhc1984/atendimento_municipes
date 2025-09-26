<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\EstatisticasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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



//Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');


Route::group(['middleware' => 'auth'], function () {

    //Pagina inicial
    Route::get('/', [AtendimentoController::class, 'home'])->name('atendimento.home');

    //Logout
    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

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

    //Usuários
    Route::get('/index-usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //Perfil
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profile-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/update-profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    //Estatisticas
    Route::get('/estatisticas', [EstatisticasController::class, 'index'])->name('estatisticas.index');
});
