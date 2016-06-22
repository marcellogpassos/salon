var detalharUsuario = function (modal, id) {
	$.getJSON(urlRecuperarUsuario.replace('{id}', id), function (data) {
		$(modal + ' .nome').html(data.name + " " + data.surname);

		if (data.cpf) {
			$(modal + ' .nao-cadastrado').hide();
			$(modal + ' .dados').show();

			$(modal + ' .cpf').html(formatarCPF(data.cpf));
			$(modal + ' .sexo').html(data.sexo == 'F' ? 'Feminino' : (data.sexo == 'M' ? 'Masculino' : ''));
			$(modal + ' .dataNascimento').html(formatarDataNascimento(data.data_nascimento));
			$(modal + ' .telefone').html(formatarTelefone(data.telefone));

			$(modal + ' .logradouro').html(data.logradouro);
			$(modal + ' .numero').html(data.numero)
			$(modal + ' .bairro').html(data.bairro);
			$(modal + ' .cep').html(formatarCEP(data.cep));
			$(modal + ' .municipio').html('...');
			$(modal + ' .uf').html('...');
			$(modal + ' .complemento').html(data.complemento);

			enderecosService.getMunicipio(data.uf, data.municipio, function (municipio) {
				$(modal + ' .municipio').html(municipio.nome)
			}, function (error) {
				$(modal + ' .municipio').html(data.municipio);
			});

			enderecosService.getUf(data.uf, function (uf) {
				$(modal + ' .uf').html(uf.sigla);
			}, function (error) {
				$(modal + ' .uf').html(data.uf);
			});
		} else {
			$(modal + ' .nao-cadastrado').show();
			$(modal + ' .dados').hide();
		}

		$(modal).openModal();
	});
};