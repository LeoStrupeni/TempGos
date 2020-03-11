$(document).ready(function() {
    var app_url = $('#app_url').attr('url');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#dt-Compras').DataTable({
		dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : window.location.href,
        columns : [	{data : 'Fechas', class:"dt-left", render: function(data, type, row){
                        var splited = data.split('|');
                        return  `<p class="my-1 tooltip-test text-nowrap" title="Fecha compra"> Fc: `+splited[0]+`</p>
                                <p class="my-1 tooltip-test text-nowrap" title="Vencimiento"> V: `+splited[1]+`</p>
                                <p class="my-1 tooltip-test text-nowrap" title="Fecha pago"> Fp: `+splited[2]+`</p>`
                    }}, 
                    {data : 'nomb_proveedor'}, 
                    {data : 'gos_compra_id',name : 'id'},
                    {data : 'nro_Requisicion'}, // # de requisición, no esta calculado en vista
                    {data : 'nro_factura'},

                    { data : 'gos_os_id',class:"text-nowrap", render: function(data, type, meta){
                        var id = meta.nro_orden_interno;
                        if (data == 0 || id== 0){return ''}
                        else{return '<a href=/orden-servicio-generada/'+ data +'> # '+id+'</a>' }
                        }
                    },
                    {data : 'nomb_forma_pago'},
                    {data : 'total'},
                    {data : 'Abonado'}, // Abonado, no esta calculado en vista
                    {data : 'Opciones',name : 'Opciones',orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
    });
    
    /* GUARDAR COMPRA */
    $('#btn_ItemCompra').click(function() {
        // limpiartextCompra();
        var regex_numeros = /^([0-9.])*$/;
        var regex_alfanumerico = /^([a-zA-ZÀ-ÖØ-öø-ÿ0-9.!#$%&'*+/=?^_ `{|}~-])*$/;
        var $errores = 0
        if($("#gos_compra_tipo_id").val() != 1){

            // if($('#gos_producto_id_compra').val()==0){
            //     $('.gos_producto_id').text('Campo obligatorio');$errores++;}
            // else{$(this).focus(function(){$('.gos_producto_id').text('');
            //     if($errores > 0){$errores-1;}});}

            if($('#cantidad').val().trim() == '' || !regex_numeros.test($('#cantidad').val())){
                $('.cantidad').text('Campo numerico');$errores++;}
            else{$(this).focus(function(){$('.cantidad').text('');
                if($errores > 0){$errores-1;}});}
            
            if($('#venta').val().trim() == ''){
                $('.venta').text('Campo obligatorio');$errores++;}
            else{$(this).focus(function(){$('.venta').text('');
                if($errores > 0){$errores-1;}});}

        } 
        if($('#nro_factura').val().trim() == '' ){
            $('.nro_factura').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.nro_factura').text('');
            if($errores > 0){$errores-1;}});}

        if($('#tipo_compra').val()==0){
            $('.tipo_compra').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.tipo_compra').text('');
            if($errores > 0){$errores-1;}});}

        if($('gos_proveedor_id_compras').val()==0){
            $('.gos_proveedor_id').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.gos_proveedor_id').text('');
            if($errores > 0){$errores-1;}});}

        if($('#fecha').val()==0)
            {$('.fecha').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.fecha').text('');
            if($errores > 0){$errores-1;}});}

        if($('#gos_forma_pago_id').val()==0){
            $('.gos_forma_pago_id').text('Campo obligatorio');errores++;}
        else{$(this).focus(function(){$('.gos_forma_pago_id').text('');
            if($errores > 0){$errores-1;}});}
         
        if($('#tipo_pago').val()==0){
            $('.tipo_pago').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.tipo_pago').text('');
            if($errores > 0){$errores-1;}});}

        if($errores != 0){
            event.preventDefault();
        }else{
            guardarCompra();
        }
    });

    //FUNCION GUARDAR
    function guardarCompra(){
        var datosForm1=$('#compras_form').serializeArray();
        var datosForm2=$('#compras_Cierre_form').serializeArray();
        var datosForm3=$('#ItemCompra_form').serializeArray();
        datosForm1=datosForm1.concat(datosForm2);
        datosForm1=datosForm1.concat(datosForm3);
        $.ajax({contenttype : 'application/json; charset=utf-8',
            data: datosForm1,
            url : app_url+'/gestion-compras',
            type : 'POST',
            done : function(response) {console.log(response);},
            error : function(jqXHR,textStatus,errorThrown) {
                if (console && console.log) {
                    console.log('La solicitud a fallado: '+ textStatus);
                    console.log('La solicitud a fallado: '+ errorThrown);
                }
            },
            success : function(data) {
                $('#Itemcompra_form').trigger('reset');
                $('#gos_compra_id').val(data);
                cargatablaItemsCompras(data);
            }
        });
    }

    $('#btn-guardar-compra').click(function() {
        var datosForm1=$('#compras_form').serializeArray();
        var datosForm2=$('#compras_Cierre_form').serializeArray();
        datosForm1=datosForm1.concat(datosForm2);

        $.ajax({contenttype : 'application/json; charset=utf-8',
            data: datosForm1,
            url : app_url+'/gestion-compras',
            type : 'POST',
            done : function(response) {console.log(response);},
            error : function(jqXHR,textStatus,errorThrown) {
                if (console && console.log) {
                    console.log('La solicitud a fallado: '+ textStatus);
                    console.log('La solicitud a fallado: '+ errorThrown);
                }
            },
            success : function(data) {
                $('#gos_compra_id').val(data);
                var fecha = $('#fecha_compra').val();   
                if($('#gos_forma_pago_id').val()==1){
                    $.ajax({contenttype : 'application/json; charset=utf-8',
                        data: {gos_compra_id:data, fecha_compra: fecha},
                        url : '/pagoCompraContacto',
                        type : 'POST',
                        done : function(response) {console.log(response);},
                        error : function(jqXHR,textStatus,errorThrown) {
                            if (console && console.log) {
                                console.log('La solicitud a fallado: '+ textStatus);
                                console.log('La solicitud a fallado: '+ errorThrown);
                            }
                        },
                        success : function(data) {
                            $('#Itemcompra_form').trigger('reset');
                        }
                    });
                }
            }
        });
    });   

    /* BORRAR Compra */
    $('body').on('click','#borrarCompra',function() {
        var id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : app_url+'/gestion-compras/'+ id,
                success : function(data) {
                    $('#dt-Compras').DataTable().ajax.reload();
                },
                error : function(data) {
                    console.log('Error:',data);
                }
            });
        }
    });

    $("#gos_producto_id_compra").on('change',function(){
        if($("#gos_producto_id_compra").val() == "CP"){
            $('#descripcion').attr("readonly", false); 
            $("#descripcion").css("background-color", "white");
            $('#nomb_marca').attr("readonly", false); 
            $("#nomb_marca").css("background-color", "white");
            $("#nomb_medida").addClass('d-none');
            $("#gos_producto_medida_id").removeClass('d-none');
        }
        else{
            $('#descripcion').attr("readonly", true); 
            $("#descripcion").css("background-color", "#f7f8fa");
            $('#nomb_marca').attr("readonly", true); 
            $("#nomb_marca").css("background-color", "#f7f8fa");
            $("#nomb_medida").removeClass('d-none');
            $("#gos_producto_medida_id").addClass('d-none');
        }
    });

    $("#gos_compra_tipo_id").on('change',function(){
        if($(this).val() == 1){
            $(".remove").hide();
            $("#descripcion").val('');
            $("#costo").val('');
            $('#descripcion').attr("readonly", false); 
            $("#descripcion").css("background-color", "white");
            $("#cantidad").val("1");
        } else if($(this).val() == 3){
            $(".remove").show();
            $("#ProductosInternos").addClass('d-none');
            $("#ProductosExternos").removeClass('d-none');
            $('#Itemcompra_form').trigger('reset');
            $('#descripcion').attr("readonly", true); 
            $("#descripcion").css("background-color", "#f7f8fa");
        } else{
            $(".remove").show();
            $("#ProductosExternos").addClass('d-none');
            $("#ProductosInternos").removeClass('d-none');
            $('#Itemcompra_form').trigger('reset');
            $('#descripcion').attr("readonly", true); 
            $("#descripcion").css("background-color", "#f7f8fa");
        }
    });

    if($("#gos_compra_tipo_id").val()==1){
        $(".remove").hide();
        $("#descripcion").val('');
        $("#costo").val('');
        $('#descripcion').attr("readonly", false); 
        $("#descripcion").css("background-color", "white");
        $("#cantidad").val("1");   
    }
  
    
    /** SECCION DE PAGOS COMPRAS */ 

    $('body').on('click','#abonarCompra',function() {
        $('.saldo_PagoCompra').text('');
        $('.importe_PagoCompra').text('');
        $('.fecha_PagoCompra').text('');
        $('#pagarCompraForm').trigger('reset');
        var datos = $(this).data('id');
		var corte = datos.split('|');
		var id=corte[0];
		var metodo=corte[1];
        $.get('pagosPorCompra/'+id ,function (data) {
            $('#gos_compra_id_PagoCompra').val(id);
            $('#saldo_PagoCompra').val(parseFloat(data.TotalCompra)-parseFloat(data.TotalPagado));
            $('#metodoPago').val(metodo);
			$('#metodoPago').change();
            $('#PagoCompra').modal('show');
        });
    });

    $('#btn-PagoCompra').click(function() {
        $('.saldo_PagoCompra').text('');
        $('.importe_PagoCompra').text('');
        $('.fecha_PagoCompra').text('');
        var regex_numeros = /^([0-9.])*$/;
        if($('#saldo_PagoCompra').val() == 0){
            $('.saldo_PagoCompra').text('El Saldo Pendiente es 0');
        } else if ($('#importe_PagoCompra').val().trim() == '' || !regex_numeros.test($('#importe_PagoCompra').val())){
            $('.importe_PagoCompra').text('Campo Numerico');
        } else if($('#fecha_PagoCompra').val().trim() == ''){
            $('.fecha_PagoCompra').text('Campo obligatorio');
        } else if($('#saldo_PagoCompra').val()-$('#importe_PagoCompra').val() < 0){
            $('.importe_PagoCompra').text('El importe ingresado es Mayor al saldo');
        } else {           
            $('#btn-PagoCompra').html('Registrando ...');
            var datosForm1=$('#pagarCompraForm').serializeArray();
            $.ajax({contenttype : 'application/json; charset=utf-8',
                data: datosForm1,
                url : app_url+'/registro-pago-compra',
                type : 'POST',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    $('#btn-PagoCompra').html('Cargar pago');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                    }
                },
                success : function(data) {
                    $('#btn-PagoCompra').html('Cargar pago');
                    $('#dt-Compras').DataTable().ajax.reload();
                    $('#PagoCompra').modal('hide');
                }
            });

        }
    });   

    /** ACA COMIENZA LA PARTE DE LOS ITEMS COMPRA */
    // FUNCION PARA AGREGAR EL ITEM COMPRA
    
    function cargatablaItemsCompras(id){
        var tabla = $('#dt-itemsCompras').DataTable();
		tabla.clear().destroy();
        $('#dt-itemsCompras').DataTable({
            responsive: true,
            rowReorder: { update: false },
            paging: false,
            searching: false,
            ordering: false,
            ajax : app_url+'/gestion-compras-items/' + id,
            columns : [ { data : 'gos_compra_item_id',name : 'id','visible' : false},	 //ID
                        { data : 'nomb_producto'},
                        { data : 'nomb_marca'},
                        { data : 'descripcion'},
                        { data : 'cantidad',class:'dt-center'},
                        { data : 'nomb_medida',class:'dt-center'},
                        { data : 'costo',class:'dt-center'},
                        { data : 'precio_venta',class:'dt-center'}, //p.venta
                        { data : 'Opciones',name : 'Opciones', orderable : false,class:'dt-center'} ], // archivo OpcionesItemsDatatable
            order : [ [ 0, 'desc' ] ],
            language : {'url' : '/gos/Spanish.json'},
            footerCallback: function ( row, data, start, end, display ) {
                $('#formUnirProductos').empty();
                $('#formUnirProductos').append(`<div class="row bg-secondary mb-1"><div class="col-4 text-center"><strong>Nombre</strong></div><div class="col-5 text-center"><strong>Descripcion</strong></div><div class="col-3 text-center"><strong>Cant.</strong></div></div>`);
                $('#formUnirProductos').append(`<input type="hidden" id="largoProd" value="`+data.length+`"></input>`);
                data.forEach( function(prod, index, array) {
                    var html = `
                    <div class="form-group row mb-1">
                        <label class="col-4 pt-2 text-center">`+prod['nomb_producto']+`</label>
                        <label class="col-5 pt-2 text-center">`+prod['descripcion']+`</label>
                        <div class="col-3">
                            <input type="hidden" id="`+index+`_id" value="`+prod['gos_producto_id']+`">
                            <input class="form-control text-center" type="text" value="`+parseInt(prod['cantidad'])+`" id="`+index+`_cant">
                        </div>
                    </div>`;
                    $('#formUnirProductos').append(html);
                });
            }
        });
        calculoscompras(id);
    }

    function calculoscompras(id){
        $.ajax({
			url : app_url+'/gestion-compras-items/'+ id,
			success : function(data) {
                var subtotal = 0;
                $.each(data['data'], function(key, item) {
                    subtotal = parseFloat(subtotal) + (parseFloat(item.costo) * parseFloat(item.cantidad)); 
                });

                var descuento = parseFloat($('#descuento').val());
                var iva = parseFloat($('#iva').val());
                var total = 0;
        
                if($('#descuento_tipo').val()=='PORCIENTO'){descuento = subtotal * descuento / 100;}       
        
                if ($('#iva').val() != ''){
                    total = (subtotal-descuento) * iva / 100  + (subtotal-descuento);
                }else{total = subtotal-descuento}
                
                $('#subtotal').val(subtotal); 
                $('#total').val(total); 

			},
			error : function(data) {
				console.log('Error:', data);
			}
		});
    }

    if($('#gos_compra_id').val() != ''){
        cargatablaItemsCompras($('#gos_compra_id').val());
    }
	
	/* BORRAR ITEM */
	$('body').on('click','#borrarItemCompra',function() {
        var id = $(this).data('id');
        var datos = id.split('|');
        var gos_compra_item_id = datos[0];
        var tipo = datos[1];
        var producto = datos[2];
        var cantidad = datos[3];
        var gos_compra_id = $('#gos_compra_id').val();
        var req ={ Id:gos_compra_item_id, Tipo:tipo, Producto:producto, Cantidad:cantidad}
        $.ajax({
            data:  req,
            url : '/gestion-compras-item-Borrar',
            type : "POST",
            done : function(response) {console.log(response);},
            success : function(data) {
                cargatablaItemsCompras(gos_compra_id)
                calculoscompras(gos_compra_id);
            }
        });
    });


    /** CODIGO CARGAR fecha al agregar credito **/
    $("#gos_forma_pago_id").on("change", function() {
        if ($(this).val() === "2") {
            $("#f_pago").show();
        }
        else {
            $("#f_pago").hide();
        }
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

        
    /**
     * LISTA DE ORDENES DE SERVICIOS
     * 
     */

    $('#dt-OS-compras').DataTable({
        dom : "<'row'<'col-4 d-none'l><'col-6'f>>" +
        "<'row'<'col-12'tr>>" +
        "<'row'<'col-6 d-none'i><'col-12 d-none'p>>",
        responsive : true,
        paging: false,
        ordering: false,
        language : {'url' : '/gos/Spanish.json'}
    });


    //Evento clic en el Boton seleccionar abre modal confirmando union de compra a OS

    $('body').on('click','.btn-unir',function() {
        if ($("#gos_compra_tipo_id").val()==1){
            $("#mjs-unido-oculto-Adm").removeClass('d-none');
            $("#mjs-unido-oculto-Os").addClass('d-none');
        } else if($("#gos_os_id").val()==0){
            var os = $(this).data('id');
            $('#os_selecy_unir').val(os)
            $('#modalCompraUnida').modal('show');
        } else {
            var os = $('#gos_os_id').val();
            var nro = $('#gos_os_nro_Interno').val();
            $('#vinculoOs').removeAttr('href');
            $('#vinculoOs').attr('href','/orden-servicio-generada/'+os);
            $('#vinculoOs').text('# '+nro);
            $("#mjs-unido-oculto-Os").removeClass('d-none');
        }     
    });


    $('body').on('click','#btn-unir-listo',function() {
        $('#modalCompraUnida').modal('hide');
        $('#modalbuscarOS-compras').modal('show');
        var os = $('#os_selecy_unir').val();
        var compra = $('#gos_compra_id').val();
        var cant = $('#largoProd').val();
        // console.log(os);
        // console.log(compra);
        // console.log(cant);
        var producto = [];
        for (let index = 0; index < $('#largoProd').val(); index++) {
            var id = document.getElementById(index+'_id').value;
            var cant = document.getElementById(index+'_cant').value;
            producto.push([id,cant]);
        }
        var req={gos_os_id:os, gos_compra_id:compra, productos: producto}
        $.ajax({
            data:  req,
            url : '/UnirCompraOs',
            type : "POST",
            done : function(response) {console.log(response);},
            success : function(data) {
                $('.btn-unir').text('');
                $('.btn-unir').text('Unida');
                $('.btn-unir').removeClass('btn-success');
                $('.btn-unir').addClass('btn-warning');
                $('.btn-unir').removeClass('btn-unir');
                $('#vinculoOs').removeAttr('href');
                $('#vinculoOs').attr('href','/orden-servicio-generada/'+os);
                $('#vinculoOs').text('');
                $('#vinculoOs').text(os);
                $('#gos_os_id').val(os);
                window.location.href=app_url+'/gestion-compras';
            }
        });
    });
});    

