@extends('layouts.appm')

@section('title')
    Relat&oacute;rio de compras
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Relat&oacute;rio de compras</h4>

                    <form id="servicosForm" class="form-horizontal" method="GET" action="{{ url('compras/buscar') }}"
                          role="form">

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 m3">
                                    <input id="dataInicialInput" name="data_inicial" class="data" required type="text">
                                    <label for="dataInicialInput">Data inicial *</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="dataFinalInput" name="data_final" class="data" required type="text">
                                    <label for="dataFinalInput">Data final *</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="valorMinimoInput" name="valor_minimo" class="moeda" required type="text">
                                    <label for="valorMinimoInput">Valor m&iacute;nimo *</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="valorMaximoInput" name="valor_maximo" class="moeda" required type="text">
                                    <label for="valorMaximoInput">Valor m&aacute;ximo *</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="itemInput" name="item" required type="text">
                                    <label for="itemInput">Item espec&iacute;fico *</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="clienteInput" name="cliente" required type="text">
                                    <label for="clienteInput">Cliente espec&iacute;fico *</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection