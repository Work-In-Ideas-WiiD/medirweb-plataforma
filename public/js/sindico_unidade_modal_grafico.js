function modalGrafico(data) {
    var areaChartData = {
        labels  : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [
            {
                label: 'Média de consumo da unidade',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: data
            },
        ]
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
        datasetFill: false
    }
    
    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
}
