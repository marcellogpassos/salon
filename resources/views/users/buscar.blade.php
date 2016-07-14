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

                    <h4 class="card-title">Buscar usu&aacute;rios</h4>

                    <form id="userForm" class="form-horizontal" method="POST" action="{{ url('/users/buscar') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="nameInput" name="nome_sobrenome" type="text" maxlength="255"
                                           value="{{

                                            old('nome_sobrenome') ?
                                                old('nome_sobrenome') : isset($buscaPrevia) ?
                                                    $buscaPrevia['nome_sobrenome'] : ""

                                           }}" minlength="3" class="validate">
                                    <label for="nameInput">Nome ou sobrenome</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="emailInput" name="email" type="email" maxlength="255" class="validate"
                                           value="{{

                                            old('email') ?
                                                old('email') : isset($buscaPrevia) ?
                                                    $buscaPrevia['email'] : ""

                                            }}">
                                    <label for="emailInput">E-mail</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field sexo-div col s12 m4">
                                    <div>
                                        <spam>
                                            <input name="sexo" type="radio" id="femininoInput" value="F"
                                                    {!!

                                                        (old('sexo') == 'F' || (isset($buscaPrevia['sexo']) && $buscaPrevia['sexo'] == 'F')) ?
                                                            ' checked' : ''

                                                    !!}>
                                            <label for="femininoInput">Feminino</label>
                                        </spam>
                                        <spam>
                                            <input name="sexo" type="radio" id="masculinoInput" value="M"
                                                    {!!

                                                        (old('sexo') == 'M' || (isset($buscaPrevia['sexo']) && $buscaPrevia['sexo'] == 'M')) ?
                                                            ' checked' : ''

                                                    !!}>
                                            <label for="masculinoInput">Masculino</label>
                                        </spam>
                                    </div>
                                    <label class="active">Sexo</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="cpfInput" name="cpf" type="text" class="validate cpf"
                                           value="{{

                                            old('cpf') ?
                                                old('cpf') : isset($buscaPrevia) ?
                                                    $buscaPrevia['cpf'] : ""

                                            }}">
                                    <label for="cpfInput">CPF</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                           value="{{

                                            old('telefone') ?
                                                old('telefone') : isset($buscaPrevia) ?
                                                    $buscaPrevia['telefone'] : ""

                                            }}">
                                    <label for="telefoneInput">Telefone</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
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

        @if (isset($usersEncontrados) && (count($usersEncontrados) == 0))
            <div id="information-alert" class="card card-alert card-alert-information">
                <div class="card-content">
                    <p>Consulta realizada com sucesso! Nenhum resultado encontrado.</p>
                </div>
            </div>
        @endif

        @if(isset($usersEncontrados) && (count($usersEncontrados) > 0))

            <div id="information-alert" class="card card-alert card-alert-information">
                <div class="card-content">
                    <p>Consulta realizada com sucesso! {{ count($usersEncontrados) }} resultado(s) encontrado(s).</p>
                </div>
            </div>

            <div class="row">
                <div class="col s12">

                    <div class="card white usuarios-encontrados">

                        <h4 class="card-title">Usu&aacute;rios encontrados</h4>

                        <div class="card-content gray-text text-darken-4">

                            <ul class="collapsible popout" data-collapsible="accordion">

                                @foreach($usersEncontrados as $us)
                                    <li class="usuario-encontrado">
                                        <div class="collapsible-header{{(count($usersEncontrados) == 1) ? ' active' : ''}}">
                                            <i class="material-icons">account_circle</i>{{ $us->name . ' ' . $us->surname }}

                                            @foreach($us->roles as $role)
                                                <div class="chip">
                                                    {{$role->descricao}}
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="collapsible-body">

                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="col s6 m4">
                                                        <a class="waves-effect waves-light btn btn-large btn-block secondary"
                                                           onclick="detalharUsuario('#datalharUsuarioModal', '{{ $us->id }}')">
                                                            <i class="material-icons left">search</i>Detalhar
                                                        </a>
                                                    </div>

                                                    <div class="col s6 m4">
                                                        <a href="{{ url('users/' . $us->id . '/papeis') }}"
                                                           class="waves-effect waves-light btn btn-large btn-block secondary">
                                                            <i class="material-icons left">verified_user</i>Pap&eacute;is
                                                        </a>
                                                    </div>

                                                    <div class="col s6 m4">
                                                        <a class="waves-effect waves-light btn btn-large btn-block secondary">
                                                            <i class="material-icons left">shopping_cart</i>Caixa
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                    </div>

                </div>

            </div>

            <div id="datalharUsuarioModal" class="modal">
                <div class="modal-content">
                    <h4 class="nome"></h4>
                    <div class="row">
                        <div class="col s12">
                            <div id="information-alert" class="card card-alert card-alert-information nao-cadastrado">
                                <div class="card-content">
                                    <p>Dados do usu&aacute;rio n&atilde;o fornecidos!</p>
                                </div>
                            </div>

                            <div class="col s12 m6 dados">
                                <p><strong>CPF:</strong>&nbsp;&nbsp;<span class="cpf"></span></p>
                                <p><strong>Sexo:</strong>&nbsp;&nbsp;<span class="sexo"></span></p>
                                <p>
                                    <strong>Data de nascimento:</strong>&nbsp;&nbsp;<span class="dataNascimento"></span>
                                </p>
                                <p><strong>Telefone:</strong>&nbsp;&nbsp;<span class="telefone"></span></p>
                            </div>
                            <div class="col s12 m6 dados">
                                <p><strong>Endere&ccedil;o:</strong></p>
                                <p>
                                    <span class="logradouro"></span>,&nbsp;
                                    <span class="numero"></span>.&nbsp;
                                    <span class="bairro"></span>
                                </p>
                                <p>
                                    <span class="cep"></span>.&nbsp;
                                    <span class="municipio"></span>&nbsp;-&nbsp;
                                    <span class="uf"></span>
                                </p>
                                <p>
                                    <span class="complemento"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
        @endif

    </div>
@endsection


@section('scripts')

    <script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

    @include('layouts.angular')

    <script>
        var urlRecuperarUsuario = '{{ url('/users/{id}') }}';
    </script>

    <script src="{{ asset('js/detalharUsuario.js') }}"></script>

@endsection