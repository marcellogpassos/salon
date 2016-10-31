var clientesPorSexoLabels = ['Feminino', 'Masculino'];
var clientesPorSexoBGColor = ['rgb(255, 205, 210)', 'rgb(197, 202, 233)'];
var clientesPorSexoBorderColor = ['rgb(211, 47, 47)', 'rgb(48, 63, 159)'];
var clientesPorSexoData = [clientesSexoFeminino, clientesSexoMasculino];

var clientesPorSexoCtx = document.getElementById("clientesPorSexoChart");
var clientesPorSexoChart = new Chart(clientesPorSexoCtx, {
	type: 'pie',
	data: {
		labels: ["Feminino", "Masculino"],
		datasets: [{
			label: 'Clientes por Sexo',
			data: clientesPorSexoData,
			backgroundColor: clientesPorSexoBGColor,
			borderColor: clientesPorSexoBorderColor,
			borderWidth: 1
		}]
	}
});