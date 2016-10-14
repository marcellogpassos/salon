(function ($) {
    $(function () {

        $('.button-collapse').sideNav();

    }); // end of document ready
})(jQuery); // end of jQuery name space

var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var mesesAbrev = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
var diasSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
var diasSemanaAbrev = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];

$(document).ready(function () {

    $('input.data').pickadate({
        format: 'dd/mm/yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        max: new Date(),
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
    });
});

$(document).ready(function () {
    $('select').material_select();
});

jQuery(function ($) {
    $(".data").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
    $(".telefone").mask("(99) 99999999?9");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99.999-999");
    $(".porcento").mask("9?9");
});