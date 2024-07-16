@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Vereadores</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
                <li class="breadcrumb-item active">Vereadores</li>
            </ol>
        </div>

        <x-alert />

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('vereador.create') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>

            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vereadores as $vereador)
                            <tr>
                                <th scope="row">{{ $vereador->id }}</th>
                                <td>{{ $vereador->nome }}</td>
                                <td class="d-md-flex justify-content-center">

                                    <a href="{{ route('vereador.edit', ['vereador' => $vereador->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i>Editar</a>

                                    <form id="formDelete{{ $vereador->id }}" method="POST"
                                        action="{{ route('vereador.destroy', ['vereador' => $vereador->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $vereador->id }}"><i class="fa-regular fa-trash-can"></i>
                                            Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum vereador encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $vereadores->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection
