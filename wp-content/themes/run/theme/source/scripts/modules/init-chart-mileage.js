import Chart from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';

const init_chart_mileage = () => {

  Chart.plugins.unregister(ChartDataLabels);
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var config = {
    type: 'line',
    data: {
      labels:  MONTHS,
      datasets: [
        {
          cubicInterpolationMode: 'monotone',
          label: 'Киллометраж',
          backgroundColor: '#000000',
          borderColor: '#000000',
          lineTension: 0,
          pointStyle: 'rect',
          pointRadius: 5,
          pointHoverRadius: 5,
          data: [
            150,
            163,
            160,
            170,
            180,
            183,
            189,
            192,
            190,
            210,
            220,
            212,
            230,
            242,
          ],
          fill: false,
          yAxisID: 'y-axis-1',
          datalabels: {
            color: '#000000',
          }
        }, {
          cubicInterpolationMode: 'monotone',
          label: 'Количество тренировок',
          fill: false,
          backgroundColor: '#a0a0a0',
          borderColor: '#a0a0a0',
          lineTension: 0,
          pointStyle: 'rect',
          pointRadius: 5,
          pointHoverRadius: 5,
          // spanGaps: true,
          data: [
            15,
            16,
            15,
            20,
            19,
            20,
            21,
            24,
            20,
            23,
            22,
            26,
            25,
            23
          ],
          yAxisID: 'y-axis-2',
          datalabels: {
            color: '#a0a0a0',
          }
        }]
    },
    plugins: [ChartDataLabels],
    options: {
      layout: {
        padding: {
          top: 20,
        }
      },
      plugins: {
        // Change options for ALL labels of THIS CHART
        datalabels: {
          align: 'end',
          anchor: 'end',
          offset: 2,
          font: {
            family: 'Montserrat',
            style: 700,
            size: 14
          },
        }
      },
      title: {
        display: false,
      },
      legend: {
        display: false,
      },
      tooltips: false,
      responsive: false,
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Месяц',
            fontFamily: 'Montserrat',
            fontStyle: '700',
            fontSize: 14,
            fontColor: '#000000',
          }
        }],
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
            stacked: true,
            display: true,
            position: 'left',
            scaleLabel: {
              display: true,
              labelString: 'Километры',
              fontFamily: 'Montserrat',
              fontStyle: '700',
              fontSize: 14,
              fontColor: '#000000',
            },
            id: 'y-axis-1',
          },
          {
            // stacked: true,
            ticks: {
              min: 10,
              max: 50,
              stepSize: 5,
              beginAtZero: false,
            },
            display: true,
            position: 'right',
            scaleLabel: {
              display: true,
              labelString: 'Тренировки',
              fontFamily: 'Montserrat',
              fontStyle: '700',
              fontSize: 14,
              fontColor: '#000000',
            },
            id: 'y-axis-2',
            gridLines: {
              drawOnChartArea: false, // only want the grid lines for one axis to show up
            },
          },
        ]
      }
    }
  };

  var ctx = document.getElementById('distance-chart').getContext('2d');
  window.myLine = new Chart(ctx, config);

};

export default init_chart_mileage;
