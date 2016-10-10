<!DOCTYPE html>
<html lang="pt-BR" ng-app="blank">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style rel="stylesheet">
        p, pre {
            line-height: 100% !important;
            font-family: "Courier New";
            font-size: 8pt;
        }

        pre.inline {
            display: inline;
        }

        div.main {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
<div class="main">
    <p>___________________________________________________________</p>
    <p><br></p>
    <pre>{{mb_str_pad('SALON PROJECT', 60, ' ', STR_PAD_BOTH )}}</pre>
    <p><br></p>
    <pre>{{mb_str_pad('RECIBO DE COMPRA', 60, ' ', STR_PAD_BOTH )}}</pre>
    <p><br></p>
    <p>-----------------------------------------------------------</p>
    <pre>COD.  ITEM                         QNTD. VAL.UNI. VAL.TOT.</pre>
    <p>-----------------------------------------------------------</p>
    @foreach($compra->itensCompra as $itemCompra)
        <p>
        <pre class="inline">{{mb_str_pad($itemCompra->item->id, 5, ' ', STR_PAD_RIGHT)}}</pre>
        <pre class="inline">{{mb_str_pad(itemComprovanteCompra($itemCompra->item->descricao(), 30), 30, ' ', STR_PAD_RIGHT)}}</pre>
        <pre class="inline">{{mb_str_pad($itemCompra->quantidade, 4, ' ', STR_PAD_BOTH)}}</pre>
        <pre class="inline">{{mb_str_pad(number_format((float)$itemCompra->valor_unitario_corrente, 2, ',', ''), 8, ' ', STR_PAD_LEFT)}}</pre>
        <pre class="inline">{{mb_str_pad(number_format((float)($itemCompra->quantidade * $itemCompra->valor_unitario_corrente), 2, ',', ''), 8, ' ', STR_PAD_LEFT)}}</pre>
        </p>
    @endforeach
    <p>-----------------------------------------------------------</p>
    <pre>VALOR TOTAL:{{mb_str_pad(moneyFormat($compra->valor_total), 46, ' ', STR_PAD_LEFT)}}</pre>
    <pre>DESCONTO:{{mb_str_pad(moneyFormat($compra->desconto), 49, ' ', STR_PAD_LEFT)}}</pre>
    <p>-----------------------------------------------------------</p>
    <pre>VALOR FINAL:{{mb_str_pad(moneyFormat($compra->valor_total - $compra->desconto), 46, ' ', STR_PAD_LEFT)}}</pre>
    <p>-----------------------------------------------------------</p>
    <p><br></p>
    <pre>FORMA DE PAGAMENTO:{{mb_str_pad(strtoupper($compra->formaPagamento->descricao), 39, ' ', STR_PAD_LEFT)}}</pre>
    @if(isset($compra->cliente))
        <pre>CLIENTE:{{ mb_str_pad(strtoupper($compra->cliente->name . ' ' . $compra->cliente->surname), 50, ' ', STR_PAD_LEFT ) }}</pre>
    @endif
    <pre>CAIXA:{{mb_str_pad(strtoupper($compra->caixa->name . ' ' . $compra->caixa->surname), 52, ' ', STR_PAD_LEFT)}}</pre>
    <pre>DATA E HORA:{{mb_str_pad($compra->data_compra, 46, ' ', STR_PAD_LEFT)}}</pre>
    <p><br></p>
    <p>-----------------------------------------------------------</p>
    <pre>C&Oacute;DIGO DE VALIDA&Ccedil;&Atilde;O:{{mb_str_pad($compra->codigo_validacao, 38, ' ', STR_PAD_LEFT)}}</pre>
    <p>-----------------------------------------------------------</p>
    <p><br></p>
    <pre>{{mb_str_pad('OBRIGADO E VOLTE SEMPRE', 60, ' ', STR_PAD_BOTH )}}</pre>
    <p><br></p>
    <p>___________________________________________________________</p>
</div>
</body>