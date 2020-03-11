	$(document).ready(function() {

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

		// get de listado o index tomado del controller para el
		// Objeto DataTable
	$('#dt-inventarioExterno').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/inventario-externo',
		columns : [ { data : 'gos_producto_id',name : 'id','visible' : false },
					{ data : 'nomb_marca'},
					{ data : 'nomb_familia'},
					{ data : 'nomb_proveedor'},
					{ data : 'nomb_medida'},
					{ data : 'codigo'},
					{ data : 'nomb_producto'},
					{ data : 'descripcion'},
					{ data : 'codigo_sat'},
					{ data : 'Cantidad'},
					{ data : 'venta'},
					{ data : 'Opciones', name : 'Opciones', orderable : false} ],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

	$('#btn-Nuevo-InventarioExterno').click(function() {
		limpiartextProductos();
		$('#gos_producto_ubic_stock_id').val('');
		$('#gos_producto_id').val('');
		$('#ganancia').val('');
		$('#gananciaok').val('');
		$('#gos_proveedor_id').val('');
		$('#gos_proveedor_id').change();
		$('#gos_producto_medida_id').val('');
		$('#gos_producto_medida_id').change();
		$('#gos_producto_marca_id').val('');
		$('#gos_producto_marca_id').change();
		$('#gos_producto_familia_id').val('');
		$('#gos_producto_familia_id').change();
		$('#gos_producto_ubicacion_id').val('');
		$('#gos_producto_ubicacion_id').change();
		$('#collapseOne').removeClass('show');		
		$('#inventarioExterno-form').trigger('reset');
		$('#title-modalInventarioExterno').html('Nuevo producto externo');
		$('#modalInventarioExterno').modal('show');
	});

/* BTN GUARDAR */
	$('#btn-guardar-producto').click(function() {
		limpiartextProductos();
		var regex_numeros = /^([0-9.])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
		var $errores = 0

		if($('#gos_proveedor_id').val()==0){
			$('.gos_proveedor_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_proveedor_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}
		
		if($('#codigo').val().trim() == '' || !regex_alfanumerico.test($('#codigo').val())){
			if($('#codigo').val().trim() == ''){
				$('.codigo').text('Campo obligatorio');
			}else{
				$('.codigo').text('');
				$('.codigo').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.codigo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#nomb_producto').val().trim() == '' || !regex_alfanumerico.test($('#nomb_producto').val())){
			if($('#nomb_producto').val().trim() == ''){
				$('.nomb_producto').text('Campo obligatorio');
			}else{
				$('.nomb_producto').text('');
				$('.nomb_producto').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.nomb_producto').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#descripcion').val().trim() == '' || !regex_alfanumerico.test($('#descripcion').val())){
			if($('#descripcion').val().trim() == ''){
				$('.descripcion').text('Campo obligatorio');
			}else{
				$('.descripcion').text('');
				$('.descripcion').text('Campo alfanumerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.descripcion').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#cantidad').val().trim() == '' || !regex_numeros.test($('#cantidad').val())){
			if($('#cantidad').val().trim() == ''){
				$('.cantidad').text('Campo obligatorio');
			}else{
				$('.cantidad').text('');
				$('.cantidad').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.cantidad').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#gos_producto_medida_id').val()==0){
			$('.gos_producto_medida_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_producto_medida_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#gos_producto_marca_id').val()==0){
			$('.gos_producto_marca_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_producto_marca_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#gos_producto_familia_id').val()==0){
			$('.gos_producto_familia_id').text('Campo obligatorio');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.gos_producto_familia_id').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#costo').val().trim() == '' || !regex_numeros.test($('#costo').val())){
			if($('#costo').val().trim() == ''){
				$('.costo').text('Campo obligatorio');
			}else{
				$('.costo').text('');
				$('.costo').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.costo').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#ganancia').val().trim() == '' || !regex_numeros.test($('#ganancia').val())){
			if($('#ganancia').val().trim() == ''){
				$('.ganancia').text('Campo obligatorio');
			}else{
				$('.ganancia').text('');
				$('.ganancia').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.ganancia').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($('#venta').val().trim() == '' || !regex_numeros.test($('#venta').val())){
			if($('#venta').val().trim() == ''){
				$('.venta').text('Campo obligatorio');
			}else{
				$('.venta').text('');
				$('.venta').text('Campo numerico');
			}
			$errores++;
		} else {
			$(this).focus(function(){
				$('.venta').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if(!regex_numeros.test($('#cant_minima').val())){
			$('.cant_minima').text('Campo numerico');
			$errores++;
		} else {
			$(this).focus(function(){
				$('.cant_minima').text('');
				if($errores > 0){
					$errores-1;
				}
			});
		}

		if($errores != 0){
			event.preventDefault();
		} else {
			guardarProducto();
		}
	});

	//FUNCION GUARDAR
	function guardarProducto(){
		$('#btn-guardar-producto').html('Guardando...');
		$.ajax({contenttype : 'application/json; charset=utf-8',
				data:  $('#inventarioExterno-form').serialize(),
				url : app_url+'/inventario-externo',
				type : 'POST',
				done : function(response) {console.log(response);},
				error : function(jqXHR,textStatus,errorThrown) {
					$('#btn-guardar-producto').html('Guardar');
					if (console && console.log) {
						console.log('La solicitud a fallado: '+ textStatus);
						console.log('La solicitud a fallado: '+ errorThrown);
						}
					},
				success : function(data) {
					limpiartextProductos();
					$('#dt-inventarioExterno').DataTable().ajax.reload();
					$('#inventarioExterno-form').trigger('reset');
					$('#modalInventarioExterno').modal('hide');
					$('#btn-guardar-producto').html('Guardar');
				}
		});
	};

/* EDITAR PRODUCTO*/
	$('body').on('click', '.btn-editar-inventarioExterno', function () {
		var id = $(this).data('id');
		$.get(app_url+'/inventario-externo/' + id +'/edit', function (data) {
			limpiartextProductos();
			$('#title-error').hide();
			$('#product_code-error').hide();
			$('#description-error').hide();
			$('#title-modalInventarioExterno').html('Editar producto externo');
			$('#modalInventarioExterno').modal('show');
			$('#gos_producto_id').val(data.gos_producto_id);
			$('#gos_producto_ubic_stock_id').val(data.gos_producto_ubic_stock_id);
			$('#gos_proveedor_id').val(data.gos_proveedor_id);
			$('#gos_proveedor_id').change();
			$('#codigo').val(data.codigo);
			$('#nomb_producto').val(data.nomb_producto);
			$('#descripcion').val(data.descripcion);
			$('#cantidad').val(data.Cantidad);
			$('#gos_producto_medida_id').val(data.gos_producto_medida_id);
			$('#gos_producto_medida_id').change();
			$('#gos_producto_marca_id').val(data.gos_producto_marca_id);
			$('#gos_producto_marca_id').change();
			$('#gos_producto_familia_id').val(data.gos_producto_familia_id);
			$('#gos_producto_familia_id').change();			
			$('#codigo_sat').val(data.codigo_sat);
			$('#costo').val(data.Costo);
			$('#ganancia').val(data.ganancia);
			$('#gananciaok').val(data.ganancia);
			$('#venta').val(data.venta);
			$('#cant_minima').val(data.cant_minima);
			$('#ubicacion').val(data.Ubicacion);
		})
	});

	/* BORRAR */
	$('body').on('click','#borrar-inventarioExterno',function() {
		var id = $(this).data('id');
		if (confirm('Esta seguro que desea borrar?')) {
			$.ajax({
				type : 'DELETE',
				url : app_url+'/inventario-externo/'+ id,
				success : function(data) {
					$('#dt-inventarioExterno').DataTable().ajax.reload();
				},
				error : function(data) {
					console.log('Error:', data);
				}
			});
		}
	});

	$('#costo').change(function() {
		if($('#ganancia').val().length > 0){
			var venta = (parseFloat($("#costo").val()) * parseFloat($("#ganancia").val()) / 100) + parseFloat($("#costo").val());
			$('#venta').removeAttr('value');
			$('#venta').attr('value',venta);
			$('#gananciaok').removeAttr('value');
			$('#gananciaok').attr('value',$("#ganancia").val());
		}
	});

	$('#ganancia').change(function() {
		if($('#costo').val().length > 0){
			var venta = (parseFloat($("#costo").val()) * parseFloat($("#ganancia").val()) / 100) + parseFloat($("#costo").val());
			$('#venta').removeAttr('value');
			$('#venta').attr('value',venta);
			$('#gananciaok').removeAttr('value');
			$('#gananciaok').attr('value',$("#ganancia").val());
		}
	});

	$('#venta').change(function() {
		if($('#costo').val().length > 0){
			var ganancia = ((parseFloat($("#venta").val()) * 100 / parseFloat($("#costo").val())) - parseFloat(100));
			$('#ganancia').removeAttr('value');
			$('#ganancia').attr('value',ganancia);
			$('#gananciaok').removeAttr('value');
			$('#gananciaok').attr('value',ganancia);
		}
	});

	function limpiartextProductos(){
		$('.gos_proveedor_id').text('');
		$('.codigo').text('');
		$('.nomb_producto').text('');
		$('.descripcion').text('');
		$('.cantidad').text('');
		$('.gos_producto_medida_id').text('');
		$('.gos_producto_marca_id').text('');
		$('.gos_producto_familia_id').text('');
		$('.codigo_sat').text('');
		$('.costo').text('');
		$('.ganancia').text('');
		$('.venta').text('');
		$('.cant_minima').text('');
	}

	$('body').on('click','.btn-Historial-inventarioExterno',function() {
		var dataid = $(this).data('id');
		var datos= dataid.split('|');
		var id = datos[0];
		var nombre = datos[1];
		$('#titleModalHistorialVenta').html('Historial "'+nombre+'"');

		$.get('/Historial-externo-compra/' + id , function (data) {
			$('#dt-itemsCompra').DataTable().clear().destroy();
			$('#dt-Os').DataTable().clear().destroy();
			$('#UC_Fecha').val('');
			$('#UC_Proveedor').val('');
			$('#UC_Total').val('');

			if(data[0] != undefined){
				$('#UC_Fecha').val(data[0].fecha);
				$('#UC_Proveedor').val(data[0].nomb_proveedor);
				$('#UC_Total').val(data[0].total);

				var gos_compra_id = data[0].gos_compra_id
				
				$.get('/Historial-externo-compra-items/' + gos_compra_id , function (data) {
					$('#dt-itemsCompra').DataTable({
						dom : "<'row'<'col-12'tr>>",
						responsive: true,
						processing: true,
						searching: false,
						paging: false,
						data: data,
						columns: [
							{data: 'nomb_producto', class:"align-middle text-center text-nowrap px-0",},
							{data: 'cantidad', class:"align-middle text-center text-nowrap px-0"},
							{data: 'costo', class:"align-middle text-center text-nowrap px-0"},
							{data: 'precio_venta', class:"align-middle text-center text-nowrap px-0"},
							{data: 'CantDisponible', class:"align-middle text-center text-nowrap px-0"}
						],
						language : {'url' : '/gos/Spanish.json'}
					});
				});
			}
			
			$.get('/Historial-externo-compra-tecnicos/' + id , function (data) {
				$('#dt-Os').DataTable({
					dom : "<'row'<'col-12'tr>>",
					responsive: true,
					processing: true,
					searching: false,
					paging: false,
					data: data,
					columns: [
						{data: 'nombre', class:"align-middle text-center text-nowrap px-0",},
						{data : 'gos_os_id',name : 'id', render: function(data, type,  meta){
							var id = meta.nro_orden_interno;
							if(id == ''){return '';}
							else {return '<a href='+app_url+'/orden-servicio-generada/'+ data +'> # '+id+'</a>';}}
						},
						{data: 'cantidad', class:"align-middle text-center text-nowrap px-0"},
						{data: 'fecha_creacion_os',render: function(data, type,  meta){
							console.log(data == '')
							if(data == ''){return '';}
							else {return data;}
						}},
						{data: 'costo', class:"align-middle text-center text-nowrap px-0"},
						{data: 'Total', class:"align-middle text-center text-nowrap px-0"},
						{data: 'nomb_aseguradora_min', render: function(data, type, row){
							var aseguradora = data.split('|');
							if(data == ''){return '';}
							else {return aseguradora[0];}}
						},
						{data : 'nomb_cliente', render: function(data, type, row){
							if(data == ''){return '';}
							else {return data.split('|').join( '<br>');}}
						},
						{ data: 'detallesVehiculo', render: function(data, type, row){
							var veh = data.split('|');
							var circulo = `<i class="fas fa-circle" style="background-color: #`+veh[0]+` ; color: #`+veh[0]+`;font-size: medium;border: 1px solid black;border-radius: 100%;"></i>`
							if(data == ''){return '';}
							else {return circulo+' '+veh[1]+'<br>'+veh[2] +'<br>'+ veh[3]+'<br>'+ veh[4];}}
						},
						{data : 'porcentaje', render: function(data, type, meta){
							var e = Math.round(data);
							var FT = meta.fecha_terminado;
							var FE = meta.fecha_entregado;
							if (data == '') {return '';}
							else{if(data== null){
									return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'0%'+'</div></div>';                                        
								} else if(FT!==null && FE==null){
									return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Terminada'+'</div></div>';
																
								} else if(FE!==null && FT!==null){
									return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Entregada'+'</div></div>';
																
								} else if(data=="100.0000"){
									return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Finalizada'+'</div></div>';
								} else{
									return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: '+e+'%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+e+'%</div></div>';
								}}}
						}
					],
					order : [ [ 1, 'asc' ] ],
					language : {'url' : '/gos/Spanish.json'}
				});
				$('#HistorialVenta').modal('show');	
			});
		});
	});

	$('body').on('click','.btn-entregar',function() {
		$('#titleModalEntregarPE').html('');
		$('.gos_usuario_id').text('');
		$('.cantidad').text('');
		var dataid = $(this).data('id');
		var datos= dataid.split('|');
		var id = datos[0];
		var nombre = datos[1];
		var descripcion = datos[2];

		if(nombre == 'compra unica') {$('#titleModalEntregarPE').html('Entregar '+descripcion);}
		else {$('#titleModalEntregarPE').html('Entregar '+nombre);}
		
		$('#gos_usuario_id').val('');
		$('#gos_usuario_id').change();
		$('#Producto_EPE').val(nombre);
		$('#gos_producto_id_EPE').val(id);
		$('#descripcion_EPE').val(descripcion);
		$('#cantidad').val('');
		cargaProductosEntregados(id);
		$('#EntregarPE').modal('show');	
	});

	$('body').on('click','#btn-entregar-producto',function() {
		$('.gos_usuario_id_EPE').text('');
		$('.cantidad_EPE').text('');
		var regex_numeros = /^([0-9])*$/;
		var $errores = 0

		if($('#gos_usuario_id_EPE').val()==0 || $('#gos_usuario_id_EPE').val().trim()==''){
			$('.gos_usuario_id_EPE').text('Campo obligatorio');$errores++;}
		else{$(this).focus(function(){$('.gos_usuario_id_EPE').text('');
			if($errores > 0){$errores-1;}});}

		if($('#cantidad_EPE').val().trim() == '' || !regex_numeros.test($('#cantidad_EPE').val())){
			$('.cantidad_EPE').text('Campo numerico');$errores++;}
		else{$(this).focus(function(){$('.cantidad_EPE').text('');
			if($errores > 0){$errores-1;}});}

		if($errores != 0){
			event.preventDefault();
		}else{
			$('#btn-entregar-producto').html('Cargando...');
			$.ajax({contenttype : 'application/json; charset=utf-8',
					data:  $('#formEntregarPE').serialize(),
					url : '/inventario-externo-Entrega',
					type : 'POST',
					done : function(response) {console.log(response);},
					error : function(jqXHR,textStatus,errorThrown) {
						$('#btn-entregar-producto').html('Cargar');
						if (console && console.log) {
							console.log('La solicitud a fallado: '+ textStatus);
							console.log('La solicitud a fallado: '+ errorThrown);
							}
						},
					success : function(data) {
						$('#btn-entregar-producto').html('Cargar');
						cargaProductosEntregados(data);
					}
			});
		}
	});

	function cargaProductosEntregados(gos_producto_id) {
		$('#dt-ProductosEntregados').DataTable().clear().destroy();
		$('#dt-ProductosEntregados').DataTable({
			dom : "<'row'<'col-12'tr>>",
			responsive: true,
			processing: true,
			searching: false,
			paging: false,
			ordering: false,
			ajax : '/inventario-externo-lista/'+gos_producto_id,
			columns: [
				{data: 'nombre', class:"align-middle text-center text-nowrap px-0",},
				{data: 'cantidad', class:"align-middle text-center text-nowrap px-0"}
			],
			language : {'url' : '/gos/Spanish.json'}
		});
	}
	


});
	/*** METODO PARA ACTUALIZAR CARGA PROVEEDORES */
	function getselectProveedor() {
		var regex_mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
        var regex_numeros = /^([0-9.])*$/;
        var regex_letras = /^([a-zA-Z ])*$/;
		var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;

		var $errores = 0

		/** EVALUACION DE CAMPOS */
			if($('#nomb_proveedor').val().trim() == '' || !regex_alfanumerico.test($('#nomb_proveedor').val())){
				if($('#nomb_proveedor').val().trim() == ''){$('.nomb_proveedor').text('Campo obligatorio');}
				else{$('.nomb_proveedor').text('');$('.nomb_proveedor').text('Campo alfanumerico');}
				$errores++;}
			else{$(this).focus(function(){$('.nomb_proveedor').text('');if($errores > 0){$errores-1;}});}

			if($('#contacto').val().trim() == '' || !regex_letras.test($('#contacto').val())){
				if($('#contacto').val().trim() == ''){$('.contacto').text('Campo obligatorio');}
				else{$('.contacto').text('');$('.contacto').text('El campo acepta solo letras');}
				$errores++;}
			else{$(this).focus(function(){$('.contacto').text('');if($errores > 0){$errores-1;}});}

			if($('#telefono').val().trim() == '' || !regex_numeros.test($('#telefono').val()) || ($('#telefono').val().length != 10)){
				if($('#telefono').val().trim() == ''){$('.telefono').text('Campo obligatorio');}
				else{$('.telefono').text('');$('.telefono').text('Campo numerico y de largo 10');}
				$errores++;}
			else{$(this).focus(function(){$('.telefono').text('');if($errores > 0){$errores-1;}});}

			if($('#email').val().trim() == '' || !regex_mail.test($('#email').val())){
				if($('#email').val().trim() == ''){$('.email').text('Campo obligatorio');}
				else{$('.email').text('');$('.email').text('Formato email no valido');}
				$errores++;}
			else{$(this).focus(function(){$('.email').text('');if($errores > 0){$errores-1;}});}

		/** EVALUACION DE ERRORES Y GUARDADO */
		if($errores != 0){event.preventDefault();}
		else {
			$('#btn-guardadoRapidoProveedor').html('Guardando...');
			var name=$('#nomb_proveedor').val();
			$.ajax({
				type: 'POST',
				url: '/ProveedorCargaRapida',
				data: $('#ProveedorFormRapido').serializeArray(),
				success: function(data) {
					$('#ProveedorRapido').modal('hide');
					$('#btn-guardadoRapidoProveedor').html('Guardar');
					$('#gos_proveedor_id').append('<option value="'+data+'" selected>'+name+'</option>');
					$('#gos_proveedor_id').selectpicker('refresh');
				}
			});
			$('#modalInventarioExterno').modal('show');
		}	
	}
	
	/*** METODO PARA ACTUALIZAR CARGA MARCAS */
	function getselectMarca() {
		var idselect=document.getElementById("bs-select-3");
		var child=idselect.childNodes[0].childNodes[0].innerHTML;
		var res = child.split('"');
		var insert=res[1];
		var obj = { name: insert, taller: 0 };
		$.ajax({
			type: 'POST',
			url: '/MarcaCargaRapida',
			data: obj,
			success: function(data) {
				$('#gos_producto_marca_id').append('<option value="'+data+'" selected>'+insert+'</option>');
				$('#gos_producto_marca_id').selectpicker('refresh');
			}
		});
	}
	/*** METODO PARA ACTUALIZAR CARGA FAMILIAS */
	function getselectFamilia() {
		var idselect=document.getElementById("bs-select-4");
		var child=idselect.childNodes[0].childNodes[0].innerHTML;
		var res = child.split('"');
		var insert=res[1];
		var obj = { name: insert, taller: 0 };
		$.ajax({
			type: 'POST',
			url: '/FamiliaCargaRapida',
			data: obj,
			success: function(data) {
				$('#gos_producto_familia_id').append('<option value="'+data+'" selected>'+insert+'</option>');
				$('#gos_producto_familia_id').selectpicker('refresh');
			}
		});
	}	
	/*** METODO PARA ACTUALIZAR CARGA UBICACIONES */
	function getselectUbicacion() {
		var idselect=document.getElementById("bs-select-5");
		var child=idselect.childNodes[0].childNodes[0].innerHTML;
		var res = child.split('"');
		var insert=res[1];
		var obj = { name: insert, taller: 0 };
		$.ajax({
			type: 'POST',
			url: '/UbicacionCargaRapida',
			data: obj,
			success: function(data) {
				$('#gos_producto_ubicacion_id').append('<option value="'+data+'" selected>'+insert+'</option>');
				$('#gos_producto_ubicacion_id').selectpicker('refresh');
			}
		});
	}