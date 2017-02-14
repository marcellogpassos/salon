var detalharAgendamento = function (modal, id) {

	var url = urlRecuperarAgendamento.replace(':id', id);

	$.getJSON(url, function (data) {
		$(modal + ' .servico').html(data.servico.descricao);
		$(modal + ' .dataHora').html(formatarData( data.data ) + " " + data.hora);
		$(modal + ' .duracaoServico').html(data.servico.duracao);
		$(modal + ' .cliente').html(data.cliente.name + ' ' + data.cliente.surname);
		if (data.profissional)
			$(modal + ' .profissional').html(data.profissional.name + ' ' + data.profissional.surname);
		else
			$(modal + ' .profissional').html('--');
		switch (data.status) {
			case 'C':
				$(modal + ' .status').html('Confirmado');
				break;
			case 'I':
				$(modal + ' .status').html('Não analisado');
				break;
			case 'N':
				$(modal + ' .status').html('Cancelado');
				break;
			default:
				$(modal + ' .status').html('--');
		}
		if (data.data_cancelamento)
			$(modal + ' .status').html('Cancelado');

		var urlRegCompra = urlRegistrarCompra.replace(':id', data.cliente.id);
		$(modal + ' .registrarCompra').attr('href', urlRegCompra);

		$(modal).modal();
		$(modal).modal('open');
	});
};