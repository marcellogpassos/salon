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

                    <h4 class="card-title">Dados do Profissional</h4>

                    <form id="userRoleForm" class="form-horizontal" method="POST"
                          action="{{ url('/users/' . $user->id . '/papeis') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="nameInput" name="nome_sobrenome" type="text" readonly
                                           value="{{$user->name . ' ' . $user->surname}}">
                                    <label for="nameInput" class="active">Nome do Profissional</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <textarea id="curriculoInput" class="materialize-textarea" type="text" length="2048"
                                              name="curriculo">{!! $user->curriculo !!}</textarea>
                                    <label for="curriculoInput">
                                        Curr&iacute;culo (breve descri&ccedil;&atilde;o)
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">

                                    <p>Fun&ccedil;&otilde;es desempenhadas</p>

                                    @foreach($roles as $role)
                                        <div class="col s12 m6 input-role">
                                            <p>
                                                <input id="{{ 'role-' . $role->id }}" name="roles[]"
                                                       value="{{$role->id}}"
                                                       {{$user->possuiRole($role->id) ? ' checked' : ''}} type="checkbox"/>
                                                <label for="{{ 'role-' . $role->id }}">{{$role->descricao}}</label>
                                            </p>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
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
