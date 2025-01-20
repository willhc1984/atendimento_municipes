@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Usuários</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span>
                    <a href="{{ route('user.index') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Usuários</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                            placeholder="Nome do usuário">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}"
                            placeholder="Email do usuário">
                    </div>
                    <div class="col-12">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password"
                            value="{{ old('password') }}" placeholder="Senha do usuário">
                    </div>
                    <div class="col-12">
                        <label for="papel" class="form-label">Papel:</label>
                        <select name="roles" class="form-select" id="roles">
                            <option value="">Selecione</option>
                            @forelse($roles as $role)
                                @if ($role != 'Super Admin')
                                    <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : '' }}">{{ $role }}</option>
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