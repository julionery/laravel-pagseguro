@extends('store.layouts.main')

@section('content')
    <div class="container text-center">
        <h1 class="title">Meu Perfil</h1>

        @if( session('message'))
            <div class="alert alert-success">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        @if( session('error'))
            <div class="alert alert-danger">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if( isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        <form class="form form-custom" method="POST" action="{{ route('password.update') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Senha</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirme a Senha</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirme a Senha"
                       required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Atualizar Senha
                </button>
            </div>
        </form>
    </div>
@endsection