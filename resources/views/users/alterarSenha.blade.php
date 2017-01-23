@extends('layouts.appm')

@section('title')
    Alterar Senha
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Alterar Senha</h4>

                    <form id="alterarSenhaForm" class="form-horizontal" method="POST"
                          action="{{ url('/users/alterarSenha') }}" role="form">

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
                                    <input id="passwordInput" type="password" class="validate" name="current-password"
                                           required>
                                    <label for="passwordInput">Senha atual *</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="passwordInput" type="password" class="validate" name="new-password"
                                           required>
                                    <label for="passwordInput">Nova senha *</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 offset-m3 m6">
                                    <input id="passwordInput" type="password" class="validate"
                                           name="confirm-new-password" required>
                                    <label for="passwordInput">Confirme a nova senha *</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Alterar Senha
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

    <script type="text/javascript">
        var formSelector = '#alterarSenhaForm';
    </script>

    <script src="{{ asset('js/confirmarSenhas.js') }}"></script>

@endsection
