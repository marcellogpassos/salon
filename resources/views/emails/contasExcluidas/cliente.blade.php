@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!} - Conta Exclu&iacute;da
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {{ $user->name }}!</p>

    <p>&nbsp;</p>

    <p>Recebemos sua solicita&ccedil;&atilde;o de exclus&atilde;o de conta. Sua conta e seus dados pessoais j&aacute;
        foram apagados dos nossos registros. Sinta-se &agrave; vontade para retornar ao nosso hall de clientes a
        qualquer momento. Sentiremos sua falta!</p>

    <p>&nbsp;</p>

    <p>Cordialmente,</p>

    <p>&nbsp;</p>

    <p style="text-align:right">{!! env('NOME_RESPONSAVEL_ESTABELECIMENTO') !!}</p>

    <p style="text-align:right">{!! env('CARGO_RESPONSAVEL_ESTABELECIMENTO') !!}</p>


@endsection