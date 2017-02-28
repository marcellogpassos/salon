@extends('layouts.appm')

@section('title')
    Cadastre-se
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col m8 offset-m2">

                <div class="card white">

                    <h4 class="card-title">Cadastre-se</h4>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="card-content grey-text text-darken-3">

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="nameInput" name="name" type="text" required maxlength="255"
                                           class="validate" value="{{ old('name') }}">
                                    <label for="nameInput">Nome</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                           class="validate" value="{{ old('surname') }}">
                                    <label for="surnameInput">Sobrenome</label>
                                </div>

                            </div>

                            @if ($errors->has('name'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->has('surname'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                        value="{{ old('telefone') }}">
                                    <label for="telefoneInput">Telefone *</label>
                                </div>

                                <div class="input-field horizontal-radio col s12 m6">
                                    <div>
                                        <spam>
                                            <input name="sexo" type="radio" id="femininoInput" value="F"
                                                    {!! (old('sexo') == 'F') ? ' checked' : '' !!}>
                                            <label for="femininoInput">Feminino</label>
                                        </spam>
                                        <spam>
                                            <input name="sexo" type="radio" id="masculinoInput" value="M"
                                                    {!! (old('sexo') == 'M') ? ' checked' : '' !!}>
                                            <label for="masculinoInput">Masculino</label>
                                        </spam>
                                    </div>
                                    <label class="active">Sexo *</label>
                                </div>

                            </div>

                            @if ($errors->has('telefone'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telefone') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->has('sexo'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sexo') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="emailInput" name="email" type="email" required maxlength="255"
                                           class="validate" value="{{ (old('email') ? old('email') : (isset($email) ? $email : "" )) }}">
                                    <label for="emailInput">E-mail</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="emailConfirmationInput" name="email_confirmation" type="email"
                                           required maxlength="255" class="validate">
                                    <label for="emailConfirmationInput">Confirme seu e-mail</label>
                                </div>

                            </div>

                            @if ($errors->has('email'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->has('email_confirmation'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email_confirmation') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="passwordInput" name="password" type="password" required minlength="6"
                                           maxlength="32" class="validate">
                                    <label for="passwordInput">Senha</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="passwordConfirmationInput" name="password_confirmation"
                                           type="password" required minlength="6" maxlength="32" class="validate">
                                    <label for="passwordConfirmationInput">Confirme sua senha</label>
                                </div>

                            </div>

                            @if ($errors->has('password'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->has('password_confirmation'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>

                            @if ($errors->has('g-recaptcha-response'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m6 offset-m3 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
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
