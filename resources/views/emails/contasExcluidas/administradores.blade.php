@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!} - Conta Exclu&iacute;da
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;!</p>

    <p>&nbsp;</p>

    <p>Recebemos uma solicita&ccedil;&atilde;o de exclus&atilde;o de conta:</p>

    <p>&nbsp;</p>

    <ul>
        <li style="margin-top: 8px"><strong>Usu&aacute;rio</strong>: {{ $user->name . ' ' . $user->surname }}</li>
        <li style="margin-top: 8px"><strong>E-mail</strong>: {{ $user->email  }}</li>
        <li style="margin-top: 8px"><strong>Telefone</strong>: {{ telefoneFormat($user->telefone) }}</li>
        <li style="margin-top: 8px"><strong>Motivo</strong>: {{ $contaExcluida->motivo }}</li>
        <li style="margin-top: 8px"><strong>Avalia&ccedil;&atilde;o</strong>: {{ $contaExcluida->stars . ' estrela(s)' }}</li>
    </ul>

    <p>&nbsp;</p>

@endsection