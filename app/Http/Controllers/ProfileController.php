<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //Detalhes do perfil
    public function show()
    {
        //Recupera informações do usuario logado
        $user = User::where('id', Auth::id())->first();
        //Carrega a view
        return view('profile.show', ['user' => $user]);
    }
}
