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
                                    <label for="dataInicialInput">Data inicial</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="dataFinalInput" name="data_final" class="data" required type="text">
                                    <label for="dataFinalInput">Data final</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="valorMinimoInput" name="valor_minimo" class="moeda" required type="text">
                                    <label for="valorMinimoInput">Valor m&iacute;nimo</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <input id="valorMaximoInput" name="valor_maximo" class="moeda" required type="text">
                                    <label for="valorMaximoInput">Valor m&aacute;ximo</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="itemInput" class="autocomplete highlight-matching item" maxlength="255"
                                           type="text">
                                    <label for="itemInput">Nome ou c&oacute;digo do item</label>
                                </div>

                                <input id="itemHiddenInput" name="item" type="hidden" value="">

                                <div class="input-field col s12 m6">
                                    <input id="clienteInput" class="autocomplete highlight-matching cliente"
                                           maxlength="255" type="text">
                                    <label for="clienteInput">Nome ou cpf do cliente</label>
                                </div>

                                <input id="clienteHiddenInput" name="cliente" type="hidden" value="">

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
    <script>
        var itemAutocompleteSelector = '.autocomplete.item';
        var itemHiddenInputSelector = '#itemHiddenInput';
        var clienteAutocompleteSelector = '.autocomplete.cliente';
        var clienteHiddenInputSelector = '#clienteHiddenInput';

        var buscarItemSrc = '{{url("/compras/buscarItem")}}';
        var buscarClienteSrc = '{{url("/compras/buscarCliente")}}';

        $(itemAutocompleteSelector).autocomplete({
            source: buscarItemSrc,
            minLength: 2,
            focus: function (event, ui) {
                $(itemAutocompleteSelector).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $(itemAutocompleteSelector).val(ui.item.label);
                $(itemHiddenInputSelector).val(ui.item.id);
                return false;
            },
            change: function (event, ui) {
                if (!ui.item) {
                    $(itemAutocompleteSelector).val('');
                    $(itemHiddenInputSelector).val('');
                }
            }
        });

        $(clienteAutocompleteSelector).autocomplete({
            source: buscarClienteSrc,
            minLength: 2,
            focus: function (event, ui) {
                $(clienteAutocompleteSelector).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $(clienteAutocompleteSelector).val(ui.item.label);
                $(clienteHiddenInputSelector).val(ui.item.id);
                return false;
            },
            change: function (event, ui) {
                if (!ui.item) {
                    $(clienteAutocompleteSelector).val('');
                    $(clienteHiddenInputSelector).val('');
                }
            }
        });
    </script>
@endsection