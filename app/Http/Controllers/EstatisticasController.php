<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtendimentoRequest;
use App\Http\Requests\EstatisticasRequest;
use App\Models\Atendimento;
use App\Models\Vereador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EstatisticasController extends Controller
{
    //Carrega a view de estatisticas
    public function index(EstatisticasRequest $request)
    {
        //dd(empty($request->input('data_inicial')) && empty($request->input('data_final')));

        //Se as datas não forem fornecidas, retorna total geral e finaliza
        if (empty($request->input('data_inicial')) && empty($request->input('data_final'))) {
            $totalGeral = Atendimento::where('status', 'like', 'Atendido')->count();
            $desistencia = Atendimento::where('status', 'like', 'Desistencia')->count();

            return view('estatisticas.index', [
                'totalGeral' => $totalGeral,
                'atendimentos' => null,
                'desistencia' => $desistencia
            ]);
        }

        //A validação é executada se pelo menos uma data for preenchida.
        $request->validated();

        $dataInicial = $request->input('data_inicial');
        $dataFinal = $request->input('data_final');

        $dataFinal = $dataFinal . ' 23:59:59';

        $atendimentosNoPerido = Atendimento::whereBetween('dataHora', [$dataInicial, $dataFinal])
            ->where('status', 'like', 'Atendido');

        $totalAtendimentosNoPeriodo = $atendimentosNoPerido->count();
        $desistenciasNoPeriodo = Atendimento::whereBetween('dataHora', [$dataInicial, $dataFinal])
            ->where('status', 'like', 'Desistencia')->count();

        $atendimentosPorVereador = Atendimento::where('status', 'Atendido')
            ->whereBetween('dataHora', [$dataInicial, $dataFinal])
            ->select('vereador', DB::raw('count(*) as total'))
            ->groupBy('vereador')
            ->orderByRaw('count(*) desc')
            ->get();

        return view('estatisticas.index', [
            'atendimentos' => $atendimentosPorVereador,
            'totalGeral' => null,
            'totalPeriodo' => $totalAtendimentosNoPeriodo,
            'dataInicial' => $dataInicial,
            'dataFinal' => $dataFinal,
            'desistenciasNoPeriodo' => $desistenciasNoPeriodo
        ]);
    }
}
