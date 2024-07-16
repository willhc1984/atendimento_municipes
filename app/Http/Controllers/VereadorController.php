<?php

namespace App\Http\Controllers;

use App\Http\Requests\VereadorRequest;
use App\Models\Vereador;
use Exception;
use Illuminate\Http\Request;
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
            return redirect()->route('vereador.index', ['vereador' => $vereador->id]);

        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }

    }
}
