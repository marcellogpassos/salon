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
        showMessage(getMessage('error', 3));
        $(this).val('');
    }
});

function dateToBrFormat(inputFormat) {
    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }

    var d = new Date(inputFormat);
    
    return [pad(d.getDate() + 1), pad(d.getMonth() + 1), d.getFullYear()].join('/');
}