$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

    // get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#TOT-DataTable').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : '/gestion-otrotaller',
		columns : [ { data : 'gos_ot_id', name : 'id','visible' : false },
					{ data : 'nomb_ot'},
					{ data : 'direccion'},
					{ data : 'telefono'},
					{ data : 'cant_os'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {"url" : "/gos/Spanish.json"}
	});


	$("#gos_region_estado_id").on('change',function(){
		var id = $(this).val();
		$('#gos_region_ciudad_id').empty();
		$.ajax({
			url : '/gestion-clientes-ciudad/'+id,
			type: 'get',
			dataType: 'json',
			success: function(response){
	
			  var len = 0;
			  if(response['data'] != null){
				len = response['data'].length;
			  }
			  if(len > 0){
				var optionBlank = '<option></option>';
				$("#gos_region_ciudad_id").append(optionBlank); 
				// Read data and create <option >
				for(var i=0; i<len; i++){
	
					var id = response['data'][i].gos_region_ciudad_id;
					var name = response['data'][i].nomb_ciudad;
					var option = "<option value='"+id+"'>"+name+"</option>"; 
					$("#gos_region_ciudad_id").append(option); 
					$("#gos_region_ciudad_id").selectpicker("refresh");
				}
			  }
	
			}
		});
	});
	
	// BTN TOT
	$('#crear-nuevo-TOT').click(function() {
		$('.nomb_ot').text('');
		$('.telefono').text('');
		$('.direccion').text('');
		$('.cp').text('');

		$("#gos_region_ciudad_id").selectpicker("refresh");
		$("#gos_region_estado_id").selectpicker("refresh");
		
		$('.gos_region_ciudad_id').text('');
		$('.gos_region_estado_id').text('');

		$('#gos_ot_id').val('');
		$('#formTOT').trigger("reset");
		$('#titleModalTOT').html("Otro taller nuevo");
		$('#modalTOT').modal('show');
	});

	/* GUARDAR TOT */
	$('#btnGuardarTOT').click(function(event) {
		var regex_numeros = /^([0-9])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9 ])*$/;
		var regex_letras = /^[A-Za-zÀ-ÖØ-öø-ÿ.!#$%&'*+/=?^_ ]*$/;
		var $errores = 0

		if($('#nomb_ot').val().trim() == '' || !regex_letras.test($('#nomb_ot').val())){
			if($('#nomb_ot').val().trim() == ''){
				$('.nomb_ot').text('Campo obligatorio');
			}else{
				$('.nomb_ot').text('');
				$('.nomb_ot').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_ot').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#telefono').val().trim() == '' || !regex_numeros.test($('#telefono').val())  || $('#telefono').val().length != 10 ){
			if($('#telefono').val().trim() == ''){
				$('.telefono').text('Campo obligatorio');
			}else{
				$('.telefono').text('');
				$('.telefono').text('Campo numerico y de largo 10');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.telefono').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#gos_region_estado_id').val()==0){
			$('.gos_region_estado_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_region_estado_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#gos_region_ciudad_id').val()==0){
			$('.gos_region_ciudad_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_region_ciudad_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		if($('#direccion').val().trim() == '' ){
			if($('#direccion').val().trim() == ''){
				$('.direccion').text('Campo obligatorio');
			}else{
				$('.direccion').text('');
				$('.direccion').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.direccion').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}


		if($('#cp').val().trim() == '' || !regex_numeros.test($('#cp').val()) ){
			if($('#cp').val().trim() == ''){
				$('.cp').text('Campo obligatorio');
			}else{
				$('.cp').text('');
				$('.cp').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.cp').text('');
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

	//FUNCION GUARDAR
	function guardar(){
		// var actionType = $('#btnGuardarTOT').val();
		$('#btnGuardarTOT').html('Guardando...');
		$.ajax({contenttype : "application/json; charset=utf-8",
			data:  $("#formTOT").serialize(),
			url : '/gestion-otrotaller',
			type : "POST",
			//dataType : "json",
			done : function(response) {console.log(response);},
			error : function(jqXHR,textStatus,errorThrown) {
				$('#btnGuardarTOT').html('Guardar');
				if (console && console.log) {
					console.log("La solicitud a fallado: "+ textStatus);
					console.log("La solicitud a fallado: "+ errorThrown);
					}
				},
			success : function(data) {
				$('.nomb_ot').text('');
				$('.telefono').text('');
				$('.direccion').text('');
				$('.cp').text('');
				$('#TOT-DataTable').DataTable().ajax.reload();
				$('#formTOT').trigger("reset");
				$('#modalTOT').modal('hide');
				$('#btnGuardarTOT').html('Guardar');
				}
	}); //ajax
} //fn

	/* EDITAR TOT */
	$('body').on('click', '.btn-editar-TOT', function () {
		var id = $(this).data('id');
		$('.nomb_ot').text('');
		$('.telefono').text('');
		$('.direccion').text('');
		$('.cp').text('');

		$('.gos_region_ciudad_id').text('');
		$('.gos_region_estado_id').text('');
		$.get('gestion-otrotaller/' + id +'/edit', function (data) {
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#titleModalTOT').html("Editar TOT");
			$('#modalTOT').modal('show');
		//campos
			$('#gos_ot_id').val(data.gos_ot_id);
			$('#nomb_ot').val(data.nomb_ot);
			$('#ot_localidad').val(data.ot_localidad);
			$('#ot_municipio').val(data.ot_municipio);
			$('#telefono').val(data.telefono);
			$('#direccion').val(data.direccion);
			$('#cp').val(data.cp);
			$('#gos_region_ciudad').val(data.gos_region_ciudad_id); // SELECT
			$('#gos_region_estado_id').val(data.gos_region_estado_id); //SELECT
			$('#gos_region_estado_id').change();
		})

		setTimeout(function(){     
			var fac_ciudad = $('#gos_region_ciudad').val(); 
			$('#gos_region_ciudad_id').val(fac_ciudad); 
			$('#gos_region_ciudad_id').change(); 
		}, 2000);
	});

	/* BORRAR TOT */
	$('body').on('click','#borrar-TOT',function() {
		var id = $(this).data('id');
		if (confirm("Esta seguro que desea borrar!!")) {
			$.ajax({
				type : "DELETE",
				url : "gestion-otrotaller/"+ id,
				success : function(data) {
					$('#TOT-DataTable').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});


});
