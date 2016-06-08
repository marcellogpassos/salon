@extends('layouts.appm')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col m8 offset-m2">

                <div class="card white">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="card-content grey-text text-darken-3">

                            <h4 class="card-title">Cadastre-se</h4>

                            <div class="row">

                                <div class="input-field col s12 m6{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="nameInput" name="name" type="text" required maxlength="255"
                                           class="validate" value="{{ old('name') }}">
                                    <label for="nameInput">Nome</label>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('surname') ? ' has-error' : '' }}">
                                    <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                           class="validate" value="{{ old('surname') }}">
                                    <label for="surnameInput">Sobrenome</label>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="emailInput" name="email" type="email" required maxlength="255"
                                           class="validate" value="{{ old('email') }}">
                                    <label for="emailInput">E-mail</label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                                    <input id="emailConfirmationInput" name="email_confirmation" type="email"
                                           required maxlength="255" class="validate">
                                    <label for="emailConfirmationInput">Confirme seu e-mail</label>

                                    @if ($errors->has('email_confirmation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email_confirmation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="passwordInput" name="password" type="password" required minlength="6"
                                           maxlength="32" class="validate">
                                    <label for="passwordInput">Senha</label>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input id="passwordConfirmationInput" name="password_confirmation"
                                           type="password" required minlength="6" maxlength="32" class="validate">
                                    <label for="passwordConfirmationInput">Confirme sua senha</label>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m6 offset-m3 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End card action -->

                    </form>
                </div>
                <!-- End card -->

            </div>
        </div>
        <!-- End row -->

    </div>
    <!-- End container -->
@endsection
