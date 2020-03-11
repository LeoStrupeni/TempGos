$(document).ready(function() {
	//console.log("os-cliente-vehiculo");
	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
    $('#titleModalCliente').html('Nuevo cliente con vehículo');

	$("#gos_vehiculo_marca_id").on('change',function(){
		var id = $(this).val();
			console.log(id);
		$('#gos_vehiculo_modelo_id').empty();
		$.ajax({
			url : '/gestion-vehiculos-modelo/'+id,

			type: 'get',
			dataType: 'json',
			success: function(response){

			  var len = 0;
			  if(response['data'] != null){
				len = response['data'].length;
			  }
			  if(len > 0){
				var optionBlank = '<option></option>';
				$("#gos_vehiculo_modelo_id").append(optionBlank);
				// Read data and create <option >
				for(var i=0; i<len; i++){

				  	var id = response['data'][i].gos_vehiculo_modelo_id;
					var name = response['data'][i].modelo_vehiculo;

				  	var option = "<option value='"+id+"'>"+name+"</option>";
					$("#gos_vehiculo_modelo_id").append(option);
					$("#gos_vehiculo_modelo_id").selectpicker("refresh");
				}
			  }

			}
		});
	});
	$('#btn-guardar-cliente').click(function(event){
		var regex_mail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
		var regex_letras = /^[A-Za-zÀ-ÖØ-öø-ÿ.!#$%&'*+/=?^_ ?^`{|}~-]*$/;
		var regex_numeros = /^([0-9])*$/;
		var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;
		 var $errores = 0

		if($('#nombre').val().trim() == ''  || !regex_letras.test($('#nombre').val())){
			if($('#nombre').val().trim() == ''){
				$('.nombre').text('El campo es obligatorio');
			}else{
				$('.nombre').text('');
				$('.nombre').text('El campo acepta solo letras');
			}
			$errores++;
		} else {
			$('.nombre').text('');
			if($errores > 0){
				$errores-1;
			}
		}

		if($('#apellidos').val().trim() == ''   || !regex_letras.test($('#apellidos').val())){
			if($('#apellidos').val().trim() == ''){
				$('.apellidos').text('El campo es obligatorio');
			}else{
				$('.apellidos').text('');
				$('.apellidos').text('El campo acepta solo letras');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.apellidos').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if(!regex_mail.test($('#email_cliente').val()) && !$('#email_cliente').attr('disabled')){
			if($('#email_cliente').val().trim() == ''){
				$('.email_cliente').text('El campo es obligatorio');
			}else{
				$('.email_cliente').text('Formato email no valido');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.email_cliente').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#celular').val().trim() == '' || !regex_numeros.test($('#celular').val())  || $('#celular').val().length != 10){
			if($('#celular').val().trim() == ''){
				$('.celular').text('Campo obligatorio');
			}else{
				$('.celular').text('');
				$('.celular').text('Campo numerico y de largo 10');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.celular').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#anio_vehiculo').val().trim() == '' || !regex_numeros.test($('#anio_vehiculo').val())){
			if($('#anio_vehiculo').val().trim() == ''){
				$('.anio_vehiculo').text('Campo obligatorio');
			}else{
				$('.anio_vehiculo').text('');
				$('.anio_vehiculo').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.anio_vehiculo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#placa').val().trim() == '' || !regex_alfanumerico.test($('#placa').val())){
			if($('#placa').val().trim() == ''){
				$('.placa').text('Campo obligatorio');
			}else{
				$('.placa').text('');
				$('.placa').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.placa').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#color_vehiculo').val() == '' ){
				$('.color_vehiculo').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.color_vehiculo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#gos_vehiculo_marca_id').val() == 0 ){
			$('.gos_vehiculo_marca_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_vehiculo_marca_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#gos_vehiculo_modelo_id').val() == 0 ){
			$('.gos_vehiculo_modelo_id').text('Campo obligatorio');
			$errores++;
			} else {
			$(this).focus(function(){
				$('.gos_vehiculo_modelo_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#nro_serie').val().trim() == '' || !regex_alfanumerico.test($('#nro_serie').val())){
			if($('#nro_serie').val().trim() == ''){
				$('.nro_serie').text('Campo obligatorio');
			}else{
				$('.nro_serie').text('');
				$('.nro_serie').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nro_serie').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($errores != 0){
			event.preventDefault();
		} else {
			guardar();
		}
    });

    function guardar(){
		$('#btn-guardar-cliente').html('Guardando...');
		cliente = $("#nombre").val();
		apellidos = $("#apellidos").val();
		marca = $( "#gos_vehiculo_marca_id option:selected" ).text();
		modelo = $( "#gos_vehiculo_modelo_id option:selected" ).text();
		placa = $('#placa').val();
		anio_vehiculo = $('#anio_vehiculo').val();
		concatenaVehiculo = marca + ' ' + modelo + ' ' + anio_vehiculo + ', P:' +placa;
		var nomb_cliente=cliente+' '+ apellidos;
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#clienteForm').serialize(),
				url : '/os-clientes-vehiculo',
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btn-guardar-vehiculo').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					$('#clienteForm').trigger('reset');
					$('#modalCliente').modal('hide');
					$('#btn-guardar-cliente').html('Guardar');
                    $('.nombre').text('');
                    $('.apellidos').text('');
                    $('.email_cliente').text('');
					$('.celular').text('');
					if(data != ''){
						$("#btn-buscarcliente").attr("style","display:none;") ;
						$('#cls-buscarcliente').removeAttr("style");
						$("#nomb_cliente").val(nomb_cliente);
						$("#detallesVehiculo").val(concatenaVehiculo);
						$("#gos_vehiculo_id").val(data.gos_vehiculo_id);
						$("#gos_cliente_id").val(data.gos_cliente_id);
					}
                	$("#gos_vehiculo_marca_id").selectpicker("refresh");
                    $("#gos_vehiculo_modelo_id").selectpicker("refresh");
                    $("#color_vehiculo").selectpicker("refresh");
                    $("#tipo_combustible").selectpicker("refresh");
                    $("#vehiculo_cilindros").selectpicker("refresh");
                    $("#nro_puertas").selectpicker("refresh");
                    $("#color_interior").selectpicker("refresh");
					$('.placa').text('');
					$('.gos_cliente_id').text('');
					$('.color_vehiculo').text('');
					$('.gos_vehiculo_marca_id').text('');
					$('.gos_vehiculo_modelo_id').text('');
					$('.nro_serie').text('');
					$('.anio_vehiculo').text('');
                    $('#dt-clientes-vehiculos').DataTable().ajax.reload();
				}
		});
	}
});
