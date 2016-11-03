var movimentoMensalLabels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25,
	26, 27, 28, 29, 30, 31];
var movimentoMensalCtx = document.getElementById("movimentoMensalChart");
var movimentoMensalChart = new Chart(movimentoMensalCtx, {
	type: 'bar',
	data: {
		labels: movimentoMensalLabels,
		datasets: [{
			label: 'Número de compras',
			data: movimentoMensalData,
			backgroundColor: 'rgb(197, 202, 233)',
			borderColor: 'rgb(48, 63, 159)',
			borderWidth: 0.5
		}]
	}
});