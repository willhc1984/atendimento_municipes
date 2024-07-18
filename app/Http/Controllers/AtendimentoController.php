<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtendimentoRequest;
use App\Models\Atendimento;
use App\Models\Municipe;
use App\Models\Vereador;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    //Listar atendimentos do municipe
    public function index(Municipe $municipe){
        //Busca atendimentos do municipe no banco de dados
        $atendimentos = Atendimento::with('municipe')
            ->where('municipe_id', $municipe->id)
            ->orderBy('dataHora')
            ->paginate(10);
    
        //Carrega a view
        return view('atendimentos.index', [
            'municipe' => $municipe,
            'atendimentos' => $atendimentos
        ]);
    }

    //Abrir formulario para registrar atendimento
    public function create(Municipe $municipe){
        $vereadores = Vereador::orderBy('nome')->get();
        return view('atendimentos.create', [
            'municipe' => $municipe,
            'vereadores' => $vereadores
        ]);
    }

    //Cadastrar atendimento ao municipe
    public function store(AtendimentoRequest $request){
        //Validar o formulario de atendimento ao municipe
        $request->validated();
        dd("OK");
    }
}
