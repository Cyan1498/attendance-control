document.addEventListener('DOMContentLoaded', function () {
    totales()
    cargarGraficoAsistenciasSemanales();
})
function totales() {
    axios.get(ruta + 'controllers/adminController.php?option=totales')
        .then(function (response) {
            const info = response.data;
            console.log(info);
            document.querySelector('#totalUsuarios').textContent = info.usuario.total;
            document.querySelector('#totalEst').textContent = info.estudiante.total;
            document.querySelector('#totalAsistencia').textContent = info.asistencia.total;
            document.querySelector('#totalCarreras').textContent = info.carrera.total;
        })
        .catch(function (error) {
            console.log(error);
        });
}

function cargarGraficoAsistenciasSemanales() {
    axios.get(ruta + 'controllers/adminController.php?option=weekAsistencias')
        .then(function (response) {
            const data = response.data;
            console.log(data);
            // Aquí se deben procesar los datos de asistencias semanales y crear el gráfico
            crearGraficoAsistenciasSemanales(data);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function crearGraficoAsistenciasSemanales(data) {
    // Configurar el gráfico con los datos de asistencias semanales
    var options = {
        chart: {
            height: 380,
            type: 'area',
            stacked: false,
        },
        stroke: {
            curve: 'straight'
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val.toFixed(0);
            },
            offsetY: -5,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        series: [{
            name: 'Asistencias',
            data: data
        }],
        xaxis: {
            categories: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']
        },
        tooltip: {
            followCursor: true
        },
        fill: {
            opacity: 1,
        }
    };

    // Crear el gráfico
    var chart = new ApexCharts(document.querySelector('#chart-container'), options);
    chart.render();
}
