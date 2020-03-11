$(document).ready(function () {

/**
 *  LISTADO COMPLETO DE FORMULARIOS DE LA OS
 *	var datosForm1=$('#OS_Cliente_form').serializeArray();
 *	var datosForm2=$('#OS_ItemsEtapas_form').serializeArray();
 *	var datosForm3=$('#OS_ItemsPaquetes_form').serializeArray();
 *	var datosForm4=$('#OS_ItemsProductos_form').serializeArray();
 *	var datosForm5=$('#OS_Anticipo_form').serializeArray();
 *	var datosForm6=$('#OS_Cierre_form').serializeArray();
 *
 *  EJEMPLO PARA CONCATENAR LOS FORMULARIOS
 *  datosForm1=datosForm1.concat(datosForm6);
 */
	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

/**
 * LISTADO DE CLIENTES VEHICULOS
 */

	$('#dt-orden-servicio').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/ordenes-servicio',
		columns : [	{data : 'gos_os_id',name : 'id'}, // #ORDEN
					{data : 'gos_taller_id'}, // FECHA
					{data : 'gos_taller_id'}, // DIAS
					{data : 'nombre_apellidos_cliente'}, // CLIENTE
					{data : 'nomb_aseguradora'}, // ASEGURADORA
					{data : 'vehiculo'}, // VEHICULO
					{data : 'tiempo'}, // TIEMPO
					{data : 'asesor'}, // ASESOR
					{data : 'total'}, // TOTAL
					{data : 'avance'}, // AVANCE
					{data : 'Opciones',name : 'Opciones',orderable : false}
				],
		language : {'url' : '/gos/Spanish.json'}
	});
	// funcion que separa la url actual en /
	function obten_os_id_url() {
		var currentURL = $(location).attr("href");
	    return currentURL.split('/');
	}
	//obtener el arreglo 4 que es el id pasado
	var id=obten_os_id_url()[4];
	// listar items de orden de servicio del id pasado
	if (id !== 'undefined')
		listaItemsOS(id);

	//listar otros items

	//esto debe hacerce al mostrar el modal
	$('#dt-clientes-vehiculos').DataTable({
		responsive: true,
		searchDelay: 500,
		processing: true,
		ajax: '/lista-clientes-vehiculos',
		columns: [
		{data: 'nomb_cliente'},
		{data: 'vehiculo'},
		{data: 'economico'},
		{data: 'nro_serie'}, // nro_serie ACA VA EL NUMERO DE SERIE, NO VIENE EN LA VISTA QUE CONSULTA
		{data: 'gos_vehiculo_id',"visible": false,"searchable": false},
		{data: 'gos_cliente_id',"visible": false,"searchable": false},
		{defaultContent:`<button class="btn btn-success btn-seleccionar">Seleccionar</button>`}
		/** BTN COMENTADO PARA AGREGAR VEHICULO DESDE MODAL DE BUSCAR CLIENTE VEHICULO
		* <div class="row">
		*		<div class="col-2 p-0">
		*			<button class="btn btn-brand h-100 p-2 btn-vehiculo-cliente" data-toggle="modal" data-target="#modal-vehiculo"><i class="fas fa-car"></i></button>
		*		</div>
		*		<div class="col-10 pl-4">
		*			<button class="btn btn-success btn-seleccionar">Seleccionar</button>
		*		</div>
		*	</div>
		*/
		],
		language : {'url' : '/gos/Spanish.json'}
	});

/**
 * Evento clic donde tomar los datos
 */
	$('#dt-clientes-vehiculos tbody').on('click', '.btn-seleccionar', function () {
		//
		var table = $('#dt-clientes-vehiculos').DataTable();
		var data = table.row( $(this).parents('tr') ).data();
		//
		var nomb_cliente=data['nomb_cliente'];
		var detallesVehiculo=data['vehiculo'];
		// Actualizar datos;
		$("#nomb_cliente").val(nomb_cliente);
		//datos del vehiculo
		$("#detallesVehiculo").val(detallesVehiculo)
		//ids
		//Capturar valores ocultos
		//alert( "ID Cliente: "+data['gos_cliente_id']);
		//Pasar valores ocultos
		$("#gos_vehiculo_id").val(data['gos_vehiculo_id'])
		$("#gos_cliente_id").val(data['gos_cliente_id'])
		// cerrar modal
		$('#modalbuscarcliente').modal('hide');
	});

/**
* Funcion para cambio del boton "Buscar Cliente"
*/
	$("#btn-buscarcliente").click(function(){
		$(this).attr("style","display:none;") ;
		$('#cls-buscarcliente').removeAttr("style");
	});


// FUNCIONA VALIDACION DE DATOS CLIENTE
	function validacionDatosOS(){


		//var regex_letras = /^([a-zA-Z ])*$/;
		var regex_numeros = /^([0-9.])*$/;
		var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;
		var $errores = 0

		if($('#nomb_cliente').val().trim() == ''){
			$('.nomb_cliente').text('Campo obligatorio');
			$errores++;
		} else {
			$('.nomb_cliente').text('');
			if($errores > 0){$errores-1;}
		};

		if($('#gos_aseguradora_id').val().trim() == ''){
			$('.gos_aseguradora_id').text('Campo obligatorio');
			$errores++;
		} else {
			$('.gos_aseguradora_id').text('');
			if($errores > 0){$errores-1;}
		};
		if($('#gos_os_riesgo_id').val().trim() == ''){
			$('.gos_os_riesgo_id').text('Campo obligatorio');
			$errores++;
		} else {
			$('.gos_os_riesgo_id').text('');
			if($errores > 0){$errores-1;}
		};

		if($('#nro_reporte').val().trim() == '' || !regex_alfanumerico.test($('#nro_reporte').val())){
			if($('#nro_reporte').val().trim() == ''){
				$('.nro_reporte').text('Campo obligatorio');
			}else{
				$('.nro_reporte').text('');
				$('.nro_reporte').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nro_reporte').text('');
				if($errores > 0){$errores-1;}
			});
		}
		if($('#gos_os_tipo_o_id').val().trim() == ''){
			$('.gos_os_tipo_o_id').text('Campo obligatorio');
			$errores++;
		} else {
			$('.gos_os_tipo_o_id').text('');
			if($errores > 0){$errores-1;}
		};

		if($('#gos_os_tipo_danio_id').val().trim() == ''){
			$('.gos_os_tipo_danio_id').text('Campo obligatorio');
			$errores++;
		} else {
			$('.gos_os_tipo_danio_id').text('');
			if($errores > 0){$errores-1;}
		};

		if($('#gos_os_estado_exp_id').val().trim() == ''){
			$('.gos_os_estado_exp_id').text('Campo obligatorio');
			$errores++;
		} else {
			$('.gos_os_estado_exp_id').text('');
			if($errores > 0){$errores-1;}
		};

		// if(!regex_numeros.test($('#descuento').val()) && $('#descuento').val().length > 0){
		// 	$('.descuento').text('Campo numerico');
		// 	$errores++;
		// } else {
		// 	$('.descuento').text('');
		// 	if($errores > 0){$errores-1;}
		// };

		// if(!regex_numeros.test($('#iva').val()) && $('#iva').val().length > 0){
		// 	$('.iva').text('Campo numerico');
		// 	$errores++;
		// } else {
		// 	$('.iva').text('');
		// 	if($errores > 0){$errores-1;}
		// };
    $('#add-item-etapa').removeAttr('href');
    $('#add-item-paquete').removeAttr('href');
    $('#add-item-producto').removeAttr('href');
		if($errores != 0){
			event.preventDefault();
		} else {

			guardarOS();
			$('#add-item-etapa').removeAttr('href');
			$('#add-item-paquete').removeAttr('href');
			$('#add-item-producto').removeAttr('href');
			$('#add-item-etapa').attr('href','#collapseEtapa');
			$('#add-item-paquete').attr('href','#collapsePaquete');
			$('#add-item-producto').attr('href','#collapseProducto');
		}
	};

