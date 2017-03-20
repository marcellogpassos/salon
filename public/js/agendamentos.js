var setServicosBusy = function (busy) {
	$('.categorias-servico').prop('disabled', busy);
	$('.servicos').prop('disabled', busy);
};

var resetServicos = function () {
	$('.categorias-servico').val('');
	$('.servicos').empty().append('<option selected value=""> -- </option>');
	$('.profissionais').val('');
	$('.profissionais').prop('disabled', true);
};

var resetProfissional = function () {
	$('.profissionais').val('');
};

var setCategoriaServico = function (categoria) {
	if (categoria) {
		var url = urlListarServicosPorCategoria.replace(':categoria', categoria);
		setServicosBusy(true);
		$.getJSON(url, function (data) {

			$('.servicos').empty().append(
				'<option selected value=""> -- </option>'
			);

			$.each(data, function () {

				$('.servicos').append(
					$('<option>', {
						value: this.id,
						text: this.descricao
					})
				);

			});

			setServicosBusy(false);
		});
	} else
		resetServicos();
};

var setServico = function (servico) {
	resetProfissional();
	if (servico) {
		var url = urlProfissionaisPorServico.replace(':servico', servico);
		$.getJSON(url, function (data) {

			$('.profissionais').empty().append(
				'<option selected value=""> -- </option>'
			);

			$.each(data, function () {

				$('.profissionais').append(
					$('<option>', {
						value: this.id,
						text: this.name
					})
				);

			});

			$('.profissionais').prop('disabled', false);
		});
	}
	else
		$('.profissionais').prop('disabled', true);
};

var cancelarAgendamento = function (agendamentoId) {
	var url = urlCancelarAgendamento.replace(':id', agendamentoId);
	$('#formCancelarAgendamento').attr('action', url);
	$('#confirmarCancelarAgendamento').modal();
	$('#confirmarCancelarAgendamento').modal('open');
};

$('#modalCancelar').click(function () {
	$('#confirmarCancelarAgendamento').closeModal({
		complete: function () {
			$('#formCancelarAgendamento').removeAttr('action');
		}
	});
});

$('#modalConfirmar').click(function () {
	$('#formCancelarAgendamento').submit();
});

$('.hora').change(function () {
	var valorInserido = this.value;
	var hora = formatarHoraMinuto(valorInserido);
	if (hora)
		this.val(hora);
	else {
		showMessage(Messages.error[10]);
		this.value = ''
	}
});

var adicionarServicoRow = function (id, servico, profissional) {
	var servicoRowId = 'servico-row-' + id;
	var removerFunction = 'removerServico(' + id + ')';

	var html = '<tr id="{servicoRowId}">';
	html += '<td class="tooltipped" data-position="top" data-delay="50" data-tooltip="{profissional}">{servico}</td>'
	html += '<td><i onclick="{removerFunction}" class="material-icons">delete</i></td>'
	html += '</tr>';

	html = html.replace('{servicoRowId}', servicoRowId);
	html = html.replace('{profissional}', profissional);
	html = html.replace('{servico}', servico);
	html = html.replace('{removerFunction}', removerFunction);

	$("#servico-row").append(html);
	$('.tooltipped').tooltip({delay: 50});
};

var adicionarServicoInput = function (id, servico, profissional) {
	var servicoInputId = 'servico-input-' + id;
	var profissionalInputId = 'profissional-input-' + id;
	var servicoInputName = 'servicos[' + id + ']';
	var profissionalInputName = 'profissionais[' + id + ']';

	var html = '<input id="{servicoInputId}" type="hidden" name="{servicoInputName}" value="{servico}">';
	html += '<input id="{profissionalInputId}" type="hidden" name="{profissionalInputName}" value="{profissional}">';

	html = html.replace('{servicoInputId}', servicoInputId);
	html = html.replace('{profissionalInputId}', profissionalInputId);
	html = html.replace('{servicoInputName}', servicoInputName);
	html = html.replace('{profissionalInputName}', profissionalInputName);
	html = html.replace('{servico}', servico);
	html = html.replace('{profissional}', profissional);

	$("#servico-input").append(html);
};

var servicosAdicionadosId = 0;
var servicosAdicionadosCount = 0;

var adicionarServico = function () {
	var servicoId = $("#servicoInput").val();
	var profissionalId = $("#profissionalInput").val();
	var servicoName = $("#servicoInput option:selected").text();
	var profissionalName = $("#profissionalInput option:selected").text();

	adicionarServicoRow(servicosAdicionadosId, servicoName, profissionalName);
	adicionarServicoInput(servicosAdicionadosId, servicoId, profissionalId);
	servicosAdicionadosId++;
	servicosAdicionadosCount++;

	if (servicosAdicionadosCount > 0) {
		$('#nenhum-servico-alert').hide();
		$("#servicos-table").show();
	}

	resetServicos();
	showMessage(Messages.success[5]);
};

var removerServico = function (id) {
	$('#servico-row-' + id).remove();
	$('#servico-input-' + id).remove();
	$('#profissional-input-' + id).remove();
	showMessage(Messages.success[6]);
	servicosAdicionadosCount--;

	if (servicosAdicionadosCount < 1) {
		$("#servicos-table").hide();
		$('#nenhum-servico-alert').show();
	}
};

var validarForm = function () {
	if (servicosAdicionadosCount < 1) {
		showMessage(Messages.error[22]);
		return false;
	} else
		return true;
};