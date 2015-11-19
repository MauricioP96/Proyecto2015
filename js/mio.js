
                       $(document).ready(function () {
     $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares January, 2015 to May, 2015'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Brands",
                colorByPoint: true,
                data: [{
                    name: "Microsoft Internet Explorer",
                    y: 56.33
                }, {
                    name: "Chrome",
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: "Firefox",
                    y: 10.38
                }, {
                    name: "Safari",
                    y: 4.77
                }, {
                    name: "Opera",
                    y: 0.91
                }, {
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 70.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 70.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }, {
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }
                ]
            }]
        });
        $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monto total de cuotas'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Cuota',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0]
        }]
    });
});
