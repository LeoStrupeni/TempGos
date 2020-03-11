$(document).ready(function() {
	var app_url = $('#app_url').attr('url');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });


    // USUARIO ADMINISTRATIVO
    $('.nuevoUsuarioAdm').click(function() {
        limpiartextUsuarioAdmin();
				var idtaller=0;


			  $('#masDatosTecnico').removeClass('show');
        $('#gos_usuario_perfil_id_ADM').val('');
        $('#gos_usuario_perfil_id_ADM').change();
        $('#gos_usuario_admin_id').val('');
        $('#fecha_contratacion_ADM').val('');
        $('#fecha_contratacion_ADM').change();
        $('#fecha_nacimineto_ADM').val('');
        $('#fecha_nacimineto_ADM').change();
        $('#gos_usuario_segmenta_comi_id').val('');
        $('#gos_usuario_segmenta_comi_id').change();
        $("#gos_aseguradora_comision_id_ADM").val('');
        $('#gos_aseguradora_comision_id_ADM').change();
        $("#gos_aseguradora_seguimiento_id_ADM").val('');
        $('#gos_aseguradora_seguimiento_id_ADM').change();
        $('#gos_usuario_admin_id').val('');
        $('.btnCambioPorcientoComision').addClass('d-none');
        $('.btnCambioPesoComision').removeClass('d-none');
        $('#comision_tipo_ADM').val('PESOS');
        $('#UsuarioAdmForm').trigger('reset');
        $('#titleModalEquipoAdm').html('Nuevo Administrativo');
				$.ajax({
						type: 'get',
						url: '/edt/limit',
						success: function(data) {
							 console.log(data);
							if (data > 0) {
								$('#ModalEquipoAdm').modal('show');
							}
							else {
								alert("Limite de Usuarios Excedido Contacta al Equipo de Soporte ");
							}

						}
				});

    });


    /* GUARDAR USUARIO ADMINISTRATIVO */
    $('#btnGuardarUsuarioAdmin').click(function() {
        var regex_mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
        var regex_letras = /^([a-zA-Z ])*$/;
        var regex_numeros = /^([0-9.])*$/;
        var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
        var $errores = 0

        if($('#gos_usuario_perfil_id_ADM').val().trim() == '' ){
            $('.gos_usuario_perfil_id').text('Campo obligatorio');
            $errores++;
        } else {
            $('.gos_usuario_perfil_id').text('');
            if($errores > 0){
                $errores-1;
            }
        }

        if($('#nombre_ADM').val().trim() == '' || !regex_letras.test($('#nombre_ADM').val())){
            if($('#nombre_ADM').val().trim() == ''){
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

        if($('#apellidos_ADM').val().trim() == '' || !regex_letras.test($('#apellidos_ADM').val())){
            if($('#apellidos_ADM').val().trim() == ''){
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

        if(!regex_mail.test($('#email_ADM').val()) && $('#email_ADM').val().length > 0){
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

        if($('#clave_ADM').val().trim() == ''){
            $('.clave').text('Campo obligatorio');
            $errores++;
        } else {
            $(this).focus(function(){
                $('.clave').text('');
                if($errores > 0){
                    $errores-1;
                }
            });
        }

        if($('#clave_validacion_ADM').val().trim() == '' || $('#clave_ADM').val() != $('#clave_validacion_ADM').val()){
            if($('#clave_validacion_ADM').val().trim() == ''){
                $('.clave_validacion').text('Campo obligatorio');
            }else{
                $('.clave_validacion').text('');
                $('.clave_validacion').text('Claves distintas');
            }
            $errores++;
        } else {
            $(this).focus(function(){
                $('.clave_validacion').text('');
                if($errores > 0){
                    $errores-1;
                }
            });
        }

        if($('#sueldo_ADM').val().trim() == '' || !regex_numeros.test($('#sueldo_ADM').val())){
            if($('#sueldo_ADM').val().trim() == ''){
                $('.sueldo').text('Campo obligatorio');
            }else{
                $('.sueldo').text('');
                $('.sueldo').text('Campo numerico');
            }
            $errores++;
        } else {
            $(this).focus(function(){
                $('.sueldo').text('');
                if($errores > 0){
                    $errores-1;
                }
            });
        }

        if($('#gos_aseguradora_comision_id_ADM').val() != ''){

            if($('#monto_comision_ADM').val().trim() == '' || !regex_numeros.test($('#monto_comision_ADM').val()) ){
                $('#monto_comision_mjs_ADM').text('Campo numerico');
                $errores++;
            } else {
                $('#monto_comision_mjs_ADM').text('');
                if($errores > 0){
                    $errores-1;
                }
            }

            if($('#gos_usuario_segmenta_comi_id').val().trim() == ''){
                $('#gos_usuario_segmenta_comi_id_ADM').text('Campo obligatorio');
                $errores++;
            } else {
                $('#gos_usuario_segmenta_comi_id_ADM').text('');
                if($errores > 0){
                    $errores-1;
                }
            }
        }

        if(!regex_numeros.test($('#telefono_ADM').val()) || ($('#telefono_ADM').val().length != 10 && $('#telefono_ADM').val().length > 0)){
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

        if(!regex_alfanumerico.test($('#domicilio_ADM').val())){
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

        if(!regex_numeros.test($('#nro_empleado_ADM').val()) && $('#nro_empleado_ADM').val().length > 0 ){
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
            guardarUsuarioAdmin();
        }

    });

    $('#gos_aseguradora_comision_id_ADM').on('change',function() {
        $('#monto_comision_mjs_ADM').text('');
        $('#gos_usuario_segmenta_comi_id_ADM').text('');
    })

    function guardarUsuarioAdmin(){
        $('#btnGuardarUsuarioAdmin').html('Guardando...');
        $.ajax({contenttype : 'application/json; charset=utf-8',
                data:  $('#UsuarioAdmForm').serialize(),
                url : app_url+'/gestion-usuarios-admin',
                type : 'POST',
                dataType : 'json',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    $('#btnGuardarUsuarioAdmin').html('Guardar');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                        }
                    },
                success : function(data) {
                    $('#masDatosTecnico').removeClass('show');
                    $('#gos_usuario_perfil_id_ADM').val('');
                    $('#gos_usuario_perfil_id_ADM').change();
                    $('#gos_usuario_admin_id').val('');
                    $('#fecha_contratacion_ADM').val('');
                    $('#fecha_contratacion_ADM').change();
                    $('#fecha_nacimineto_ADM').val('');
                    $('#fecha_nacimineto_ADM').change();
                    $('#gos_usuario_segmenta_comi_id').val('');
                    $('#gos_usuario_segmenta_comi_id').change();
                    $("#gos_aseguradora_comision_id_ADM").val('');
                    $('#gos_aseguradora_comision_id_ADM').change();
                    $("#gos_aseguradora_seguimiento_id_ADM").val('');
                    $('#gos_aseguradora_seguimiento_id_ADM').change();
                    $('.btnCambioPorcientoComision').addClass('d-none');
                    $('.btnCambioPesoComision').removeClass('d-none');
                    $('#comision_tipo_ADM').val('PESOS');
                    $('#dt-equipo-trabajo').DataTable().ajax.reload();
                    $('#UsuarioAdmForm').trigger('reset');
                    $('#ModalEquipoAdm').modal('hide');
                    $('#btnGuardarUsuarioAdmin').html('Guardar');
                }
        });
    }

    /* EDITAR USUARIO ADMINISTRATIVO */
    $('body').on('click', '.btnEditarUsuarioAdmin', function () {
        var id = $(this).data('id');
        $.get(app_url+'/gestion-usuarios-admin/' + id +'/edit', function (data) {
            $('#title-error').hide();
            $('#product_code-error').hide();
            $('#description-error').hide();
            $('#titleModalEquipoAdm').html('Editar Administrativo');
            $('#ModalEquipoAdm').modal('show');
            $('#gos_usuario_admin_id').val(data['user'].gos_usuario_id);
            $('#gos_usuario_perfil_id_ADM').val(data['user'].gos_usuario_perfil_id);
            $('#gos_usuario_perfil_id_ADM').change();
            $('#nombre_ADM').val(data['user'].nombre);
            $('#apellidos_ADM').val(data['user'].apellidos);
            $('#email_ADM').val(data['user'].email);
            $('#clave_ADM').val(data['user'].clave);
            $('#clave_validacion_ADM').val(data['user'].clave_validacion);
            $('#sueldo_ADM').val(data['user'].sueldo);
            $('#genero_ADM').val(data['user'].genero);
            $('#genero_ADM').change();
            //$('#almacen_ADM').val(data.almacen);
            $('#telefono_ADM').val(data['user'].telefono);
            $('#domicilio_ADM').val(data['user'].domicilio);
            $('#fecha_contratacion_ADM').val(data['user'].fecha_contratacion);
            $('#fecha_contratacion_ADM').change();
            $('#fecha_nacimineto_ADM').val(data['user'].fecha_nacimineto);
            $('#fecha_nacimineto_ADM').change();
            $('#nro_seguro_social_ADM').val(data['user'].nro_seguro_social);
            $('#nro_empleado_ADM').val(data['user'].nro_empleado);

            // TIPO COMISION USUARIO
            $('#comision_tipo_ADM').val(data['comisionUsuario'].comision_tipo);
            $('#monto_comision_ADM').val(data['comisionUsuario'].monto_comision);
            $('#gos_usuario_segmenta_comi_id').val(data['comisionUsuario'].gos_usuario_segmenta_comi_id);
            $('#gos_usuario_segmenta_comi_id').change();

            if(data['comisionUsuario'].comision_tipo == 'PORCIENTO') {
                $('.btnCambioPorcientoComision').removeClass('d-none');
                $('.btnCambioPesoComision').addClass('d-none');
            }

            // ASEGURADORAS COMISION Y SEGUIMIENTO
            var comision = [];
            $.each(data['comision'], function(key, aseg) {
                comision.push(aseg.gos_aseguradora_id);
            });
            $("#gos_aseguradora_comision_id_ADM").val(comision);
            $('#gos_aseguradora_comision_id_ADM').change();

            var seguimiento = [];
            $.each(data['seguimiento'], function(key, aseg) {
                seguimiento.push(aseg.gos_aseguradora_id);
            });
            $("#gos_aseguradora_seguimiento_id_ADM").val(seguimiento);
            $('#gos_aseguradora_seguimiento_id_ADM').change();

        });
    });

    /* BORRAR USUARIO ADMINISTRATIVO */
    $('body').on('click','#borrarAdmin',function() {
        var id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : app_url+'/gestion-usuarios-admin/'+ id,
                success : function(data) {
                    $('#dt-equipo-trabajo').DataTable().ajax.reload();
                },
                error : function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    function limpiartextUsuarioAdmin() {
        $('.gos_usuario_perfil_id').text('');
        $('.gos_aseguradora_id').text('');
        $('.nombre').text('');
        $('.apellidos').text('');
        $('.email').text('');
        $('.clave').text('');
        $('.clave_validacion').text('');
        $('.sueldo').text('');
        $('.almacen').text('');
        $('.telefono').text('');
        $('.domicilio').text('');
        $('.nro_empleado').text('');
        $('.gos_usuario_seg_comision_id').val('');
        $('#monto_comision_mjs_ADM').text('');
        $('#gos_usuario_segmenta_comi_id_ADM').text('');
    }

    // BOTONES % $ COMISION
	$('.ComisionPesoAdm').click(function(){
        $(this).addClass('d-none');
		$('.ComisionPorcientoAdm').removeClass('d-none');
		$('#comision_tipo_ADM').attr('value','PORCIENTO');
	});

	$('.ComisionPorcientoAdm').click(function(){
        $(this).addClass('d-none');
		$('.ComisionPesoAdm').removeClass('d-none');
		$('#comision_tipo_ADM').attr('value','PESOS');
    });

});
