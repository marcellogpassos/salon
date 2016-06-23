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

                    <h4 class="card-title">Gerenciar Pap&eacute;is</h4>

                    <form id="userRoleForm" class="form-horizontal" method="POST"
                          action="{{ url('/users/{id}/addRole') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="nameInput" name="nome_sobrenome" type="text" readonly
                                           value="{{$user->name . ' ' . $user->surname}}">
                                    <label for="nameInput" class="active">Usu&aacute;rio</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <label for="roleInput" class="active">Papel</label>
                                    <select id="roleInput" name="roles" required multiple>
                                        <option value="" disabled>Selecione os pap&eacute;is do usu&aacute;rio</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{$user->possuiRole($role) ? ' selected' : ''}}>
                                                {{$role->descricao}}
                                            </option>
                                        @endforeach
                                    </select>
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
                <!-- End card -->

            </div>
        </div>

    </div>
@endsection
