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
    public function index()
    {
        $municipes = Municipe::orderBy('nome')->paginate(30);
        return view('municipes.index', [
            'municipes' => $municipes
        ]);
    }

    //Abrir formulario de cadastro de municipe
    public function create(){
        return view('municipes.create');
    }

    //Cadastrar municipe no banco de dados
    public function store(MunicipeRequest $request)
    {
        //Validação dos campos do formulario
        $request->validated();
        
        //Ponto inicial da transação
        DB::beginTransaction();

        try{
            //Cadastrar municipe no banco de dados
            $municipe = Municipe::create([
                'nome' => $request->nome,
                'documento' => $request->documento,
                'telefone' => $request->telefone,
                'bairro' => $request->bairro,
            ]);

            //Operação concluida com exito
            DB::commit();

            return redirect()->route('municipe.index')->with('success', 'Munícipe cadastrado com sucesso!');

        }catch(Exception $e){
            dd($e);
            //Operação não concluida com exito
            DB::rollBack();
            //Redireciona com meg de erro
            return back()->withInput()->with('error', 'Munícpe não foi cadastrado! Tente novamente.');
        }
    }
}
