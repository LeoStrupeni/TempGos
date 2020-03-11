$('.repeater-default').repeater({
	show: function () {
	  $(this).slideDown();
	},
});

$(document).ready(function() {

	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});
	var table =$('#dt-Etapas').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 50,
			responsive: true,
		rowReorder: { update: true },
		// ordering: false,
		processing : true,
			order : [ [ 1, 'asc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

 $("#saveetapasubmit").hide();
 $("#saveetapa").show();

	//get de listado o index tomado del controller para el Objeto DataTable
	// var table = $('#dt-Etapas').DataTable({
	// 	dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
	// 	"<'row'<'col-sm-12'tr>>" +
	// 	"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
	// 	"iDisplayLength": 50,
	// 	responsive: true,
	// 	rowReorder: { update: true },
	// 	// ordering: false,
	// 	processing : true,
	// 	ajax : '/gestion-etapas',
	// 	columns : [ {data : 'gos_paq_etapa_id',name : 'id','visible' : true},
	// 				{data : 'orden_etapa',name : 'orden','visible' : true},
	// 				{data : 'nomb_etapa'},
	// 				{data : 'descripcion_etapa'},
	// 				{data : 'tiempo_meta'},
	// 				{data : 'minimo_fotos'},
	// 				{data : 'Opciones', name : 'Opciones',orderable : false} ],
	// 	order : [ [ 1, 'asc' ] ],
	// 	language : {'url' : '/gos/Spanish.json'}
	// });
	table.on( 'row-reorder', function ( e, diff, edit ) {
		for(i = 0; i < diff.length; i++){
			id = diff[i].node.cells[0].innerText;
			newPos = diff[i].newPosition + 1;
			$.ajax({
				type : "GET",
				url : '/orden-etapas/'+id+'/'+newPos+'/',
				success: function(data) {
					console.log(data);
					window.location.reload();
				  
				}        

			});
		}

	});

	/*$('#NuevaEtapa').click(function() {
		limpiartextEtapa();
		$('#calc_tiempo_2').addClass('d-none');
		$('#calc_tiempo_3').addClass('d-none');
		$('#calc_tiempo_4').addClass('d-none');
		$('#calc_tiempo_5').addClass('d-none');
		$('#calc_tiempo_6').addClass('d-none');
		$('#calc_tiempo_7').addClass('d-none');
		$('#calc_tiempo_8').addClass('d-none');
		$('#calc_tiempo_9').addClass('d-none');
		$('#calc_tiempo_10').addClass('d-none');
		$('#MensajesWS').removeClass('show');
		$('#calculos_tiempos').removeClass('show');
		$('#etapas_relacionadas').removeClass('show');
		$('#gos_paq_etapa_id').val('');
		$('#gos_etapa_asesor_id').val('');
		$('#etapaForm').trigger('reset');
		$('#titleModalEtapa').html('Nueva etapa');
		$('#modalEtapa').modal('show');
	});

	// GUARDAR ETAPA
	$('#guardarEtapa').click(function(){
		var regex_numeros = /^([0-9.])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
		var $errores = 0;

		if($('#nomb_etapa').val().trim() == '' || !regex_alfanumerico.test($('#nomb_etapa').val())){
			if($('#nomb_etapa').val().trim() == ''){
				$('.nomb_etapa').text('Campo obligatorio');
			}else{
				$('.nomb_etapa').text('');
				$('.nomb_etapa').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_etapa').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#descripcion_etapa').val().trim() == '' || !regex_alfanumerico.test($('#descripcion_etapa').val())){
			if($('#descripcion_etapa').val().trim() == ''){
				$('.descripcion_etapa').text('Campo obligatorio');
			}else{
				$('.descripcion_etapa').text('');
				$('.descripcion_etapa').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.descripcion_etapa').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		// if($('#comision_asesor').val().trim() == '' || !regex_numeros.test($('#comision_asesor').val())){
		// 	if($('#comision_asesor').val().trim() == ''){
		// 		$('.comision_asesor').text('Campo obligatorio');
		// 	}else{
		// 		$('.comision_asesor').text('');
		// 		$('.comision_asesor').text('Campo numerico');
		// 	}
		// 	$errores++;
		// } else {
		// 	$(this).focus(function(){
		// 		$('.comision_asesor').text('');
		// 		if($errores > 0){
		// 			$errores-1;
		// 		}
		// 	});
		// }
		if($('#tiempo_meta').val().trim() == '' || !regex_numeros.test($('#tiempo_meta').val())){
			if($('#tiempo_meta').val().trim() == ''){
				$('.tiempo_meta').text('Campo obligatorio');
			}else{
				$('.tiempo_meta').text('');
				$('.tiempo_meta').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.tiempo_meta').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#minimo_fotos').val().trim() == '' || !regex_numeros.test($('#minimo_fotos').val())){
			if($('#minimo_fotos').val().trim() == ''){
				$('.minimo_fotos').text('Campo obligatorio');
			}else{
				$('.minimo_fotos').text('');
				$('.minimo_fotos').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.minimo_fotos').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			console.log($('#etapaForm').serializeArray());
			$('#guardarEtapa').html('Guardando...');
			$.ajax({contenttype : 'application/json; charset=utf-8',
				data : $('#etapaForm').serialize(),
				url : '/gestion-etapas',
				type : 'POST',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#guardarEtapa').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud ha fallado: '+ textStatus);
						console.log('La solicitud ha fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					limpiartextEtapa();
             window.location.reload(true);
					$('#etapaForm').trigger('reset');
					$('#modalEtapa').modal('hide');
					$('#guardarEtapa').html('Guardar');
				}
			});
		}
	});


		$('body').on('click', '.btn-editar-Etapa', function () {
			var id = $(this).data('id');
			$.get('/gestion-etapas/' + id +'/edit', function (data) {
				limpiartextEtapa();
				$('#title-error').hide();
				$('#product_code-error').hide();
				$('#description-error').hide();
				$('#MensajesWS').removeClass('show');
				$('#calculos_tiempos').removeClass('show');
				$('#etapas_relacionadas').removeClass('show');
				$('#titleModalEtapa').html('Editar Etapa');
				$('#modalEtapa').modal('show');
				//campos
				$('#gos_paq_etapa_id').val(data['gral'].gos_paq_etapa_id);
				$('#gos_etapa_asesor_id').val(data['gral'].gos_etapa_asesor_id);
				$('#nomb_etapa').val(data['gral'].nomb_etapa);
				$('#descripcion_etapa').val(data['gral'].descripcion_etapa);
				$('#comision_tipo').val(data['gral'].comision_tipo);
				$('#comision_asesor').val(data['gral'].comision_asesor);
				$('#gos_usuario_tecnico_id').val(data['gral'].gos_usuario_tecnico_id);
				$('#gos_usuario_tecnico_id').change();
				$('#tiempo_meta').val(data['gral'].tiempo_meta);
				$('#minimo_fotos').val(data['gral'].minimo_fotos);
				//checks-----------------alberto----------------------------------------------------------
				console.log(data['gral'].perdidatota);
				if(data['gral'].perdidatotal==1){ $('#chekperdida').attr('checked','checked');}
				else { $('#chekperdida').removeAttr('checked');}
					console.log(data['gral'].pagodanio);
				if(data['gral'].pagodanios==1){ $('#checkpao').attr('checked','checked');}
				else { $('#checkpao').removeAttr('checked');}

				//--------------------checks alberto-------------------------------------------------------
				if(data['gral'].genera_valor==1){ $('#genera_valor').attr('checked','checked');}
				else { $('#genera_valor').removeAttr('checked');}
				if(data['gral'].complemento==1){ $('#complemento').attr('checked','checked');}
				else { $('#complemento').removeAttr('checked'); }
				if(data['gral'].materiales==1){ $('#materiales').attr('checked','checked');}
				else { $('#materiales').removeAttr('checked');}
				if(data['gral'].refacciones==1){ $('#refacciones').attr('checked','checked');}
				else { $('#refacciones').removeAttr('checked');}
				$('#link').val(data['gral'].link); // TEXTAREA
		// MENSAJES WHATSAPp
				if(data['mjs'][0]){
					$('#gos_paq_etapa_mensaje_id_1').val(data['mjs'][0].gos_paq_etapa_mensaje_id);
					$('#mensaje_nomb_1').val(data['mjs'][0].mensaje_nomb);
					$('#mensaje_cuerpo_1').val(data['mjs'][0].mensaje_cuerpo);
				}
				if(data['mjs'][1]){
					$('#gos_paq_etapa_mensaje_id_2').val(data['mjs'][1].gos_paq_etapa_mensaje_id);
					$('#mensaje_nomb_2').val(data['mjs'][1].mensaje_nomb);
					$('#mensaje_cuerpo_2').val(data['mjs'][1].mensaje_cuerpo);
				}
				if(data['mjs'][2]){
					$('#gos_paq_etapa_mensaje_id_3').val(data['mjs'][2].gos_paq_etapa_mensaje_id);
					$('#mensaje_nomb_3').val(data['mjs'][2].mensaje_nomb);
					$('#mensaje_cuerpo_3').val(data['mjs'][2].mensaje_cuerpo);
				}
		//CALCULOS DE TIEMPOS
				if(data['CalcTiempo'][0]){
					$('#gos_paq_etapa_calc_tiempo_id_1').val(data['CalcTiempo'][0].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_1').val(data['CalcTiempo'][0].gos_aseguradora_id);
					$('#gos_aseguradora_id_1').change();
					$('#monto_1').val(data['CalcTiempo'][0].monto);
				}
				if(data['CalcTiempo'][1]){
					$('#gos_paq_etapa_calc_tiempo_id_2').val(data['CalcTiempo'][1].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_2').val(data['CalcTiempo'][1].gos_aseguradora_id);
					$('#gos_aseguradora_id_2').change();
					$('#monto_2').val(data['CalcTiempo'][1].monto);
				}
				if(data['CalcTiempo'][2]){
					$('#gos_paq_etapa_calc_tiempo_id_3').val(data['CalcTiempo'][2].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_3').val(data['CalcTiempo'][2].gos_aseguradora_id);
					$('#gos_aseguradora_id_3').change();
					$('#monto_3').val(data['CalcTiempo'][2].monto);
				}
				if(data['CalcTiempo'][3]){
					$('#gos_paq_etapa_calc_tiempo_id_4').val(data['CalcTiempo'][3].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_4').val(data['CalcTiempo'][3].gos_aseguradora_id);
					$('#gos_aseguradora_id_4').change();
					$('#monto_4').val(data['CalcTiempo'][3].monto);
				}
				if(data['CalcTiempo'][4]){
					$('#gos_paq_etapa_calc_tiempo_id_5').val(data['CalcTiempo'][4].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_5').val(data['CalcTiempo'][4].gos_aseguradora_id);
					$('#gos_aseguradora_id_5').change();
					$('#monto_5').val(data['CalcTiempo'][4].monto);
				}
				if(data['CalcTiempo'][5]){
					$('#gos_paq_etapa_calc_tiempo_id_6').val(data['CalcTiempo'][5].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_6').val(data['CalcTiempo'][5].gos_aseguradora_id);
					$('#gos_aseguradora_id_6').change();
					$('#monto_6').val(data['CalcTiempo'][5].monto);
				}
				if(data['CalcTiempo'][6]){
					$('#gos_paq_etapa_calc_tiempo_id_7').val(data['CalcTiempo'][6].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_7').val(data['CalcTiempo'][6].gos_aseguradora_id);
					$('#gos_aseguradora_id_7').change();
					$('#monto_7').val(data['CalcTiempo'][6].monto);
				}
				if(data['CalcTiempo'][7]){
					$('#gos_paq_etapa_calc_tiempo_id_8').val(data['CalcTiempo'][7].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_8').val(data['CalcTiempo'][7].gos_aseguradora_id);
					$('#gos_aseguradora_id_8').change();
					$('#monto_8').val(data['CalcTiempo'][7].monto);
				}
				if(data['CalcTiempo'][8]){
					$('#gos_paq_etapa_calc_tiempo_id_9').val(data['CalcTiempo'][8].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_9').val(data['CalcTiempo'][8].gos_aseguradora_id);
					$('#gos_aseguradora_id_9').change();
					$('#monto_9').val(data['CalcTiempo'][8].monto);
				}
				if(data['CalcTiempo'][9]){
					$('#gos_paq_etapa_calc_tiempo_id_10').val(data['CalcTiempo'][9].gos_paq_etapa_calc_tiempo_id);
					$('#gos_aseguradora_id_10').val(data['CalcTiempo'][9].gos_aseguradora_id);
					$('#gos_aseguradora_id_10').change();
					$('#monto_10').val(data['CalcTiempo'][9].monto);
				}
				if($('#calc_tiempo_2').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_2').val().length > 0){
					$('#calc_tiempo_2').removeClass('d-none');
				}
				if($('#calc_tiempo_3').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_3').val().length > 0){
					$('#calc_tiempo_3').removeClass('d-none');
				}
				if($('#calc_tiempo_4').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_4').val().length > 0){
					$('#calc_tiempo_4').removeClass('d-none');
				}
				if($('#calc_tiempo_5').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_5').val().length > 0){
					$('#calc_tiempo_5').removeClass('d-none');
				}
				if($('#calc_tiempo_6').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_6').val().length > 0){
					$('#calc_tiempo_6').removeClass('d-none');
				}
				if($('#calc_tiempo_7').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_7').val().length > 0){
					$('#calc_tiempo_7').removeClass('d-none');
				}
				if($('#calc_tiempo_8').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_8').val().length > 0){
					$('#calc_tiempo_8').removeClass('d-none');
				}
				if($('#calc_tiempo_9').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_9').val().length > 0){
					$('#calc_tiempo_9').removeClass('d-none');
				}
				if($('#calc_tiempo_10').hasClass('d-none') && $('#gos_paq_etapa_calc_tiempo_id_10').val().length > 0){
					$('#calc_tiempo_10').removeClass('d-none');
				}

				var selected_PerdidaTotal = [];
				$.each(data['PerdTotal'], function(key, perdidaTotal) {
					selected_PerdidaTotal.push(perdidaTotal.etapa_perdida_total_id_rel);
				});
				$("#perdida_total_id").val(selected_PerdidaTotal);
				$('#perdida_total_id').change();

				var selected_EtapasLigadas = [];
				$.each(data['Ligaga'], function(key, etapaligada) {
					selected_EtapasLigadas.push(etapaligada.etapa_ligada_relacionada);
				});
				$("#etapa_ligada_id").val(selected_EtapasLigadas);
				$('#etapa_ligada_id').change();

				var selected_danio = [];
				$.each(data['Danios'], function(key, danio) {
					selected_danio.push(danio.etapa_pago_danios_id_rel);
				});
				$("#etapa_danio_id").val(selected_danio);
				$('#etapa_danio_id').change();
			});
		});*/

		/* BORRAR ETAPA */
		$('body').on('click','#borrar-etapa',function(){
			var id = $(this).data('id');
			if (confirm('Está seguro que desea borrar?')) {
				$.ajax({
					type : 'DELETE',
					url : '/gestion-etapas/'+ id,
					success : function(data) {
					},
					error : function(data) {
						console.log('Error:', data);
					}
				});
			}
			 window.location.reload(true);
		});

	// BOTONES % $ COMISION


	function limpiartextEtapa(){
		$('.nomb_etapa').text('');
		$('.descripcion_etapa').text('');
		$('.comision_asesor').text('');
		$('.gos_usuario_tecnico_id').text('');
		$('.tiempo_meta').text('');
		$('.minimo_fotos').text('');
	}

	$('.btn_calc').click(function(){
		if($('#calc_tiempo_10').hasClass('d-none')){
			if($('#calc_tiempo_9').hasClass('d-none')==false && $('#calc_tiempo_10').hasClass('d-none')){
				$('#calc_tiempo_10').removeClass('d-none');
			}
			if($('#calc_tiempo_8').hasClass('d-none')==false && $('#calc_tiempo_9').hasClass('d-none')){
				$('#calc_tiempo_9').removeClass('d-none');
			}
			if($('#calc_tiempo_7').hasClass('d-none')==false && $('#calc_tiempo_8').hasClass('d-none')){
				$('#calc_tiempo_8').removeClass('d-none');
			}
			if($('#calc_tiempo_6').hasClass('d-none')==false && $('#calc_tiempo_7').hasClass('d-none')){
				$('#calc_tiempo_7').removeClass('d-none');
			}
			if($('#calc_tiempo_5').hasClass('d-none')==false && $('#calc_tiempo_6').hasClass('d-none')){
				$('#calc_tiempo_6').removeClass('d-none');
			}
			if($('#calc_tiempo_4').hasClass('d-none')==false && $('#calc_tiempo_5').hasClass('d-none')){
				$('#calc_tiempo_5').removeClass('d-none');
			}
			if($('#calc_tiempo_3').hasClass('d-none')==false && $('#calc_tiempo_4').hasClass('d-none')){
				$('#calc_tiempo_4').removeClass('d-none');
			}
			if($('#calc_tiempo_2').hasClass('d-none')==false && $('#calc_tiempo_3').hasClass('d-none')){
				$('#calc_tiempo_3').removeClass('d-none');
			}
			if($('#calc_tiempo_2').hasClass('d-none')){
				$('#calc_tiempo_2').removeClass('d-none');
			}
		}
	});

});

function comisiontipo(){
	var comtipo=document.getElementById('comision_asesor_tipo').value;

  var btn=document.getElementById('btncomtipo')
	if (comtipo=="PESOS") {
    btn.innerHTML ="%";
    document.getElementById('comision_asesor_tipo').value="PORCIENTO";
	}
	if (comtipo=="PORCIENTO") {
   btn.innerHTML ="$";
   document.getElementById('comision_asesor_tipo').value="PESOS";
	}
}

function agregarws(){

		var lentgh = parseInt (document.getElementById("MensajesWSlength").value);
		lentgh=lentgh+1;
  	$('#MensajesWSBody').append('<div class="form-group"><label>Titulo del Mensaje</label>'+
     '<input type="text" class="form-control" name="Nmensaje['+lentgh+']"></div><div class="form-group">'+
		'<label>Mensaje de Whatsapp  <i class="fas fa-info-circle fa-sm"></i></label>'+
   '<textarea class="form-control" rows="3" name="Nmensaje_cuerpo['+lentgh+']"></textarea></div>');
		 document.getElementById("MensajesWSlength").value=lentgh;
}

function addcalculiTiempo(){
	var lentgh =parseInt(document.getElementById("CaculoTiempolength").value);
	lentgh=lentgh+1;
	var monto=document.getElementById("monto").value;
	var Asesel=document.getElementById("calculotiemposel");
	console.log(Asesel);
  var Asename= $("#calculotiemposel option:selected").text();
	var Aseid=document.getElementById("calculotiemposel").value;
  	$('#calculos_tiemposbody').append('<br> <input type="hidden"name="NuevoCtiempoAseid['+lentgh+']" value="'+Aseid+'" ><div class="row"> <div class=col-md-5> <input type="text"class="form-control"  value="'+Asename+'"> </div> <div class=col-md-5>     <input type="text"class="form-control" name="NuevoCtiempoMonto['+lentgh+']" value="'+monto+'"> </div> </div>');
document.getElementById("CaculoTiempolength").value=lentgh;
}
function addperdidat(){
	var lentgh=parseInt(document.getElementById("perdidalength").value);
  lentgh=lentgh+1;
	var etapaid=document.getElementById("perdida_total_id").value;
	var etapaname=$("#perdida_total_id option:selected").text();;;
	$('#containerperdida').append('<div class="row mb-1"><div class="col-md-2">'+
	  '<input type="hidden" name="NPerdiodaEtapa['+lentgh+']" value="'+etapaid+'">'+
	  '<input type="text" class="form-control" name="NPerdiodaOrden['+lentgh+']" value="'+lentgh+'">'+
	  '</div><div class="col-md-8">'+
	  '<input type="text" class="form-control"  value="'+etapaname+'">'+
		'</div></div>');
	document.getElementById("perdidalength").value=lentgh;
}

function addetapalig(){
	var lentgh =parseInt(document.getElementById("ligadalen").value);
	lentgh=lentgh+1;
	var etapaid=document.getElementById("etapa_ligada_id").value;
	var etapaname=$("#etapa_ligada_id option:selected").text();;;
	$('#containerLigadas').append('<div class="row mb-1"><div class="col-md-2">'+
		'<input type="hidden" name="NLigadaEtapa['+lentgh+']" value="'+etapaid+'">'+
		'<input type="text" class="form-control" name="NLigadaOrden['+lentgh+']" value="'+lentgh+'">'+
		'</div><div class="col-md-8">'+
		'<input type="text" class="form-control"  value="'+etapaname+'">'+
		'</div></div>');
	document.getElementById("ligadalen").value=lentgh;
}

function addpagodaños(){
	var lentgh =parseInt(document.getElementById("pagolen").value);
  lentgh=lentgh+1;
	var etapaid=document.getElementById("etapa_danio_id").value;
	var etapaname=$("#etapa_danio_id option:selected").text();;;
	$('#containerdaños').append('<div class="row mb-1"><div class="col-md-2">'+
	  '<input type="hidden" name="NPdanosEtapa['+lentgh+']" value="'+etapaid+'">'+
	  '<input type="text" class="form-control" name="NPdanosOrden['+lentgh+']" value="'+lentgh+'">'+
	  '</div><div class="col-md-8">'+
	  '<input type="text" class="form-control"  value="'+etapaname+'">'+
		'</div></div>');
	document.getElementById("pagolen").value=lentgh;
}

function GuardarEtapaVal(){
 var val=0; var msg="";
	var etapa=document.getElementById('nomb_etapa').value;
	var descripcion=document.getElementById('descripcion_etapa').value;
	var tecnico=document.getElementById('gos_usuario_tecnico_id').value;
	var tiempometa=document.getElementById('tiempo_meta').value;
		 if (etapa=="") {
		     val=1;
				 msg=msg+"- Etapa -\n"
		 }
		 if (descripcion=="") {
				val=1;
				 msg=msg+"- Descripcion -\n"
		}
		if (tecnico=="") {
				val=1;
				 msg=msg+"- Asesor -\n"
		}
		if (tiempometa=="") {
				val=1;
				 msg=msg+"- Tiempo Meta -\n"
		}

		if (val>0) {
			Swal.fire({
			icon: 'Error',
			title: 'Campos Faltantes',
			text: msg,

			})
		}
		else{
			 document.getElementById("saveetapasubmit").click();
		}


}
