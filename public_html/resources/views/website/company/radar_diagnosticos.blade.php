  <h1 class="mt-10">Niveles Alcanzados por Dimensión</h1>
  <div style="max-width: 500px; height: 50vh; margin: 0 auto;">
      <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const data = {
  labels: {!! $dimensions !!},
          datasets: [{
          label: '{{$company->business_name}}',
                data: [{{implode(",", $results)}}],
                  fill: true,
                  backgroundColor: 'rgba(252,183,22, 0.2)',
                  borderColor: 'rgb(255,180,0)',
                  pointBackgroundColor: 'rgb(252,183,22)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(12, 24, 146)'
          }, ]
          };
  const config = {
  type: 'radar',
          data: data,
          options: {
          elements: {
          line: {
          borderWidth: 3
          }
          },
                  scales: {
                  r: {
                  suggestedMin: 0,
                          suggestedMax: 5
                  }
                  }
          },
          };
  const myChart = new Chart(document.getElementById('myChart'), config);
</script>
<style>
        #myChart{ margin: 0 auto; }
</style>