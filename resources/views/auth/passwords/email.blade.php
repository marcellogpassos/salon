@extends('layouts.appm')

@section('title')
    Redefinir a senha
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col m8 offset-m2">

                @if (session('status'))
                    <div id="card-alert" class="card blue lighten-5">
                        <div class="card-content blue-text text-darken-4">
                            <span class="help-block">
                                <strong> {{ session('status') }}</strong>
                            </span>
                        </div>
                    </div>
                @endif

                <div class="card white">

                    <h4 class="card-title">Redefinir a senha</h4>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="card-content grey-text text-darken-4">

                            <div class="row">
                                <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="emailInput" type="email" class="validate" name="email"
                                           maxlength="255" required value="{{ old('email') }}">
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

                        </div>
                        <!-- End card content-->

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
