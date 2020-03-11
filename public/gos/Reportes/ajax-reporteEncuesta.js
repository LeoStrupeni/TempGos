$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

	$('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		startDate: primerDia,
		endDate: ultimoDia,
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});


	var id = $('#asgid').val();
	var fechainc = $('#fechainc').val();
	var fechafin = $('#fechafin').val();

    $.ajax({
      contenttype : 'application/json; charset=utf-8',
      url : '/ReporteEncuestaOS/chart/'+id+'/'+fechainc+'/'+fechafin,
	  type : 'GET',
	  done : function(response) {console.log(response);},
      error : function(jqXHR,textStatus,errorThrown,data) {
        console.log('Error');
      },
      success : function(data) {
		$("#myfirstchart").empty();
		chart(data);
      }
	});   
	var count = 0 ;
    $("#easteregg").click(function(){
		
        count+=1;
        if (count==5) {  
		
			
        }

	});
	var egg = new Egg();
	egg.addCode("up,up,down,down,left,left,a", function() {
		// swal.fire({
		// 	title: 'Enhorabuena!',
		// 	text: 'Descubriste el hack, ahora eres un hackerman.',
		// 	imageUrl: 'https://unsplash.it/400/200',
		// 	imageWidth: 400,
		// 	imageHeight: 200,
		// 	imageAlt: 'Custom image',
		// 	showClass: {
		// 		popup: 'animated fadeInDown faster'
		// 	  },
		// 	  hideClass: {
		// 		popup: 'animated fadeOutUp faster'
		// 	  },
		// 	animation: true
		// });
		const ipAPI = '//api.ipify.org?format=json'

		Swal.queue([{
		title: 'Hemos descubierto que eres alguna clase de hacker',
		confirmButtonText: 'Click',
		text:
			'Deja de presionar botones ' +
			'ó te encontraremos',
		showLoaderOnConfirm: false,
		preConfirm: () => {
			return fetch(ipAPI)
			.then(response => response.json())
			.then(data => Swal.insertQueueStep(data.ip))
			.catch(() => {
				Swal.insertQueueStep({
				icon: 'error',
				title: 'Unable to get your public IP'
				})
			})
		}
		}])
		// swal.fire({
		// 	title: 'Custom width, padding, background.',
		// 	width: 600,
		// 	padding: '3em',
		// 	background: '#fff url(/images/trees.png)',
		// 	backdrop: `
		// 	  rgba(0,0,123,0.4)
		// 	  url("https://giphy.com/gifs/RjaLjjt78xBNS/html5")
		// 	  left top
		// 	  no-repeat
		// 	`
		//   })
	}).listen();

});
function chart(data)
{
	if(data['filtro']==1){
		var tamañoenc = data['categories'].length;

		for(i = 0; i < tamañoenc; i++){
			var tamañopregunta = data['categories'][i].length;
			var arrres =[];
			var arrpreg =[];
			for(j = 0; j < tamañopregunta; j++){
				var countres = data['categories'][i][j].count;
                 if(countres==null){
					 var countres = 0;
				 }
				arrres.push({ y: data['categories'][i][j].tipo_respuestas, a: countres});
				arrpreg.push({ pregunta: data['categories'][i][j].pregunta, pregunta_id: data['categories'][i][j].gos_enc_preguntas_id});
			}
			$('#nomb_pregunta_'+arrpreg[0].pregunta_id).html(arrpreg[0].pregunta);
			var tablaid = data['encuesta_item'][i].gos_encuesta_pregunta_id;
			new Morris.Bar({
				element: 'bar_morris_'+tablaid,
				barGap:2,
  				barSizeRatio:0.5,
				data: arrres,
				xkey: 'y',
				ykeys: ['a'],
				labels: ['contestaron'],
				barShape: 'soft'
				
			});
			var pregid = data['encuesta_item'][i].gos_encuesta_pregunta_id;
		}
		var encsincontestar = data['contestadas'][0].total;
		var encconcontestar = data['contestadas'][1].total;
		if(encsincontestar==null){
			var encsincontestar = 0;
		}
		if(encconcontestar==null){
			var encconcontestar = 0;
		}
		var theData = [
			{mapname: 'Contestó', value: encconcontestar, count: encconcontestar},
			{mapname: 'No Contestó', value: encsincontestar, count: encsincontestar}
		  ]
		new Morris.Bar({
			element: 'bar_morris_chartrespuesta',
			barGap:2,
  			barSizeRatio:0.5,
			data: theData,
			xkey: 'mapname',
			ykeys: ['value'],
			labels: ['contestaron'],
			barShape: 'soft',
			barColors: function (row, series, type) {
				// console.log("--> "+row, series, type);
				if(row.label == "Contestó") return "Green";
				else if(row.label == "No Contestó") return "#AD1D28";
				
			  }
		});
	}
	else{
		var encsincontestar = data['contestadas'][0].total;
		var encconcontestar = data['contestadas'][1].total;
		if(encsincontestar==null){
			var encsincontestar = 0;
		}
		if(encconcontestar==null){
			var encconcontestar = 0;
		}
		var theData = [
			{mapname: 'Contestó', value: encconcontestar, count: encconcontestar},
			{mapname: 'No Contestó', value: encsincontestar, count: encsincontestar}
		]
		new Morris.Bar({
			element: 'bar_morris_chartrespuesta',
			barGap:2,
  			barSizeRatio:0.5,
			data: theData,
			xkey: 'mapname',
			ykeys: ['value'],
			labels: ['contestaron'],
			barShape: 'soft',
			barColors: function (row, series, type) {
				// console.log(theData);
				// console.log("--> "+row, series, type);
				if(row.label == "Contestó") return "Green";
				else if(row.label == "No Contestó") return "#AD1D28";
				
			}
		});

	}

}

