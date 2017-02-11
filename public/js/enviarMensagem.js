var enviarMensagem = function (modal, id) {

	var url = urlRecuperarUsuario.replace(':id', id);

	$.getJSON(url, function (data) {

		$(modal + ' .assunto').val("");
		$(modal + ' .mensagem').val("");

		if (data.email) {
			$(modal + ' .nome').val(data.name + " " + data.surname);
			$(modal + ' .email').val(data.email);
			$(modal + ' .id').val(data.id);
			$(modal + ' .usuario-sem-email').hide();
			$(modal + ' .usuario-com-email').show();
		} else {
			$(modal + ' .usuario-sem-email').show();
			$(modal + ' .usuario-com-email').hide();
		}

		$(modal).modal();
		$(modal).modal('open');

		Materialize.updateTextFields();

	});
};