(function ($) {
    $(function () {

        $('.button-collapse').sideNav({draggable: true});

    }); // end of document ready
})(jQuery); // end of jQuery name space

var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var mesesAbrev = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
var diasSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
var diasSemanaAbrev = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];

$(document).ready(function () {

    var dataGenericaConfig = {
        format: 'dd/mm/yyyy',
        formatSubmit: 'yyyy-mm-dd',

        hiddenName: true,
        selectMonths: true,
        selectYears: 120,

        monthsFull: meses,
        monthsShort: mesesAbrev,
        weekdaysFull: diasSemana,
        weekdaysShort: diasSemanaAbrev,
        showMonthsShort: true,

        today: 'Hoje',
        clear: 'Limpar',
        close: 'Fechar',

        labelMonthNext: 'Próximo mês',
        labelMonthPrev: 'Mês anterior',
        labelMonthSelect: 'Selecione um mês',
        labelYearSelect: 'Selecione um ano'
    };

    var dataPassadaConfig = dataGenericaConfig;
    dataPassadaConfig.min = false;
    dataPassadaConfig.max = true;

    $('input.data-passada').pickadate(dataPassadaConfig);

    var dataFuturaConfig = dataGenericaConfig;
    dataFuturaConfig.min = true;
    dataFuturaConfig.max = false;

    $('input.data-futura').pickadate(dataFuturaConfig);

    try {
        drEvent = $('.dropify').dropify({
            messages: {
                default: 'Arraste um arquivo ou clique aqui',
                replace: 'Arraste um arquivo ou clique para substituir',
                remove: 'Remover',
                error: 'Desculpe, o arquivo é muito grande!'
            }
        });
    }
    catch (err) {
    }

    $('input.char-counter, textarea.char-counter').characterCounter();

    Materialize.updateTextFields();

});

jQuery(function ($) {
    $(".data").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
    $(".telefone").mask("(99) 99999999?9");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99.999-999");
    $(".porcento").mask("9?9");
});