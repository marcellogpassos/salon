var validarSenhas = function () {
	var novaSenha = $(formSelector + ' input[name = new-password]').val();
	var confirmacao = $(formSelector + ' input[name = confirm-new-password]').val();
	return (novaSenha == confirmacao);
};

$(formSelector).submit(function () {
	if (validarSenhas(this))
		return true;

	else {
		showMessage(Messages.error[21]);
		$(formSelector + ' input[name = new-password]').val('');
		$(formSelector + ' input[name = confirm-new-password]').val('');
		return false;
	}
});