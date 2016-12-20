@extends('layouts.appm')

@section('title')
    Bem vindo!
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">

            <div class="col s12 m7">
                <div class="card white">

                    <h4 class="card-title">{{ dataPorExtenso() }}</h4>

                    <div class="card-content gray-text text-darken-4 agenda-do-dia">

                        @if(!isset($agendaDoDia) || !count($agendaDoDia))
                            <div class="row">
                                <div class="col s12">

                                    <div id="success-alert" class="card card-alert card-alert-information">
                                        <div class="card-content">
                                            <p>N&atilde;o h&aacute; servi&ccedil;os agendados para hoje.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @else

                            <ul>
                                @foreach($agendaDoDia as $agendamento)
                                    <li>
                                        <div class="row">
                                            <div class="col s12">
                                                <a onclick="detalharAgendamento('#datalharAgendamentoModal', '{{ $agendamento->id }}')"
                                                   class="special-link">
                                                    <strong>{{ $agendamento->getCarbonDateTime()->format('H:i') }}</strong>&nbsp;&nbsp;-
                                                    {{ $agendamento->servico->descricao }}&nbsp;&nbsp;-
                                                    {{  $agendamento->cliente->name . ' ' . $agendamento->cliente->surname }}
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        @endif

                        <br>
                        <hr>
                        <br>

                        <div class="row">
                            <div class="col s12 center">
                                <a class="special-link" href="{{ url('/agenda') }}">
                                    (Ver agenda completa)
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col s12 m5">
                <div class="card white">

                    <h4 class="card-title">Agendamentos Pendentes</h4>

                    <div class="card-content gray-text text-darken-4 agendamentos-pendentes">
                        <div class="row">

                            <div class="col s12">

                                @if(!isset($agendamentos) || !count($agendamentos))
                                    <div class="row">
                                        <div class="col s12">

                                            <div id="success-alert" class="card card-alert card-alert-success">
                                                <div class="card-content">
                                                    <p>&Oacute;timo! N&atilde;o h&aacute; agendamentos pendentes.</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @else

                                    @foreach($agendamentos as $agendamento)

                                        <div class="card grey lighten-4">

                                            <div class="card-content black-text">

                                        <span class="card-title">
                                            {{ $agendamento->servico->descricao }}
                                        </span>

                                                <hr>

                                                <br>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <p>
                                                            <strong>Cliente:</strong>
                                                            <a onclick="detalharUsuario('#datalharUsuarioModal', '{{ $agendamento->cliente->id }}')"
                                                               class="special-link">
                                                                {{ $agendamento->cliente->name . ' ' . $agendamento->cliente->surname }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <p>
                                                            <strong>Data e hora:</strong>
                                                            {{ $agendamento->getCarbonDateTime()->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <p>
                                                            <strong>Profissional:</strong>
                                                            @if(isset($agendamento->profissional))
                                                                {{ $agendamento->profissional->name . ' ' . $agendamento->profissional->surname }}
                                                            @else
                                                                --
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <form id="analisarAgendamentoForm-{{ $agendamento->id }}" method="post"
                                                      role="form"
                                                      action="{{ url('/agendamentos/analisar') }}">

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="id" value="{{ $agendamento->id }}">

                                                    <div class="row">
                                                        <div class="col s12 m6">
                                                            <p>
                                                                <input name="status" type="radio"
                                                                       id="confirmarInput-{{ $agendamento->id }}"
                                                                       class="status"
                                                                       onchange="confirmarAgendamento(this, '{{ $agendamento->id }}')"
                                                                       value="C" checked/>
                                                                <label for="confirmarInput-{{ $agendamento->id }}">Confirmar</label>
                                                            </p>
                                                        </div>
                                                        <div class="col s12 m6">
                                                            <p>
                                                                <input name="status" type="radio"
                                                                       id="rejeitarInput-{{ $agendamento->id }}"
                                                                       class="status"
                                                                       onchange="rejeitarAgendamento(this, '{{ $agendamento->id }}')"
                                                                       value="N"/>
                                                                <label for="rejeitarInput-{{ $agendamento->id }}">Rejeitar</label>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row justificativaDiv-{{ $agendamento->id }}"
                                                         style="display: none;">
                                                        <div class="input-field col s12">
                                                    <textarea id="justificativaInput-id" name="justificativa"
                                                              class="materialize-textarea char-counter"
                                                              length="255"></textarea>
                                                            <label for="justificativaInput">Justificativa</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <button class="waves-effect waves-light btn btn-block primary"
                                                                    type="submit">
                                                                Salvar
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    @endforeach

                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

    @include('users.partials.detalhar')

    @include('agendamentos.partials.detalhar')

@endsection

@section('scripts')

    <script type="text/javascript">

        var justificativaDiv = '.justificativaDiv-:id';

        var confirmarAgendamento = function (confirmarInput, id) {
            var justificativaId = justificativaDiv.replace(':id', id);
            if (confirmarInput.checked)
                $(justificativaId).hide();
        };

        var rejeitarAgendamento = function (rejeitarInput, id) {
            var justificativaId = justificativaDiv.replace(':id', id);
            if (rejeitarInput.checked)
                $(justificativaId).show();
        };

    </script>

@endsection