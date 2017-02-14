@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Cadastro efetuado
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {!! $user->name !!}!</p>

    <p>&nbsp;</p>

    <p>Voc&ecirc; foi {{ $user->sexo == 'F' ? 'cadastrada' : 'cadastrado' }} no nosso sistema e a partir de agora pode
        realizar agendamentos de servi&ccedil;os. &Eacute; super simples! Basta acessar nosso site, clicar em
        &quot;Agendar um hor&aacute;rio&quot;, se autenticar com seu nome de usu&aacute;rio e senha e pronto. Voc&ecirc;
        tamb&eacute;m poder&aacute; receber mensagens com novidades e promo&ccedil;&otilde;es diretamente dos
        administradores do {{ env('NOME_ESTABELECIMENTO') }}. Aproveite!</p>

    <p>&nbsp;</p>

    <p>Lembramos que inicialmente as suas credenciais para se autenticar s&atilde;o:</p>

    <p>&nbsp;</p>

    <ul>
        <li><strong>Nome do usu&aacute;rio:</strong> {{ $user->email }}</li>
        <li><strong>Senha:</strong> Sua data de nascimento no formato: &quot;ddMMyy&quot; (Exemplo: se a data de
            nascimento for 04/05/1990, a senha ser&aacute; &quot;040590&quot;).
        </li>
    </ul>

    <p>&nbsp;</p>

    <p><a href="{{ url('/agendamentos') }}">Clique aqui</a> para fazer seu primeiro agendamento.</p>

    <p>&nbsp;</p>


    @include('emails.mensagens.partials.assinatura')
@endsection