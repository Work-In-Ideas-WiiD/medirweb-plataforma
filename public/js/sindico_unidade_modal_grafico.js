function modalGrafico(data) {
    var areaChartData = {
        labels  : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [
            {
                label: 'Média de consumo da unidade',
                backgroundColor: '#d42a17',
                borderColor: '#d42a17',
                pointRadius: false,
                pointColor: '#d42a17',
                pointStrokeColor: '#fff',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#fff',
                data: data
            },
            
        ],
        options: {
            scales: {
                yAxes: [{
                    color: "#fff",
                }],
            },
            legend: {
                labels: {
                    fontColor: '#fff'
                }
            }
        }
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChartModal').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    //var temp1 = areaChartData.datasets[1]
    
    barChartData.datasets[0] = temp0
    //barChartData.datasets[1] = temp0
    
    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        legend: {
            labels: {
                fontColor: '#fff'
            },
        },
        scales: {
            yAxes: [{
                fontColor: '#fff',
                gridLines: {
                    color: "#fff",
                    zeroLineColor: "#fff"
                },
                ticks: {
                    fontColor: "#fff"
                }
            }],
            xAxes: [{
                fontColor: '#fff',
                gridLines: {
                    color: "#fff"
                },
                ticks: {
                    fontColor: "#fff"
                }
            }],
            
        }
    }
    
    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
}
