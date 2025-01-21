<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-usuarios', ['only' => ['index']]);
        $this->middleware('permission:show-usuarios', ['only' => ['show']]);
        $this->middleware('permission:create-usuarios', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-usuarios', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-usuarios', ['only' => ['destroy']]);
    }

    //Listar usuarios
    public function index()
    {
        //Recuperar registros do banco de dados
        $users = User::orderByDesc('created_at')->paginate(10);
        //Carrega a view
        return view('users.index', [
            'menu' => 'usuarios',
            'users' => $users
        ]);
    }

    //Cadastrar usuarios
    public function create()
    {
        //recupera as roles
        $roles = Role::pluck('name')->all();
        //Retorna a view de cadastro
        return view('users.create', [
            'menu' => 'usuarios',
            'roles' => $roles
        ]);
    }

    //Cadastra no banco de dados
    public function store(UserRequest $request)
    {
        //Validar formulario com request
        $request->validated();

        //Marca inicio da tansação
        DB::beginTransaction();

        try {
            //Cadastra no banco de dados
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            //Atribui papel ao usuário
            $user->assignRole($request->roles);

            //Operação concluida com exito
            DB::commit();

            //Redireciona usuario e envia mensagem de sucesso
            return redirect()->route('user.index', ['user' => $user->id])->with('success', 'Usuario cadastrado!');
        } catch (Exception $e) {
            //Operação nao concluida com exito
            DB::rollBack();

            //Redireciona usuario e envia mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado! Tente novamente.');
        }
    }

    //Formulario para editar usuario
    public function edit(User $user)
    {
        //Recupera od papeis do banco de dados
        $roles = Role::pluck('name')->all();

        //Recupera papeis do usuario
        $userRoles = $user->roles->pluck('name')->first();

        //Carrega a view
        return view('users.edit', [
            'menu' => 'usuarios',
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    //Salva edição do usuario
    public function update(UserRequest $request, User $user)
    {
        //Valida formulario
        $request->validated();

        //Inicia a transação
        DB::beginTransaction();

        try {
            //Editar as informação no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            //Editar o papel do usuario
            $user->syncRoles($request->roles);

            DB::commit();

            //Redirecionar usuario e enviar mensagem de sucesso
            return redirect()->route('user.index', ['user' => $request->user])->with('success', 'Usuário editado!');
        } catch (Exception $e) {
            //Operação nao concluida
            DB::rollBack();
            //Redireciona com mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado.');
        }
    }
}
