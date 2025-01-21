@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Perfil</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Perfil</a></li>
                <li class="breadcrumb-item active">Editar senha</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Editar</span>
                <span class="d-flex">
                    <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm me-1">
                        <i class="fa-solid fa-eye"></i>Visualizar
                    </a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('profile.update-password', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Nova senha:</label>
                        <input type="password" class="form-control" name="password" id="password"
                            value="{{ old('password', $user->password) }}" placeholder="Senha com no minimo 6 caracteres">
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