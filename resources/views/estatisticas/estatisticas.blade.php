@extends('layouts.appm')

@section('title')
    Estat&iacute;sticas
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">

            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Estat&iacute;sticas</h4>

                    <div class="card-content">

                        <div class="row">
                            <div class="col s12">
                                <ul class="tabs tabs-fixed-width">
                                    <li class="tab col s3"><a class="active" href="#clientesTab">Clientes</a></li>
                                    <li class="tab col s3"><a href="#movimentoTab">Movimento</a></li>
                                    <li class="tab col s3"><a href="#produtosServicosTab">Produtos e Servi&ccedil;os</a>
                                    <li class="tab col s3"><a href="#comprasTab">Compras</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="clientesTab" class="col s12">
                                <div class="row">
                                    <div class="col s12">

                                        <div class="card white">

                                            <h4 class="card-title">Clientes por Sexo</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col s12 offset-m1 m10">
                                                        <div class="progress clientes-por-sexo">
                                                            <div class="determinate"
                                                                 style="width: {{ 100 * $clientesPorSexo[1]->quantidade / ($clientesPorSexo[1]->quantidade + $clientesPorSexo[0]->quantidade) }}%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col s6 offset-m1 m5">
                                                        <p>Masculino: {{ $clientesPorSexo[1]->quantidade }}</p>
                                                    </div>
                                                    <div class="col s6 m5" style="text-align: right">
                                                        <p>Feminino: {{ $clientesPorSexo[0]->quantidade }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Clientes por Bairros</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col offset-m1 m10 s12">
                                                        <canvas id="clientesPorBairroChart" width="100%"
                                                                height="100%"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Clientes por Faixas Et&aacute;rias</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col offset-m1 m10 s12">
                                                        <canvas id="clientesPorFaixaEtariaChart" width="100%"
                                                                height="100%"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="movimentoTab" class="col s12">
                                <div class="row">
                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Movimento semanal</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col offset-m1 m10 s12">
                                                        <canvas id="movimentoSemanalChart" width="100%"
                                                                height="100%"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Movimento mensal</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col offset-m1 m10 s12">
                                                        <canvas id="movimentoMensalChart" width="100%"
                                                                height="100%"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="produtosServicosTab" class="col s12">
                                <div class="row">
                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Servi&ccedil;os mais vendidos</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <table class="highlight bordered">
                                                            <thead>
                                                            <tr>
                                                                <th data-field="id">Nome do servi&ccedil;o</th>
                                                                <th data-field="name">Frequ&ecirc;ncia</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            @foreach($servicosMaisVendidos as $servico)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ url('/servicos/buscar?id=' . $servico->servico_id) }}"
                                                                           class="special-link" target="_blank">
                                                                            {{ $servico->servico_id . ' - ' . $servico->servico_descricao }}
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ $servico->frequencia }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-action">
                                                <a href="#">Ver todos</a>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col s12 m6">

                                        <div class="card white">

                                            <h4 class="card-title">Produtos mais vendidos</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <table class="highlight bordered">
                                                            <thead>
                                                            <tr>
                                                                <th data-field="id">Nome do produto</th>
                                                                <th data-field="name">Frequ&ecirc;ncia</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            @foreach($produtosMaisVendidos as $produto)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ url('/produtos/buscar?id=' . $produto->produto_id) }}"
                                                                           class="special-link" target="_blank">
                                                                            {{ $produto->produto_id . ' - ' . $produto->produto_descricao }}
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ $produto->frequencia }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-action">
                                                <a href="#">Ver todos</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="comprasTab" class="col s12">
                                <div class="row">
                                    <div class="col s12 offset-m2 m8">

                                        <div class="card white">

                                            <h4 class="card-title">Resultados</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="col s4" style="text-align: center">
                                                        <p>
                                                            <input name="periodo" type="radio" id="semana" checked
                                                                   value="S" onchange="alterarPeriodo(this.value)"/>
                                                            <label for="semana">Semana</label>
                                                        </p>
                                                    </div>
                                                    <div class="col s4 center" style="text-align: center">
                                                        <p>
                                                            <input name="periodo" type="radio" id="mes"
                                                                   value="M" onchange="alterarPeriodo(this.value)"/>
                                                            <label for="mes">M&ecirc;s</label>
                                                        </p>
                                                    </div>
                                                    <div class="col s4" style="text-align: center">
                                                        <p>
                                                            <input name="periodo" type="radio" id="ano"
                                                                   value="A" onchange="alterarPeriodo(this.value)"/>
                                                            <label for="ano">Ano</label>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <ul class="collection">
                                                            <li class="collection-item dismissable">
                                                                <div>
                                                                    Quantidade de compras
                                                                    <p class="secondary-content periodo semana"
                                                                       style="display: block;">
                                                                        10
                                                                    </p>
                                                                    <p class="secondary-content periodo mes"
                                                                       style="display: none;">
                                                                        20
                                                                    </p>
                                                                    <p class="secondary-content periodo ano"
                                                                       style="display: none;">
                                                                        30
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="collection-item dismissable">
                                                                <div>
                                                                    Receitas totais
                                                                    <p class="secondary-content periodo semana"
                                                                       style="display: block;">
                                                                        10
                                                                    </p>
                                                                    <p class="secondary-content periodo mes"
                                                                       style="display: none;">
                                                                        20
                                                                    </p>
                                                                    <p class="secondary-content periodo ano"
                                                                       style="display: none;">
                                                                        30
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="collection-item dismissable">
                                                                <div>
                                                                    Novos clientes
                                                                    <p class="secondary-content periodo semana"
                                                                       style="display: block;">
                                                                        10
                                                                    </p>
                                                                    <p class="secondary-content periodo mes"
                                                                       style="display: none;">
                                                                        20
                                                                    </p>
                                                                    <p class="secondary-content periodo ano"
                                                                       style="display: none;">
                                                                        30
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="collection-item dismissable">
                                                                <div>
                                                                    Serviços vendidos
                                                                    <p class="secondary-content periodo semana"
                                                                       style="display: block;">
                                                                        10
                                                                    </p>
                                                                    <p class="secondary-content periodo mes"
                                                                       style="display: none;">
                                                                        20
                                                                    </p>
                                                                    <p class="secondary-content periodo ano"
                                                                       style="display: none;">
                                                                        30
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="collection-item dismissable">
                                                                <div>
                                                                    Produtos vendidos
                                                                    <p class="secondary-content periodo semana"
                                                                       style="display: block;">
                                                                        10
                                                                    </p>
                                                                    <p class="secondary-content periodo mes"
                                                                       style="display: none;">
                                                                        20
                                                                    </p>
                                                                    <p class="secondary-content periodo ano"
                                                                       style="display: none;">
                                                                        30
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('lib/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>

    <script type="text/javascript" charset="UTF-8">
        // clientes por sexo
        var clientesSexoFeminino = {{ $clientesPorSexo[0]->quantidade }};
        var clientesSexoMasculino = {{ $clientesPorSexo[1]->quantidade }};

        // clientes por faixa etaria
        var clientesPorFaixaEtariaLabels = [];
        var clientesPorFaixaEtariaData = [];
        @foreach($clientesPorFaixaEtaria as $item)
            clientesPorFaixaEtariaLabels.push('{{ $item->faixaEtaria }}');
            clientesPorFaixaEtariaData.push('{{ $item->quantidade }}');
        @endforeach

        // clientes por bairro
        var clientesPorBairroLabels = [];
        var clientesPorBairroData = [];
        @foreach($clientesPorBairro as $item)
            clientesPorBairroLabels.push(
                $('<div />').html('{{ $item->bairro }}').text()
            );
            clientesPorBairroData.push('{{ $item->quantidade }}');
        @endforeach

        // movimento semanal
        var movimentoSemanalData = [0, 0, 0, 0, 0, 0, 0];
        @foreach($movimentoSemanal as $item)
                movimentoSemanalData[{{ $item->dia }}] = {{ $item->frequencia }};
        @endforeach

        // movimento mensal
        var movimentoMensalData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0];
        @foreach($movimentoMensal as $item)
                movimentoMensalData[{{ $item->dia - 1 }}] = {{ $item->frequencia }};
        @endforeach

        function alterarPeriodo(value) {
            switch (value) {
                case 'S':
                    $('.periodo').hide();
                    $('.semana').show();
                    break;
                case 'M':
                    $('.periodo').hide();
                    $('.mes').show();
                    break;
                case 'A':
                    $('.periodo').hide();
                    $('.ano').show();
                    break;
            }
        }
    </script>

    <script type="text/javascript" charset="UTF-8" src="{{ asset('js/estatisticas/clientesPorSexo.js') }}"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ asset('js/estatisticas/clientesPorBairro.js') }}"></script>
    <script type="text/javascript" charset="UTF-8"
            src="{{ asset('js/estatisticas/clientesPorFaixaEtaria.js') }}"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ asset('js/estatisticas/movimentoSemanal.js') }}"></script>
    <script type="text/javascript" charset="UTF-8" src="{{ asset('js/estatisticas/movimentoMensal.js') }}"></script>
@endsection