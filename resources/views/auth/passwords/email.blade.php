@extends('layouts.appm')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col m8 offset-m2">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card white">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}


                        <div class="card-content grey-text text-darken-4">

                            <h4 class="card-title">Redefinir a senha</h4>

                            <div class="row">
                                <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="emailInput" type="email" class="validate" name="email"
                                           maxlength="255" required value="{{ old('email') }}">
                                    <label for="emailInput">E-mail</label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- End card content-->

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m6 offset-m3 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
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
