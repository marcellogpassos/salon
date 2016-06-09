@extends('layouts.appm')

@section('title')
    Dados do usu&aacute;rio
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col s12">

                @if ( count($errors) )
                    <div id="card-alert" class="card red lighten-5">
                        <div class="card-content red-text text-darken-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card white">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/dados') }}">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <h4 class="card-title">Dados do usu&aacute;rio</h4>

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <input id="nameInput" name="name" type="text" required maxlength="255"
                                           class="validate" value="{{ old('name') ? old('name') : $user->name }}">
                                    <label for="nameInput">Nome *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                           class="validate"
                                           value="{{ old('surname') ? old('surname') : $user->surname }}">
                                    <label for="surnameInput">Sobrenome *</label>
                                </div>

                                <div class="input-field sexo-div col s12 m4">
                                    <div>
                                        <spam>
                                            <input name="sexo" type="radio" id="femininoInput" value="F"
                                                    {!! ($user->sexo == 'F') ? ' checked' : '' !!}>
                                            <label for="femininoInput">Feminino</label>
                                        </spam>
                                        <spam>
                                            <input name="sexo" type="radio" id="masculinoInput" value="M"
                                                    {!! ($user->sexo == 'M') ? ' checked' : '' !!}>
                                            <label for="masculinoInput">Masculino</label>
                                        </spam>
                                    </div>
                                    <label class="active">Sexo *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="cpfInput" name="cpf" type="text" class="validate cpf" required
                                           value="{{ old('cpf') ? old('cpf') : $user->cpf }}">
                                    <label for="cpfInput">CPF *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="nascimentoInput" name="data_nascimento" class="dataNascimento" required
                                           value="{{ $user->data_nascimento ? date("d-m-Y", strtotime($user->data_nascimento)) : '' }}"
                                           type="text">
                                    <label for="nascimentoInput">Data de nascimento *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                           value="{{ old('telefone') ? old('telefone') : $user->telefone }}">
                                    <label for="telefoneInput">Telefone</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End card action -->

                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection
