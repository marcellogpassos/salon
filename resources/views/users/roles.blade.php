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

                    <form id="userRoleForm" class="form-horizontal" method="POST"
                          action="{{ url('/users/{id}/addRole') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <h4 class="card-title">Gerenciar Pap&eacute;is</h4>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="nameInput" name="nome_sobrenome" type="text" readonly
                                           value="{{$user->name . ' ' . $user->surname}}">
                                    <label for="nameInput" class="active">Usu&aacute;rio</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 offset-m3 m6">
                                    <label for="roleInput">Papel</label>
                                    <select id="roleInput" name="role_id" class="browser-default" required>
                                        <option value="1">Administrador</option>
                                        <option value="2">Barbeiro</option>
                                        <option value="3">Caixa</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Adicionar
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