// FUNCION PARA TRAER DATOS DE PRODUCTO
var app_url_out = $('#app_url').attr('url'); 

function MostrarSelectProducto(){
	var itemProducto=Array.from($("#gos_producto_id_compra").find(':selected')).find(function(item){return $(item).text();});
	fetch(app_url_out+'/inventario-interno/'+itemProducto.value)
	.then(function(response) {
		return response.json();
	})
	.then(function(data){
        $('#gos_producto_marca_id').val(data.gos_producto_marca_id);
        $('#nomb_producto').val(data.nomb_producto);
		$('#descripcion').val(data.descripcion);
        $('#nomb_marca').val(data.nomb_marca);
        $('#nomb_medida').val(data.nomb_medida);
        $('#costo').val(data.costo);   
        $('#venta').val(data.venta);    
	});
};

function MostrarSelectExtProducto(){
    var itemProducto=Array.from($("#gos_producto_id_ext").find(':selected')).find(function(item){return $(item).text();});
	fetch('/inventario-externo/'+itemProducto.value)
	.then(function(response) {
		return response.json();
	})
	.then(function(data){
        $('#gos_producto_marca_id').val(data.gos_producto_marca_id);
        $('#nomb_producto').val(data.nomb_producto);
		$('#descripcion').val(data.descripcion);
        $('#nomb_marca').val(data.nomb_marca);
        $('#nomb_medida').val(data.nomb_medida);
        $('#costo').val(data.Costo);   
        $('#venta').val(data.venta);    
	});
};

function cambiosCalculosFinales() {
    if($('#subtotal').val() != ''){
        var subtotal = parseFloat($('#subtotal').val());
        var descuento = parseFloat($('#descuento').val());
        var iva = parseFloat($('#iva').val());
        var total = 0;

        if($('#descuento_tipo').val()=='PORCIENTO'){descuento = subtotal * descuento / 100;}       

        if ($('#iva').val() != ''){
            total = (subtotal-descuento) * iva / 100  + (subtotal-descuento);
        }else{total = subtotal-descuento}
        
        $('#total').val(total);    
    }
}   

function validacionesproductos(){
    $("#title-modalInventarioInterno").text('Inventario Interno');
    $('.gos_proveedor_id_PRO').text('');
    $('.codigo_PRO').text('');
    $('.nomb_producto_PRO').text('');
    $('.descripcion_PRO').text('');
    $('.cantidad_PRO').text('');
    $('.gos_producto_medida_id_PRO').text('');
    $('.gos_producto_marca_id_PRO').text('');
    $('.gos_producto_familia_id_PRO').text('');
    $('.costo_PRO').text('');
    $('.venta_PRO').text('');
    $('.cant_minima_PRO').text('');
    var regex_numeros = /^([0-9.])*$/;
    var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
    var errores = 0
    if($('#gos_proveedor_id_PRO').val()==0){$('.gos_proveedor_id_PRO').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_proveedor_id_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#codigo_PRO').val().trim() == '' || !regex_alfanumerico.test($('#codigo_PRO').val())){$('.codigo_PRO').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.codigo_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#nomb_producto_PRO').val().trim() == '' || !regex_alfanumerico.test($('#nomb_producto_PRO').val())){$('.nomb_producto_PRO').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.nomb_producto_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#descripcion_PRO').val().trim() == '' || !regex_alfanumerico.test($('#descripcion_PRO').val())){$('.descripcion_PRO').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.descripcion_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#cantidad_PRO').val().trim() == '' || !regex_numeros.test($('#cantidad_PRO').val())){$('.cantidad_PRO').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.cantidad_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_medida_id_PRO').val()==0){$('.gos_producto_medida_id_PRO').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_medida_id_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_marca_id_PRO').val()==0){$('.gos_producto_marca_id_PRO').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_marca_id_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_familia_id_PRO').val()==0){$('.gos_producto_familia_id_PRO').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_familia_id_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#costo_PRO').val().trim() == '' || !regex_numeros.test($('#costo_PRO').val())){$('.costo_PRO').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.costo_PRO').text('');if(errores > 0){errores-1;}});}
    // if($('#ganancia_PRO').val().trim() == '' || !regex_numeros.test($('#ganancia_PRO').val())){$('.ganancia_PRO').text('Campo numerico');errores++;
    // } else {$(this).focus(function(){$('.ganancia_PRO').text('');if(errores > 0){errores-1;}});}
    if($('#venta_PRO').val().trim() == '' || !regex_numeros.test($('#venta_PRO').val())){$('.venta_PRO').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.venta_PRO').text('');if(errores > 0){errores-1;}});}
    if(!regex_numeros.test($('#cant_minima_PRO').val())){$('.cant_minima_PRO').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.cant_minima_PRO').text('');if(errores > 0){errores-1;}});}
    if(errores != 0){event.preventDefault();
    } else {guardarProducto();}
}

//FUNCION GUARDAR
function guardarProducto(){
    var nombre = $('#nomb_producto_EXT').val();
    $.ajax({contenttype : 'application/json; charset=utf-8',
            data: $('#inventarioInterno-formCompras').serialize(),
            url : '/inventario-interno',
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
                $('#btn-guardar-producto').html('Guardar');
                $('#modalInventarioInterno').modal('hide');
                $('#gos_producto_id_compra').append('<option value="'+data+'" selected>'+nombre+'</option>');
                $('#gos_producto_id_compra').selectpicker('refresh');

                fetch('/inventario-interno/'+data)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data){
                    $('#gos_producto_marca_id').val(data.gos_producto_marca_id);
                    $('#nomb_producto').val(data.nomb_producto);
                    $('#cantidad').val(data.cantidad);
                    $('#descripcion').val(data.descripcion);
                    $('#nomb_marca').val(data.nomb_marca);
                    $('#nomb_medida').val(data.nomb_medida);
                    $('#costo').val(data.costo);
                    $('#venta').val(data.venta);
                });

            }
    });
};

