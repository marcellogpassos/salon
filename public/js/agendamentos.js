var setServicosBusy = function (busy) {
    $('.categorias-servico').prop('disabled', busy);
    $('.servicos').prop('disabled', busy);
};

var resetServicos = function () {
    $('.categorias-servico').val('');
    $('.servicos').empty().append('<option selected value=""> -- </option>');
    $('.profissionais').val('');
    $('.profissionais').prop('disabled', true);
};

var resetProfissional = function () {
    $('.profissionais').val('');
};

var setCategoriaServico = function (categoria) {
    if (categoria) {
        var url = urlListarServicosPorCategoria.replace(':categoria', categoria);
        setServicosBusy(true);
        $.getJSON(url, function (data) {

            $('.servicos').empty().append(
                '<option selected value=""> -- </option>'
            );

            $.each(data, function () {

                $('.servicos').append(
                    $('<option>', {
                        value: this.id,
                        text: this.descricao
                    })
                );

            });

            setServicosBusy(false);
        });
    } else
        resetServicos();
};

var setServico = function (servico) {
    resetProfissional();
    if (servico){
        var url = urlProfissionaisPorServico.replace(':servico', servico);
        $.getJSON(url, function (data) {

            $('.profissionais').empty().append(
                '<option selected value=""> -- </option>'
            );

            $.each(data, function () {

                $('.profissionais').append(
                    $('<option>', {
                        value: this.id,
                        text: this.name + ' ' + this.surname
                    })
                );

            });

            $('.profissionais').prop('disabled', false);
        });
    }        
    else
        $('.profissionais').prop('disabled', true);
};