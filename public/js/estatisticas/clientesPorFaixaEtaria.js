var clientesPorFaixaEtariaCtx = document.getElementById("clientesPorFaixaEtariaChart");
var clientesPorFaixaEtariaChart = new Chart(clientesPorFaixaEtariaCtx, {
	type: 'horizontalBar',
	data: {
		labels: clientesPorFaixaEtariaLabels,
		datasets: [{
			label: 'Número de clientes',
			data: clientesPorFaixaEtariaData,
			backgroundColor: 'rgb(197, 202, 233)',
			borderColor: 'rgb(48, 63, 159)',
			borderWidth: 0.5
		}]
	}
});