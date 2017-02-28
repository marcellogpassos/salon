@extends('layouts.appm')

@section('title')
    Registrar Compra
@endsection

@section('content')
    <div class="container container-lg" xmlns="http://www.w3.org/1999/html">

        @include('layouts.messages')

        <div class="row">

            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Registrar Compra</h4>

                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m4">
                                @if(isset($cliente))
                                    <strong>Cliente:</strong> {{ $cliente->name . ' ' . $cliente->surname }}
                                @else
                                    <strong>Cliente:</strong> -
                                @endif
                            </div>

                            <div class="col s12 m4">
                                {{ dataPorExtenso() }}
                            </div>

                            <div class="col s12 m4">
                                <strong>Usu&aacute;rio:</strong> {{ $caixa->name . ' ' . $caixa->surname }}
                            </div>
                        </div>

                        <form id="registrarCompraForm" method="POST" onsubmit="return validarForm()"
                              action="{{
                                isset($cliente) ?
                                    url('users/' . $cliente->id . '/registrarCompra') :
                                    url('compras/registrar')
                              }}" role="form">

                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col s12 m9">

                                    <div class="card white">

                                        <h4 class="card-title">Itens</h4>

                                        <div class="card-content gray-text text-darken-4">


                                            <div class="row">

                                                <div class="input-field col s12 m9">
                                                    <input id="buscarItemInput" maxlength="255" type="text"
                                                           class="autocomplete highlight-matching" tabindex="1">
                                                    <label for="buscarItemInput">Nome ou c&oacute;digo do item *</label>
                                                </div>

                                                <div class="input-field col s12 m3">
                                                    <button class="btn btn-block waves-effect waves-light primary"
                                                            id="adicionarItemButton" type="button" tabindex="2">
                                                        Adicionar item
                                                    </button>
                                                </div>

                                            </div>

                                            <div id="autocomplete-loader" class="row" style="display: none">
                                                <div class="col s12 m6 offset-m3" style="text-align: center">
                                                    <img src="{{ asset('img/loading.gif') }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col s12">
                                                    <table class="responsive-table">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="id">Item</th>
                                                            <th data-field="price">Valor unitário</th>
                                                            <th data-field="name">Quantidade</th>
                                                            <th data-field="price">Valor total</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody id="itensTbody">

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
                                                    <i class="material-icons prefix">attach_money</i>
                                                    <input id="valorTotalInput" maxlength="32" tabindex="3"
                                                           class="moeda" type="text" required readonly>
                                                    <label id="valorTotalLabel" for="valorTotalInput">Valor
                                                        total</label>
                                                </div>

                                                <div id="descontoPorcentoDiv" class="input-field col s12 hide">
                                                    <i class="fa fa-percent material-icons prefix" aria-hidden="true"></i>
                                                    <input id="descontoPorcentoInput"
                                                           onchange="setDescontoPorcento(this.value)"
                                                           class="porcento" maxlength="32" type="text">
                                                    <label id="descontoPorcentoLabel" for="descontoPorcentoInput">Desconto
                                                        em Porcento</label>
                                                </div>

                                                <div id="descontoReaisDiv" class="input-field col s12">
                                                    <i class="material-icons prefix">attach_money</i>
                                                    <input id="descontoReaisInput" class="moeda"
                                                           onchange="setDescontoReais(this.value)"
                                                           maxlength="32" type="text">
                                                    <label id="descontoReaisLabel" for="descontoReaisInput">Desconto em
                                                        Reais</label>
                                                </div>

                                                <input id="descontoInput" type="hidden" name="desconto" value="0">

                                                <div class="input-field col s12 m6">
                                                    <div>
                                                    <span>
                                                        <input name="tipoDesconto" type="radio" value="P"
                                                               id="descontoPorcentoRadio" class="tipo-desconto">
                                                        <label for="descontoPorcentoRadio">Porcento</label>
                                                    </span>
                                                    </div>
                                                </div>

                                                <div class="input-field col horizontal-radio s12 m6">
                                                    <div>
                                                    <span>
                                                        <input name="tipoDesconto" type="radio" value="R" checked
                                                               id="descontoReaisRadio" class="tipo-desconto">
                                                        <label for="descontoReaisRadio">Reais</label>
                                                    </span>
                                                    </div>
                                                </div>

                                                <div class="input-field col s12">
                                                    <i class="material-icons prefix">attach_money</i>
                                                    <input id="valorFinalInput" maxlength="32"
                                                           type="text" required readonly>
                                                    <label id="valorFinalLabel" for="valorFinalInput">Valor
                                                        final</label>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col s12">
                                                    <label for="formaPagamentoSelect" class="active">Forma de
                                                        pagamento</label>
                                                    <select id="formaPagamentoSelect" name="formaPagamento"
                                                            class="browser-default" required>
                                                        <option value=""></option>
                                                        @foreach($formasPagamento as $forma)
                                                            <option value="{{$forma->id}}">{{$forma->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12 formaPagamento dinheiro hide">
                                                    <i class="material-icons prefix">attach_money</i>
                                                    <input id="valorPagoInput" maxlength="255" type="text"
                                                           onchange="setValorPago(this.value)"
                                                           class="moeda formaPagamentoField">
                                                    <label id="valorPagoLabel" for="valorPagoInput">Valor pago</label>
                                                </div>

                                                <div class="input-field col s12 troco formaPagamento dinheiro hide">
                                                    <i class="material-icons prefix">attach_money</i>
                                                    <input id="trocoInput" maxlength="255" type="text"
                                                           class="formaPagamentoField" readonly>
                                                    <label id="trocoLabel" for="trocoInput">Troco</label>
                                                </div>

                                                <div class="col s12 formaPagamento cartao hide"
                                                     style="margin-top: 24px">
                                                    <label for="bandeiraCartaoSelect" class="active">
                                                        Bandeira do cart&atilde;o</label>
                                                    <select id="bandeiraCartaoSelect" name="bandeiraCartao"
                                                            class="browser-default formaPagamentoField">
                                                        <option value=""></option>
                                                        @foreach($bandeirasCartoes as $bandeira)
                                                            <option value="{{$bandeira->id}}">{{$bandeira->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="card-action">
                                            <div class="row">
                                                <div class="col s12 grid-example">
                                                    <button class="btn btn-block waves-effect waves-light primary"
                                                            type="submit">
                                                        Finalizar compra
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        var buscarItemSrc = '{{url("/compras/buscarItem")}}';
    </script>
    <script src="{{ asset('js/registrarCompra.js') }}"></script>
    <script src="{{ asset('lib/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection
