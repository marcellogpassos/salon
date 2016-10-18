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

                                <div class="input-field col s12 m2">
                                    <input id="codigoValidacaoInput" class="codigo-validacao" maxlength="6" min="6"
                                           type="text" value="" name="codigo_validacao">
                                    <label for="codigoValidacaoInput">C&oacute;digo de valida&ccedil;&atilde;o</label>
                                </div>

                                <div class="input-field col s12 m5">
                                    <input id="clienteInput" class="autocomplete highlight-matching cliente"
                                           maxlength="255" type="text" value="">
                                    <label for="clienteInput">Nome ou cpf do cliente</label>
                                </div>

                                <input id="clienteHiddenInput" name="cliente" type="hidden" value="">

                                <div class="input-field col s12 m5">
                                    <input id="itemInput" class="autocomplete highlight-matching item" maxlength="255"
                                           type="text" value="">
                                    <label for="itemInput">Nome ou c&oacute;digo do item</label>
                                </div>

                                <input id="itemHiddenInput" name="item" type="hidden" value="">

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m3">
                                    <i class="material-icons prefix">date_range</i>
                                    <input id="dataInicialInput" name="data_inicial" class="data" type="text">
                                    <label for="dataInicialInput">Data inicial</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <i class="material-icons prefix">date_range</i>
                                    <input id="dataFinalInput" name="data_final" class="data" type="text">
                                    <label for="dataFinalInput">Data final</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input id="valorMinimoInput" name="valor_minimo" class="moeda" type="text">
                                    <label for="valorMinimoInput">Valor m&iacute;nimo</label>
                                </div>

                                <div class="input-field col s12 m3">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input id="valorMaximoInput" name="valor_maximo" class="moeda" type="text">
                                    <label for="valorMaximoInput">Valor m&aacute;ximo</label>
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

                @if (isset($comprasEncontradas) && (count($comprasEncontradas) == 0))
                    @include('partials.nenhumResultadoEncontrado')
                @endif

                @if(isset($comprasEncontradas) && (count($comprasEncontradas) > 0))

                    @include('partials.resultadosEncontrados', ['total' => $comprasEncontradas->total()])

                    <div class="row">
                        <div class="col s12">

                            <div class="card white compras-encontradas">

                                <h4 class="card-title">Compras encontradas</h4>

                                <div class="card-content gray-text text-darken-4">

                                    <table class="bordered highlight responsive-table">

                                        <thead>
                                        <tr>
                                            <th data-field="codigo_validacao">C&oacute;d.</th>
                                            <th data-field="cliente_id">Cliente</th>
                                            <th data-field="data_compra">Data da compra</th>
                                            <th data-field="valor_total">Valor total</th>
                                            <th data-field="desconto">Desconto</th>
                                            <th data-field="valor_final">Valor final</th>
                                            <th>Op&ccedil;&otilde;es</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($comprasEncontradas as $compra)
                                            <tr>
                                                <td>{{$compra->codigo_validacao}}</td>
                                                <td>{{
                                                    isset($compra->cliente) ?
                                                        ($compra->cliente->name . ' ' . $compra->cliente->surname) :
                                                        ' - '
                                                }}</td>
                                                <td>{{dateToBrFormat($compra->data_compra, true)}}</td>
                                                <td>{{moneyFormat($compra->valor_total, true)}}</td>
                                                <td>{{
                                                    $compra->desconto ?
                                                    moneyFormat($compra->desconto, true) :
                                                    ' - '
                                                }}</td>
                                                <td>{{moneyFormat($compra->valor_total - $compra->desconto, true)}}</td>
                                                <td>
                                                    <a class="special-link">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                                <div class="card-action">
                                    <div class="row">
                                        <div class="col s12">
                                            {!! $comprasEncontradas->appends($buscaPrevia)->render() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                @endif

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

        var codigoValidacaoInput = '#codigoValidacaoInput';

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

        $(codigoValidacaoInput).change(function () {
            var codigoFornecido = $(codigoValidacaoInput).val();
            if (!validarCodigo(codigoFornecido)) {
                $(codigoValidacaoInput).val('');
                showMessage('O código deve conter 6 caracteres apenas letras e números');
            } else
                $(codigoValidacaoInput).val(codigoFornecido.toUpperCase());
        });
    </script>
@endsection