@extends('layouts.appm')

@section('title')
    Dados do usu&aacute;rio
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col s12">
                <div class="card white">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/dados') }}">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <h4 class="card-title">Dados do usu&aacute;rio</h4>

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <input id="nameInput" name="name" type="text" required maxlength="255"
                                           class="validate" value="{{ $user->name }}">
                                    <label for="nameInput">Nome</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                           class="validate" value="{{ $user->surname }}">
                                    <label for="surnameInput">Sobrenome</label>
                                </div>

                                <div class="input-field sexo-div col s12 m4">
                                    <div>
                                        <spam>
                                            <input name="sexo" type="radio" id="feminino_input" value="F" required
                                                   checked="{{ $user->sexo == 'F' }}"/>
                                            <label for="feminino_input">Feminino</label>
                                        </spam>
                                        <spam>
                                            <input name="sexo" type="radio" id="masculino_input" value="M" required
                                                   checked="{{ $user->sexo == 'M' }}"/>
                                            <label for="masculino_input">Masculino</label>
                                        </spam>
                                    </div>
                                    <label class="active">Sexo:</label>
                                </div>

                                <div>{{ $user->sexo == 'F' }}</div>
                                <div>{{ $user->sexo == 'M' }}</div>

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
