<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipeRequest;
use App\Models\Municipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipeController extends Controller
{
    //Listar municipes
    public function index(Request $request)
    {
        //Recuperar registros no banco de dados conforme parametros do formulario de pesquisa
        $municipes = Municipe::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })

            ->orderBy('nome')
            ->paginate(60)
            ->withQueryString();

        // $municipes = Municipe::orderBy('nome')->paginate(30);
        return view('municipes.index', [
            'municipes' => $municipes,
            'nome' => $request->nome
        ]);
    }

    //Abrir formulario de cadastro de municipe
    public function create()
    {
        return view('municipes.create');
    }

    //Cadastrar municipe no banco de dados
    public function store(MunicipeRequest $request)
    {
        //Validação dos campos do formulario
        $request->validated();

        //Ponto inicial da transação
        DB::beginTransaction();

        try {
            //Cadastrar municipe no banco de dados
            $municipe = Municipe::create([
                'nome' => $request->nome,
                'documento' => $request->documento,
                'telefone' => $request->telefone,
                'bairro' => $request->bairro,
            ]);

            //Operação concluida com exito
            DB::commit();
            //Redireciona com mensagem de sucesso
            return redirect()->route('municipe.index')->with('success', 'Munícipe cadastrado com sucesso!');
        } catch (Exception $e) {
            //Operação não concluida com exito
            DB::rollBack();
            //Redireciona com meg de erro
            return back()->withInput()->with('error', 'Munícpe não foi cadastrado! Tente novamente.');
        }
    }

    //Abrir formulario para editar municipe
    public function edit(Municipe $municipe)
    {
        return view('municipes.edit', ['municipe' => $municipe]);
    }

    //Atualizar municipe
    public function update(MunicipeRequest $request, Municipe $municipe)
    {
        //Validar formulario
        $request->validated();

        //Ponto inicial da transação
        DB::beginTransaction();

        try {
            //Edita as informações do municipe
            $municipe->update([
                'nome' => $request->nome,
                'documento' => $request->documento,
                'telefone' => $request->telefone,
                'bairro' => $request->bairro,
            ]);

            DB::commit();

            //Redireciona co mensagem de sucesso
            return redirect()->route('municipe.index')->with('success', 'Munícipe editado com sucesso!');

        } catch (Exception $e) {
             //Operação não concluida com exito
             DB::rollBack();
             //Redireciona com msg de erro
             return back()->withInput()->with('error', 'Munícpe não foi cadastrado! Tente novamente.');
        }
    }

    //Excluir municipe
    public function destroy(Municipe $municipe){
        //Exclui registro
        try{
            $municipe->delete();
            return back()->withInput()->with('success', 'Cadastro excluido!');
        }catch(Exception $e){
            //Redireciona usuario com mensagem de erro
            return redirect()->route('municipe.index')->with('error', 'Cadastro não excluido! Pode ser que exista registros de atendimentos para o munícipe. Exclua os atendimentos e tente novamente.');
        }

    }
}
