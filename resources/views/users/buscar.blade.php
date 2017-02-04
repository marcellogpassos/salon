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

                    <form id="userForm" class="form-horizontal" method="GET" action="{{ url('/users/buscar') }}"
                          role="form">

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 offset-m2 m4">
                                    <input id="nameInput" name="nome_sobrenome" type="text" maxlength="255"
                                           value="{{

                                            old('nome_sobrenome') ?
                                                old('nome_sobrenome') : isset($buscaPrevia['nome_sobrenome']) ?
                                                    $buscaPrevia['nome_sobrenome'] : ""

                                           }}" minlength="3" class="validate">
                                    <label for="nameInput">Nome ou sobrenome</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <i class="material-icons prefix">email</i>
                                    <input id="emailInput" name="email" type="email" maxlength="255" class="validate"
                                           value="{{

                                            old('email') ?
                                                old('email') : isset($buscaPrevia['email']) ?
                                                    $buscaPrevia['email'] : ""

                                            }}">
                                    <label for="emailInput">E-mail</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field horizontal-radio col s12 offset-m2 m2">
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

                                <div class="input-field col s12 m3">
                                    <input id="cpfInput" name="cpf" type="text" class="validate cpf"
                                           value="{{

                                            old('cpf') ?
                                                old('cpf') : isset($buscaPrevia['cpf']) ?
                                                    $buscaPrevia['cpf'] : ""

                                            }}">
                                    <label for="cpfInput">CPF</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                           value="{{

                                            old('telefone') ?
                                                old('telefone') : isset($buscaPrevia['telefone']) ?
                                                    $buscaPrevia['telefone'] : ""

                                            }}">
                                    <label for="telefoneInput">Telefone</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 grid-example{{ Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin() ? ' offset-m2 ' : ' offset-m4' }}">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Buscar
                                    </button>
                                </div>

                                @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())
                                    <div class="col s12 m4 grid-example">
                                        <a href="{{ url('/users/cadastrar') }}"
                                           class="btn btn-block waves-effect waves-light secondary">
                                            Cadastrar Cliente
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- End card action -->

                    </form>

                </div>
                <!-- End card -->

            </div>
        </div>

        @if (isset($usersEncontrados) && (count($usersEncontrados) == 0))
            @include('partials.nenhumResultadoEncontrado')
        @endif

        @if(isset($usersEncontrados) && (count($usersEncontrados) > 0))

            @include('partials.resultadosEncontrados', ['total' => $usersEncontrados->total()])

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
                                                        <a href="{{ url('users/' . $us->id . '/agendar') }}"
                                                           class="waves-effect waves-light btn btn-large btn-block secondary">
                                                            <i class="material-icons left">access_time</i>Agendar Servi&ccedil;o
                                                        </a>
                                                    </div>

                                                    @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())

                                                        <div class="col s6 m4">
                                                            <a href="{{ url('users/' . $us->id . '/registrarCompra') }}"
                                                               class="waves-effect waves-light btn btn-large btn-block secondary">
                                                                <i class="material-icons left">shopping_cart</i>Registrar
                                                                Compra
                                                            </a>
                                                        </div>

                                                    @endif

                                                    @if(Auth::user()->admin())

                                                        <div class="col s6 m4">
                                                            <a href="{{ url('users/' . $us->id . '/papeis') }}"
                                                               class="waves-effect waves-light btn btn-large btn-block secondary">
                                                                <i class="material-icons left">verified_user</i>Dados
                                                                Profissionais
                                                            </a>
                                                        </div>

                                                        @if($us->ativo)

                                                            <form role="form" method="post"
                                                                  action="{{ url('/users/status') }}">

                                                                {!! csrf_field() !!}

                                                                <input type="hidden" name="id" value="{{ $us->id }}">

                                                                <input type="hidden" name="ativo" value="0">

                                                                <div class="col s6 m4">
                                                                    <button class="waves-effect waves-light btn btn-large btn-block secondary"
                                                                            type="submit">
                                                                        <i class="material-icons left">block</i>Bloquear
                                                                        Usu&aacute;rio
                                                                    </button>
                                                                </div>

                                                            </form>

                                                        @else

                                                            <form role="form" method="post"
                                                                  action="{{ url('/users/status') }}">

                                                                {!! csrf_field() !!}

                                                                <input type="hidden" name="id" value="{{ $us->id }}">

                                                                <input type="hidden" name="ativo" value="1">

                                                                <div class="col s6 m4">
                                                                    <button class="waves-effect waves-light btn btn-large btn-block secondary"
                                                                            type="submit">
                                                                        <i class="fa fa-unlock left"
                                                                           aria-hidden="true"></i>Desbloquear
                                                                        Usu&aacute;rio
                                                                    </button>
                                                                </div>

                                                            </form>

                                                        @endif

                                                        <div class="col s6 m4">
                                                            <a class="waves-effect waves-light btn btn-large btn-block secondary"
                                                               onclick="enviarMensagem('#enviarMensagemModal', '{{ $us->id }}')">
                                                                <i class="material-icons left">message</i>Enviar
                                                                mensagem
                                                            </a>
                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12">
                                    {!! $usersEncontrados->appends($buscaPrevia)->render() !!}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            @include('users.partials.detalhar')

            @include('users.partials.message')
        @endif

    </div>
@endsection


@section('scripts')

    <script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

@endsection