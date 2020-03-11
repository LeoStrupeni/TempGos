<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

$( document ).ready(function() {

  fetch('http://localhost:8000/api/chart-etapas')
    .then(function(res){
      return res.json();
    })
    .then(function(datos){
      var ctx = KTUtil.getByID('kt_charty_profit_share').getContext('2d');
      var config = {
          type: 'doughnut',
          data: {
              datasets: [{
                  data:	datos.data,
                  backgroundColor: [
                    '#32B89D','#EAEBF1',
                  ]
              }],
              labels: datos.labels
          },
          options: {
              cutoutPercentage: 75,
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                  display: false,
                  position: 'top',
              },
              title: {
                  display: false,
                  text: 'Technology'
              },
              animation: {
                  animateScale: true,
                  animateRotate: true
              },
              tooltips: {
                  enabled: true,
                  intersect: false,
                  mode: 'nearest',
                  bodySpacing: 5,
                  yPadding: 10,
                  xPadding: 10,
                  caretPadding: 0,
                  displayColors: false,
                  backgroundColor: '#5D78FF',
                  titleFontColor: '#ffffff',
                  cornerRadius: 4,
                  footerSpacing: 0,
                  titleSpacing: 0
              }
          }
      };
      var ctx = KTUtil.getByID('kt_charty_profit_share').getContext('2d');
      var myDoughnut = new Chart(ctx, config);
    });

    // Gráfico 2
      var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
      var config = {
      type: 'doughnut',
      data: {
          datasets: [{
              data:	 [20,30],
              backgroundColor: [
                '#32B89D','#EAEBF1',
              ]
          }],
          labels: ['Hola', 'Dos']
      },
      options: {
          cutoutPercentage: 75,
          responsive: true,
          maintainAspectRatio: false,
          legend: {
              display: false,
              position: 'top',
          },
          title: {
              display: false,
              text: 'Technology'
          },
          animation: {
              animateScale: true,
              animateRotate: true
          },
          tooltips: {
              enabled: true,
              intersect: false,
              mode: 'nearest',
              bodySpacing: 5,
              yPadding: 10,
              xPadding: 10,
              caretPadding: 0,
              displayColors: false,
              backgroundColor: '#5D78FF',
              titleFontColor: '#ffffff',
              cornerRadius: 4,
              footerSpacing: 0,
              titleSpacing: 0
          }
      }
      };
      var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
      var myDoughnut = new Chart(ctx, config);

});
