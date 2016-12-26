var detalharUsuario = function (modal, id) {

	var url = urlRecuperarUsuario.replace(':id', id);

	$.getJSON(url, function (data) {
		$(modal + ' .nome').html(data.name + " " + data.surname);

		if (data.dados_atualizados) {
			$(modal + ' .nao-cadastrado').hide();
			$(modal + ' .dados').show();

			$(modal + ' .cpf').html(formatarCPF(data.cpf));
			$(modal + ' .sexo').html(data.sexo == 'F' ? 'Feminino' : (data.sexo == 'M' ? 'Masculino' : ''));
			$(modal + ' .dataNascimento').html(formatarData(data.data_nascimento));
			$(modal + ' .telefone').html(formatarTelefone(data.telefone));
			$(modal + ' .email').html(formatarTelefone(data.email));

			$(modal + ' .logradouro').html(data.logradouro);
			$(modal + ' .numero').html(data.numero);
			$(modal + ' .bairro').html(data.bairro);
			$(modal + ' .cep').html(formatarCEP(data.cep));
			$(modal + ' .municipio').html(data.municipio.nome);
			$(modal + ' .uf').html(data.municipio.uf.sigla);
			$(modal + ' .complemento').html(data.complemento);
			if (data.foto)
				$(modal + ' .foto').attr('src', urlPublic + '/' + data.foto);
			else {
				var foto = (data.sexo == 'M') ? '/img/user-male-icon.png' : '/img/user-female-icon.png';
				$(modal + ' .foto').attr('src', urlPublic + foto);
			}

		} else {
			$(modal + ' .nao-cadastrado').show();
			$(modal + ' .dados').hide();
		}

		$(modal + ' .compras').attr('href', comprasUsuario.replace(':id', data.id));

		$(modal).openModal();
	});
};