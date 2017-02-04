@extends('layouts.appm')

@section('title')
    Detalhar compra
@endsection

@section('content')

    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Compra finalizada</h4>

                    @if($compra->data_cancelamento)
                        <div class="row">
                            <div class="col offset-m1 s10">
                                <div id="information-alert" class="card card-alert card-alert-information">
                                    <div class="card-content">
                                        <p>Compra Cancelada em {{ dateToBrFormat($compra->data_cancelamento) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col s12 m4 offset-m2">
                                <p class="dl">
                                    @if(isset($compra->cliente))
                                        <strong>Cliente:</strong>
                                        <a onclick="detalharUsuario('#datalharUsuarioModal', '{{ $compra->cliente->id }}')"
                                           class="special-link">
                                            {{ $compra->cliente->name . ' ' . $compra->cliente->surname }}
                                        </a>
                                    @else
                                        <strong>Cliente:</strong> -
                                    @endif
                                </p>
                                <p class="dl">
                                    <strong>Caixa:</strong>{{$compra->caixa->name . ' ' . $compra->caixa->surname}}
                                </p>
                                <p class="dl">
                                    <strong>Data da compra:</strong>{{dateToBrFormat($compra->data_compra, true)}}
                                </p>
                                <p class="dl">
                                    <strong>C&oacute;digo de valida&ccedil;&atilde;o:</strong>
                                    {{$compra->codigo_validacao}}
                                </p>
                            </div>

                            <div class="col s12 m4">
                                <p class="dl">
                                    <strong>Valor total:</strong>{{moneyFormat($compra->valor_total)}}
                                </p>
                                <p class="dl">
                                    <strong>Desconto:</strong>{{moneyFormat($compra->desconto)}}
                                </p>
                                <p class="dl">
                                    <strong>Valor
                                        final:</strong>{{moneyFormat($compra->valor_total - $compra->desconto)}}
                                </p>
                                <p class="dl">
                                    <strong>Forma de pagamento:</strong>
                                    {{$compra->formaPagamento->descricao}}
                                    @if($compra->formaPagamento->pede_bandeira_cartao)
                                        {{' (' . $compra->bandeiraCartao->descricao . ')' }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m10 offset-m1">
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">shopping_cart</i>Itens
                                        </div>
                                        <div class="collapsible-body">

                                            <table class="bordered highlight responsive-table">

                                                <thead>
                                                <tr>
                                                    <th>Descri&ccedil;&atilde;o</th>
                                                    <th>Quantidade</th>
                                                    <th>Valor unit&aacute;rio</th>
                                                    <th>Valor total</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($compra->itensCompra as $itemCompra)
                                                    <tr>
                                                        <td>
                                                            <div class="chip">
                                                                {{$itemCompra->item->eProduto() ? 'Produto' : 'Serviço'}}
                                                            </div>
                                                            {{$itemCompra->item->id . ' - ' . $itemCompra->item->descricao()}}
                                                        </td>
                                                        <td>{{$itemCompra->quantidade}}</td>
                                                        <td>{{moneyFormat($itemCompra->valor_unitario_corrente)}}</td>
                                                        <td>{{moneyFormat($itemCompra->quantidade * $itemCompra->valor_unitario_corrente)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-action">
                        <div class="row">
                            <div class="col s12 m4 {{ ($compra->data_cancelamento || !Auth::user()->admin()) ? ' offset-m4' : ' offset-m2' }}">
                                <a href="{{ url('compras/' . $compra->codigo_validacao . '/emitirComprovante') }}"
                                   class="waves-effect waves-light btn btn-large btn-block primary" target="_blank">
                                    <i class="material-icons left">print</i>Emitir comprovante
                                </a>
                            </div>

                            @if(!$compra->data_cancelamento && Auth::user()->admin())

                                <form role="form" method="post"
                                      action="{{ url('compras/' . $compra->codigo_validacao . '/cancelar') }}">

                                    {!! csrf_field() !!}

                                    <input type="hidden" name="cancelar" value="1">

                                    <div class="col s6 m4">
                                        <button class="waves-effect waves-light btn btn-large btn-block secondary"
                                                type="submit">
                                            <i class="material-icons left">delete_forever</i>Cancelar Compra
                                        </button>
                                    </div>

                                </form>

                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    @include('users.partials.detalhar')

@endsection

@section('scripts')



@endsection