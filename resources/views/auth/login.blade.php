@extends('layouts.appm')

@section('title')
    Login
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col m8 offset-m2">

                <div class="card white">

                    <h4 class="card-title">Login</h4>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}


                        <div class="card-content grey-text text-darken-4">

                            <div class="row">
                                <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="emailInput" type="email" class="validate" name="email"
                                           maxlength="255" required value="{{ old('email') }}">
                                    <label for="emailInput">E-mail</label>
                                </div>

                                <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="passwordInput" type="password" class="validate" name="password"
                                           minlength="6" maxlength="32" required>
                                    <label for="passwordInput">Senha</label>
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

                            @if ($errors->has('password'))
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content red-text">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col s12 m6">
                                    <p>
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember">Lembrar minha senha</label>
                                    </p>
                                </div>
                                <div class="col s12 m6">
                                    <a href="{{ url('/password/reset') }}">
                                        <p class="right-align">
                                            Esqueci a senha
                                        </p>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- End card content-->

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m6 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Entrar
                                    </button>
                                </div>

                                <div class="col s12 m6 grid-example">
                                    <a class="btn btn-block waves-effect waves-light secondary"
                                       href="{{ url('/register') }}">
                                        Cadastre-se
                                    </a>
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
