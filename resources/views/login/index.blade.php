@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        {{-- style="background-image:url({{ url('img/fundo3.jpg') }}); background-repeat: no-repeat; background-size: 100% 100%;"> --}}
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-1 mt-4">Registro de atendimento ao munícipe</h3>
                                    <div class="d-flex justify-content-center mt-4 mb-4"> <img
                                            src="{{ asset('/img/logo.png') }}" style="width: 200px; height: 150px;"/></div>
                                </div>
                                <div class="card-body">

                                    <x-alert-login />

                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" name="name" type="text"
                                                value="{{ old('name') }}" placeholder="Seu login" />
                                            <label for="login">Login</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password"
                                                    value="{{ old('password') }}" placeholder="Sua senha" />
                                                <label for="password">Senha</label>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" href="#">Acessar</a>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
