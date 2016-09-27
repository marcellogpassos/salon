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
                                                <input id="valorTotalInput" name="valorTotal" maxlength="255"
                                                       type="text" required readonly>
                                                <label id="valorTotalLabel" for="valorTotalInput">Valor total</label>
                                            </div>

                                            <div class="input-field col s12">
                                                <input id="descontoInput" name="desconto" maxlength="255" type="text">
                                                <label for="descontoInput">Desconto</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <div>
                                                    <spam>
                                                        <input name="tipoDesconto" type="radio" value="P"
                                                               id="descontoPorcentoInput">
                                                        <label for="descontoPorcentoInput">Porcento</label>
                                                    </spam>
                                                </div>
                                            </div>

                                            <div class="input-field col horizontal-radio s12 m6">
                                                <div>
                                                    <spam>
                                                        <input name="tipoDesconto" type="radio" id="descontoReaisInput"
                                                               value="R" checked>
                                                        <label for="descontoReaisInput">Reais</label>
                                                    </spam>
                                                </div>
                                            </div>

                                            <div class="input-field col s12">
                                                <input id="valorFinalInput" name="valorFinal" maxlength="255"
                                                       type="text" required readonly>
                                                <label for="valorFinalInput">Valor final</label>
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
                        estadoInicial();
                }
            });
        });

        var itens = [];

        var itemSelecionado = null;

        var atualizarListaItens = function () {
            $("#itensTableBody").empty();
            html = "";
            for (i = 0; i < itens.length; i++) {
                html += '<tr><td>' + itens[i].item.label;
                html += '<span class="remover">(<a class="special-link" onclick="removerItem(';
                html += itens[i].item.value + ')">Remover item</a>)</span></td><td>' + itens[i].item.valor + '</td><td>';
                html += '<div class="input-field"><input class="validate quantidade" type="number" onchange="setQuantidade(';
                html += itens[i].item.value + ', this.value)" value="' + itens[i].quantidade + '" min="1" max="';
                html += itens[i].item.quantidade + '"></div></td><td>' + itens[i].quantidade * itens[i].item.valor + '</td></tr>';
            }
            $("#itensTableBody").html(html);
            calcularValorTotal();
        };

        var adicionarItem = function () {
            itens.push({
                item: itemSelecionado,
                quantidade: 1
            });
            atualizarListaItens();
            estadoInicial();
        };

        var calcularValorTotal = function () {
            total = 0;
            for (i = 0; i < itens.length; i++)
                total += itens[i].quantidade * itens[i].item.valor;
            $("#valorTotalLabel").addClass('active');
            $("#valorTotalInput").val(total);
        };

        var estadoInicial = function () {
            $("#buscarItemInput").val('');
            $("#buscarItemInput").focus();
        };

        var getItemIndex = function (itemValue) {
            for (i = 0; i < itens.length; i++)
                if (itens[i].item.value == itemValue)
                    return i;
        };

        var removerItem = function (item) {
            index = getItemIndex(item);
            itens.splice(index, 1);
            atualizarListaItens();
            estadoInicial();
        };

        var setQuantidade = function (itemValue, novaQuantidade) {
            for (i = 0; i < itens.length; i++)
                if (itens[i].item.value == itemValue)
                    itens[i].quantidade = novaQuantidade;
            atualizarListaItens();
        };

    </script>
@endsection
