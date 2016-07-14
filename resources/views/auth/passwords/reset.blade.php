@extends('layouts.appm')

@section('title')
    Redefinir a senha
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col m8 offset-m2">

                <div class="card white">

                    <h4 class="card-title">Redefinir senha</h4>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="card-content grey-text text-darken-3">

                            <div class="row">

                                <div class="input-field col s12">
                                    <input id="emailInput" name="email" type="email" required maxlength="255"
                                           class="validate" value="{{ old('email') }}">
                                    <label for="emailInput">E-mail</label>
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

                            <div class="row">

                                <div class="input-field col s12 m6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="passwordInput" name="password" type="password" required minlength="6"
                                           maxlength="32" class="validate">
                                    <label for="passwordInput">Senha</label>
                                </div>

                                <div class="input-field col s12 m6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
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

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m6 offset-m3 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Redefinir senha
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
