@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Agendamento
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {!! $agendamento->cliente->name !!}!</p>

    <p>&nbsp;</p>

    @if($agendamento->status == \App\Agendamento::CONFIRMADO)
        <p>Gostariamos de avisar que o seu agendamento foi confirmado pela equipe de profissionais do
            {!! env('NOME_ESTABELECIMENTO') !!}. Agora &eacute; s&oacute; esperar a hora chegar para desfrutar
            do melhor serviço realizado pelos melhores profissionais.
        </p>
    @endif

    @if($agendamento->status == \App\Agendamento::NEGADO)
        <p>Infelizmente n&atilde;o ser&aacute; poss&iacute;vel realizar o servi&ccedil;o no hor&aacute;rio
            informado. As raz&otilde;es s&atilde;o apresentadas logo em seguida. Entraremos em contato em breve
            para descobrir o melhor hor&aacute;rio tanto para n&oacute;s quanto para voc&ecirc;, ok?
        </p>
    @endif

    <p>&nbsp;</p>

    @include('emails.agendamentos.partials.detalhar', ['mostraCliente' => false])

    <p>&nbsp;</p>

    @include('emails.agendamentos.partials.assinatura')
@endsection