<ul>
    @if($mostraCliente)
        <li style="margin: 8px auto">
            <strong>Cliente:&nbsp;</strong>
            <a href="{{ url('/users/buscar?id=' . $agendamento->cliente->id ) }}">
                {{ $agendamento->cliente->name . ' ' . $agendamento->cliente->surname }}
            </a>
        </li>
    @endif
    <li style="margin: 8px auto">
        <strong>Servi&ccedil;o:&nbsp;</strong>
        {{ $agendamento->servico->descricao }}
    </li>
    <li style="margin: 8px auto">
        <strong>Data:&nbsp;</strong>
        {{ dateToBrFormat($agendamento->data) }}
    </li>
    <li style="margin: 8px auto">
        <strong>Hora:&nbsp;</strong>
        {{ $agendamento->hora }}
    </li>
    <li style="margin: 8px auto">
        <strong>Dura&ccedil;&atilde;o aproximada:&nbsp;</strong>
        {{ $agendamento->servico->duracao }}
    </li>
    @if(isset($agendamento->profissional))
        <li style="margin: 8px auto">
            <strong>Profissional de prefer&ecirc;ncia:&nbsp;</strong>
            {{ $agendamento->profissional->name }}
        </li>
    @endif
    <li style="margin: 8px auto">
        <strong>Status do agendamento:&nbsp;</strong>
        {{ \App\Agendamento::getStatusName($agendamento->status) }}
    </li>
    @if(isset($agendamento->justificativa))
        <li style="margin: 8px auto">
            <strong>Justificativa:&nbsp;</strong>
            {{ $agendamento->justificativa }}
        </li>
    @endif
</ul>