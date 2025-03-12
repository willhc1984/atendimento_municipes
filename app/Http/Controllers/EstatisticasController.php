<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Vereador;
use Illuminate\Http\Request;

class EstatisticasController extends Controller
{
    //Carrega a view de estatisticas
    public function index(Request $request)
    {
        //Busca vereadores
        $vereadores = Vereador::orderBy('nome')->get();

        $atendimentos = Atendimento::query();

        dd($atendimentos);

        //Conta registros filtrados
        $total = $atendimentos->count();

        return view('estatisticas.index', [
            'total' => $total,
            'vereadores' => $vereadores,
        ]);
    }
}
