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

                                            <div class="input-field col s12">
                                                <input id="valorPagoInput" name="valorPago" maxlength="255"
                                                       type="text" required>
                                                <label for="valorPagoInput">Valor pago</label>
                                            </div>

                                            <div class="input-field col s12 troco">
                                                <input id="trocoInput" name="troco" maxlength="255"
                                                       type="text" required>
                                                <label for="trocoInput">Troco</label>
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
                },
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
                html += '<tr><td>' + itens[i].item.label;
                html += '<span class="remover">(<a class="special-link" onclick="removerItem(';
                html += itens[i].item.id + ')">Remover item</a>)</span></td><td>';
                html += itens[i].item.valor.formatMoney(2, ',', '.') + '</td><td>';
                html += '<div class="input-field"><input class="validate quantidade" type="number" onchange="setQuantidade(';
                html += itens[i].item.id + ', this.value)" value="' + itens[i].quantidade + '" min="1" max="';
                html += itens[i].item.quantidadeDisponivel + '"></div></td><td>' + valorItem.formatMoney(2, ',', '.') + '</td></tr>';
            }
            tableBody.html(html);
            var valorTotal = calcularValorTotal();
            setValorTotalInput(valorTotal);
            setValorFinalInput(valorTotal - descontoReais);
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

        var removerItem = function (item) {
            var index = getItemIndex(item);
            itens.splice(index, 1);
            atualizarListaItens();
            buscarItemEstadoInicial();
        };

        var setDescontoPorcento = function (desconto) {
            descontoPorcento = desconto;
            setDescontoPorcentoInput(descontoPorcento);
            var valorTotal = calcularValorTotal();
            descontoReais = calcularDescontoReais(descontoPorcento, valorTotal);
            setDescontoReaisInput(descontoReais);
            setValorFinalInput(valorTotal - descontoReais);
        };

        var setDescontoReais = function (desconto) {
            desconto = getMoney(desconto) / 100;
            var valorTotal = calcularValorTotal();
            if (desconto < 0 || desconto > valorTotal) {
                showMessage('O desconto concedido é inválido!');
                setDescontoReaisInput(null);
                setDescontoPorcentoInput(null);
            } else {
                descontoReais = desconto;
                setDescontoReaisInput(descontoReais);
                descontoPorcento = calcularDescontoPorcento(descontoReais, valorTotal);
                setDescontoPorcentoInput(descontoPorcento);
                setValorFinalInput(valorTotal - descontoReais);
            }
        };

        var setDescontoReaisInput = function (desconto) {
            if (desconto == null) {
                $("#descontoReaisLabel").removeClass('active');
                $('#descontoReaisInput').val('');
            } else {
                $("#descontoReaisLabel").addClass('active');
                $('#descontoReaisInput').val(desconto.formatMoney(2, ',', '.'));
            }
        };

        var setDescontoPorcentoInput = function (desconto) {
            if (desconto == null) {
                $("#descontoPorcentoLabel").removeClass('active');
                $('#descontoPorcentoInput').val('');
            } else {
                $("#descontoPorcentoLabel").addClass('active');
                $('#descontoPorcentoInput').val(desconto + ' %');
            }
        };

        var setQuantidade = function (itemId, novaQuantidade) {
            for (i = 0; i < itens.length; i++)
                if (itens[i].item.id == itemId)
                    itens[i].quantidade = novaQuantidade;
            atualizarListaItens();
        };

        var setValorTotalInput = function (valorTotal) {
            $("#valorTotalLabel").addClass('active');
            $("#valorTotalInput").val(valorTotal.formatMoney(2, ',', '.'));
        };

        var setValorFinalInput = function (valorFinal) {
            $("#valorFinalLabel").addClass('active');
            $("#valorFinalInput").val(valorFinal.formatMoney(2, ',', '.'));
        };

    </script>

    <script src="{{ asset('lib/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection
