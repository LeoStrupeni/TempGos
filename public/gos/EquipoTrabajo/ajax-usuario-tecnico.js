$(document).ready(function() {
	var app_url = $('#app_url').attr('url');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
   
// USUARIO TECNICO
    $('.nuevoUsuarioTecnico').click(function() {
        limpiartextUsuarioTecnico();
        $('#masDatosTecnico').removeClass('show');
        $('#gos_usuario_perfil_id_TEC').val('');
        $('#gos_usuario_perfil_id_TEC').change();
        $('#gos_paq_servicio_id_TEC').val('');
        $('#gos_paq_servicio_id_TEC').change();
        $('#gos_usuario_tecnico_id').val('');
        $('.ComisionPorcientoTecnico').addClass('d-none');
        $('.ComisionPesoTecnico').removeClass('d-none');
        $('.ComisionMaterialesPorcientoTecnico').addClass('d-none');
        $('.ComisionMaterialesPesoTecnico').removeClass('d-none');
        $('#tipo_comision_TEC').val('PESOS');
        $('#tipo_comision_Materiales_TEC').val('PESOS');
        $('#UsuarioTecnicoForm').trigger('reset');
        $('#titleModalEquipoTecnico').html('Nuevo tecnico');
        $('#modalEquipoTecnico').modal('show');
    });

/* GUARDAR USUARIO TECNICO */
    $('#btnGuardarUsuarioTecnico').click(function() {
        limpiartextUsuarioTecnico();
            var regex_mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
            var regex_letras = /^([a-zA-Z ])*$/;
            var regex_numeros = /^([0-9.])*$/;
            var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
            var $errores = 0

            if($('#gos_usuario_perfil_id_TEC').val().trim() == '' ){
                $('.gos_usuario_perfil_id').text('Campo obligatorio');
                $errores++;
            } else {
                $('.gos_usuario_perfil_id').text('');
                if($errores > 0){
                    $errores-1;
                }
            }
            
            if($('#gos_paq_servicio_id_TEC').val() == '' ){
                $('.gos_paq_servicio_id').text('Campo obligatorio');
            	$errores++;
            } else {
            	$('.gos_paq_servicio_id').text('');
            	if($errores > 0){
            		$errores-1;
            	}
            }
            
            if($('#monto_comision_TEC').val().trim() == '' || !regex_numeros.test($('#monto_comision_TEC').val()) ){
                $('.monto_comision').text('Campo numerico');
                $errores++;
            } else {
                $('.monto_comision').text('');
                if($errores > 0){
                    $errores-1;
                }
            }

            if($('#monto_comision_Materiales_TEC').val().trim() == '' || !regex_numeros.test($('#monto_comision_Materiales_TEC').val())){
                $('.monto_comision_materiales').text('Campo numerico');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.monto_comision_materiales').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if($('#nombre_TEC').val().trim() == '' || !regex_letras.test($('#nombre_TEC').val())){
                if($('#nombre_TEC').val().trim() == ''){
                    $('.nombre').text('Campo obligatorio');
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

            if($('#apellidos_TEC').val().trim() == '' || !regex_letras.test($('#apellidos_TEC').val())){
                if($('#apellidos_TEC').val().trim() == ''){
                    $('.apellidos').text('Campo obligatorio');
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
            
            if(!regex_mail.test($('#email_TEC').val()) && $('#email_TEC').val().length > 0){
                $('.email').text('Formato email no valido');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.email').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            // if($('#clave_TEC').val().trim() == '' ){
            //     $('.clave').text('Campo obligatorio');
            //     $errores++;
            // } else {
            //     $(this).focus(function(){
            //         $('.clave').text('');
            //         if($errores > 0){
            //             $errores-1;
            //         }
            //     });
            // }

            if($('#clave_TEC').val() != $('#clave_validacion_TEC').val()){
               $('.clave_validacion').text('Claves distintas');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.clave_validacion').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if($('#sueldo_TEC').val().trim() == '' || !regex_numeros.test($('#sueldo_TEC').val())){
                $('.sueldo').text('Campo numerico');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.sueldo').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if(!regex_numeros.test($('#telefono_TEC').val()) || ($('#telefono_TEC').val().length != 10 && $('#telefono_TEC').val().length > 0)){
                $('.telefono').text('Campo numerico y de largo 10');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.telefono').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }
            
            if(!regex_alfanumerico.test($('#domicilio_TEC').val())){
                $('.domicilio').text('Campo alfanumerico');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.domicilio').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if(!regex_numeros.test($('#nro_seguro_social_TEC').val())){
                $('.nro_seguro_social').text('Campo numerico');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.nro_seguro_social').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if(!regex_numeros.test($('#nro_empleado_TEC').val()) && $('#nro_empleado_TEC').val().length > 0 ){
                $('.nro_empleado').text('Campo numerico');
                $errores++;
            } else {
                $(this).focus(function(){
                    $('.nro_empleado').text('');
                    if($errores > 0){
                        $errores-1;
                    }
                });
            }

            if($errores != 0){
                event.preventDefault();
            } else {
                guardarUsuarioTecnico();
            }
        
    });

    function guardarUsuarioTecnico(){
        $('#btnGuardarUsuarioTecnico').html('Guardando...');
        $.ajax({contenttype : 'application/json; charset=utf-8',
                data:  $('#UsuarioTecnicoForm').serialize(),
                url : app_url+'/gestion-usuarios-tecnicos',
                type : 'POST',
                //dataType : 'json',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    $('#btnGuardarUsuarioTecnico').html('Guardar');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                        }
                    },
                success : function(data) {
                    $('#masDatosTecnico').removeClass('show');
                    $('#gos_usuario_perfil_id_TEC').val('');
                    $('#gos_usuario_perfil_id_TEC').change();
                    $('#gos_paq_servicio_id_TEC').val('');
                    $('#gos_paq_servicio_id_TEC').change();
                    $('#gos_usuario_tecnico_id').val('');
                    $('.ComisionPorcientoTecnico').addClass('d-none');
                    $('.ComisionPesoTecnico').removeClass('d-none');
                    $('.ComisionMaterialesPorcientoTecnico').addClass('d-none');
                    $('.ComisionMaterialesPesoTecnico').removeClass('d-none');
                    $('#tipo_comision_TEC').val('PESOS');
                    $('#tipo_comision_Materiales_TEC').val('PESOS');
                    $('#dt-equipo-trabajo').DataTable().ajax.reload();
                    $('#UsuarioTecnicoForm').trigger('reset');
                    $('#modalEquipoTecnico').modal('hide');
                    $('#btnGuardarUsuarioTecnico').html('Guardar');
                }
        });
    }

    /* EDITAR USUARIO TECNICO */
    $('body').on('click', '.btnEditarUsuarioTecnico', function () {
        var id = $(this).data('id');
        $.get(app_url+'/gestion-usuarios-tecnicos/' + id +'/edit', function (data) {
            $('#title-error').hide();
            $('#product_code-error').hide();
            $('#description-error').hide();
            $('#titleModalEquipoTecnico').html('Editar Tecnico');
            $('#modalEquipoTecnico').modal('show');
            $('#gos_usuario_tecnico_id').val(data['user'].gos_usuario_id);
            $('#gos_usuario_perfil_id_TEC').val(data['user'].gos_usuario_perfil_id);
            $('#gos_usuario_perfil_id_TEC').change();
            $('#nombre_TEC').val(data['user'].nombre);
            $('#apellidos_TEC').val(data['user'].apellidos);
            $('#email_TEC').val(data['user'].email);
            $('#clave_TEC').val(data['user'].clave);
            $('#clave_validacion_TEC').val(data['user'].clave_validacion);
            $('#sueldo_TEC').val(data['user'].sueldo);
            $('#genero_TEC').val(data['user'].genero);
            $('#genero_TEC').change();
            $('#telefono_TEC').val(data['user'].telefono);
            $('#domicilio_TEC').val(data['user'].domicilio);
            $('#fecha_contratacion_TEC').val(data['user'].fecha_contratacion);
            $('#fecha_contratacion_TEC').change();
            $('#fecha_nacimineto_TEC').val(data['user'].fecha_nacimineto);
            $('#fecha_nacimineto_TEC').change();
            $('#nro_seguro_social_TEC').val(data['user'].nro_seguro_social);
            $('#nro_empleado_TEC').val(data['user'].nro_empleado);
            
            // COMISION
            $('#tipo_comision_TEC').val(data['comision'].tipo_comision);
            $('#monto_comision_TEC').val(data['comision'].monto_comision);
            $('#tipo_comision_Materiales_TEC').val(data['comision'].tipo_comision_materiales);
            $('#monto_comision_Materiales_TEC').val(data['comision'].monto_comision_materiales);

            if(data['comision'].tipo_comision == 'PORCIENTO') {
                $('.ComisionPorcientoTecnico').removeClass('d-none');
                $('.ComisionPesoTecnico').addClass('d-none');
            }

            if(data['comision'].tipo_comision_materiales == 'PORCIENTO') {
                $('.ComisionMaterialesPorcientoTecnico').removeClass('d-none');
                $('.ComisionMaterialesPesoTecnico').addClass('d-none');
            }

            var serviciosAsociados = [];
            $.each(data['servicios'], function(key, servicio) {
                serviciosAsociados.push(servicio.gos_paq_servicio_id); 
            });
            $("#gos_paq_servicio_id_TEC").val(serviciosAsociados);
            $('#gos_paq_servicio_id_TEC').change();
        })
    });



    /* BORRAR USUARIO TECNICO */
    $('body').on('click','#borrarTecnico',function() {
        var id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : app_url+'/gestion-usuarios-tecnicos/'+ id,
                success : function(data) {
                    $('#dt-equipo-trabajo').DataTable().ajax.reload();
                },
                error : function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    function limpiartextUsuarioTecnico() {
        $('.gos_usuario_perfil_id').text('');
        $('.gos_paq_servicio_id').text('');
        $('.monto_comision').text('');
        $('.monto_comision_materiales').text('');
        $('.nombre').text('');
        $('.apellidos').text('');
        $('.email').text('');
        $('.clave').text('');
        $('.clave_validacion').text('');
        $('.sueldo').text('');
        $('.telefono').text('');
        $('.domicilio').text('');
        $('.nro_empleado').text('');
    }

        // BOTONES % $ COMISION
	$('.ComisionPesoTecnico').click(function(){
        $(this).addClass('d-none');
		$('.ComisionPorcientoTecnico').removeClass('d-none');
		$('#tipo_comision_TEC').attr('value','PORCIENTO');
	});
	
	$('.ComisionPorcientoTecnico').click(function(){
        $(this).addClass('d-none');
		$('.ComisionPesoTecnico').removeClass('d-none');
		$('#tipo_comision_TEC').attr('value','PESOS');
    }); 

	$('.ComisionMaterialesPesoTecnico').click(function(){
        $(this).addClass('d-none');
		$('.ComisionMaterialesPorcientoTecnico').removeClass('d-none');
		$('#tipo_comision_Materiales_TEC').attr('value','PORCIENTO');
	});
	
	$('.ComisionMaterialesPorcientoTecnico').click(function(){
        $(this).addClass('d-none');
		$('.ComisionMaterialesPesoTecnico').removeClass('d-none');
		$('#tipo_comision_Materiales_TEC').attr('value','PESOS');
    }); 

});