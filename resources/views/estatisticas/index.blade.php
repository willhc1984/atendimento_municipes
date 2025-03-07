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
                <form action="{{ route('estatisticas.index') }}">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="data_inicial">Data inicial:</label>
                            <input type="date" name="data_inicial" id="data_inicial" class="form-control" value="" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="data_final">Data final:</label>
                            <input type="date" name="data_final" id="data_final" class="form-control" value="" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="vereador" class="form-label">Vereador</label>
                            <select class="form-select" name="vereador">
                                <option selected></option>
                                @forelse($vereadores as $vereador)
                                    <option value="{{ $vereador->nome }}">{{ $vereador->nome }}</option>
                                @empty
                                @endforelse
                            </select>
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

        @if(isset($total))
            <p>Total de atendimentos:  {{ $total }} </p>
        @endif

    </div>
@endsection