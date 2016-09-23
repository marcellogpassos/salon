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

                                            <div class="input-field col s9">
                                                <input id="buscarItemInput" name="item" maxlength="255" type="text"
                                                       class="autocomplete" required>
                                                <label for="buscarItemInput">Nome ou c&oacute;digo do item *</label>
                                            </div>

                                            <div class="input-field col s3">
                                                <button class="btn btn-block waves-effect waves-light primary"
                                                        id="adicionarItem" type="button"> Adicionar item
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

                                                    <tbody>
                                                    <tr>
                                                        <td>2205 - BASE MINERAL
                                                            <span class="remover">
                                                                (<a class="special-link" href="">Remover item</a>)
                                                            </span>
                                                        </td>
                                                        <td>R$ 15,00</td>
                                                        <td>
                                                            <div class="input-field">
                                                                <input id="quantidade-01" class="validate quantidade"
                                                                       type="number" value="1">
                                                                <label for="quantidade-01"></label>
                                                            </div>
                                                        </td>
                                                        <td>R$ 15,00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1107 - CORTE DE FRANJA
                                                            <span class="remover">
                                                                (<a class="special-link" href="">Remover item</a>)
                                                            </span>
                                                        </td>
                                                        <td>R$ 50,00</td>
                                                        <td>
                                                            <div class="input-field">
                                                                <input id="quantidade-02" class="validate quantidade"
                                                                       type="number" value="1">
                                                                <label for="quantidade-02"></label>
                                                            </div>
                                                        </td>
                                                        <td>R$ 50,00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1400 - DEPILAÇÃO À CERA
                                                            <span class="remover">
                                                                (<a class="special-link" href="">Remover item</a>)
                                                            </span>
                                                        </td>
                                                        <td>R$ 20,00</td>
                                                        <td>
                                                            <input id="quantidade-03" class="validate quantidade"
                                                                   type="number" value="2">
                                                            <label for="quantidade-03"></label>
                                                        </td>
                                                        <td>R$ 40,00</td>
                                                    </tr>
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
                                                <label for="valorTotalInput">Valor total</label>
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
        $('input.autocomplete').autocomplete({
            data: {
                "Apple": null,
                "Microsoft": null,
                "Google": 'http://placehold.it/250x250'
            }
        });
    </script>
@endsection