//FUNCION PARA GUARDAR OS
	function guardarOS(){
		var id=document.getElementById('gos_os_id');
		var valorid = id.value;
		if(valorid == ''){
			var datosForm1=$('#OS_Cliente_form').serializeArray();
			var datosForm6=$('#OS_Cierre_form').serializeArray();
			var datosForm5=$('#OS_Anticipo_form').serializeArray();
			datosForm1=datosForm1.concat(datosForm5);
			datosForm1=datosForm1.concat(datosForm6);
			$.ajax({
				contenttype : 'application/json; charset=utf-8',
				data: datosForm1,
				url : app_url+'/ordenes-servicio',
				type : 'POST',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					$('#gos_os_id').val(data.gos_os_id);
					$('#gos_os_id_EtapaItem').val(data.gos_os_id);
					$('#gos_os_id_PaqueteItem').val(data.gos_os_id);
					$('#gos_os_id_ProductoItem').val(data.gos_os_id);
					$('#gos_os_id_anticipo').val(data.gos_os_id);

					generaInventario();

					$('.nomb_cliente').text('');
					$('.gos_aseguradora_id').text('');
					$('.gos_ot_id').text('');
					$('.nro_poliza').text('');
					$('.nro_siniestro').text('');
					$('.gos_os_riesgo_id').text('');
					$('.nro_reporte').text('');
					$('.nro_orden_interno').text('');
					$('.gos_os_tipo_o_id').text('');
					$('.gos_os_tipo_danio_id').text('');
					$('.gos_os_estado_exp_id').text('');
					$('.demerito').text('');
					$('.deducible').text('');
				}
			});
		}
		else{
			var datosForm1=$('#OS_Cliente_form').serializeArray();
			var datosForm6=$('#OS_Cierre_form').serializeArray();
			var datosForm5=$('#OS_Anticipo_form').serializeArray();
			datosForm1=datosForm1.concat(datosForm5);
			datosForm1=datosForm1.concat(datosForm6);
			$.ajax({
				contenttype : 'application/json; charset=utf-8',
				data: datosForm1,
				url : app_url+'/ordenes-servicio',
				type : 'POST',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {


					$('.nomb_cliente').text('');
					$('.gos_aseguradora_id').text('');
					$('.gos_ot_id').text('');
					$('.nro_poliza').text('');
					$('.nro_siniestro').text('');
					$('.gos_os_riesgo_id').text('');
					$('.nro_reporte').text('');
					$('.nro_orden_interno').text('');
					$('.gos_os_tipo_o_id').text('');
					$('.gos_os_tipo_danio_id').text('');
					$('.gos_os_estado_exp_id').text('');
					$('.demerito').text('');
					$('.deducible').text('');
				}
			});
		}
	};

	function generaInventario() {
		if($('#gos_vehiculo_inventario_id').val()==''){
			$.ajax({
				data: $('#OS_Cliente_form').serializeArray(),
				url : app_url+'/generarIdInventario',
				type : "POST",
				done : function(response) {console.log(response);},
				success : function(data) {
					$('#gos_vehiculo_inventario_id').val(data.gos_vehiculo_inventario_id);
				}
			});
		}
	}

