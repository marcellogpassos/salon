var clientesPorBairroCtx = document.getElementById("clientesPorBairroChart");
var clientesPorBairroChart = new Chart(clientesPorBairroCtx, {
    type: 'pie',
    data: {
        labels: clientesPorBairroLabels,
        datasets: [{
            label: 'Clientes por Sexo',
            backgroundColor: [
                '#303F9F',
                '#3F51B5',
                '#536DFE',
                '#C5CAE9',
                '#FFFFFF',
                '#434343'
            ],
            borderColor: '#BDBDBD',
            data: clientesPorBairroData,
            borderWidth: 0.5
        }]
    },
    options: {
        legend: {
            position: 'bottom',
        }
    }
});