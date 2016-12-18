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

                    <h4 class="card-title">Agenda do Dia</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">

                            <div class="col s12">


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
                                                        {{ dateToBrFormat($agendamento->data) }} {{ $agendamento->hora }}
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

                            </div>
                        </div>
                    </div>

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
                    <div class="col s12 m4">
                        <p><img class="foto" src="" height="100%" width="100%" align="middle"></p>
                    </div>
                    <div class="col s12 m8 dados">
                        <p><strong>CPF:</strong>&nbsp;&nbsp;<span class="cpf"></span></p>
                        <p><strong>Sexo:</strong>&nbsp;&nbsp;<span class="sexo"></span>&nbsp;&nbsp;
                            <strong>Data de nascimento:</strong>&nbsp;&nbsp;<span class="dataNascimento"></span>
                        </p>
                        <br>
                        <p><strong>Telefone:</strong>&nbsp;&nbsp;<span class="telefone"></span></p>
                        <p><strong>E-mail:</strong>&nbsp;&nbsp;<span class="email"></span></p>
                        <br>
                        <p><strong>Endere&ccedil;o:</strong></p>
                        <p>
                            <span class="logradouro"></span>,&nbsp;
                            <span class="numero"></span>.&nbsp;
                            <span class="bairro"></span>
                            <span class="municipio"></span>&nbsp;-&nbsp;
                            <span class="uf"></span>
                        </p>
                        <p>
                            <span class="cep"></span>.&nbsp;
                            <span class="complemento"></span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        var justificativaDiv = '.justificativaDiv-:id';
        var urlRecuperarUsuario = '{{ url('/users/:id') }}';
        var urlPublic = '{{ url('/') }}';

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

    <script src="{{ asset('js/detalharUsuario.js') }}"></script>

@endsection