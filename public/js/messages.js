var format = function (str, args) {
    return str.replace(/{(\d+)}/g, function (match, number) {
        return typeof args[number] != 'undefined' ? args[number] : match;
    });
};

var Messages = {
    error: [
        "Não foi possível carregar a lista de UF's!",                                                                   // 0
        "Não foi possível carregar o endereço! CEP fornecido: {0}",                                                     // 1
        "Não foi possível carregar a lista de Municípios! UF fornecido: {0}",                                           // 2
        "CPF inválido",                                                                                                 // 3
        "O campo {0} é obrigatório",                                                                                    // 4
        "O campo {0} deve ter pelo menos {1} caracteres",                                                               // 5
        "As senhas não conferem",                                                                                       // 6
        "Os e-mails não conferem",                                                                                      // 7
        "E-mail inválido",                                                                                              // 8
        "CEP inválido",                                                                                                 // 9
    ],
    information: [
        "Um link para resetar a senha foi enviado para: {0}"                                                            // 0
    ],
    success: [
        "Usuário cadastrado com sucesso: {0}!",                                                                         // 0
        "Usuário autenticado com sucesso: {0}!"                                                                         // 1
    ],
    warning: [
        ""
    ]
};

var getMessage = function (type, id, args) {
    var messagesScope = null;

    switch (type) {
        case 'error':
            messagesScope = Messages.error; break;
        case 'information':
            messagesScope = Messages.information; break;
        case 'success':
            messagesScope = Messages.success; break;
        case 'warning':
            messagesScope = Messages.warning; break;
        default:
            return null;
    }

    if (!args)
        return messagesScope[id];

    else
        return format(messagesScope[id], args);
}

var showMessage = function (message) {
    Materialize.toast(message, 4000);
};