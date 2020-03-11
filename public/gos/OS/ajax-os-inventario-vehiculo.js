$( document ).ready(function() {
    console.log( "ajax-os-inventario-vehiculo-ready!" );
		//-----------------------load Canvas---------------------
		setTimeout(function(){
			var valmedgas= parseInt(document.getElementById("medidor_gasolina").value);
			if (valmedgas>0) {
			  medgas(valmedgas);
			}
		}, 3000);

		//--------------------------------------------------------
});
/* INVENTARIO --------------------------------------------------------------------*/

	//EL MODAL DE INVENTARIO SOLO SE ABRIRA SI EXISTE GOS_OS_ID>0
	// via GET ajax  con la url /inventario-vehiculo
	/*--------------------------------------------------------------------*/
	//FUNCION PARA TRAER DATOS DEL INVENTARIO
	/*--------------------------------------------------------------------*/
	/**
	 */

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});

	$('#btnAbrirInventario').click( function() {
		if ($('#gos_os_id').val()==''){
			alert("Para agregar inventario se necesita el id de OS !!!");
		} else {
			if($('#gos_vehiculo_inventario_id').val()==''){
				$.ajax({
					data: $('#OS_Cliente_form').serializeArray(),
					url : app_url+'/generarIdInventario',
					type : "POST",
					done : function(response) {console.log(response);},
					success : function(data) {
						$('#gos_vehiculo_inventario_id').val(data.gos_vehiculo_inventario_id);
						$('#btnAbrirInventario').attr("data-toggle", "modal");
					}
				});
			}else{
				$('#btnAbrirInventario').attr("data-toggle", "modal");
			}
		}
	});

	/*--------------------------------------------------------------------*/
	// FUNCION PARA GUARDAR INVENTARIO
	/*--------------------------------------------------------------------*/
	$('#btninventario').click(function() {
    var idos=document.getElementById("gos_os_id").value;
		var datosForm = $('#Inventario-form').serializeArray();
		// console.log(datosForm);
		$('#btninventario').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
			data: datosForm,
			url : app_url+'/inventario-vehiculo',
			type : "POST",
			//dataType : "json",
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				$('#btninventario').html('Guardar');
				if (console && console.log) {
					console.log("La solicitud a fallado: "+ textStatus);
					console.log("La solicitud a fallado: "+ errorThrown);
					}
				},
			success : function(data) {
				console.log(data);
				$('#modalInventario').modal('hide');
				$('#btninventario').html('Listo');

				getcanvas(idos);
				location.reload();
			}
		}); //ajax

	});

	$('#comentario-updt').click(function() {
		var idos=document.getElementById("gos_os_id").value;
			var datosForm = $('#Inventario-form').serializeArray();
			$('#comentario-updt').html('Guardando...');
			$.ajax({contenttype : "application/json; charset=utf-8",
				data: datosForm,
				url : app_url+'/inventario-vehiculo',
				type : "POST",
				//dataType : "json",
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#comentario-updt').html('Guardar');
					if (console && console.log) {
						console.log("La solicitud a fallado: "+ textStatus);
						console.log("La solicitud a fallado: "+ errorThrown);
						}
					},
				success : function(data) {
					console.log(data);
					$('#modalInventario').modal('hide');
					$('#comentario-updt').html('Listo');
	
					location.reload();
				}
			}); //ajax
	
		});

	function getcanvas($id){
		console.log("getcanvas");
		var backg=document.getElementById("modelo_vehiculo").value;
		var canvasFE = document.getElementById("canvasFirmaEncargado");
		var ctxFE=canvasFE.getContext("2d");
		var urlFE = canvasFE.toDataURL();
		var newImgFE = document.createElement("img");
		newImgFE.src = urlFE;
		//document.body.appendChild(newImgFE);
		var canvasCL = document.getElementById("canvasFirmaCliente");
		var ctxCL=canvasCL.getContext("2d");
		var urlCL = canvasCL.toDataURL();
		var newImgCL = document.createElement("img");
		newImgCL.src = urlCL;
	//	document.body.appendChild(newImgCL);
		var canvascarroceria = document.getElementById("canvas");
		var ctxcarroceria=canvascarroceria.getContext("2d");
		var urlcarroceria = canvascarroceria.toDataURL();
		var newImgcarroceria = document.createElement("img");
		newImgcarroceria.src = urlcarroceria;
		//document.body.appendChild(newImgcarroceria);
		var req ={ carroseria:urlcarroceria, cliente:urlCL, encargado:urlFE ,id:$id,bg:backg}
		$.ajax({
			data:  req,
			url : app_url+'/ordenes-servicio/canvas',
			type : "POST",
			done : function(response) {console.log(response);},
			success : function(data) {
				console.log(data);
			}
		});
	}


	/*--------------------------------------------------------------------*/
	// RAYONES GOLPES Y ESTRELLADO CONDICIONES DE CARROCERIA INVENTARIO
	/*--------------------------------------------------------------------*/

	/*--------------------------------------------------------------------*/
	// RAYONES GOLPES Y ESTRELLADO CONDICIONES DE CARROCERIA INVENTARIO
	/*--------------------------------------------------------------------*/

	function selec_vehi(select){
		var Vehiculo=select.options[select.selectedIndex].value;
		var Vurl='img/ccar/'+Vehiculo+'.jpg';
		$('#canvas').css("background-image", "url(" + Vurl + ")");
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		ctx.clearRect(0, 0, canvas.width, canvas.height);
	// alert(Vurl);
	}

	//Canvas
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	//Variables
	var canvasx = $(canvas).offset().left;
	var canvasy = $(canvas).offset().top;
	var last_mousex = last_mousey = 0;
	var mousex = mousey = 0;
	var mousedown = false;
	var tooltype = 'circle';
	document.getElementById('borrarCanvas').addEventListener('click', function() {
		$("#canvas").show();
			$("#vehiculotipoid").hide();
			$("#vehiculotipoidcanvasover").hide();
			$("#editarCanvasRayones").show();
			$("#editarCanvasRoto").show();
			$("#editarCanvasGolpes").show();
			$("#modelo_vehiculo").show();

		ctx.clearRect(0, 0, canvas.width, canvas.height);
	});
	document.getElementById('editarCanvasGolpes').addEventListener('click', function() {
		tooltype = 'circle';
		document.getElementById('editarCanvasGolpes').classList.remove("btn-default");
		document.getElementById('editarCanvasGolpes').classList.add( "btn-primary");

		document.getElementById('editarCanvasRoto').classList.remove( "btn-primary");
		document.getElementById('editarCanvasRoto').classList.add("btn-default");

		document.getElementById('editarCanvasRayones').classList.remove("btn-primary");
		document.getElementById('editarCanvasRayones').classList.add( "btn-default");
	});
	document.getElementById('editarCanvasRoto').addEventListener('click', function() {
		tooltype = 'draw';
		document.getElementById('editarCanvasRoto').classList.remove("btn-default");
		document.getElementById('editarCanvasRoto').classList.add( "btn-primary");

		document.getElementById('editarCanvasGolpes').classList.remove( "btn-primary");
		document.getElementById('editarCanvasGolpes').classList.add("btn-default");

		document.getElementById('editarCanvasRayones').classList.remove("btn-primary");
		document.getElementById('editarCanvasRayones').classList.add( "btn-default");
	});
	document.getElementById('editarCanvasRayones').addEventListener('click', function() {
		tooltype = 'break';
		document.getElementById('editarCanvasRayones').classList.remove("btn-default");
		document.getElementById('editarCanvasRayones').classList.add( "btn-primary");

		document.getElementById('editarCanvasGolpes').classList.remove( "btn-primary");
		document.getElementById('editarCanvasGolpes').classList.add("btn-default");

		document.getElementById('editarCanvasRoto').classList.remove("btn-primary");
		document.getElementById('editarCanvasRoto').classList.add( "btn-default");
	});
	//Mousedown
	// $(canvas).on('mousedown', function(e) {
	// 	// alert(e.clientX);
	// 	last_mousex = mousex = parseInt(e.clientX-canvasx);
	// 	last_mousey = mousey = parseInt(e.clientY-canvasy);
	// 	mousedown = true;
	// 	if(mousedown) {
	// 		ctx.beginPath();
	// 		if(tooltype=='circle') {
	// 			ctx.globalCompositeOperation = 'source-over';
	// 			ctx.strokeStyle = 'red';
	// 			ctx.lineWidth = 3;
	// 			ctx.moveTo(last_mousex-300,last_mousey-120);
	// 			ctx.strokeRect(mousex-600, mousey-150, 15,0 );
	// 			// ctx.arc(mousex-600, mousey-150, 1, 0, 1 * Math.PI);
	// 			ctx.stroke();

	// 		}
	// 		else if(tooltype=='draw') {
	// 			ctx.globalCompositeOperation = 'source-over';
	// 			ctx.strokeStyle = 'red';
	// 			ctx.lineWidth = 3;
	// 			ctx.moveTo(last_mousex-610,last_mousey-160);
	// 			ctx.lineTo(mousex-600,mousey-150);
	// 			ctx.moveTo(last_mousex-600,last_mousey-160);
	// 			ctx.lineTo(mousex-610,mousey-150);
	// 			ctx.lineJoin = ctx.lineCap = 'round';
	// 			ctx.stroke();
	// 		}
	// 		else if(tooltype=='break')
	// 		{
	// 			ctx.globalCompositeOperation = 'source-over';
	// 			ctx.strokeStyle = 'red';
	// 			ctx.lineWidth = 3;
	// 			ctx.lineJoin = ctx.lineCap = 'round';

	// 			ctx.moveTo(last_mousex-590,last_mousey-140);
	// 			ctx.lineTo(mousex-570,mousey-155);
	// 			ctx.stroke();

	// 			ctx.moveTo(last_mousex-600,last_mousey-150);
	// 			ctx.lineTo(mousex-590,mousey-140);
	// 			ctx.stroke();

	// 			ctx.moveTo(last_mousex-600,last_mousey-150);
	// 			ctx.lineTo(mousex-610,mousey-140);
	// 			ctx.stroke();
	// 		}
	// 	}
	// });
	//Click position


   var pointSize = 3;
   var $canvas = $("#canvas");
	var canvasOffset = $canvas.offset();
	var offsetX = canvasOffset.left;
	var offsetY = canvasOffset.top;
	var startX;
	var startY;
	$("#canvas").click(function(e){
		// mouseX = e.offsetX * canvas.width / canvas.clientWidth | 0
		// mouseY = e.offsetY * canvas.height / canvas.clientHeight | 0
		// // mouseX1 = e.offsetX * canvas.width / canvas.clientWidth | 0
		// // mouseY1 = e.offsetY * canvas.width / canvas.clientWidth | 0
		// mouseX1 = parseInt(e.clientX - offsetX);
        // mouseY1 = parseInt(e.clientY - offsetY);
		// console.log(canvasOffset);
		// console.log(canvas.width);
		// console.log(canvas.clientWidth);
		// console.log(canvas.clientHeight);
		// console.log("posicion mouse",mouseX,mouseY);
		// console.log("posicion mouse",mouseX1,mouseY1);
		getPosition(e);

   });

   function getPosition(event){


		var rect = canvas.getBoundingClientRect();
		var x = event.offsetX * canvas.width / canvas.clientWidth | 0
		var y = event.offsetY * canvas.height / canvas.clientHeight | 0
		console.log("x: " + x + " y: " + y)

		drawCoordinates(x,y);
   }



   function drawCoordinates(x,y){
		 var ctx = document.getElementById("canvas").getContext("2d");


			ctx.beginPath();
			if(tooltype=='circle') {
			ctx.fillStyle = "#ff2626"; // Red color
			ctx.beginPath();
			ctx.arc(x, y, pointSize, 0, Math.PI * 2, true);
			ctx.fill();
			}


			ctx.beginPath();
			if(tooltype=='draw') {
			ctx.fillStyle = "#ff2626"; // Red color
			ctx.strokeStyle = 'red';
			ctx.lineWidth = 3;
			ctx.beginPath();
			ctx.moveTo(x-10,y-10);
				ctx.lineTo(x,y);
				ctx.moveTo(x,y-10);
				ctx.lineTo(x-10,y);
				ctx.lineJoin = ctx.lineCap = 'round';
				ctx.stroke();
			ctx.fill();
			}


			ctx.beginPath();
			if(tooltype=='break') {
			ctx.fillStyle = "#ff2626"; // Red color
			ctx.strokeStyle = 'red';
			ctx.lineWidth = 3;
			ctx.beginPath();
			ctx.moveTo(x-8,y+8);
	 			ctx.lineTo(x,y);
	 			ctx.stroke();
                ctx.moveTo(x,y);
	 			ctx.lineTo(x+2,y+10);
	 			ctx.stroke();
                ctx.moveTo(x+2,y+10);
	 			ctx.lineTo(x+11,y);
	 			ctx.stroke();
			ctx.fill();
			}

	}

	//Mouseup
	$(canvas).on('mouseup', function(e) {
		mousedown = false;
	});

	//Mousemove
	$(canvas).on('mousemove', function(e) {
		mousex = parseInt(e.clientX-canvasx);
		mousey = parseInt(e.clientY-canvasy);
		last_mousex = mousex;
		last_mousey = mousey;
		console.log(last_mousex,last_mousey);
	});

	//Use draw|erase
	use_tool = function(tool) {
		tooltype = tool; //update
	}
	/*--------------------------------------------------------------------*/
	// NOTE: FIRMA CLIENTE
	/*--------------------------------------------------------------------*/
	// FIRMA DEL CLIENTE PRIMER SIGNATURE PAD

	var signcliente = document.getElementById('canvasFirmaCliente');		
	var canvasFirmaCliente = new SignaturePad(signcliente);

	// capturo la etiqueta imagen
	var imgFirmaCliente = document.getElementById('imgFirmaCliente');
	// clic en borrar
	document.getElementById('borrarFirmaCliente').addEventListener('click', function() {
		 var canvasFirmaCliente2=document.getElementById('canvasFirmaCliente');
		 var ctx2 = canvasFirmaCliente2.getContext('2d');


		 ctx2.clearRect(0, 0, canvas.width, canvas.height);
		 $("#canvasFirmaCliente").show();
   	});
	// // clic en guardar

	// $("#canvasFirmaCliente").change(function(){
	// 	var firmaCliente = canvasFirmaCliente.toDataURL('image/png');
	// 	imgFirmaCliente.setAttribute("src", firmaCliente);
	// 	console.log(firmaCliente);
   	// });

	/*--------------------------------------------------------------------*/
	// NOTE: FIRMA Encargado
	/*--------------------------------------------------------------------*/
	// FIRMA DEL ENCARGADO SEGUNDO SIGNATURE PAD
	var canvasFirmaEncargado = new SignaturePad(document.getElementById('canvasFirmaEncargado'));
	// capturo la etiqueta imagen
	var imgFirmaEncargado = document.getElementById('imgFirmaEncargado');
	// clic en borrar
	document.getElementById('borrarFirmaEncargado').addEventListener('click', function() {
		 var canvasFirmaEncargado2=document.getElementById('canvasFirmaEncargado');
		var ctx3 = canvasFirmaEncargado2.getContext('2d');
		ctx3.clearRect(0, 0, canvas.width, canvas.height);
			 $("#canvasFirmaEncargado").show();
	});
	// // clic en guardar

	// $("#btnGuardarFirmaEncargado").change(function(){
	// 	var firmaEncargado = canvasFirmaEncargado.toDataURL('image/png');
	// 	imgFirmaEncargado.setAttribute("src",firmaEncargado);
	// 	console.log(firmaEncargado);
   	// });

