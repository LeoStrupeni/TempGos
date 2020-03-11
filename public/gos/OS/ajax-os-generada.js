$(document).ready(function() {
	var app_url = $('#app_url').attr('url');
    var OS_ID=document.getElementById('gos_os_id').value;

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // $.get(app_url+'/chart-etapas/'+OS_ID, function(data){
    //     $.each(data, function(posicion, item) {
    //         var grafico = document.getElementById('etapas_os_'+posicion).getContext('2d');
    //         var avance = Math.round(data[posicion].avance);
    //         var tipo  = data[posicion].estado_etapa;
    //         if(tipo == 'F'){
    //             avance = 100;
    //         }
    //         else {
    //             avance = 0;
    //         }
    //         var avanceFinal = 100 -avance;
    //         var config = {
    //             type: 'doughnut',
    //             data: {
    //                 datasets: [{
    //                     data: [avance,avanceFinal], // VALORES A CAMBIAR
    //                     backgroundColor: ['#32B89D','#EAEBF1']
    //                 }],
    //                 labels: ['Completado', 'En Proceso'] // VALORES A CAMBIAR
    //             },
    //             options: {
    //                 cutoutPercentage: 75,
    //                 responsive: true,
    //                 maintainAspectRatio: false,
    //                 legend: {
    //                     display: false,
    //                     position: 'top',
    //                 },
    //                 title: {
    //                     display: false,
    //                     text: 'Technology'
    //                 },
    //                 animation: {
    //                     animateScale: true,
    //                     animateRotate: true
    //                 },
    //                 tooltips: {
    //                     enabled: true,
    //                     intersect: false,
    //                     mode: 'nearest',
    //                     bodySpacing: 5,
    //                     yPadding: 10,
    //                     xPadding: 10,
    //                     caretPadding: 0,
    //                     displayColors: false,
    //                     backgroundColor: '#5D78FF',
    //                     titleFontColor: '#ffffff',
    //                     cornerRadius: 4,
    //                     footerSpacing: 0,
    //                     titleSpacing: 0
    //                 }
    //             }
    //         };
    //         var myDoughnut = new Chart(grafico, config);
    //     });
    // });

    popimagen();

});

function popimagen(){
    $('#img-os-cliente').magnificPopup({
        delegate: '.popup-link-img', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery:{enabled:true,tCounter: '%curr% de %total%'},
        image: {
            // markup: '<img style="width: 6rem;position: absolute;left: 0;bottom: 71rem;" src="../img/logo.png"></img>'+
            //         '<div class="mfp-figure">'+
            //         '<div class=""><button title="Close (Esc)" type="button" class="mfp-close"></button></div>'+
            //         '<div class="mfp-img"></div>'+
            //         '<div class="mfp-bottom-bar">'+
            //             '<div class="mfp-title"></div>'+
            //             '<div class="mfp-counter"></div>'+
            //         '</div>'+
            //         '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button

            cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.

            titleSrc: function(item) {
            return '<small>Imágenes Cliente</small>';
            },

            verticalFit: true, // Fits image in area vertically

            tError: '<a href="%url%">La Imagen</a> No ha sido cargada.' // Error message
        }
    });
    $('#img-os-internas').magnificPopup({
        delegate: '.popup-link-img', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery:{enabled:true,tCounter: '%curr% de %total%'},
        image: {
            markup: '<img style="width: 6rem;position: fixed;left: 56rem;bottom: 48rem;" src="../img/logo.png"></img>'+
                    '<div class="mfp-figure">'+
                      '<div class=""><button title="Close (Esc)" type="button" class="mfp-close"></button></div>'+
                      '<div class="mfp-img"></div>'+
                      '<div class="mfp-bottom-bar">'+
                        '<div class="mfp-title"></div>'+
                        '<div class="mfp-counter"></div>'+
                      '</div>'+
                    '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button

            cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.

            titleSrc: function(item) {
                return '<small>Imágenes Internas</small>';
              },

            verticalFit: true, // Fits image in area vertically

            tError: '<a href="%url%">La Imagen</a> No ha sido cargada.' // Error message
          }
    });
}

