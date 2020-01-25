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

        <form class="form form-custom" method="POST" action="{{ route('profile-update') }}">
            {{ csrf_field() }}

            <h4>Dados Pessoais:</h4>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nome</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}"
                       placeholder="Nome" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"
                       placeholder="E-mail" disabled>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf">CPF</label>

                <input id="cpf" type="text" class="form-control" name="cpf" value="{{ auth()->user()->cpf }}"
                       placeholder="CPF" disabled>

                @if ($errors->has('cpf'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                <label for="birth_date">Data Aniversário:</label>

                <input id="birth_date" type="date" class="form-control" name="birth_date"
                       value="{{ auth()->user()->birth_date }}"
                       placeholder="Data de aniversário" required autofocus>

                @if ($errors->has('birth_date'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                @endif
            </div>

            <h4>Endereço:</h4>
            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                <label for="street">Rua:</label>

                <input id="street" type="text" class="form-control" name="street" value="{{ auth()->user()->street }}"
                       placeholder="Rua" required autofocus>

                @if ($errors->has('street'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                <label for="number">Número:</label>

                <input id="number" type="text" class="form-control" name="number" value="{{ auth()->user()->number }}"
                       placeholder="Número" required autofocus>

                @if ($errors->has('number'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                <label for="complement">Complemento:</label>

                <input id="complement" type="text" class="form-control" name="complement"
                       value="{{ auth()->user()->complement }}"
                       placeholder="Complemento" required autofocus>

                @if ($errors->has('complement'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('complement') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                <label for="district">Bairro:</label>

                <input id="district" type="text" class="form-control" name="district"
                       value="{{ auth()->user()->district }}"
                       placeholder="Bairro" required autofocus>

                @if ($errors->has('district'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                <label for="postal_code">CEP:</label>

                <input id="postal_code" type="text" class="form-control" name="postal_code"
                       value="{{ auth()->user()->postal_code }}"
                       placeholder="CEP" required autofocus>

                @if ($errors->has('postal_code'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city">Cidade:</label>

                <input id="city" type="text" class="form-control" name="city" value="{{ auth()->user()->city }}"
                       placeholder="Cidade" required autofocus>

                @if ($errors->has('city'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state">Estado:</label>

                <input id="state" type="text" class="form-control" name="state" value="{{ auth()->user()->state }}"
                       placeholder="Estado" required autofocus>

                @if ($errors->has('state'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country">País:</label>

                <input id="country" type="text" class="form-control" name="country"
                       value="{{ auth()->user()->country }}"
                       placeholder="País" required autofocus>

                @if ($errors->has('country'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                @endif
            </div>
            <h4>Telefone</h4>
            <div class="form-group{{ $errors->has('area_code') ? ' has-error' : '' }}">
                <label for="area_code">Código de Área:</label>

                <input id="area_code" type="text" class="form-control" name="area_code"
                       value="{{ auth()->user()->area_code }}"
                       placeholder="DDD" required autofocus>

                @if ($errors->has('area_code'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('area_code') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">Telefone:</label>

                <input id="phone" type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}"
                       placeholder="Telefone" required autofocus>

                @if ($errors->has('phone'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
@endsection