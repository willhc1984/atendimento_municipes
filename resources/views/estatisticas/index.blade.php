@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Estatísticas</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Início</a></li>
                <li class="breadcrumb-item active">Estatísticas</li>
            </ol>
        </div>

        <x-alert />

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Pesquisar</span>
            </div>
            <div class="card-body">
                <form action="{{ route('estatisticas.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="data_inicial">Data inicial:</label>
                            <input type="date" name="data_inicial" id="data_inicial" class="form-control" value="{{ old('data_inicial') }}" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="data_final">Data final:</label>
                            <input type="date" name="data_final" id="data_final" class="form-control" value="{{ old('data_final') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-2 pt-2">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass">
                                </i> Pesquisar</button>
                            <a href="#" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-trash"></i>Limpar</a>
                        </div>
                    </div>
                </form>
            </div>                
        </div>

        <div class="card mb-4 border-light shadow">
            @if(isset($atendimentos) && $atendimentos)
            <div class="card-header space-between-elements">
                <span>Período de <b> {{ \Carbon\Carbon::parse($dataInicial)->tz('America/Sao_Paulo')->format('d/m/Y') }} 
                                a {{ \Carbon\Carbon::parse($dataFinal)->tz('America/Sao_Paulo')->format('d/m/Y') }} </b></span>
            </div>
            
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Vereador</th>
                            <th>Total de Atendimentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atendimentos as $atendimento)
                            <tr style="text-align: center;">
                                <td>{{ $atendimento->vereador }}</td>
                                <td>{{ $atendimento->total }}</td>
                            </tr>
                        @empty
                            <tr style="text-align: center;">
                                <td colspan="2" class="text-center">Nenhum atendimento encontrado para o período.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="alert alert-success" role="alert">
                    <p class="lead">Foram registrados <b>**{{ $totalPeriodo }}**</b> atendimentos no período de <b> {{ \Carbon\Carbon::parse($dataInicial)->tz('America/Sao_Paulo')->format('d/m/Y') }} 
                                a {{ \Carbon\Carbon::parse($dataFinal)->tz('America/Sao_Paulo')->format('d/m/Y') }}</p>
                    <p class="lead">Ocorreram <b>**{{ $desistenciasNoPeriodo }}**</b> desistências nesse período.</p>
                </div>
            </div>
            @elseif(isset($totalGeral))
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <p class="lead">Desde janeiro de 2025, foram registrados <b>**{{ $totalGeral }}**</b> atendimentos no total.</p>
                        <p class="lead">Ocorreram <b>**{{ $desistencia }}**</b> desistências.</p>
                    </div>
                </div>
            @endif
            
        </div>

    </div>
@endsection