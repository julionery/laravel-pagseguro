@extends('store.layouts.main')

@section('content')
    <div class="container text-center">
        <h1 class="title">
            Recuperar Senha
        </h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="E-mail" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Enviar link para resetar a senha
                </button>
            </div>
        </form>
    </div>
@endsection
