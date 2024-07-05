@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb1 space-between-elements">
        <h2 class="mt-3">Munícipes</h2>
        <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
            <li class="breadcrumb-item active">Munícipes</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Listar</span>
            <span>
                <a href="#" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
            </span>
        </div>

        <div class="card-body">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($municipes as $municipe)
                        <tr>
                            <th scope="row">{{ $municipe->id }}</th>
                            <td>{{ $municipe->nome }}</td>
                            <td>{{ $municipe->documento }}</td>
                            <td>{{ $municipe->telefone }}</td>
                            <td>{{ $municipe->bairro }}</td>
                            <td class="d-md-flex justify-content-center">

                                <a href="#" class="btn btn-info btn-sm me-1 mb-1">
                                    <i class="fa-solid fa-list-check"></i> Atendimentos</a>

                                <a href="#" class="btn btn-secondary btn-sm me-1 mb-1">
                                    <i class="fa-solid fa-magnifying-glass"></i>Visualizar</a>

                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">
                            Nenhum munícipe encontrado!
                        </div>
                    @endforelse
                </tbody>
            </table>

            {{ $municipes->onEachSide(2)->links() }}         

        </div>
    </div>
</div>

@endsection