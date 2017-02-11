var setUfBusy = function (busy) {
    $('.uf').prop('disabled', busy);
    $('.municipio').prop('disabled', busy);
};

var setCepBusy = function (busy) {
    setUfBusy(busy);
    $('.cep').prop('disabled', busy);
    $('.logradouro').prop('disabled', busy);
    $('.numero').prop('disabled', busy);
    $('.bairro').prop('disabled', busy);
    $('.complemento').prop('disabled', busy);
};

var resetUf = function () {
    $('.uf').val('');
    $('.municipio').empty().append('<option selected value=""> -- </option>');
};

var resetCep = function () {
    resetUf();
    $('.cep').val('');
    $('.logradouro').val('');
    $('.numero').val('');
    $('.bairro').val('');
    $('.complemento').val('');
    $('.endereco-label').removeClass('active');
    setCepBusy(false);
};

var setUf = function (uf, municipio) {

    if (uf) {

        var url = urlListarMunicipios.replace(':uf', uf);

        setUfBusy(true);

        $.getJSON(url, function (data) {

            $('.municipio').empty().append(
                '<option selected value=""> -- </option>'
            );

            $.each(data, function () {

                $('.municipio').append(
                    $('<option>', {
                        value: this.id,
                        text: this.nome,
                        selected: municipio == this.id
                    })
                );

            });

            setUfBusy(false);
        });

    } else
        resetUf();

};

var setCep = function (cep) {

    var cep = cep.replace(/\D/g, '');

    if (cep != "") {

        var cepRegex = /^[0-9]{8}$/;

        if (cepRegex.test(cep)) {

            var url = urlConsultarCep.replace(':cep', cep);

            setCepBusy(true);

            $.getJSON(url, function (dados) {
                if (!("erro" in dados)) {
                    $(".logradouro").val(dados.logradouro);
                    $(".bairro").val(dados.bairro);
                    $(".complemento").val(dados.complemento);

                    var uf = dados.ibge.substring(0, 2);

                    $(".uf").val(uf);
                    setUf(uf, dados.ibge);

                    $('.endereco-label').addClass('active');

                    setCepBusy(false);
                } else {
                    resetCep();
                    showMessage(Messages.error[11]);
                }
            });
        } else {
            resetCep();
            showMessage(Messages.error[12]);
        }
    } else {
        resetCep();
    }
};