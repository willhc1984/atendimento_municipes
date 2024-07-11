@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Curso</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('municipe.index') }}">Munícipes</a></li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span>
                    <a href="{{ route('municipe.index') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Listar</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('municipe.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}"
                            placeholder="Nome do munícipe">
                    </div>
                    <div class="col-12">
                        <label for="documento" class="form-label">Documento:</label>
                        <input type="text" class="form-control" name="documento" id="documento"
                            value="{{ old('documento') }}" placeholder="Documento do munícipe">
                    </div>
                    <div class="col-12">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone"
                            value="{{ old('telefone') }}" placeholder="Telefone do munícipe">
                    </div>
                    <div class="col-12">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" value="{{ old('bairro') }}"
                            placeholder="Bairro do munícipe">
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
