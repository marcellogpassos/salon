@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Mensagem
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {!! $mensagem->destinatario->name !!}!</p>

    <p>&nbsp;</p>

    <p>
        {!! $mensagem->mensagem !!}
    </p>

    <p>&nbsp;</p>

    @include('emails.mensagens.partials.assinatura')
@endsection