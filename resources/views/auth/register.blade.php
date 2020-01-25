@extends('store.layouts.main')

@section('content')
    <div class="container text-center">
        <h1 class="title">
            Cadastrar-se
        </h1>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <h4>Dados Pessoais:</h4>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nome</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                       placeholder="Nome" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

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

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme a Senha"
                           required>
            </div>

            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf">CPF</label>

                <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}"
                       placeholder="CPF" required autofocus>

                @if ($errors->has('cpf'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                <label for="birth_date">Data Aniversário:</label>

                <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}"
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

                <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}"
                       placeholder="Rua" required autofocus>

                @if ($errors->has('street'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                <label for="number">Número:</label>

                <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}"
                       placeholder="Número" required autofocus>

                @if ($errors->has('number'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                <label for="complement">Complemento:</label>

                <input id="complement" type="text" class="form-control" name="complement" value="{{ old('complement') }}"
                       placeholder="Complemento" required autofocus>

                @if ($errors->has('complement'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('complement') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                <label for="district">Bairro:</label>

                <input id="district" type="text" class="form-control" name="district" value="{{ old('district') }}"
                       placeholder="Bairro" required autofocus>

                @if ($errors->has('district'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                <label for="postal_code">CEP:</label>

                <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}"
                       placeholder="CEP" required autofocus>

                @if ($errors->has('postal_code'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city">Cidade:</label>

                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"
                       placeholder="Cidade" required autofocus>

                @if ($errors->has('city'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state">Estado:</label>

                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}"
                       placeholder="Estado" required autofocus>

                @if ($errors->has('state'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country">País:</label>

                <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}"
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

                <input id="area_code" type="text" class="form-control" name="area_code" value="{{ old('area_code') }}"
                       placeholder="DDD" required autofocus>

                @if ($errors->has('area_code'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('area_code') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">Telefone:</label>

                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                       placeholder="Telefone" required autofocus>

                @if ($errors->has('phone'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
            </div>
        </form>
    </div>
@endsection
