// COMIENZAN LOS GRAFICOS
//notificacion de llegada
$( document ).ready(function() {

  fetch('http://localhost:8000/api/chart-etapas')
    .then(function(res){
      return res.json();
    })
    .then(function(datos){
			//Notificacion llegada
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

//Desarmado valuacion
      var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
      var config = {
      type: 'doughnut',
      data: {
          datasets: [{
              data:	 [70,30],
              backgroundColor: [
                '#32B89D','#EAEBF1',
              ]
          }],
          labels: ['Completado', 'En Proceso']
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

//Valuacion piso
      var ctx = KTUtil.getByID('kt_charty_profit_share2').getContext('2d');
      var config = {
      type: 'doughnut',
      data: {
          datasets: [{
              data:	 [50,40],
              backgroundColor: [
                '#32B89D','#EAEBF1',
              ]
          }],
          labels: ['Completado', 'En Proceso']
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
      var ctx = KTUtil.getByID('kt_charty_profit_share2').getContext('2d');
      var myDoughnut = new Chart(ctx, config);


			//Valuacion web
	      var ctx = KTUtil.getByID('kt_charty_profit_share3').getContext('2d');
	      var config = {
	      type: 'doughnut',
	      data: {
	          datasets: [{
	              data:	 [10,90],
	              backgroundColor: [
	                '#32B89D','#EAEBF1',
	              ]
	          }],
	          labels: ['Completado', 'En Proceso']
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
	      var ctx = KTUtil.getByID('kt_charty_profit_share3').getContext('2d');
	      var myDoughnut = new Chart(ctx, config);

	//Autorizacion
	      var ctx = KTUtil.getByID('kt_charty_profit_share4').getContext('2d');
	      var config = {
	      type: 'doughnut',
	      data: {
	          datasets: [{
	              data:	 [50,40],
	              backgroundColor: [
	                '#32B89D','#EAEBF1',
	              ]
	          }],
	          labels: ['Completado', 'En Proceso']
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
	      var ctx = KTUtil.getByID('kt_charty_profit_share4').getContext('2d');
	      var myDoughnut = new Chart(ctx, config);
				//Refacciones
	      var ctx = KTUtil.getByID('kt_charty_profit_share5').getContext('2d');
	      var config = {
	      type: 'doughnut',
	      data: {
	          datasets: [{
	              data:	 [50,40],
	              backgroundColor: [
	                '#32B89D','#EAEBF1',
	              ]
	          }],
	          labels: ['Completado', 'En Proceso']
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
	      var ctx = KTUtil.getByID('kt_charty_profit_share5').getContext('2d');
	      var myDoughnut = new Chart(ctx, config);

	//Asig.laminado
	      var ctx = KTUtil.getByID('kt_charty_profit_share6').getContext('2d');
	      var config = {
	      type: 'doughnut',
	      data: {
	          datasets: [{
	              data:	 [50,40],
	              backgroundColor: [
	                '#32B89D','#EAEBF1',
	              ]
	          }],
	          labels: ['Completado', 'En Proceso']
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
	      var ctx = KTUtil.getByID('kt_charty_profit_share6').getContext('2d');
	      var myDoughnut = new Chart(ctx, config);
				//Laminado
				      var ctx = KTUtil.getByID('kt_charty_profit_share7').getContext('2d');
				      var config = {
				      type: 'doughnut',
				      data: {
				          datasets: [{
				              data:	 [50,40],
				              backgroundColor: [
				                '#32B89D','#EAEBF1',
				              ]
				          }],
				          labels: ['Completado', 'En Proceso']
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
				var ctx = KTUtil.getByID('kt_charty_profit_share7').getContext('2d');
				var myDoughnut = new Chart(ctx, config);
				//Autorizacion
				var ctx = KTUtil.getByID('kt_charty_profit_share8').getContext('2d');
				var config = {
				type: 'doughnut',
				data: {
				    datasets: [{
				        data:	 [50,40],
				        backgroundColor: [
				          '#32B89D','#EAEBF1',
				        ]
				    }],
				    labels: ['Completado', 'En Proceso']
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
				var ctx = KTUtil.getByID('kt_charty_profit_share8').getContext('2d');
				var myDoughnut = new Chart(ctx, config);
				//Refacciones
				var ctx = KTUtil.getByID('kt_charty_profit_share9').getContext('2d');
				var config = {
				type: 'doughnut',
				data: {
				    datasets: [{
				        data:	 [50,40],
				        backgroundColor: [
				          '#32B89D','#EAEBF1',
				        ]
				    }],
				    labels: ['Completado', 'En Proceso']
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
				var ctx = KTUtil.getByID('kt_charty_profit_share9').getContext('2d');
				var myDoughnut = new Chart(ctx, config);

				//Asig.laminado
				var ctx = KTUtil.getByID('kt_charty_profit_share10').getContext('2d');
				var config = {
				type: 'doughnut',
				data: {
				    datasets: [{
				        data:	 [50,40],
				        backgroundColor: [
				          '#32B89D','#EAEBF1',
				        ]
				    }],
				    labels: ['Completado', 'En Proceso']
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
				var ctx = KTUtil.getByID('kt_charty_profit_share10').getContext('2d');
				var myDoughnut = new Chart(ctx, config);
				//Laminado
				      var ctx = KTUtil.getByID('kt_charty_profit_share11').getContext('2d');
				      var config = {
				      type: 'doughnut',
				      data: {
				          datasets: [{
				              data:	 [50,40],
				              backgroundColor: [
				                '#32B89D','#EAEBF1',
				              ]
				          }],
				          labels: ['Completado', 'En Proceso']
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
				      var ctx = KTUtil.getByID('kt_charty_profit_share11').getContext('2d');
				      var myDoughnut = new Chart(ctx, config);
			//Autorizacion
			      var ctx = KTUtil.getByID('kt_charty_profit_share12').getContext('2d');
			      var config = {
			      type: 'doughnut',
			      data: {
			          datasets: [{
			              data:	 [50,40],
			              backgroundColor: [
			                '#32B89D','#EAEBF1',
			              ]
			          }],
			          labels: ['Completado', 'En Proceso']
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
			      var ctx = KTUtil.getByID('kt_charty_profit_share12').getContext('2d');
			      var myDoughnut = new Chart(ctx, config);
						//Refacciones
			      var ctx = KTUtil.getByID('kt_charty_profit_share13').getContext('2d');
			      var config = {
			      type: 'doughnut',
			      data: {
			          datasets: [{
			              data:	 [50,40],
			              backgroundColor: [
			                '#32B89D','#EAEBF1',
			              ]
			          }],
			          labels: ['Completado', 'En Proceso']
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
			      var ctx = KTUtil.getByID('kt_charty_profit_share13').getContext('2d');
			      var myDoughnut = new Chart(ctx, config);

			//Asig.laminado
			      var ctx = KTUtil.getByID('kt_charty_profit_share14').getContext('2d');
			      var config = {
			      type: 'doughnut',
			      data: {
			          datasets: [{
			              data:	 [50,40],
			              backgroundColor: [
			                '#32B89D','#EAEBF1',
			              ]
			          }],
			          labels: ['Completado', 'En Proceso']
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
			      var ctx = KTUtil.getByID('kt_charty_profit_share14').getContext('2d');
			      var myDoughnut = new Chart(ctx, config);
						//Laminado
						      var ctx = KTUtil.getByID('kt_charty_profit_share15').getContext('2d');
						      var config = {
						      type: 'doughnut',
						      data: {
						          datasets: [{
						              data:	 [50,40],
						              backgroundColor: [
						                '#32B89D','#EAEBF1',
						              ]
						          }],
						          labels: ['Completado', 'En Proceso']
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
						      var ctx = KTUtil.getByID('kt_charty_profit_share15').getContext('2d');
						      var myDoughnut = new Chart(ctx, config);
});
