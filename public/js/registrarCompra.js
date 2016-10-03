var adicionarItemButton = $('#adicionarItemButton');

var descontoPorcentoDiv = $('#descontoPorcentoDiv');
var descontoReaisDiv = $('#descontoReaisDiv');

var buscarItemInput = $("#buscarItemInput");
var descontoInput = $("#descontoInput");
var descontoPorcentoInput = $("#descontoPorcentoInput");
var descontoReaisInput = $("#descontoReaisInput");
var tipoDescontoInput = $(".tipo-desconto");
var trocoInput = $("#trocoInput");
var valorFinalInput = $("#valorFinalInput");
var valorPagoInput = $("#valorPagoInput");
var valorTotalInput = $("#valorTotalInput");

var descontoPorcentoLabel = $("#descontoPorcentoLabel");
var descontoReaisLabel = $("#descontoReaisLabel");
var trocoLabel = $('#trocoLabel');
var valorFinalLabel = $('#valorFinalLabel');
var valorPagoLabel = $('#valorPagoLabel');
var valorTotalLabel = $('#valorTotalLabel');

var formaPagamentoSelect = $("#formaPagamentoSelect");

var itensTbody = $('#itensTbody');

var itens = [];

var itemSelecionado = null;

var descontoPorcento = 0;

var descontoReais = 0;

adicionarItemButton.on('click', function () {
	if (getItemIndex(itemSelecionado.id) != -1) {
		showMessage('Item já adicionado!');
		buscarItemEstadoInicial();
		return;
	}
	itens.push({
		item: itemSelecionado,
		quantidade: 1
	});
	atualizarListaItens();
	resetDesconto();
	resetValorPago();
	showMessage('Item adicionado!');
	buscarItemEstadoInicial();
});

buscarItemInput.autocomplete({
	source: buscarItemSrc,
	minLength: 2,
	focus: function (event, ui) {
		buscarItemInput.val(ui.item.label);
		return false;
	},
	select: function (event, ui) {
		buscarItemInput.val(ui.item.label);
		itemSelecionado = ui.item;
		return false;
	},
	change: function (event, ui) {
		if (!ui.item)
			buscarItemEstadoInicial();
	}
});

tipoDescontoInput.on('change', function () {
	var tipoDescontoSelecionado = $('.tipo-desconto:checked');
	if (tipoDescontoSelecionado.val() == 'P') {
		descontoPorcentoDiv.removeClass('hide');
		descontoReaisDiv.addClass('hide');
	}
	if (tipoDescontoSelecionado.val() == 'R') {
		descontoReaisDiv.removeClass('hide');
		descontoPorcentoDiv.addClass('hide');
	}
});

formaPagamentoSelect.on('change', function () {
	var formaPagamento = formaPagamentoSelect.val();
	if (formaPagamento == 1) {
		$('.dinheiro').removeClass('hide');
		valorPagoInput.prop('required', true);
	} else {
		$('.dinheiro').addClass('hide');
		valorPagoInput.prop('required', false);
	}
});

var atualizarListaItens = function () {
	itensTbody.empty();
	var html = "";
	for (i = 0; i < itens.length; i++) {
		var valorItem = itens[i].quantidade * itens[i].item.valor;
		var descricaoItem = itens[i].item.label;
		var removerItem = '<span class="remover">(<a class="special-link" onclick="removerItem('
			+ itens[i].item.id + ')">Remover item</a>)</span>';
		var colItem = '<td>' + descricaoItem + removerItem + '</td>';
		var colValorUnitario = '<td>' + itens[i].item.valor.formatMoney(2, ',', '.') + '</td>';
		var colQuantidade = '<td><div class="input-field"><input class="validate quantidade" type="number" ' +
			'onchange="setQuantidade(' + itens[i].item.id + ', this.value)" value="' + itens[i].quantidade
			+ '" min="1" max="' + itens[i].item.quantidadeDisponivel + '" id="quantidade' + itens[i].item.id +
			'" name="item[item' + itens[i].item.id + '][quantidade]"></div></td>';
		var colValorTotalItem = '<td>' + valorItem.formatMoney(2, ',', '.') + '</td>';
		var hidden = '<input type="hidden" name="item[item' + itens[i].item.id + '][id]" VALUE="' + itens[i].item.id + '">';
		html += '<tr>' + colItem + colValorUnitario + colQuantidade + colValorTotalItem + hidden + '</tr>';
	}
	itensTbody.html(html);
	var valorTotal = calcularValorTotal();
	defineInput(valorTotalInput, valorTotalLabel, valorTotal, 'M');
	defineInput(valorFinalInput, valorFinalLabel, valorTotal - descontoReais, 'M');
};

