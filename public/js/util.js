var validarCpf = function (cpf) {
    if (!cpf || cpf.length != 11 || cpf == "00000000000" || cpf == "99999999999")
        return false;
    var soma = 0;
    var resto;
    for (i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11))
        resto = 0;
    if (resto != parseInt(cpf.substring(9, 10)))
        return false;
    soma = 0;
    for (i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11))
        resto = 0;
    if (resto != parseInt(cpf.substring(10, 11)))
        return false;
    return true;
};

$('.cpf').change(function () {
    var cpf = $(this).val().replace(/\D/g, '');

    if (!validarCpf(cpf)) {
        showMessage(Messages.error[3]);
        $(this).val('');
    }
});

function formatarData(input) {
    if (!input)
        return null;

    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }

    var d = new Date(input);

    return [pad(d.getDate() + 1), pad(d.getMonth() + 1), d.getFullYear()].join('/');
}

function formatarCPF(input) {
    if (!input || input.length != 11)
        return input;
    return input.substring(0, 3) + '.' + input.substring(3, 6) + '.' + input.substring(6, 9) + '-' + input.substring(9);
}

function formatarCEP(input) {
    if (!input || input.length != 8)
        return input;
    return input.substring(0, 3) + '.' + input.substring(3, 6) + '-' + input.substring(6);
}

function formatarTelefone(input) {
    if (!input || input.length < 10 || input.length > 12)
        return input;
    return '(' + input.substring(0, 2) + ') ' + input.substring(2);
}

function formatarHoraMinuto(time) {
    var result = false, m;
    var re = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
    if ((m = time.match(re))) {
        result = (m[1].length === 2 ? "" : "0") + m[1] + ":" + m[2];
    }
    return result;
}

function validarCodigo(code) {
    if (/[^a-zA-Z0-9]/.test(code) || code.length != 6)
        return false;
    return true;
}