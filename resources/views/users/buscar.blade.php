@extends('layouts.appm')

@section('title')
    Buscar usu&aacute;rios
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <form id="userForm" class="form-horizontal" method="POST" action="{{ url('/users/buscar') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <h4 class="card-title">Buscar usu&aacute;rio</h4>

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="nameInput" name="nome_sobrenome" type="text" maxlength="255"
                                           class="validate" value="{{ old('nome_sobrenome') }}">
                                    <label for="nameInput">Nome ou sobrenome</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="emailInput" name="email" type="email" maxlength="255"
                                           class="validate" value="{{ old('email') }}">
                                    <label for="emailInput">E-mail</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field sexo-div col s12 m4">
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
                                    <label class="active">Sexo</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="cpfInput" name="cpf" type="text" class="validate cpf"
                                           value="{{ old('cpf') }}">
                                    <label for="cpfInput">CPF</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                           value="{{ old('telefone') }}">
                                    <label for="telefoneInput">Telefone</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Buscar
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

    <script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

@endsection