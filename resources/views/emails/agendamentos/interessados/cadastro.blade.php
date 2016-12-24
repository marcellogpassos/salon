@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Agendamento
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;!</p>

    <p>&nbsp;</p>

    <p>Foi registrado mais um agendamento de servi&ccedil;o pelo website do {!! env('NOME_ESTABELECIMENTO') !!}.
        Queira, por gentileza, analisar o mesmo na <a href="{{ url('/') }}">home da sua &aacute;rea privada</a>.
        Caso n&atilde;o seja poss&iacute;vel realizar o servi&ccedil;o, forne&ccedil;a uma justificativa.
    </p>

    <p>&nbsp;</p>

    @if(isset($agendamento->cliente->telefone))
        <p>Se preferir, voc&ecirc; pode entrar em contato com o cliente pelo telefone:
            <strong>{!! telefoneFormat($agendamento->cliente->telefone) !!}</strong></p>

        <p>&nbsp;</p>
    @endif

    @include('emails.agendamentos.partials.detalhar', ['mostraCliente' => true])

    <p>&nbsp;</p>

    <p>O cliente aguarda a confirma&ccedil;&atilde;o.</p>
@endsection