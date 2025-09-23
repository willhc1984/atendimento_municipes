<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Vereador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstatisticasController extends Controller
{
    //Carrega a view de estatisticas
    public function index(Request $request)
    {

        //Verifica se data inicial e final foram fornecidas
        $request->validate([
            'data_inicial' => 'required_with:data_final',
            'data_final' => 'required_with:data_inicial'
        ], [
            'data_inicial.required_with' => 'Forneça data inicial e final!',
            'data_final.required_with' => 'Forneça data inicial e final!'
        ]);

        //Recupera o intervalo de datas
        $data_inicial = $request->input('data_inicial');
        $data_final = $request->input('data_final');

        $totalAtendimentos = Atendimento::count();
        $desistencia = Atendimento::where('status', 'LIKE', '%Desistencia%');

        //Se não foi fornecido as datas
        if (empty($data_inicial) || empty($data_final)) {
            return view('estatisticas.index', [
                'totalGeral' => $totalAtendimentos,
                'atendimentos' => null, //Define como nulo para a view saber que não deve exibir a tabela de detalhes
                'desistencia' => $desistencia->count()
            ]);
        }

        //Se forem fornecidas, retorna contagem por vereador
        $data_final = $data_final . ' 23:59:59';

        $atendimentosNoPeriodo = Atendimento::whereBetween('dataHora', [$data_inicial, $data_final])
            ->where('status', '!=', 'Desistencia')
            ->where('status', '!=', 'Aguardando');

        $atendimentos = Atendimento::select('vereador', DB::raw('count(*) as total'))
            ->whereBetween('dataHora', [$data_inicial, $data_final])
            ->groupBy('vereador')
            ->orderBy('total', 'desc')
            ->get();

        $totalAtendimentosNoPeriodo = $atendimentosNoPeriodo->count();

        return view('estatisticas.index', [
            'atendimentos' => $atendimentos,
            'dataInicial' => $data_inicial,
            'dataFinal' => $data_final,
            'totalPeriodo' => $totalAtendimentosNoPeriodo,
            'desistencia' => $desistencia
        ]);
    }
}
