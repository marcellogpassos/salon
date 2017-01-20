@extends('layouts.appm')

@section('title')
    Gerenciar Pap&eacute;is
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Excluir Conta</h4>

                    <form id="excluirContaForm" class="form-horizontal" method="POST"
                          action="{{ url('/users/excluirConta') }}" role="form">

                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="nameInput" type="text" readonly
                                           value="{{$user->name . ' ' . $user->surname}}">
                                    <label for="nameInput" class="active">Nome do Usu&aacute;rio</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="passwordInput" type="password" class="validate" name="password" required>
                                    <label for="passwordInput">Senha *</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <textarea id="motivoInput" class="materialize-textarea" type="text" length="2048"
                                              name="motivo">{!! old('motivo') ? old('motivo') : '' !!}</textarea>
                                    <label for="motivoInput">
                                        Deixe-nos saber o motivo da exclus&atilde;o
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <p class="center-align">Avalie sua experi&ecirc;ncia com o nosso sistema</p>

                                    @include('partials.starRate')

                                </div>
                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Excluir Conta
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

    </div>
@endsection



@section('scripts')

    <script src="{{ asset('js/star-rate.js') }}"></script>

@endsection
