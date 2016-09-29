@extends('layouts.appm')

@section('title')
    Registrar Compra
@endsection

@section('content')
    <div class="container container-lg">

        @include('layouts.messages')

        <div class="row">

            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Registrar Compra</h4>

                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m4">
                                <strong>Cliente:</strong> {{ $cliente->name . ' ' . $cliente->surname }}
                            </div>

                            <div class="col s12 m4">
                                {{ dataPorExtenso() }}
                            </div>

                            <div class="col s12 m4">
                                <strong>Usu&aacute;rio:</strong> {{ $caixa->name . ' ' . $caixa->surname }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m9">

                                <div class="card white">

                                    <h4 class="card-title">Itens</h4>

                                    <div class="card-content gray-text text-darken-4">

                                        <div class="row">

                                            <div class="input-field col s12 m9">
                                                <input id="buscarItemInput" name="item" maxlength="255" type="text"
                                                       required class="autocomplete highlight-matching">
                                                <label for="buscarItemInput">Nome ou c&oacute;digo do item *</label>
                                            </div>

                                            <div class="input-field col s12 m3">
                                                <button class="btn btn-block waves-effect waves-light primary"
                                                        onclick="adicionarItem()" id="adicionarItem" type="button">
                                                    Adicionar item
                                                </button>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col s12">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th data-field="id">Item</th>
                                                        <th data-field="price">Valor unitário</th>
                                                        <th data-field="name">Quantidade</th>
                                                        <th data-field="price">Valor total</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id="itensTableBody">

                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col s12 m3">

                                <div class="card white">

                                    <h4 class="card-title">Resumo da compra</h4>

                                    <div class="card-content gray-text text-darken-4">

                                        <div class="row">

                                            <div class="input-field col s12">
                                                <input id="valorTotalInput" name="valorTotal" maxlength="32"
                                                       class="moeda" type="text" required readonly>
                                                <label id="valorTotalLabel" for="valorTotalInput">Valor total</label>
                                            </div>

                                            <div id="descontoPorcentoDiv" class="input-field col s12 hide">
                                                <input id="descontoPorcentoInput" name="descontoPorcento"
                                                       onchange="setDescontoPorcento(this.value)"
                                                       class="porcento" maxlength="32" type="text">
                                                <label id="descontoPorcentoLabel" for="descontoPorcentoInput">Desconto
                                                    em Porcento</label>
                                            </div>

                                            <div id="descontoReaisDiv" class="input-field col s12">
                                                <input id="descontoReaisInput" name="descontoReais" class="moeda"
                                                       onchange="setDescontoReais(this.value)"
                                                       maxlength="32" type="text">
                                                <label id="descontoReaisLabel" for="descontoReaisInput">Desconto em
                                                    Reais</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <div>
                                                    <span>
                                                        <input name="tipoDesconto" type="radio" value="P"
                                                               id="descontoPorcentoRadio">
                                                        <label for="descontoPorcentoRadio">Porcento</label>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="input-field col horizontal-radio s12 m6">
                                                <div>
                                                    <span>
                                                        <input name="tipoDesconto" type="radio" value="R" checked
                                                               id="descontoReaisRadio">
                                                        <label for="descontoReaisRadio">Reais</label>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="input-field col s12">
                                                <input id="valorFinalInput" name="valorFinal" maxlength="32"
                                                       type="text" required readonly>
                                                <label id="valorFinalLabel" for="valorFinalInput">Valor final</label>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col s12">
                                                <label for="formaPagamentoInput" class="active">Forma de
                                                    pagamento</label>
                                                <select id="formaPagamentoInput" name="formaPagamento"
                                                        class="browser-default" required>
                                                    <option value=""></option>
                                                    @foreach($formasPagamento as $forma)
                                                        <option value="{{$forma->id}}">{{$forma->descricao}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-field col s12 dinheiro hide">
                                                <input id="valorPagoInput" name="valorPago" maxlength="255"
                                                       type="text" class="moeda" onchange="setValorPago(this.value)">
                                                <label id="valorPagoLabel" for="valorPagoInput">Valor pago</label>
                                            </div>

                                            <div class="input-field col s12 troco dinheiro hide">
                                                <input id="trocoInput" name="troco" maxlength="255"
                                                       type="text" readonly>
                                                <label id="trocoLabel" for="trocoInput">Troco</label>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="card-action">
                                        <div class="row">
                                            <div class="col s12 grid-example">
                                                <a class="btn btn-block waves-effect waves-light primary" href="">
                                                    Finalizar compra
                                                </a>
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
    <script>
        $(function () {
            $("#buscarItemInput").autocomplete({
                source: '{{url("/compras/buscarItem")}}',
                minLength: 2,
                focus: function (event, ui) {
                    $("#buscarItemInput").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#buscarItemInput").val(ui.item.label);
                    itemSelecionado = ui.item;
                    return false;
                },
                change: function (event, ui) {
                    if (!ui.item)
                        buscarItemEstadoInicial();
                }
            });
        });

        $('input[name=tipoDesconto]').on('change', function () {
            var tipoDescontoSelecionado = $('input[name=tipoDesconto]:checked');
            if (tipoDescontoSelecionado.val() == 'P') {
                $('#descontoPorcentoDiv').removeClass('hide');
                $('#descontoReaisDiv').addClass('hide');
            }
            if (tipoDescontoSelecionado.val() == 'R') {
                $('#descontoReaisDiv').removeClass('hide');
                $('#descontoPorcentoDiv').addClass('hide');
            }
        });

        $('select[name=formaPagamento]').on('change', function () {
            var formaPagamento = $('select[name=formaPagamento]').val();
            if (formaPagamento == 1) {
                $('.dinheiro').removeClass('hide');
                $('#valorPagoInput').prop('required', true);
            } else {
                $('.dinheiro').addClass('hide');
                $('#valorPagoInput').prop('required', false);
            }
        });

        var itens = [];

        var itemSelecionado = null;

        var descontoPorcento = 0;

        var descontoReais = 0;

        var atualizarListaItens = function () {
            var tableBody = $("#itensTableBody");
            tableBody.empty();
            var html = "";
            for (i = 0; i < itens.length; i++) {
                var valorItem = itens[i].quantidade * itens[i].item.valor;
                var descricaoItem = itens[i].item.label;
                var removerItem = '<span class="remover">(<a class="special-link" onclick="removerItem('
                        + itens[i].item.id + ')">Remover item</a>)</span>';
                var colItem = '<td>' + descricaoItem + removerItem + '</td>';
                var colValorUnitario = '<td>' + itens[i].item.valor.formatMoney(2, ',', '.') + '</td>';
                var colQuantidade = '<td><div class="input-field"><input class="validate quantidade" type="number" ' +
                        'onchange="setQuantidade(' + itens[i].item.id + ', this.value)" value="' + itens[i].quantidade
                        + '" min="1" max="' + itens[i].item.quantidadeDisponivel + '"></div></td>';
                var colValorTotalItem = '<td>' + valorItem.formatMoney(2, ',', '.') + '</td>';
                html += '<tr>' + colItem + colValorUnitario + colQuantidade + colValorTotalItem + '</tr>';
            }
            tableBody.html(html);
            var valorTotal = calcularValorTotal();
            defineInput('#valorTotalInput', '#valorTotalLabel', valorTotal, 'M');
            defineInput('#valorFinalInput', '#valorFinalLabel', valorTotal - descontoReais, 'M');
        };

        var adicionarItem = function () {
            if (getItemIndex(itemSelecionado.id) != -1) {
                showMessage('Item já adicionado!');
                buscarItemEstadoInicial();
                return;
            }
            itens.push({
                item: itemSelecionado,
                quantidade: 1
            });
            atualizarListaItens();
            resetDesconto();
            resetValorPago();
            showMessage('Item adicionado!');
            buscarItemEstadoInicial();
        };

        var calcularDescontoPorcento = function (descontoReais, valorTotal) {
            return Math.round((descontoReais / valorTotal) * 100);
        };

        var calcularDescontoReais = function (descontoPorcento, valorTotal) {
            return (descontoPorcento / 100) * valorTotal;
        };

        var calcularValorTotal = function () {
            var total = 0;
            for (i = 0; i < itens.length; i++)
                total += itens[i].quantidade * itens[i].item.valor;
            return total;
        };

        var defineInput = function (inputSelector, labelSelector, valor, formato) {
            $(labelSelector).addClass('active');
            if (formato == 'M')
                $(inputSelector).val(valor.formatMoney(2, ',', '.'));
            if (formato == 'P')
                $(inputSelector).val(valor + ' %');
        };

        var buscarItemEstadoInicial = function () {
            var input = $("#buscarItemInput");
            input.val('');
            input.focus();
        };

        var getItemIndex = function (itemId) {
            for (i = 0; i < itens.length; i++)
                if (itens[i].item.id == itemId)
                    return i;
            return -1;
        };

        var resetDesconto = function () {
            resetInput('#descontoReaisInput', '#descontoReaisLabel');
            resetInput('#descontoPorcentoInput', '#descontoPorcentoLabel');
            defineInput('#valorFinalInput', '#valorFinalLabel', calcularValorTotal(), 'M');
        };

        var resetInput = function (inputSelector, labelSelector) {
            $(labelSelector).removeClass('active');
            $(inputSelector).val('');
        };

        var resetValorPago = function () {
            resetInput('#valorPagoInput', '#valorPagoLabel');
            resetInput('#trocoInput', '#trocoLabel');
        };

        var removerItem = function (item) {
            var index = getItemIndex(item);
            itens.splice(index, 1);
            atualizarListaItens();
            resetDesconto();
            resetValorPago();
            showMessage('Item removido!');
            buscarItemEstadoInicial();
        };

        var setDescontoPorcento = function (desconto) {
            descontoPorcento = desconto;
            var valorTotal = calcularValorTotal();
            descontoReais = calcularDescontoReais(descontoPorcento, valorTotal);
            defineInput('#descontoPorcentoInput', '#descontoPorcentoLabel', descontoPorcento, 'P');
            defineInput('#descontoReaisInput', '#descontoReaisLabel', valorTotal - descontoReais, 'M');
            defineInput('#valorFinalInput', '#valorFinalLabel', valorTotal - descontoReais, 'M');
            $('#formaPagamentoInput').focus();
        };

        var setDescontoReais = function (desconto) {
            desconto = getMoney(desconto) / 100;
            var valorTotal = calcularValorTotal();
            if (validarDesconto(desconto, valorTotal)) {
                descontoReais = desconto;
                descontoPorcento = calcularDescontoPorcento(descontoReais, valorTotal);
                defineInput('#descontoReaisInput', '#descontoReaisLabel', descontoReais, 'M');
                defineInput('#descontoPorcentoInput', '#descontoPorcentoLabel', descontoPorcento, 'P');
                defineInput('#valorFinalInput', '#valorFinalLabel', valorTotal - descontoReais, 'M');
                $('#formaPagamentoInput').focus();
            }
        };

        var setQuantidade = function (itemId, novaQuantidade) {
            for (i = 0; i < itens.length; i++)
                if (itens[i].item.id == itemId)
                    itens[i].quantidade = novaQuantidade;
            atualizarListaItens();
            resetDesconto();
            resetValorPago();
            showMessage('Quantidade alterada!');
        };

        var setValorPago = function (valor) {
            var valorPago = getMoney(valor) / 100;
            var valorFinal = calcularValorTotal() - descontoReais;
            if (validarValorPago(valorPago, valorFinal)) {
                var troco = valorPago - valorFinal;
                defineInput('#valorPagoInput', '#valorPagoLabel', valorPago, 'M');
                defineInput('#trocoInput', '#trocoLabel', troco, 'M');
            }
        };

        var validarDesconto = function (desconto, valorTotal) {
            if (desconto > 0 && desconto < valorTotal)
                return true;
            showMessage('O desconto concedido é inválido!');
            resetDesconto();
            $('#descontoReaisInput').focus();
            return false;
        };

        var validarValorPago = function (valorPago, valorFinal) {
            if (valorPago >= valorFinal)
                return true;
            showMessage('O valor pago deve ser maior que o valor final!');
            resetValorPago();
            $("#valorPagoInput").focus();
            return false;
        };

    </script>

    <script src="{{ asset('lib/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection
