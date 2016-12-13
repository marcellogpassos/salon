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

    $('input.hora').timepicker({
        timeFormat: 'H:mm',
        interval: 30,
        minTime: '8:00',
        maxTime: '18:00',
        //defaultTime: '10:00',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('select').material_select();

    try {
        $('.dropify').dropify({
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

    var todayDate = moment().startOf('day');
    var YM = todayDate.format('YYYY-MM');
    var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
    var TODAY = todayDate.format('YYYY-MM-DD');
    var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        navLinks: true,
        events: [
            {
                title: 'All Day Event',
                start: YM + '-01'
            },
            {
                title: 'Long Event',
                start: YM + '-07',
                end: YM + '-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: YM + '-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: YM + '-16T16:00:00'
            },
            {
                title: 'Conference',
                start: YESTERDAY,
                end: TOMORROW
            },
            {
                title: 'Meeting',
                start: TODAY + 'T10:30:00',
                end: TODAY + 'T12:30:00'
            },
            {
                title: 'Lunch',
                start: TODAY + 'T12:00:00'
            },
            {
                title: 'Meeting',
                start: TODAY + 'T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: TODAY + 'T17:30:00'
            },
            {
                title: 'Dinner',
                start: TODAY + 'T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: TOMORROW + 'T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: YM + '-28'
            }
        ]
    });

});

jQuery(function ($) {
    $(".data").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
    $(".telefone").mask("(99) 99999999?9");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99.999-999");
    $(".porcento").mask("9?9");
});