function scaleImageClient(input) {
    $.ajax({
        method : "GET",
        url: '/imgEtapa/'+id,
        success: function(data){
            guardarImagenCliente(data,input);

        }
    });

}
function guardarImagenCliente(length,input){
	let cantidadcliente=parseInt($('#cantidadClientesOculto').val());
	if (cantidadcliente > 29) {
		alert("No se pueden agregar mas, limite alcanzado.");
		location.reload();
	}
	else {
		if ((input.files.length + cantidadcliente) > 30 ) {
			alert("Intenta subir menos fotos.");
		}
		else {
			for (let index = 0; index < input.files.length; index++){
					let file = input.files[index];
					if(file != undefined){
							let filetype = file.type;
							let reader = new FileReader();
							reader.addEventListener("load", function () {
									let image = new Image();

									image.addEventListener("load", function () {
											let width = Math.floor(image.width / 4);      // Make it an integer, just in case
											let height = Math.floor(image.height / 4);    // Make it an integer, just in case

											let canvas = document.createElement("canvas");
											canvas.width = width;
											canvas.height = height;

											let context = canvas.getContext("2d");
											context.drawImage(image, 0, 0, width, height);

											let url = canvas.toDataURL(filetype);
											let link = document.createElement("img");
											link.src = url;

											let id=document.getElementById('gos_os_id').value;
											let req={imagen:url,type:filetype}

											let cantidadcliente=parseInt($('#cantidadClientesOculto').val());
												$.ajax({
														data: req,
														url : '/guardarImgCliente/'+id,
														type : "POST",
														// done : function(response) {console.log(response);},
														success : function(data) {
																let cantidadcliente=parseInt($('#cantidadClientesOculto').val());
																cantidadcliente = cantidadcliente+1;
																$('#cantidadClientes').empty();
																$('#cantidadClientes').html('Clientes <br> '+cantidadcliente+'/30')
																$('#cantidadClientesOculto').val(cantidadcliente);

																let imagen = `<div class='col-4 col-sm-3 col-md-2 text-center mb-2' id="imgcliente_`+data.gos_os_imagen_cliente_id+`">
																								<a id="btnborrarImgCliente" data-id="`+data.gos_os_imagen_cliente_id+`" class="position-absolute w-25 p-0" style="right:0px;"
																										href="javascript:void(0);">
																										<i class="far fa-2x fa-times-circle text-danger"></i>
																								</a>
																								<a class="popup-link-img" href='/storage/VehiculoCliente/`+data.imagen_cliente+`'>
																										<img src='/storage/VehiculoCliente/`+data.imagen_cliente+`' style='border-radius:50%; height: 100px; width: 100px;'>
																								</a>
																							 </div>`;
																$("#img-os-cliente").append(imagen);
																$(document).ready(function() {
																		popimagen();

																});
														}
												});
									});
									image.src = reader.result;
							});
							reader.readAsDataURL(file);
					}
			}
		}

	}

}
function scaleImageInterna(input) {
		let cantidadcliente=parseInt($('#cantidadInternasOculto').val());
		if (cantidadcliente > 49) {
			alert("No se pueden agregar mas, limite alcanzado.");
			location.reload();
		}
		else {
			if ((input.files.length + cantidadcliente) > 50 ) {
				alert("Intenta subir menos fotos.");
			}
			else {
				for (let index = 0; index < input.files.length; index++){
		        let file = input.files[index];
		        if(file != undefined){
		            let filetype = file.type;
		            let reader = new FileReader();
		            reader.addEventListener("load", function () {
		                let image = new Image();

		                image.addEventListener("load", function () {
		                    let width = Math.floor(image.width / 4);      // Make it an integer, just in case
		                    let height = Math.floor(image.height / 4);    // Make it an integer, just in case

		                    let canvas = document.createElement("canvas");
		                    canvas.width = width;
		                    canvas.height = height;

		                    let context = canvas.getContext("2d");
		                    context.drawImage(image, 0, 0, width, height);

		                    let url = canvas.toDataURL(filetype);
		                    let link = document.createElement("img");
		                    link.src = url;

		                    let id=document.getElementById('gos_os_id').value;
		                    let req={imagen:url,type:filetype}
		                    $.ajax({
		                        data: req,
		                        url : '/guardarImgInterna/'+id,
		                        type : "POST",
		                        // done : function(response) {console.log(response);},
		                        success : function(data) {
		                            let cantidadInterna=parseInt($('#cantidadInternasOculto').val());
		                            cantidadInterna = cantidadInterna+1;

		                            $('#cantidadInternas').empty();
		                            $('#cantidadInternas').html('Internas <br> '+cantidadInterna+'/50')
		                            $('#cantidadInternasOculto').val(cantidadInterna);

		                            let imagen = `<div class='col-4 col-sm-3 col-md-2 text-center mb-2' id='imginterna_`+data.gos_os_imagen_interna_id+`'>
		                                            <a id="btnborrarImgInterna" data-id="`+data.gos_os_imagen_interna_id+`" class="position-absolute w-25 p-0" style="right:0px;"
		                                                href="javascript:void(0);">
		                                                <i class="far fa-2x fa-times-circle text-danger"></i>
		                                            </a>
		                                            <a class="popup-link-img" href='/storage/VehiculoInterna/`+data.imagen_interna+`'>
		                                                <img src='/storage/VehiculoInterna/`+data.imagen_interna+`' style='border-radius:50%; height: 100px; width: 100px;'>
		                                            </a>
		                                           </div>`;
		                            $("#img-os-internas").append(imagen);
		                            $(document).ready(function() {
		                                popimagen();
		                            });
		                        }
		                    });
		                });
		                image.src = reader.result;
		            });
		            reader.readAsDataURL(file);
		        }
		    }
			}

		}

}

