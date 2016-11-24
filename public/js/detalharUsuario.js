var detalharUsuario = function (modal, id) {

	var url = urlRecuperarUsuario.replace(':id', id);

	$.getJSON(url, function (data) {
		$(modal + ' .nome').html(data.name + " " + data.surname);

		if (data.cpf) {
			$(modal + ' .nao-cadastrado').hide();
			$(modal + ' .dados').show();

			$(modal + ' .cpf').html(formatarCPF(data.cpf));
			$(modal + ' .sexo').html(data.sexo == 'F' ? 'Feminino' : (data.sexo == 'M' ? 'Masculino' : ''));
			$(modal + ' .dataNascimento').html(formatarDataNascimento(data.data_nascimento));
			$(modal + ' .telefone').html(formatarTelefone(data.telefone));

			$(modal + ' .logradouro').html(data.logradouro);
			$(modal + ' .numero').html(data.numero);
			$(modal + ' .bairro').html(data.bairro);
			$(modal + ' .cep').html(formatarCEP(data.cep));
			$(modal + ' .municipio').html(data.municipio.nome);
			$(modal + ' .uf').html(data.municipio.uf.sigla);
			$(modal + ' .complemento').html(data.complemento);
		} else {
			$(modal + ' .nao-cadastrado').show();
			$(modal + ' .dados').hide();
		}

		$(modal).openModal();
	});
};