function validacionesproductosExt(){
    $("#title-modalInventarioInterno").text('Inventario Externo');
    $('.gos_proveedor_id_EXT').text('');
    $('.codigo_EXT').text('');
    $('.nomb_producto_EXT').text('');
    $('.descripcion_EXT').text('');
    $('.cantidad_EXT').text('');
    $('.gos_producto_medida_id_EXT').text('');
    $('.gos_producto_marca_id_EXT').text('');
    $('.gos_producto_familia_id_EXT').text('');
    $('.costo_EXT').text('');
    $('.venta_EXT').text('');
    var regex_numeros = /^([0-9.])*$/;
    var regex_alfanumerico = /^([a-zA-Z0-9. ])*$/;
    var errores = 0
    if($('#gos_proveedor_id_EXT').val()==0){$('.gos_proveedor_id_EXT').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_proveedor_id_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#codigo_EXT').val().trim() == '' || !regex_alfanumerico.test($('#codigo_EXT').val())){$('.codigo_EXT').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.codigo_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#nomb_producto_EXT').val().trim() == '' || !regex_alfanumerico.test($('#nomb_producto_EXT').val())){$('.nomb_producto_EXT').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.nomb_producto_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#descripcion_EXT').val().trim() == '' || !regex_alfanumerico.test($('#descripcion_EXT').val())){$('.descripcion_EXT').text('Campo alfanumerico');errores++;
    } else {$(this).focus(function(){$('.descripcion_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#cantidad_EXT').val().trim() == '' || !regex_numeros.test($('#cantidad_EXT').val())){$('.cantidad_EXT').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.cantidad_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_medida_id_EXT').val()==0){$('.gos_producto_medida_id_EXT').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_medida_id_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_marca_id_EXT').val()==0){$('.gos_producto_marca_id_EXT').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_marca_id_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#gos_producto_familia_id_EXT').val()==0){$('.gos_producto_familia_id_EXT').text('Campo obligatorio');errores++;
    } else {$(this).focus(function(){$('.gos_producto_familia_id_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#costo_EXT').val().trim() == '' || !regex_numeros.test($('#costo_EXT').val())){$('.costo_EXT').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.costo_EXT').text('');if(errores > 0){errores-1;}});}
    // if($('#ganancia_EXT').val().trim() == '' || !regex_numeros.test($('#ganancia_EXT').val())){$('.ganancia_EXT').text('Campo numerico');errores++;
    // } else {$(this).focus(function(){$('.ganancia_EXT').text('');if(errores > 0){errores-1;}});}
    if($('#venta_EXT').val().trim() == '' || !regex_numeros.test($('#venta_EXT').val())){$('.venta_EXT').text('Campo numerico');errores++;
    } else {$(this).focus(function(){$('.venta_EXT').text('');if(errores > 0){errores-1;}});}
    // if(!regex_numeros.test($('#cant_minima_EXT').val())){$('.cant_minima_EXT').text('Campo numerico');errores++;
    // } else {$(this).focus(function(){$('.cant_minima_EXT').text('');if(errores > 0){errores-1;}});}
    if(errores != 0){event.preventDefault();
    } else {guardarProductoExt();}
}

function guardarProductoExt(){
    var nombre = $('#nomb_producto_EXT').val();
    $.ajax({contenttype : 'application/json; charset=utf-8',
        data:  $('#inventarioExterno-form').serialize(),
        url : '/inventario-externo',
        type : 'POST',
        done : function(response) {console.log(response);},
        error : function(jqXHR,textStatus,errorThrown) {
            if (console && console.log) {
                console.log('La solicitud a fallado: '+ textStatus);
                console.log('La solicitud a fallado: '+ errorThrown);
                }
            },
        success : function(data) {
            $('#modalInventarioExterno').modal('hide');
            $('#gos_producto_id_ext').append('<option value="'+data+'" selected>'+nombre+'</option>');
            $('#gos_producto_id_ext').selectpicker('refresh');

            fetch('/inventario-externo/'+data)
            .then(function(response) {
                return response.json();
            })
            .then(function(data){
                $('#gos_producto_marca_id').val(data.gos_producto_marca_id);
                $('#nomb_producto').val(data.nomb_producto);
                $('#cantidad').val(data.Cantidad);
                $('#descripcion').val(data.descripcion);
                $('#nomb_marca').val(data.nomb_marca);
                $('#nomb_medida').val(data.nomb_medida);
                $('#costo').val(data.Costo);
                $('#venta').val(data.venta);
            });
        }
    });

};


function cargaRapidaProv(){
    var idselect=document.getElementById("bs-select-1");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    $('#nomb_proveedor').val(insert);
    $('#ProveedorRapido').modal('show');
};

function modalProductoCompra(){
    $('#inventarioInterno-formCompras').trigger('reset');
    $('#gos_proveedor_id_PRO').val($('#gos_proveedor_id_compras').val());
    $('#gos_proveedor_id_PRO').change();
    $('#gos_producto_medida_id_PRO').val('');
    $('#gos_producto_medida_id_PRO').change();
    $('#gos_producto_marca_id_PRO').val('');
    $('#gos_producto_marca_id_PRO').change();
    $('#gos_producto_familia_id_PRO').val('');
    $('#gos_producto_familia_id_PRO').change();
    $('#gos_producto_ubicacion_id_PRO').val('');
    $('#gos_producto_ubicacion_id_PRO').change();
    var idselect=document.getElementById("bs-select-2");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    $('#nomb_producto_PRO').val(insert);    
    $('#collapseOne').removeClass('show');
    $('#modalInventarioInterno').modal('show');
}

function modalProductoExtCompra(){
    $('#inventarioExterno-form').trigger('reset');
    $('#gos_proveedor_id_EXT').val($('#gos_proveedor_id_compras').val());
    $('#gos_proveedor_id_EXT').change();
    $('#gos_producto_medida_id_EXT').val('');
    $('#gos_producto_medida_id_EXT').change();
    $('#gos_producto_marca_id_EXT').val('');
    $('#gos_producto_marca_id_EXT').change();
    $('#gos_producto_familia_id_EXT').val('');
    $('#gos_producto_familia_id_EXT').change();
    var idselect=document.getElementById("bs-select-3");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    $('#nomb_producto_EXT').val(insert);    
    $('#collapseOne').removeClass('show');
    $('#modalInventarioExterno').modal('show');
}

function getselectProveedor(){
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
                $('#gos_proveedor_id_PRO').append('<option value="'+data+'" selected>'+name+'</option>');
                $('#gos_proveedor_id_PRO').selectpicker('refresh');
                $('#gos_proveedor_id_compras').append('<option value="'+data+'" selected>'+name+'</option>');
                $('#gos_proveedor_id_compras').selectpicker('refresh');
            }
        });
    }
    
    $('#costo_PRO').change(function() {
    if($('#ganancia_PRO').val().length > 0){
            var venta = (parseFloat($("#costo_PRO").val()) * parseFloat($("#ganancia_PRO").val()) / 100) + parseFloat($("#costo_PRO").val());
            $('#gananciaok_PRO').val($("#ganancia_PRO").val());
        }
    });

    $('#ganancia_PRO').change(function() {
        if($('#costo_PRO').val().length > 0){
            var venta = (parseFloat($("#costo_PRO").val()) * parseFloat($("#ganancia_PRO").val()) / 100) + parseFloat($("#costo_PRO").val());
            $('#venta_PRO').removeAttr('value');
            $('#venta_PRO').attr('value',venta);
            $('#gananciaok_PRO').removeAttr('value');
            $('#gananciaok_PRO').attr('value',$("#ganancia_PRO").val());
        }
    });

    $('#venta_PRO').change(function() {
        if($('#costo_PRO').val().length > 0){
            var ganancia = ((parseFloat($("#venta_PRO").val()) * 100 / parseFloat($("#costo_PRO").val())) - parseFloat(100)); 
            $('#gananciaok_PRO').val(ganancia);
            $("#ganancia_PRO").val(ganancia);
        }
    });

}

