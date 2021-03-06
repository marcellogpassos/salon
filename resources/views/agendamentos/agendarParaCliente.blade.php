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

            <div class="col m8 s12 offset-m2">
                <div class="card white">

                    <h4 class="card-title">Novo Agendamento</h4>

                    <form id="agendamentosForm" method="post" action="{{ url('/users/' . $cliente->id . '/agendar') }}"
                          role="form" onsubmit="return validarForm()">

                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">
                            <div class="row">
                                <div class="col s12">

                                    <div class="row">
                                        <div class="input-field col s8 offset-m2">
                                            <input id="clienteInput" type="text" readonly
                                                   value="{{ $cliente->name . ' ' . $cliente->surname }}">
                                            <label for="clienteInput">Cliente</label>
                                        </div>
                                    </div>

                                    <input name="id" type="hidden" value="{{ $cliente->id }}">

                                    <div class="row">

                                        <div class="input-field col s12 offset-m2 m4">
                                            <i class="material-icons prefix">date_range</i>
                                            <input id="dataInput" name="data" class="data data-futura" required
                                                   type="text">
                                            <label for="dataInput">Data *</label>
                                        </div>

                                        <div class="col s12 m4">
                                            <label for="categoriaServicoInput">Hora: *</label>
                                            <select name="hora" class="browser-default hora" required id="horaInput">
                                                <option value="" selected> --</option>
                                                <option value="8:00">8:00 [MANH&Atilde;]</option>
                                                <option value="8:15">8:15 [MANH&Atilde;]</option>
                                                <option value="8:30">8:30 [MANH&Atilde;]</option>
                                                <option value="8:45">8:45 [MANH&Atilde;]</option>
                                                <option value="9:00">9:00 [MANH&Atilde;]</option>
                                                <option value="9:15">9:15 [MANH&Atilde;]</option>
                                                <option value="9:30">9:30 [MANH&Atilde;]</option>
                                                <option value="9:45">9:45 [MANH&Atilde;]</option>
                                                <option value="10:00">10:00 [MANH&Atilde;]</option>
                                                <option value="10:15">10:15 [MANH&Atilde;]</option>
                                                <option value="10:30">10:30 [MANH&Atilde;]</option>
                                                <option value="10:45">10:45 [MANH&Atilde;]</option>
                                                <option value="11:00">11:00 [MANH&Atilde;]</option>
                                                <option value="11:15">11:15 [MANH&Atilde;]</option>
                                                <option value="11:30">11:30 [MANH&Atilde;]</option>
                                                <option value="11:45">11:45 [MANH&Atilde;]</option>
                                                <option value="14:00">14:00 [TARDE]</option>
                                                <option value="14:15">14:15 [TARDE]</option>
                                                <option value="14:30">14:30 [TARDE]</option>
                                                <option value="14:45">14:45 [TARDE]</option>
                                                <option value="15:00">15:00 [TARDE]</option>
                                                <option value="15:15">15:15 [TARDE]</option>
                                                <option value="15:30">15:30 [TARDE]</option>
                                                <option value="15:45">15:45 [TARDE]</option>
                                                <option value="16:00">16:00 [TARDE]</option>
                                                <option value="16:15">16:15 [TARDE]</option>
                                                <option value="16:30">16:30 [TARDE]</option>
                                                <option value="16:45">16:45 [TARDE]</option>
                                                <option value="17:00">17:00 [TARDE]</option>
                                                <option value="17:15">17:15 [TARDE]</option>
                                                <option value="17:30">17:30 [TARDE]</option>
                                                <option value="17:45">17:45 [TARDE]</option>
                                                <option value="18:00">18:00 [TARDE]</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col m6 s12'">
                                            <div class="card white">
                                                <h4 class="card-title">Escolha o servi&ccedil;os e o profissional</h4>

                                                <div class="card-content">

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label for="categoriaServicoInput">Categoria de Servi&ccedil;o
                                                                *</label>
                                                            <select class="browser-default categorias-servico"
                                                                    onchange="setCategoriaServico(this.value)"
                                                                    id="categoriaServicoInput">
                                                                <option value="" selected> --</option>
                                                                @foreach($categoriasServicos as $categoria)
                                                                    <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label for="servicoInput">Servi&ccedil;o *</label>
                                                            <select id="servicoInput" class="browser-default servicos"
                                                                    onchange="setServico(this.value)" disabled>
                                                                <option value="" selected> Escolha uma categoria
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label for="profissionalInput">Profissional
                                                                (Opcional)</label>
                                                            <select id="profissionalInput" disabled
                                                                    class="browser-default profissionais">
                                                                <option value="" selected> Escolha um servi&ccedil;o
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <button type="button" class="btn btn-block primary"
                                                                    onclick="adicionarServico()">
                                                                Adicionar Servi&ccedil;o
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col m6 s12'">
                                            <div class="card white">
                                                <h4 class="card-title">Servi&ccedil;os adicionados</h4>

                                                <div class="card-content servicos-adicionados">

                                                    <div id="nenhum-servico-alert"
                                                         class="card card-alert card-alert-information">
                                                        <div class="card-content">
                                                            <p>Nenhum servi&ccedil;o adicionado.</p>
                                                        </div>
                                                    </div>

                                                    <table id="servicos-table" class="table-responsive highlight"
                                                           style="display: none">
                                                        <thead>
                                                        <tr>
                                                            <th>Servi&ccedil;o</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>

                                                        <tbody id="servico-row">

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

                        <div id="servico-input">
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        var urlListarServicosPorCategoria = '{{ url('categoriasServicos/:categoria/servicos') }}';
        var urlProfissionaisPorServico = '{{ url('servicos/:servico/profissionais') }}';
        var urlCancelarAgendamento = '{{ url('/agendamentos/:id') }}';
    </script>

    <script src="{{ asset('js/agendamentos.js') }}"></script>

@endsection