document.addEventListener('DOMContentLoaded', function () {
    totales();
    cargarGraficoAsistenciasSemanales();
    cargarGraficoCanalChimbote(); 
    cargarGraficoCanalNvChimbote(); 

    document.getElementById('sedeSelect').addEventListener('change', function () {
        cargarGraficoAsistenciasSemanales();
    });
});

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
    var sede = document.getElementById('sedeSelect').value;
    console.log(sede);
    
    axios.get(ruta + 'controllers/adminController.php?option=weekAsistencias&sede=' + sede)
        .then(function (response) {
            const info = response.data;
            console.log(info);
            // Eliminar el gráfico existente si existe
            var chartContainer = document.querySelector('#chart-container');
            if (chartContainer) {
                chartContainer.innerHTML = ''; // Eliminar todo el contenido dentro del contenedor
            }
            crearGraficoAsistenciasSemanales(info);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function crearGraficoAsistenciasSemanales(data) {
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

    var chart = new ApexCharts(document.querySelector('#chart-container'), options);
    chart.render();
}

function cargarGraficoCanalChimbote() {
    axios.get(ruta + 'controllers/adminController.php?option=canalChimbote')
        .then(function (response) {
            const data = response.data;
            console.log(data);
            // Destruir el gráfico actual si existe
            var chart = document.querySelector('#chart-container-chimbote');
            if (chart) {
                ApexCharts.exec('chart', 'destroy');
            }
            crearGraficoCanalChimbote(data);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function crearGraficoCanalChimbote(data) {
    var options = {
        series: data,
        chart: {
            width: 380,
            type: 'donut',
        },
        labels: ['Ingeniería', 'Letras', 'Medicina'], // Nombres de los canales
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return val.toFixed(0)+ '%';
            }
        },
        legend: {
            formatter: function (val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex];
            }
        },
        title: {
            // text: 'Cantidad de estudiantes por canal'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart-container-chimbote"), options);
    chart.render();
}


function cargarGraficoCanalNvChimbote() {
    axios.get(ruta + 'controllers/adminController.php?option=canalNvChimbote')
        .then(function (response) {
            const data = response.data;
            console.log(data);
            // Destruir el gráfico actual si existe
            var chart = document.querySelector('#chart-container-canales');
            if (chart) {
                ApexCharts.exec('chart', 'destroy');
            }
            crearGraficoCanalNvChimbote(data);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function crearGraficoCanalNvChimbote(data) {
    var options = {
        series: data,
        chart: {
            width: 380,
            type: 'donut',
        },
        labels: ['Ingeniería', 'Letras', 'Medicina'], // Nombres de los canales
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return val.toFixed(0)+ '%';
            }
        },
        legend: {
            formatter: function (val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex];
            }
        },
        title: {
            // text: 'Cantidad de estudiantes por canal'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart-container-NvChimbote"), options);
    chart.render();
}