/*** METODO PARA ACTUALIZAR CARGA MARCAS */
function getselectMarcaCompra() {
    var idselect=document.getElementById("bs-select-6");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0 };
    $.ajax({
        type: 'POST',
        url: '/MarcaCargaRapida',
        data: obj,
        success: function(data) {
            $('#gos_producto_marca_id_PRO').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#gos_producto_marca_id_PRO').selectpicker('refresh');
        }
    });
}

function getselectMarcaCompraExt() {
    var idselect=document.getElementById("bs-select-11");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0 };
    $.ajax({
        type: 'POST',
        url: '/MarcaCargaRapida',
        data: obj,
        success: function(data) {
            $('#gos_producto_marca_id_EXT').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#gos_producto_marca_id_EXT').selectpicker('refresh');
        }
    });
}

/*** METODO PARA ACTUALIZAR CARGA FAMILIAS */
function getselectFamiliaCompra() {
    var idselect=document.getElementById("bs-select-7");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0 };
    $.ajax({
        type: 'POST',
        url: '/FamiliaCargaRapida',
        data: obj,
        success: function(data) {
            $('#gos_producto_familia_id_PRO').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#gos_producto_familia_id_PRO').selectpicker('refresh');
        }
    });
}
function getselectFamiliaCompraExt() {
    var idselect=document.getElementById("bs-select-12");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0 };
    $.ajax({
        type: 'POST',
        url: '/FamiliaCargaRapida',
        data: obj,
        success: function(data) {
            $('#gos_producto_familia_id_EXT').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#gos_producto_familia_id_EXT').selectpicker('refresh');
        }
    });
}

/*** METODO PARA ACTUALIZAR CARGA UBICACIONES */
function getselectUbicacionCompra() {
    var idselect=document.getElementById("bs-select-8");
    var child=idselect.childNodes[0].childNodes[0].innerHTML;
    var res = child.split('"');
    var insert=res[1];
    var obj = { name: insert, taller: 0 };
    $.ajax({
        type: 'POST',
        url: '/UbicacionCargaRapida',
        data: obj,
        success: function(data) {
            $('#gos_producto_ubicacion_id_PRO').append('<option value="'+data+'" selected>'+insert+'</option>');
            $('#gos_producto_ubicacion_id_PRO').selectpicker('refresh');
        }
    });
}