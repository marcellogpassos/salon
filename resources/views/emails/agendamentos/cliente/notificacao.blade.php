@extends('layouts.email')

@section('title')
    {!! env('NOME_ESTABELECIMENTO') !!}&nbsp;- Agendamento
@endsection

@section('body')
    <p>&nbsp;</p>

    <p>Ol&aacute;, {{ $cliente->name }}!</p>

    <p>&nbsp;</p>

    <p>Gostariamos de avisar que o seu agendamento foi registrado com sucesso. Dentro em breve voc&ecirc; receber&aacute;
        outro e-mail informando se o mesmo foi confirmado ou n&atilde;o pela equipe de profissionais do
        <strong>{!! env('NOME_ESTABELECIMENTO') !!}</strong>.
    </p>

    <p>&nbsp;</p>

    @foreach($agendamentos as $agendamento)

        <ul>
            <li style="margin: 8px auto">
                <strong>Servi&ccedil;os:&nbsp;</strong>
                <?php $servico = \App\Servico::find($agendamento['servico_id']); ?>
                {{ $servico->descricao }}
            </li>
            <li style="margin: 8px auto">
                <strong>Data:&nbsp;</strong>
                {{ dateToBrFormat($agendamento['data']) }}
            </li>
            <li style="margin: 8px auto">
                <strong>Hora:&nbsp;</strong>
                {{ $agendamento['hora'] }}
            </li>
            <li style="margin: 8px auto">
                <strong>Dura&ccedil;&atilde;o aproximada:&nbsp;</strong>
                {{ $servico->duracao }}
            </li>
            @if(isset($agendamento->profissional))
                <li style="margin: 8px auto">
                    <strong>Profissional de prefer&ecirc;ncia:&nbsp;</strong>
                    {{ \App\User::find($agendamento['profissional_id']->name) }}
                </li>
            @endif
        </ul>

        <p>&nbsp;</p>

    @endforeach

    @include('emails.agendamentos.partials.assinatura')
@endsection