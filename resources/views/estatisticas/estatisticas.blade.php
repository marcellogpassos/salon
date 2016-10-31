@extends('layouts.appm')

@section('title')
    Estat&iacute;sticas
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s6">

                <div class="card white">

                    <h4 class="card-title">Clientes por Sexo</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col offset-m1 m10 s12">
                                <canvas id="clientesPorSexoChart" width="100%" height="100%"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

                    </div>

                </div>

            </div>

            <div class="col s6">

                <div class="card white">

                    <h4 class="card-title">Clientes por Faixas Et&aacute;rias</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col offset-m1 m10 s12">
                                <canvas id="clientesPorFaixaEtariaChart" width="100%" height="100%"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

                    </div>

                </div>

            </div>

            <div class="col s6">

                <div class="card white">

                    <h4 class="card-title">Movimento semanal</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col offset-m1 m10 s12">
                                <canvas id="movimentoSemanalChart" width="100%" height="100%"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

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

        // movimento semanal
        var movimentoSemanalData = [0, 0, 0, 0, 0, 0, 0];
        @foreach($movimentoSemanal as $item)
            movimentoSemanalData[{{ $item->dia }}] = {{ $item->frequencia }};
        @endforeach
    </script>

    <script src="{{ asset('js/estatisticas/clientesPorSexo.js') }}"></script>
    <script src="{{ asset('js/estatisticas/clientesPorFaixaEtaria.js') }}"></script>
    <script src="{{ asset('js/estatisticas/movimentoSemanal.js') }}"></script>
@endsection