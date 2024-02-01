<script>

function drawDonut(Series , Labels, Currency_symbol=''){

    const apexChart = "#aggregate_accounts";

    var arraySeries = Series.match(/\d+(?:\.\d+)?/g).map(Number)

    var options = {
        series: arraySeries,
        labels: Labels,
        chart: {
            width: 320,
            type: 'donut',
        },
        tooltip: {
            enabled: true,
            x: {
                    formatter: function(x){
                        //
                    }
                },
            y: {
                  formatter: function(val) {
                    return Currency_symbol+' '+Number(val).toLocaleString()
                  },
                  title: {
                    formatter: function (seriesName) {
                      return seriesName+':';
                    }
                  }
                }
        },
        legend: {
              show: true,
              showForSingleSeries: false,
              showForNullSeries: true,
              showForZeroSeries: true,
              position: 'bottom',
              horizontalAlign: 'center',
              floating: false,
              fontSize: '10px',
              fontFamily: 'Helvetica, Arial',
              fontWeight: 400,
              formatter: undefined,
              inverseOrder: false,
              width: undefined,
              height: undefined,
              tooltipHoverFormatter: undefined,
              customLegendItems: [],
              offsetX: 0,
              offsetY: 0,
              labels: {
                  colors: undefined,
                  useSeriesColors: false
              },
              markers: {
                  width: 12,
                  height: 12,
                  strokeWidth: 0,
                  strokeColor: '#fff',
                  fillColors: undefined,
                  radius: 12,
                  customHTML: undefined,
                  onClick: undefined,
                  offsetX: 0,
                  offsetY: 0
              },
              itemMargin: {
                  horizontal: 5,
                  vertical: 0
              },
              onItemClick: {
                  toggleDataSeries: true
              },
              onItemHover: {
                  highlightDataSeries: true
              },
          },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector(apexChart), options);
    chart.render();
}

//---------------------------------------------------------------------------------------
function drawBars(id, Series, Categories, height_px=340){

    var element = document.getElementById(id);
    if (!element) {
        return;
    }
    var options = {
        series: Series,
        chart: {
            type: 'bar',
            height: height_px,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: ['30%'],
                endingShape: 'rounded'
            },
        },
        legend: {
            show: true
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: Categories,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: KTApp.getSettings()['font-family']
            },
            y: {
                formatter: function (val) {
                    /*var currency_symbol = '{{ config('languages.lang.'.session('locale').'.currency_symbol') }}';
                    var amount = Number(val).toLocaleString();
                    return currency_symbol + ' '+amount*/
                    return Number(val).toLocaleString();
                }
            }
        },
        colors: [KTApp.getSettings()['colors']['theme']['base']['primary'], KTApp.getSettings()['colors']['theme']['base']['danger'],KTApp.getSettings()['colors']['theme']['base']['warning']],
        grid: {
            borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();

}

</script>
