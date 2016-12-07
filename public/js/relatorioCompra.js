var itemAutocompleteSelector = '.autocomplete.item';
var itemHiddenInputSelector = '#itemHiddenInput';
var clienteAutocompleteSelector = '.autocomplete.cliente';
var clienteHiddenInputSelector = '#clienteHiddenInput';

var codigoValidacaoInput = '#codigoValidacaoInput';

var form = document.forms["relatorioComprasForm"];
var campos = [
    form['codigo_validacao'],
    form['cliente'],
    form['item'],
    form['data_inicial'],
    form['data_final'],
    form['valor_minimo'],
    form['valor_maximo']
];

function validateForm() {
    return (
        validarNenhumCampoFornecido(campos, function () {
            showMessage(Messages.error[17]);
        }) &&
        validarPrecedenciaDatas(form['data_inicial'].value, form['data_final'].value, function () {
            showMessage(Messages.error[18]);
            $('#dataInicialInput').val('');
            $('#dataFinalInput').val('');
        }) &&
        validarRangeValores(form['valor_minimo'].value, form['valor_maximo'].value, function () {
            showMessage(Messages.error[19]);
            $('#valorMinimoInput').val('');
            $('#valorMaximoInput').val('');
        })
    );
}

var validarNenhumCampoFornecido = function (campos, errorCallback) {
    for (i = 0; i < campos.length; i++)
        if (campos[i].value)
            return true;
    errorCallback();
    return false;
};

var validarPrecedenciaDatas = function (dataInicialString, dataFinalString, errorCallback) {
    if (!dataInicialString || !dataFinalString)
        return true;
    var dataInicial = new Date(dataInicialString);
    var dataFinal = new Date(dataFinalString);
    if (dataInicial <= dataFinal)
        return true;
    errorCallback();
    return false;
};

var validarRangeValores = function (valorMinimoString, valorMaximoString, errorCallback) {
    if (!valorMinimoString || !valorMaximoString)
        return true;
    var valorMinimo = valorMinimoString.replace(".", "").replace(",", ".");
    var valorMaximo = valorMaximoString.replace(".", "").replace(",", ".");
    if (valorMinimo <= valorMaximo)
        return true;
    errorCallback();
    return false;
};

$(itemAutocompleteSelector).autocomplete({
    source: buscarItemSrc,
    minLength: 2,
    focus: function (event, ui) {
        $(itemAutocompleteSelector).val(ui.item.label);
        return false;
    },
    select: function (event, ui) {
        $(itemAutocompleteSelector).val(ui.item.label);
        $(itemHiddenInputSelector).val(ui.item.id);
        return false;
    },
    change: function (event, ui) {
        if (!ui.item) {
            $(itemAutocompleteSelector).val('');
            $(itemHiddenInputSelector).val('');
        }
    }
});

$(clienteAutocompleteSelector).autocomplete({
    source: buscarClienteSrc,
    minLength: 2,
    focus: function (event, ui) {
        $(clienteAutocompleteSelector).val(ui.item.label);
        return false;
    },
    select: function (event, ui) {
        $(clienteAutocompleteSelector).val(ui.item.label);
        $(clienteHiddenInputSelector).val(ui.item.id);
        return false;
    },
    change: function (event, ui) {
        if (!ui.item) {
            $(clienteAutocompleteSelector).val('');
            $(clienteHiddenInputSelector).val('');
        }
    }
});

$(codigoValidacaoInput).change(function () {
    var codigoFornecido = $(codigoValidacaoInput).val();
    if (!validarCodigo(codigoFornecido)) {
        $(codigoValidacaoInput).val('');
        showMessage(Messages.error[20]);
    } else
        $(codigoValidacaoInput).val(codigoFornecido.toUpperCase());
});