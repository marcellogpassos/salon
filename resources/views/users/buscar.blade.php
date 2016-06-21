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

                    <div class="card white">
                        <div class="card-content gray-text text-darken-4">
                            <h4 class="card-title">Usu&aacute;rios encontrados</h4>

                            <ul class="collapsible popout" data-collapsible="accordion">

                                @foreach($usersEncontrados as $us)
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">account_circle</i>{{ $us->name . ' ' . $us->surname }}
                                        </div>
                                        <div class="collapsible-body">
                                            <p>Lorem ipsum dolor sit amet, his ex ubique aperiri, duo invidunt
                                                deseruisse cu, ei his idque deserunt. Eum te tota sensibus aliquando,
                                                per eu libris nostro. In ludus corrumpit vis. Eu dicta inermis convenire
                                                sit, eos inani fierent disputationi cu. Id sea ullum clita expetendis,
                                                eos in semper tamquam efficiantur.
                                            </p>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="card-action">
                        </div>
                    </div>

                </div>

            </div>
        @endif

    </div>
@endsection


@section('scripts')

    <script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

@endsection