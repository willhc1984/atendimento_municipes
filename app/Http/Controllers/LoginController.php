<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Carrega a view de login
    public function index()
    {
        return view('login.index');
    }

    //Faz verificação de ususario e senha
    public function loginProcess(LoginRequest $request)
    {
        //Validar dados do formulario
        $request->validated();

        //Validar usuario e senha com informações do banco de dados
        $authenticated = Auth::attempt(['name' => $request->name, 'password' => $request->password]);

        //Verificar se o usuario foi autenticado
        if (!$authenticated) {
            //Redireciona com msg de erro
            return back()->withInput()->with('error', 'Credenciais inválidas!');
        }

        return redirect()->route('atendimento.home');
    }

    //Logout de usuario
    public function destroy()
    {
        Auth::logout();        
        //redireciona usuario
        return redirect()->route('login.index')->with('success', 'Você saiu do sistema.');
    }
}
