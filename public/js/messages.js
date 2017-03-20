var format = function (str, args) {
	return str.replace(/{(\d+)}/g, function (match, number) {
		return typeof args[number] != 'undefined' ? args[number] : match;
	});
};

var Messages = {
	error: [
		"Não foi possível carregar a lista de UF's.",                                                                   // 0
		"Não foi possível carregar o endereço! CEP fornecido: {0}.",                                                    // 1
		"Não foi possível carregar a lista de Municípios! UF fornecido: {0}.",                                          // 2
		"CPF inválido.",                                                                                                // 3
		"O campo {0} é obrigatório.",                                                                                   // 4
		"O campo {0} deve ter pelo menos {1} caracteres.",                                                              // 5
		"As senhas não conferem.",                                                                                      // 6
		"Os e-mails não conferem.",                                                                                     // 7
		"E-mail inválido.",                                                                                             // 8
		"CEP inválido.",                                                                                                // 9
		"Hora inválida.",                                                                                               // 10
		"CEP não encontrado.",                                                                                          // 11
		"CEP em formato inválido.",                                                                                     // 12
		"Nenhum item adicionado.",                                                                                      // 13
		"O desconto concedido é inválido.",                                                                             // 14
		"O valor pago deve ser maior que o valor final.",                                                               // 15
		"A quantidade deve estar entre 0 e {0}.",                                                                       // 16
		"É necessário fornecer pelo menos um campo.",                                                                   // 17
		"A data inicial deve ser anterior à data final.",                                                               // 18
		"O valor mínimo deve ser menor que o valor máximo.",                                                            // 19
		"O código deve conter 6 caracteres apenas letras e números.",                                                   // 20
		"As senhas não conferem.",                                                                                      // 21
		"Nenhum serviço adicionado.",																					// 22
	],
	information: [
		"Um link para resetar a senha foi enviado para: {0}.",                                                          // 0
	],
	success: [
		"Usuário cadastrado com sucesso: {0}!",                                                                         // 0
		"Usuário autenticado com sucesso: {0}!",                                                                        // 1
		"Item adicionado!",                                                                                             // 2
		"Item removido!",                                                                                               // 3
		"Quantidade alterada!",                                                                                         // 4
		"Serviço adicionado!",																							// 5
		"Serviço removido!",																							// 6
	],
	warning: [
		"Item já adicionado.",                                                                                          // 0
	],
	confirmation: [
		"Deseja realmente cancelar o agendamento do serviço?",                                                          // 0
	],
};

var showMessage = function (message) {
	Materialize.toast(message, 4000);
};