/* FIN INVENTARIO ----------------------------------------------------------------*/








	function drawChart(valor){

			var myConfig2 = {
				"type": "gauge",

				"scale-r": {
					"aperture": 160, //Scale Range
					"values": "10:90:10", //and minimum, maximum, and step scale values.
					"labels": [ "E","1/8", "2/8", "3/8", "4/8", "5/8", "6/8", "7/8", "F"], //Scale Labels
					"center": {
						"size": 2,
						"background-color": "#66CCFF #FFCCFF",
						"border-color": "none"
					},
					"ring": {
					"size": 10,
					"rules": [{
							"rule": "%v >= 10 && %v <= 20",
							"background-color": "red"
						},
						{
							"rule": "%v >= 20 && %v <= 60",
							"background-color": "lightgray"
						},
						{
							"rule": "%v >= 80 && %v <= 90",
							"background-color": "green"
						}
					]
				},
				},
				"gui" : {
				"contextMenu" : {
				"empty" : true
				}
				},
				"plot": {
					"csize": "5%",
					"size": "100%",
					"background-color": "#000000",
					"animation":{
					"effect":"2",
					"method":"3",
					"sequence":"1",
					"speed":"3000"
				}
				},
				"series": [{
					"values": [valor]
				}]
			};
			zingchart.render({
				id: 'myChart',
				data: myConfig2,
				height: "100%",
				width: "100%"
				// $("#myChart-tools").remove();
				// $("#myChart-menu-area").remove();
			});
	}


  function medgas(gas){
  if (gas==9) {
     // console.log(gas);
  document.getElementById('MGF').style.visibility='hidden';
  document.getElementById('MG78').style.visibility='hidden';
  document.getElementById('MG68').style.visibility='hidden';
  document.getElementById('MG58').style.visibility='hidden';
  document.getElementById('MG48').style.visibility='hidden';
  document.getElementById('MG38').style.visibility='hidden';
  document.getElementById('MG28').style.visibility='hidden';
  document.getElementById('MG18').style.visibility='hidden';
  document.getElementById('MGE').style.visibility='initial';
  $("#medidor_gasolina").val(gas);
  }
  if (gas==10) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='hidden';
    document.getElementById('MG58').style.visibility='hidden';
    document.getElementById('MG48').style.visibility='hidden';
    document.getElementById('MG38').style.visibility='hidden';
    document.getElementById('MG28').style.visibility='hidden';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='intial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==11) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='hidden';
    document.getElementById('MG58').style.visibility='hidden';
    document.getElementById('MG48').style.visibility='hidden';
    document.getElementById('MG38').style.visibility='hidden';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==12) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='hidden';
    document.getElementById('MG58').style.visibility='hidden';
    document.getElementById('MG48').style.visibility='hidden';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==13) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='hidden';
    document.getElementById('MG58').style.visibility='hidden';
    document.getElementById('MG48').style.visibility='initial';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==14) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='hidden';
    document.getElementById('MG58').style.visibility='initial';
    document.getElementById('MG48').style.visibility='initial';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==15) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='hidden';
    document.getElementById('MG68').style.visibility='initial';
    document.getElementById('MG58').style.visibility='initial';
    document.getElementById('MG48').style.visibility='initial';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==16) {
     // console.log(gas);
    document.getElementById('MGF').style.visibility='hidden';
    document.getElementById('MG78').style.visibility='initial';
    document.getElementById('MG68').style.visibility='initial';
    document.getElementById('MG58').style.visibility='initial';
    document.getElementById('MG48').style.visibility='initial';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }
  if (gas==17) {
   // console.log(gas);
    document.getElementById('MGF').style.visibility='initial';
    document.getElementById('MG78').style.visibility='initial';
    document.getElementById('MG68').style.visibility='initial';
    document.getElementById('MG58').style.visibility='initial';
    document.getElementById('MG48').style.visibility='initial';
    document.getElementById('MG38').style.visibility='initial';
    document.getElementById('MG28').style.visibility='initial';
    document.getElementById('MG18').style.visibility='initial';
    document.getElementById('MGE').style.visibility='initial';
    $("#medidor_gasolina").val(gas);
  }

  }
