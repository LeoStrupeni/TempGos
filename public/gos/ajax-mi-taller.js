$(document).ready(function() {
	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr(
					'content')
		}
	});

	$('#btn-guardar-taller').click(function() {
		var actionType = $('#btn-guardar-taller').val();
		$('#btn-guardar-taller').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data : $('#taller-form').serialize(),
				url : '',            //completar URL
				type : 'POST',
				//dataType : 'json',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,textStatus,data) {
					$('#btn-guardar-taller').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ textStatus);
						}
				},
				success : function(data) {
					$('#tallerDataTable').DataTable().ajax.reload();
					$('#taller-form').trigger('reset');
					// $('#modalServicio').modal('hide');
					$('#btn-guardar-taller').html('Guardar');
				}
		});
	});

	// BTN EDITAR
	$('body').on('click', function () {
		var id = $(this).data('id');
		$.get('gestion-taller/' + id + '/edit',
			function (data) {
			// $('#title-error').hide();
			// $('#product_code-error').hide();
			// $('#description-error').hide();
			// $('#titleModalServicio').html('Editar servicio');
			// $('#modalServicio').modal('show');

			$('#taller_nomb').val(data.taller_nomb);
			$('#propietario_nombre').val(data.propietario_nombre);
			$('#propietario_apellidos').val(data.propietario_apellidos);
			$('#correo_respuestas').val(data.correo_respuestas);
      $('#correo_refacciones').val(data.correo_refacciones);
      $('#taller_tel_principal').val(data.taller_tel_principal);
      $('#dia_desde').val(data.dia_desde);
      $('#dia_hasta').val(data.hasta);
      $('#hora_desde').val(data.hora_desde);
      $('#hora_hasta').val(data.hora_hasta);
      $('#direccion_taller').val(data.direccion_taller);
      $('#gos_region_estado_id').val(data.gos_region_estado_id);
      $('#gos_region_municipio_id').val(data.gos_region_municipio_id);
      $('#indicaciones').val(data.indicaciones);
      /**
       * Arreglo de etiquetas llamado etiquetas
       * en el HTML poner input con nombre de etiqueta y arreglo
       * aca iria un solo campo
       */
      $('#etiquetas').val(data.etiquetas);
      // $('#alineaciones').val(data.alineaciones);
      // $('#amortiguadores').val(data.amortiguadres);
      // $('#balanceo').val(data.balanceo);
      // $('#electrico').val(data.electrico);
      // $('#mofes').val(data.mofes);
      // $('#lavado').val(data.lavado);
      // $('#suspensio').val(data.suspension);
      // $('#transmisiones').val(data.transmisiones);
      // $('#rectificado_torneado').val(data.rectificado_torneado);
      // $('#refrigeracion_calefaccion').val(data.refrigeracion_calefaccion);
      // $('#motores').val(data.motores);
      // $('#enderezado_pintura').val(data.enderezado_pintura);
      // $('#diferencial').val(data.diferencial);
      // $('#grua').val(data.grua);
      // $('#frenos_clutch').val(data.frenos_clutch);
      // $('#mecanica_general').val(data.mecanica_general);
      // $('#venta_refacciones').val(data.venta_refacciones);
      /**
       * final de etiquetas
       * todo lo de arriba es un solo campo
       */
      $('#fot_del_taller').val(data.fot_del_taller);
      $('#razon_social').val(data.razon_social);
      $('#rfc').val(data.rfc);
      $('#regimen_fiscal').val(data.regimen_fiscal);
      $('#gos_fac_tipo_persona_id').val(data.gos_fac_tipo_persona_id);
      $('#email_direccion').val(data.email_direccion);
      $('#sellos_certificado').val(data.sellos_certificado);
      $('#sellos_llave').val(data.sellos_llave);
      $('#contrasena').val(data.contrasena);
      $('#dir_fiscal_calle').val(data.dir_fiscal_calle);
      $('#dir_fiscal_nro_ext').val(data.dir_fiscal_nro_ext);
      $('#dir_fiscal_nro_int').val(data.dir_fiscal_nro_int);
      $('#gos_region_colonia_id').val(data.gos_region_colonia_id);
      $('#dir_fiscal_cod_postal').val(data.dir_fiscal_cod_postal);
      $('#gos_region_localidad_id').val(data.gos_region_localidad_id);
      $('#cuenta_pago').val(data.cuenta_pago);
      $('#nomb_estado').val(data.nomb_estado);
      $('#gos_region_municipio_id').val(data.gos_region_municipio_id);
      $('#conf_serie').val(data.conf_serie);
      $('#pie_pagina_notas_remision').val(data.pie_pagina_notas_remision);
      $('#pie_pagina_compras').val(data.pie_pagina_compras);
      $('#pie_pagina_hoja_viajera').val(data.pie_pagina_hoja_viajera);
      $('#minimo_fotos').val(data.minimo_fotos);
      $('#nomb_marca').val(data.nomb_marca);
      $('#nomb_modelo').val(data.nomb_modelo);
      $('#seguimiento_etapa').val(data.seguimiento_etapa);
      $('#mostrar_seguimiento').val(data.mostrar_seguimiento);
      $('#envio_total_ser_et').val(data.envio_total_ser_et);
      $('#envio_total_et_ser').val(data.envio_total_et_ser);
      $('#ocultar_riesgo').val(data.ocultar_riesgo);
      $('#ocultar_orden').val(data.ocultar_orden);
      $('#habilita_facturacion_cliente').val(data.habilita_facturacion_cliente);
      $('#porcentaje_adicional_productos').val(data.porcentaje_adicional_productos);
      $('#costo_adquisicion').val(data.costo_adquisicion);
      $('#iva').val(data.iva);
      $('#nob_campo_ase').val(data.nob_campo_ase);
      $('#nom_campo_poliza').val(data.nom_campo_poliza);
      $('#nomb_campo_siniestro').val(data.nomb_campo_siniestro);
      $('#nomb_campo_reporte').val(data.nomb_campo_reporte);
      $('#nomb_marca').val(data.nomb_marca);
      $('#nomb_modelo').val(data.nomb_modelo);
      $('#nomb_anio').val(data.nomb_anio);
      $('#nomb_color').val(data.nomb_color);
      $('#nomb_placa').val(data.nomb_placa);
      $('#nomb_economico').val(data.nomb_economico);
      $('#nros_serie_unicos').val(data.nros_serie_unicos);
		})
	});
