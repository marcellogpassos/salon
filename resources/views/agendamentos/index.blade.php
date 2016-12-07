@extends('layouts.appm')

@section('styles')

    <link href="{{ asset('lib/pickadate/compressed/themes/default.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('lib/pickadate/compressed/themes/default.time.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

@endsection

@section('title')
    Agendamentos
@endsection

@section('content')

    <div class="container container-lg">

        @include('layouts.messages')

        <div class="row">

            <div class="col m8 s12 {{count($agendamentos) ? '' : 'offset-m2'}}">
                <div class="card white">

                    <h4 class="card-title">Novo Agendamento</h4>

                    <form id="agendamentosForm" method="post" action="{{ url('/agendamentos') }}" role="form">

                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">
                            <div class="row">
                                <div class="col s12">

                                    <div class="row">

                                        <div class="input-field col s12 offset-m2 m4">
                                            <i class="material-icons prefix">date_range</i>
                                            <input id="dataInput" name="data" class="data data-futura" required
                                                   type="text">
                                            <label for="dataInput">Data *</label>
                                        </div>

                                        <div class="input-field col s12 m4">
                                            <i class="material-icons prefix">access_time</i>
                                            <input id="horaInput" name="hora" class="hora" required type="text">
                                            <label for="horaInput">Hora *</label>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s12 offset-m2 m4">
                                            <label for="categoriaServicoInput">Categoria de Servi&ccedil;o *</label>
                                            <select class="browser-default categorias-servico" required
                                                    onchange="setCategoriaServico(this.value)"
                                                    id="categoriaServicoInput">
                                                <option value="" selected> --</option>
                                                @foreach($categoriasServicos as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col s12 m4">

                                            <label for="servicoInput">Servi&ccedil;o *</label>
                                            <select id="servicoInput" name="servico_id" class="browser-default servicos"
                                                    onchange="setServico(this.value)" required disabled>
                                                <option value="" selected> Escolha uma categoria</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s12 offset-m2 m8">

                                            <label for="profissionalInput">Profissional (Opcional)</label>
                                            <select id="profissionalInput" class="browser-default profissionais"
                                                    name="profissional_id" disabled>
                                                <option value="" selected> Escolha um servi&ccedil;o</option>
                                            </select>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">

                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Agendar
                                    </button>

                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <div class="col m4 s12 {{count($agendamentos) ? '' : 'hiddendiv'}}">
                <div class="card white">

                    <h4 class="card-title">Agendamentos Futuros</h4>

                    <div class="card-content gray-text text-darken-4 agendamentos">
                        <div class="row">

                            @foreach($agendamentos as $agendamento)
                                <div class="col s12">

                                    <div class="card{{ $agendamento->status == 'C' ? ' green lighten-5' :
                                                    ($agendamento->status == 'N' ? ' red lighten-5' : ' grey lighten-4')}}">

                                        <div class="card-content black-text">

                                        <span class="card-title">
                                            {{ $agendamento->servico->descricao }}
                                        </span>

                                            <p class="detalhe-agendamento">
                                                <strong>Data e hora:</strong>
                                                {{ dateToBrFormat($agendamento->data) . '  ' . horaMinutoFormat($agendamento->hora) }}
                                            </p>

                                            <p class="detalhe-agendamento">
                                                <strong>Profissional:</strong>
                                                @if($agendamento->profissional_id)
                                                    {{ $agendamento->profissional->name . ' ' . $agendamento->profissional->surname }}
                                                @else
                                                    - -
                                                @endif
                                            </p>

                                            <p class="detalhe-agendamento">
                                                <strong>Status:</strong>
                                                @if($agendamento->status == 'C')
                                                    Confirmado
                                                @elseif($agendamento->status == 'N')
                                                    Negado
                                                @else
                                                    Aguardando confirmação
                                                @endif
                                            </p>

                                            @if($agendamento->status == 'N' && $agendamento->justificativa)
                                                <p class="detalhe-agendamento">
                                                    <strong>Justificativa:</strong>
                                                    {{$agendamento->justificativa}}
                                                </p>
                                            @endif

                                            {{ Form::open([
                                                'method' => 'DELETE',
                                                'url' => '/agendamentos/' . $agendamento->id,
                                                'class' => 'cancelamento-agendamento']) }}

                                            <div class="row">
                                                <div class="col s12">

                                                    <button type="submit" class="btn btn-block primary">
                                                        Cancelar Agendamento
                                                    </button>

                                                </div>
                                            </div>

                                            {{ Form::close() }}

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        var urlListarServicosPorCategoria = '{{ url('categoriasServicos/:categoria/servicos') }}';
        var urlProfissionaisPorServico = '{{ url('servicos/:servico/profissionais') }}';
    </script>

    <script src="{{ asset('js/agendamentos.js') }}"></script>

    <script type="application/javascript">

        $('.cancelamento-agendamento').submit(function (event) {
            return confirm(Messages.confirmation[0]);
        });

        $('.hora').change(function () {
            var valorInserido = this.value;
            var hora = formatarHoraMinuto(valorInserido);
            if (hora)
                this.val(hora);
            else {
                showMessage(Messages.error[10]);
                this.value = ''
            }
        });

    </script>

@endsection