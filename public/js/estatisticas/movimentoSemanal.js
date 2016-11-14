var movimentoSemanalLabels = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
var movimentoSemanalCtx = document.getElementById("movimentoSemanalChart");
var movimentoSemanalChart = new Chart(movimentoSemanalCtx, {
	type: 'bar',
	data: {
		labels: movimentoSemanalLabels,
		datasets: [{
			label: 'Número de compras',
			data: movimentoSemanalData,
			backgroundColor: 'rgb(197, 202, 233)',
			borderColor: 'rgb(48, 63, 159)',
			borderWidth: 0.5
		}]
	}
});