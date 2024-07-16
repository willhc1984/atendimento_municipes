@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Vereador</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vereador.index') }}">Vereadores</a></li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span>
                    <a href="{{ route('vereador.index') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Listar</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('vereador.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}"
                            placeholder="Nome do vereador">
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