//CAMBIAN EL COLOR DEL BTN Y VUELVE LOS OTROS DOS AL ESTILO INICIL
	$("#add-item-etapa").click(function(){
		var id=document.getElementById('gos_os_id');
		var valorid = id.value;
			$(this).attr('href','#collapseEtapa');
			$(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
			$('#add-item-paquete').removeAttr("style");
			$('#add-item-producto').removeAttr("style");

	});

	$("#add-item-paquete").click(function(){
		var id=document.getElementById('gos_os_id');
		var valorid = id.value;
		$(this).attr('href','#collapsePaquete');
		$(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
		$('#add-item-etapa').removeAttr("style");
		$('#add-item-producto').removeAttr("style");
	});

	$("#add-item-producto").click(function(){
		var id=document.getElementById('gos_os_id');
		var valorid = id.value;
			$(this).attr('href','#collapseProducto');
			$(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
			$('#add-item-etapa').removeAttr("style");
			$('#add-item-paquete').removeAttr("style");

	});






/** CODIGO PARA CAMBIO DE BOTON DESCUENTO DE PESOS A PORCIENTO EN CIERRE ORDEN SERVICIO**/
	$(".btnCambioPeso").click(function(){
		$(this).attr("style","display:none;");
		$('.btnCambioPorciento').removeAttr("style");
		$('#descuento_tipo').attr("value","PORCIENTO");
	});

	$(".btnCambioPorciento").click(function(){
		$(this).attr("style","display:none;");
		$('.btnCambioPeso').removeAttr("style");
		$('#descuento_tipo').attr("value","PESOS");
	});


/** CODIGO CARGAR DESCUENTO EN BASE DE DATOS **/
	$('#OS-descuento').change(function(){
		var OS_ID=document.getElementById("gos_os_id");
		var valorid = OS_ID.value;
		if (valorid==''){
			alert("Para cargar un descuento debe primero completar los datos de la Orden de Servicio!!!")
		}
		else {
			var datosForm=$('#formCierreOS').serializeArray();
			console.log(datosForm); // UNA VEZ QUE FUNCIONE BORRAR ESTA LINEA
			$.ajax({
			type:"POST",
			url:"",//DESCUENTO
			data: datosForm,
			success:function(r){
				if (r==1) {
				alert('agregado con exito');
				}
				else {
				alert('error en insertar datos');
				}
			}
			});
		return false;
		}
	});


	/* BTN EMAIL ------------------------------------------*/
	$('#btn-formularioEmail').click(function(){
		var OS_ID=document.getElementById("gos_os_id");
		var valorid = OS_ID.value;
		if (valorid==''){
			alert("Para eviar el Email debe primero completar los campos de cliente!!!")
		}
		else {
			var datosForm=$('#formularioEmail').serializeArray();
			$.ajax({
			type:"POST",
			url:"",//guardar-datos-email
			data: datosForm,
			success:function(r){
				if (r==1) {
				alert('agregado con exito');
				}
				else {
				alert('error en insertar datos');
				}
			}
			});
		return false;
		}
	});
	/* FIN BTN EMAIL --------------------------------------*/

	/* BTN GUARDAR ------------------------------------------*/
	$('#btn_guardar_OS').click(function(){
			validacionDatosOS();
      var table=document.getElementById("dt_lista_items_os_body");
      var itemsL=table.rows.length
      console.log(itemsL);
      if (itemsL>0) {
		var idItem=document.getElementById('gos_os_id_EtapaItem');
		var valoriditem=idItem.value;
		if (valoriditem.length > 0 && $(this).hasClass('btn-primary')){
			$(this).attr("style","background-color:#0abb87!important;border-color:#0abb87!important;") ;
			$('#add-item-paquete').removeAttr("style");
			$('#add-item-producto').removeAttr("style");
		}
		 window.location.href=('ordenes-servicio');
   }
   else {
      $('#smalltableoscreate').text('Inserte Almenos Un Dato');
   }
	});
	/* FIN BTN GUARDAR --------------------------------------*/


	/** FUNCIONES PRECARGADAS EN EL ARCHIVO JS ---- REVISAR USO */
	$(function () {
		$("#importe, #descuento").keyup(function () {
			$("#subtotal").val(+$("#importe").val() - +$("#descuento").val());
		});
	});

	$(function () {
		$("#subtotal, #iva").keyup(function () {
			$("#total").val(+$("#subtotal").val() - (+$("#iva").val()/100)*(+$("#subtotal").val()));
		});
	});

});