var calcularDescontoPorcento = function (descontoReais, valorTotal) {
	return Math.round((descontoReais / valorTotal) * 100);
};

var calcularDescontoReais = function (descontoPorcento, valorTotal) {
	return (descontoPorcento / 100) * valorTotal;
};

var calcularValorTotal = function () {
	var total = 0;
	for (i = 0; i < itens.length; i++)
		total += itens[i].quantidade * itens[i].item.valor;
	return total;
};

var defineInput = function (input, label, valor, formato) {
	label.addClass('active');
	if (formato == 'M')
		input.val(valor.formatMoney(2, ',', '.'));
	if (formato == 'P')
		input.val(valor + ' %');
};

var buscarItemEstadoInicial = function () {
	buscarItemInput.val('');
	buscarItemInput.focus();
};

var getItemIndex = function (itemId) {
	for (i = 0; i < itens.length; i++)
		if (itens[i].item.id == itemId)
			return i;
	return -1;
};

var resetDesconto = function () {
	resetInput(descontoReaisInput, descontoReaisLabel);
	resetInput(descontoPorcentoInput, descontoPorcentoLabel);
	defineInput(valorFinalInput, valorFinalLabel, calcularValorTotal(), 'M');
	descontoReais = descontoPorcento = 0;
};

var resetInput = function (input, label) {
	label.removeClass('active');
	input.val('');
};

var resetValorPago = function () {
	resetInput(valorPagoInput, valorPagoLabel);
	resetInput(trocoInput, trocoLabel);
};

var removerItem = function (item) {
	var index = getItemIndex(item);
	itens.splice(index, 1);
	atualizarListaItens();
	resetDesconto();
	resetValorPago();
	showMessage('Item removido!');
	buscarItemEstadoInicial();
};

var setDescontoPorcento = function (desconto) {
	descontoPorcento = desconto;
	var valorTotal = calcularValorTotal();
	descontoReais = calcularDescontoReais(descontoPorcento, valorTotal);
	descontoInput.val(descontoReais);
	defineInput(descontoPorcentoInput, descontoPorcentoLabel, descontoPorcento, 'P');
	defineInput(descontoReaisInput, descontoReaisLabel, valorTotal - descontoReais, 'M');
	defineInput(valorFinalInput, valorFinalLabel, valorTotal - descontoReais, 'M');
	formaPagamentoSelect.focus();
};

var setDescontoReais = function (desconto) {
	descontoReais = getMoney(desconto) / 100;
	var valorTotal = calcularValorTotal();
	if (validarDesconto(descontoReais, valorTotal)) {
		descontoInput.val(descontoReais);
		descontoPorcento = calcularDescontoPorcento(descontoReais, valorTotal);
		defineInput(descontoReaisInput, descontoReaisLabel, descontoReais, 'M');
		defineInput(descontoPorcentoInput, descontoPorcentoLabel, descontoPorcento, 'P');
		defineInput(valorFinalInput, valorFinalLabel, valorTotal - descontoReais, 'M');
		formaPagamentoSelect.focus();
	}
};

var setQuantidade = function (itemId, novaQuantidade) {
	var itemAlterado = itens[getItemIndex(itemId)];
	if (novaQuantidade > 0 && (novaQuantidade < itemAlterado.item.quantidadeDisponivel || itemAlterado.item.tipoItem == 'S')) {
		itemAlterado.quantidade = novaQuantidade;
		atualizarListaItens();
		resetDesconto();
		resetValorPago();
		showMessage('Quantidade alterada!');
	} else {
		showMessage('A quantidade deve estar entre 0 e ' + itemAlterado.item.quantidadeDisponivel + '!');
		$('#quantidade' + itemAlterado.item.id).val('1');
	}
};

var setValorPago = function (valor) {
	var valorPago = getMoney(valor) / 100;
	var valorFinal = calcularValorTotal() - descontoReais;
	if (validarValorPago(valorPago, valorFinal)) {
		var troco = valorPago - valorFinal;
		defineInput(valorPagoInput, valorPagoLabel, valorPago, 'M');
		defineInput(trocoInput, trocoLabel, troco, 'M');
	}
};

var validarDesconto = function (desconto, valorTotal) {
	if (desconto > 0 && desconto < valorTotal)
		return true;
	showMessage('O desconto concedido é inválido!');
	resetDesconto();
	descontoReaisInput.focus();
	return false;
};

var validarValorPago = function (valorPago, valorFinal) {
	if (valorPago >= valorFinal)
		return true;
	showMessage('O valor pago deve ser maior que o valor final!');
	resetValorPago();
	valorPagoInput.focus();
	return false;
};