/* BORRAR Imagen Cliente */
$('body').on('click','#btnborrarImgCliente',function() {
    var id = $(this).data('id');
    $.ajax({
        type : 'DELETE',
        url : '/destroyImgCliente/'+ id,
        success : function(data) {
            $('#imgcliente_'+id).remove();
            let cantidadcliente=parseInt($('#cantidadClientesOculto').val());
            cantidadcliente = cantidadcliente-1;
            $('#cantidadClientes').empty();
            $('#cantidadClientes').html('Clientes <br> '+cantidadcliente+'/30')
            $('#cantidadClientesOculto').val(cantidadcliente);
        },
        error : function(data) {
            console.log('Error:',data);
        }
    });
});

/* BORRAR Imagen Interna */
$('body').on('click','#btnborrarImgInterna',function() {
    var id = $(this).data('id');
    $.ajax({
        type : 'DELETE',
        url : '/destroyImgInterna/'+ id,
        success : function(data) {
            $('#imginterna_'+id).remove();
            let cantidadInterna=parseInt($('#cantidadInternasOculto').val());
            cantidadInterna = cantidadInterna-1;
            $('#cantidadInternas').empty();
            $('#cantidadInternas').html('Internas <br> '+cantidadInterna+'/50')
            $('#cantidadInternasOculto').val(cantidadInterna);
        },
        error : function(data) {
            console.log('Error:',data);
        }
    });

});


/* BORRAR Documento */
$('body').on('click','#btnborrarDoc',function() {
    var id = $(this).data('id');
		    var opcion = confirm("¿Estas seguro de borrar este documento?");
		    if (opcion == true) {
					$.ajax({
							type : 'DELETE',
							url : '/destroyDoc/'+ id,
							success : function(data) {
									$('#documento_'+id).remove();
									let cantidadDoc=parseInt($('#cantidadDocsOculto').val());
									cantidadDoc = cantidadDoc-1;
									$('#cantidadDocs').empty();
									$('#cantidadDocs').html('Clientes <br> '+cantidadDoc+'/10')
									$('#cantidadDocsOculto').val(cantidadDoc);
							},
							error : function(data) {
									console.log('Error:',data);
							}
					});
			} else {
			}
});
