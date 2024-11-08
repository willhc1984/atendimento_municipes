@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Atendimentos</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('municipe.index') }}">Munícipes</a>
                </li>
                <li class="breadcrumb-item active">Atendimentos</li>
            </ol>
        </div>

        <x-alert />

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Pesquisar</span>
            </div>
            <div class="card-body">
                <form action="{{ route('atendimento.all') }}">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="data">Data:</label>
                            <input type="date" name="data" id="data" class="form-control" value="" />
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
            <div class="card-header space-between-elements">
                <span>Listar</span>
                {{-- <span>
                    <a href="{{ route('atendimento.create', ['municipe' => $municipe]) }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i>Registrar atendimento</a>
                </span> --}}
            </div>

            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Munícipe</th>
                            <th scope="col">Vereador</th>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atendimentos as $atendimento)
                            <tr>
                                <th scope="row">{{ $atendimento->id }}</th>
                                <td>{{ $atendimento->municipe->nome }}</td>
                                <td>{{ $atendimento->vereador }}</td>
                                <td>{{ \Carbon\Carbon::parse($atendimento->dataHora)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($atendimento->dataHora)->tz('America/Sao_Paulo')->format('H:i:s') }}</td>
                                <td>{{ $atendimento->status }}</td>
                                <td class="d-md-flex justify-content-center">
                                    <a href="{{ route('atendimento.edit', ['atendimento' => $atendimento->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i>Editar</a>

                                    <form id="formDelete{{ $atendimento->id }}" method="POST"
                                        action="{{ route('atendimento.destroy', ['atendimento' => $atendimento->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $atendimento->id }}"><i class="fa-regular fa-trash-can"></i>
                                            Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum atendimento encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $atendimentos->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection
