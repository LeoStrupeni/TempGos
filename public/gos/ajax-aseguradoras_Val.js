$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});

	// get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#aseguradorasDataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/gestion-aseguradoras',
		columns : [	{data : 'gos_aseguradora_id',name : 'id','visible' : false},
					{data : 'empresa'},
					{data : 'historico_ordenes'},
					{data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

/* Clic Agregar */	
	$('#Aseguradora-Nuevo').click(function() {
		limpiartextAseguradora();
		$('#gos_aseguradora_id').val('');
		$('.linkModalAseg1').addClass('active');
		if ($('.linkModalAseg2').hasClass('active')){$('.linkModalAseg2').removeClass('active');}
		if ($('.linkModalAseg3').hasClass('active')){$('.linkModalAseg3').removeClass('active');}
		$('#aseguradoraForm').trigger('reset');
		$('#TitleModalAseguradora').html('Nueva aseguradora');
		$('#ModalAseguradora').modal('show');
		$("#gos_fac_tipo_persona_id").selectpicker("refresh");
		$('#dias_credito_Check').removeAttr('checked');
		$('#monto_maximo_credito_Check').removeAttr('checked');
		$('#nro_cta_cliente_Check').removeAttr('checked');
		$('#habilita_facturacion_cliente').removeAttr('checked');
		$('#requiere_autorizacion').removeAttr('checked');
		$("#gos_fac_region_ciudad_id").selectpicker("refresh");
		$("#gos_fac_region_estado_id").selectpicker("refresh");


		$('#dias_credito').prop('disabled', true);
		$('#nro_cta_cliente').prop('disabled', true);
		$('#monto_maximo_credito').prop('disabled', true);
	});

	$("#gos_fac_region_estado_id").on('change',function(){
		var id = $(this).val();
		$('#gos_fac_region_ciudad_id').empty();
		$.ajax({
			url : app_url+'/gestion-clientes-ciudad/'+id,
			type: 'get',
			dataType: 'json',
			success: function(response){
	
			  var len = 0;
			  if(response['data'] != null){
				len = response['data'].length;
			  }
			  if(len > 0){
				var optionBlank = '<option></option>';
				$("#gos_fac_region_ciudad_id").append(optionBlank); 
				// Read data and create <option >
				for(var i=0; i<len; i++){
	
					var id = response['data'][i].gos_region_ciudad_id;
					var name = response['data'][i].nomb_ciudad;
	
					var option = "<option value='"+id+"'>"+name+"</option>"; 
					$("#gos_fac_region_ciudad_id").append(option); 
					$("#gos_fac_region_ciudad_id").selectpicker("refresh");
				}
			  }
	
			}
		});
	});
	
//BTN GUARDAR
	$('#btnGuardarAseguradora').click(function(event){
		limpiartextAseguradora();		
		//validar modal aseguradoras
		var regex_mail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
		var regex_letras = /^[A-Za-zÀ-ÖØ-öø-ÿ.!#$%&'*+/=?^_ ]*$/;
		var regex_numeros = /^([0-9])*$/;
		var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;

		var $errores = 0

		if($('#empresa').val().trim() == '' || !regex_letras.test($('#empresa').val())){
			if($('#empresa').val().trim() == ''){
				$('.empresa').text('Campo obligatorio');
			}else{
				$('.empresa').text('');
				$('.empresa').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.empresa').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_letras.test($('#contacto').val())){
			$('.contacto').text('El campo acepta solo letras');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.contacto').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_numeros.test($('#telefono_fijo').val()) || ($('#telefono_fijo').val().length != 10 && $('#telefono_fijo').val().length > 0)){
			$('.telefono_fijo').text('Campo numerico y de largo 10');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.telefono_fijo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_numeros.test($('#celular').val()) || ($('#celular').val().length != 10 && $('#celular').val().length > 0)){
			$('.celular').text('Campo numerico y de largo 10');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.celular').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_mail.test($('#email_enlace').val()) && $('#email_enlace').val().length > 0 ){
			$('.email_enlace').text('Formato email no valido');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.email_enlace').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#datosFacturacion').hasClass('active') || $('#AseguradoraConfiguracion').hasClass('active')){
			if ($('#habilita_facturacion_cliente').prop('checked')==false){

				if($('#gos_fac_tipo_persona_id').val()==0){
					$('.gos_fac_tipo_persona_id').text('Campo obligatorio');
					$errores++;
				} else {
					$(this).focus(function(){
						$('.gos_fac_tipo_persona_id').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#razon_social').val().trim() == '' || !regex_alfanumerico.test($('#razon_social').val())){
					if($('#razon_social').val().trim() == ''){
						$('.razon_social').text('Campo obligatorio');
					}else{
						$('.razon_social').text('');
						$('.razon_social').text('Campo alfanumerico');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.razon_social').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#rfc').val().trim() == '' || !regex_alfanumerico.test($('#rfc').val())){
					if($('#rfc').val().trim() == ''){
						$('.rfc').text('Campo obligatorio');
					}else{
						$('.rfc').text('');
						$('.rfc').text('Campo alfanumerico');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.rfc').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#email_factura').val().trim() == '' || !regex_mail.test($('#email_factura').val())){
					if($('#email_factura').val().trim() == ''){
						$('.email_factura').text('Campo obligatorio');
					}else{
						$('.email_factura').text('');
						$('.email_factura').text('Formato email no valido');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.email_factura').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#calle_nro_fac').val().trim() == '' || !regex_alfanumerico.test($('#calle_nro_fac').val())){
					if($('#calle_nro_fac').val().trim() == ''){
						$('.calle_nro_fac').text('Campo obligatorio');
					}else{
						$('.calle_nro_fac').text('');
						$('.calle_nro_fac').text('Campo alfanumerico');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.calle_nro_fac').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#nro_exterior_fac').val().trim() == '' || !regex_alfanumerico.test($('#nro_exterior_fac').val())){
					if($('#nro_exterior_fac').val().trim() == ''){
						$('.nro_exterior_fac').text('Campo obligatorio');
					}else{
						$('.nro_exterior_fac').text('');
						$('.nro_exterior_fac').text('Campo alfanumerico');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.nro_exterior_fac').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if(!regex_alfanumerico.test($('#nro_interior_fac').val())){
					$('.nro_interior_fac').text('Campo alfanumerico');
					$errores++;
				} else {
					$(this).focus(function(){
						$('.nro_interior_fac').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
		
				if($('#cp_fac').val().trim() == '' || !regex_numeros.test($('#cp_fac').val())){
					if($('#cp_fac').val().trim() == ''){
						$('.cp_fac').text('Campo obligatorio');
					}else{
						$('.cp_fac').text('')
						$('.cp_fac').text('Campo numerico');
					}
					$errores++;
				} else {
					$(this).focus(function(){
						$('.cp_fac').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
				if($('#gos_fac_region_estado_id').val()==0){
					$('.gos_fac_region_estado_id').text('Campo obligatorio');
					$errores++;
				} else {
					$(this).focus(function(){
						$('.gos_fac_region_estado_id').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
	
				if($('#gos_fac_region_ciudad_id').val()==0){
					$('.gos_fac_region_ciudad_id').text('Campo obligatorio');
					$errores++;
				} else {
					$(this).focus(function(){
						$('.gos_fac_region_ciudad_id').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
			}

			if($('#AseguradoraConfiguracion').hasClass('active')){
				if($('#dias_credito').val()==0){
					$('.dias_credito').text('Campo obligatorio');
					$errores++;
				} else {
					$(this).focus(function(){
						$('.dias_credito').text('');
						if($errores > 0){
							$errores-1;
						}
					});
				}
			}
		}
		
		if($errores != 0){
			event.preventDefault();
		} else {
			guardarAseguradora();
		}
	});

	//FUNCION GUARDAR
	function guardarAseguradora(){
		$('#btnGuardarAseguradora').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data: $('#aseguradoraForm').serialize(),
				url : app_url+'/gestion-aseguradoras',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown,data) {
					$('#btnGuardarAseguradora').html('Guardar');
					// printErrorMsg(textStatus);
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
					}
				},
				success : function(data) {
					console.log(data);
					limpiartextAseguradora();
					$('.gos_fac_region_colonia_id').text('');
					$('.gos_fac_region_municipio_id').text('');
					$('#aseguradorasDataTable').DataTable().ajax.reload();
					$('#aseguradoraForm').trigger('reset');
					$('#ModalAseguradora').modal('hide');
					$('#btnGuardarAseguradora').html('Guardar');
				}
			}); //ajax
	};// fn

	

	// BTN EDITAR SERVICIO
	$('body').on('click', '.btnEditarAseguradora', function () {
		var id = $(this).data('id');
		limpiartextAseguradora();
		$.get('gestion-aseguradoras/' + id + '/edit',
			function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			// $('#TitleModalAseguradora').html('Editar Aseguradora');
			$('.linkModalAseg1').addClass('active');
			if ($('.linkModalAseg2').hasClass('active')){$('.linkModalAseg2').removeClass('active');}
			if ($('.linkModalAseg3').hasClass('active')){$('.linkModalAseg3').removeClass('active');}
			if ($('.linkModalAseg4').hasClass('active')){$('.linkModalAseg4').removeClass('active');}
			$('#ModalAseguradora').modal('show');
			//datos aseguradora
			$('#gos_aseguradora_id').val(data.gos_aseguradora_id);
			$('#empresa').val(data.empresa);
			$('#contacto').val(data.contacto);
			$('#telefono_fijo').val(data.telefono_fijo);
			$('#celular').val(data.celular);
			$('#email_enlace').val(data.email_enlace);
			//datos Facturacion	
			if(data.habilita_facturacion_cliente==1){
				$('#habilita_facturacion_cliente').attr('checked','checked');
			} else { 
				$('#habilita_facturacion_cliente').removeAttr('checked');
			}
			if(data.requiere_autorizacion==1){
				$('#requiere_autorizacion').attr('checked','checked');
			}else {
				$('#requiere_autorizacion').removeAttr('checked');
			}
			$('#gos_fac_tipo_persona_id').val(data.gos_fac_tipo_persona_id); // SELECT
			$('#gos_fac_tipo_persona_id').change();
			$('#razon_social').val(data.razon_social);
			$('#rfc').val(data.rfc);
			$('#email_factura').val(data.email_factura);
			$('#calle_nro_fac').val(data.calle_nro_fac);
			$('#nro_exterior_fac').val(data.nro_exterior_fac);
			$('#nro_interior_fac').val(data.nro_interior_fac);
			$('#cp_fac').val(data.cp_fac);
			$('#gos_region_ciudad').val(data.gos_region_ciudad_id); // SELECT
			$('#gos_fac_region_ciudad').val(data.gos_region_ciudad_id); // SELECT
		
			$('#ase_fac_municipio').val(data.ase_fac_municipio); // SELECT
			$('#ase_fac_localidad').val(data.ase_fac_localidad); // SELECT

			$('#gos_region_ciudad_id').change();
			$('#gos_fac_region_estado_id').val(data.gos_region_estado_id); // SELECT
			$('#gos_fac_region_estado_id').change();
			$('#indicaciones').val(data.indicaciones); //TEXTAREA
			//datos Configuracion
			$('#dias_credito').val(data.dias_credito);
			$('#monto_maximo_credito').val(data.monto_maximo_credito);
			$('#nro_cta_cliente').val(data.nro_cta_cliente);
			if(data.dias_credito == null){
				$('#dias_credito_Check').removeAttr('checked');
				$('#dias_credito').attr('disabled');
			}
			else {
				$('#dias_credito_Check').attr('checked','checked');
				$('#dias_credito').removeAttr('disabled');
			}

			if(data.monto_maximo_credito == null){
				$('#monto_maximo_credito_Check').removeAttr('checked');
				$('#monto_maximo_credito').attr('disabled');
			}
			else {
				$('#monto_maximo_credito_Check').attr('checked','checked');
				$('#monto_maximo_credito').removeAttr('disabled');
			}
			if(data.nro_cta_cliente == null){
				$('#nro_cta_cliente_Check').removeAttr('checked');
				$('#nro_cta_cliente').attr('disabled');
			}
			else {
				$('#nro_cta_cliente_Check').attr('checked','checked');
				$('#nro_cta_cliente').removeAttr('disabled');
			}

			if(data.tot_os == 1){
				$('#tot_os').attr('checked','checked');
			}
			else {
				$('#tot_os').removeAttr('checked');
			}
			if(data.poliza_os == 1){
				$('#poliza_os').attr('checked','checked');

			}
			else {
				$('#poliza_os').removeAttr('checked');
			}

			if(data.siniestro_os == 1){
				$('#siniestro_os').attr('checked','checked');
			}
			else {
				$('#siniestro_os').removeAttr('checked');
				
			}

			if(data.siniestro_os == 1){
				$('#siniestro_os').attr('checked','checked');
			}
			else {
				$('#siniestro_os').removeAttr('checked');
			}

			if(data.reporte_os == 1){
				$('#reporte_os').attr('checked','checked');
			}
			else {
				$('#reporte_os').removeAttr('checked');
			}

			if(data.orden_os == 1){
				$('#orden_os').attr('checked','checked');
			}
			else {
				$('#orden_os').removeAttr('checked');
			}

			if(data.demerito_os == 1){
				$('#demerito_os').attr('checked','checked');
			}
			else {
				$('#demerito_os').removeAttr('checked');
			}

			if(data.deducible_os == 1){
				$('#deducible_os').attr('checked','checked');
			}
			else {
				$('#deducible_os').removeAttr('checked');

			}
			if(data.encuesta_os == 1){
				$('#encuesta_os').attr('checked','checked');
			}
			else {
				$('#encuesta_os').removeAttr('checked');

			}

			if(data.condiciones_os == 1){
				$('#condiciones_os').attr('checked','checked');
			}
			else {
				$('#condiciones_os').removeAttr('checked');

			}
			if(data.grua_os == 1){
				$('#grua_os').attr('checked','checked');
			}
			else {
				$('#grua_os').removeAttr('checked');

			}
		});
		setTimeout(function(){     
			var fac_ciudad = $('#gos_fac_region_ciudad').val(); 
			$('#gos_fac_region_ciudad_id').val(fac_ciudad); 
			$('#gos_fac_region_ciudad_id').change(); 
		}, 2000);
	});

	/* BORRAR SERVICIO */
	$('body').on('click','#borrarAseguradora',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar!!')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/gestion-aseguradoras/'+ id,
				success : function(data) {
						$('#aseguradorasDataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:',data);
				}
			});
		}
	});

	function limpiartextAseguradora() {
		$('.empresa').text('');
		$('.contacto').text('');
		$('.telefono_fijo').text('');
		$('.celular').text('');
		$('.email_enlace').text('');
		$('.gos_fac_tipo_persona_id').text('');
		$('.razon_social').text('');
		$('.rfc').text('');
		$('.email_factura').text('');
		$('.calle_nro_fac').text('');
		$('.nro_exterior_fac').text('');
		$('.nro_interior_fac').text('');
		$('.cp_fac').text('');
		$('.gos_fac_region_colonia_id').text('');
		$('.gos_fac_region_municipio_id').text('');
		$('.gos_fac_region_localidad_id').text('');
		$('.dias_credito').text('');
		$('.gos_fac_region_ciudad_id').text('');
		$('.gos_fac_region_estado_id').text('');
	}

});


