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
                                    <li class="tab col s3"><a href="#produtosServicosTab">Produtos e Servi&ccedil;os</a></li>
                                </ul>
                            </div>
                            <div id="clientesTab" class="col s12">
                                <div class="row">
                                    <div class="col s12">

                                        <div class="card white">

                                            <h4 class="card-title">Clientes por Sexo</h4>

                                            <div class="card-content gray-text text-darken-4">
                                                <div class="row">
                                                    <div class="progress">
                                                        <div class="determinate" style="width: 70%"></div>
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
                                                        <canvas id="clientesPorBairroChart" width="100%" height="100%"></canvas>
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
                                                        <canvas id="clientesPorFaixaEtariaChart" width="100%" height="100%"></canvas>
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
                                                        <canvas id="movimentoSemanalChart" width="100%" height="100%"></canvas>
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
                                                        <canvas id="movimentoMensalChart" width="100%" height="100%"></canvas>
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

    <script>
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
            clientesPorBairroLabels.push('{{ $item->bairro }}');
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
    </script>

    <script src="{{ asset('js/estatisticas/clientesPorSexo.js') }}"></script>
    <script src="{{ asset('js/estatisticas/clientesPorBairro.js') }}"></script>
    <script src="{{ asset('js/estatisticas/clientesPorFaixaEtaria.js') }}"></script>
    <script src="{{ asset('js/estatisticas/movimentoSemanal.js') }}"></script>
    <script src="{{ asset('js/estatisticas/movimentoMensal.js') }}"></script>
@endsection