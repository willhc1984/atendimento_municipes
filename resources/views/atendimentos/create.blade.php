@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Munícipe</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('municipe.index') }}">Munícipes</a></li>
                <li class="breadcrumb-item active">Registrar atendimento</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Registrar atendimento - <b>{{ $municipe->nome }}</b></span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('atendimento.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    {{-- <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="dataHora">Data:</label>
                        <input type="date" name="data" id="data" name="data"
                            class="form-control" value="{{ date('Y-m-d') }}" placeholder="Data">
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="dataHora">Data/Hora:</label>
                            <input type="datetime-local" name="dataHora" id="hora" name="dataHora" class="form-control"
                                value="{{ date('Y-m-d H:i:s') }}" placeholder="dataHora">
                        </div>
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
                    <div class="col-md-6 col-sm-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option selected></option>
                            <option value="atendido">Atendido</option>
                            <option value="aguardando">Aguardando</option>
                            <option value="desistencia">Desistencia</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
@endsection
