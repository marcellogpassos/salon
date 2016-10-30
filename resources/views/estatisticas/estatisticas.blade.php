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
                            <div class="col offset-s1 s10">
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
                            <div class="col offset-s1 s10">
                                <canvas id="clientesPorFaixaEtariaChart" width="100%" height="100%"></canvas>
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
        var clientesPorSexoLabels = ['Feminino', 'Masculino'];
        var clientesPorSexoData = [
            {{ $clientesPorSexo[0]->quantidade }},
            {{ $clientesPorSexo[1]->quantidade }}
        ];

        var clientesPorSexoCtx = document.getElementById("clientesPorSexoChart");
        var clientesPorSexoChart = new Chart(clientesPorSexoCtx, {
            type: 'pie',
            data: {
                labels: ["Feminino", "Masculino"],
                datasets: [{
                    label: 'Clientes por Sexo',
                    data: clientesPorSexoData,
                    backgroundColor: [
                        'rgb(255, 205, 210)',
                        'rgb(197, 202, 233)',
                    ],
                    borderColor: [
                        'rgb(211, 47, 47)',
                        'rgb(48, 63, 159)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        var clientesPorFaixaEtariaLabels = [];
        var clientesPorFaixaEtariaData = [];
        @foreach($clientesPorFaixaEtaria as $item)
            clientesPorFaixaEtariaLabels.push('{{ $item->faixaEtaria }}');
            clientesPorFaixaEtariaData.push('{{ $item->quantidade }}');
        @endforeach

        var clientesPorFaixaEtariaCtx = document.getElementById("clientesPorFaixaEtariaChart");
        var clientesPorFaixaEtariaChart = new Chart(clientesPorFaixaEtariaCtx, {
            type: 'horizontalBar',
            data: {
                labels: clientesPorFaixaEtariaLabels,
                datasets:[{
                    label: 'Número de clientes',
                    data: clientesPorFaixaEtariaData,
                    backgroundColor: 'rgb(197, 202, 233)',
                    borderColor: 'rgb(48, 63, 159)',
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection