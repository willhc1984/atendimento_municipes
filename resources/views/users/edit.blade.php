@extends('layouts.admin')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Editar</span>
                <span>
                    <a href="{{ route('user.index') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Usuários</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ old('name', $user->name) }}" placeholder="Nome do usuário">
                    </div>

                    <div class="col-12">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ old('email', $user->email) }}" placeholder="Email do usuário">
                    </div>

                    <div class="col-12">
                        <label for="papel" class="form-label">Papel:</label>
                        <select name="roles" class="form-select" id="roles">
                            <option value="">Selecione</option>
                            @forelse($roles as $role)
                                @if ($role != 'Super Admin')
                                    <option value="{{ $role }}" {{ old('roles') == $role || $role == $userRoles ? 'selected' : '' }}>
                                        {{ $role }}</option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{ $role }}" {{ old('roles') == $role || $role == $userRoles ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endif
                                @endif
                            @empty
                            @endforelse
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