<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Municipe;

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
}
