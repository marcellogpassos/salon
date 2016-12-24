@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Agendamento
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {{ $agendamento->cliente->name }}!</p>

    <p>&nbsp;</p>

    <p>Gostariamos de avisar que o seu agendamento foi registrado com sucesso. Dentro em breve voc&ecirc; receber&aacute;
        outro e-mail informando se o mesmo foi confirmado ou n&atilde;o pela equipe de profissionais do
        <strong>{!! env('NOME_ESTABELECIMENTO') !!}</strong>.
    </p>

    <p>&nbsp;</p>

    @include('emails.agendamentos.partials.detalhar', ['mostraCliente' => false])

    <p>&nbsp;</p>

    @include('emails.agendamentos.partials.assinatura')
@endsection