<?php

namespace App\Http\Controllers;

use App\Http\Requests\VereadorRequest;
use App\Models\Vereador;
use Exception;
use Illuminate\Support\Facades\DB;

class VereadorController extends Controller
{
    //Listar vereadores
    public function index(){
        $vereadores = Vereador::orderBy('nome')->paginate(15);
        return view('vereadores.index', ['vereadores' => $vereadores]);
    }

    //Abrir formulario de cadastro de vereador
    public function create()
    {
        return view('vereadores.create');
    }

    //Salva vereador no banco de dados
    public function store(VereadorRequest $request){
        //Validação dos dados do formulario
        $request->validated();
        
        //Marca inicio da transação
        DB::beginTransaction();

        try{
            //Cadastra no banco de dados
            $vereador = Vereador::create([
                'nome' => $request->nome
            ]);

            //Operação concluida com exito
            DB::commit();
            //Redireciona com mensagem de sucesso
            return redirect()->route('vereador.index')->with('success', 'Vereador cadastrado!');

        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    //Formulario para editar vereadores
    public function edit(Vereador $vereador){
        //Retorna a view para editar
        return view('vereadores.edit', ['vereador' => $vereador]);
    }

    //Atualiza cadastro de vereador
    public function update(VereadorRequest $request, Vereador $vereador){
        //Valida dados do formulário
        $request->validated();

        //Inicia da trasação
        DB::beginTransaction();

        try{
            $vereador->update([
                'nome' => $request->nome
            ]);

            //Operação concluida com exito
            DB::commit();
            //Redireciona com mensagem de sucesso
            return redirect()->route('vereador.index')->with('success', 'Cadastro atualizado!');

        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            //Redireciona com mensagem de erro
            return back()->withInput()->with('error', 'Cadastro não atualizado!. Tente novamente.');
        }
    }

    //Exclui cadastro de vereador
    public function destroy(Vereador $vereador){
        try{
            $vereador->delete();
            //Redireciona com mensagem de sucesso
            return redirect()->route('vereador.index')->with('success', 'Cadastro excluído!');
        }catch(Exception $e){
            //Redireciona com mensagem de erro
            return redirect()->route('vereador.index')->with('error', 'Cadastro não foi excluído. Tente novamente.');
        }
    }
}
