$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

    var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    
    $('#fecha').datepicker({
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        startDate: primerDia,
        endDate: ultimoDia,
        locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
    }).datepicker("setDate", date);

    $('#fechaPago').datepicker({
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        startDate: primerDia,
        endDate: ultimoDia,
        locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
    }).datepicker("setDate", date);

    $('#dt-Prestamos').DataTable({
        dom : "<'row'<'col-6 pl-2'f><'col-6 d-flex justify-content-end'B>>" +
                "<'row'<'col-12'tr>>" +
                "<'row'<'col-6'i><'col-6'p>>",
        buttons:[ 
			{
                extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel p-0"></i> ',
				titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                title: null,
                autoFilter: true,
                exportOptions : {
                    //columns: [ 0, 1, 2, 8, 9, 10, 3, 12, 4, 5, 6 ]
                }
            },

			{
				extend:    'print',
				text:      '<i class="fa fa-print p-0 text-white"></i> ',
				titleAttr: 'Imprimir',
                className: 'btn btn-danger',
                title: 'Registros Prestamos',
                exportOptions : {
                    // columns: [ 0, 7, 8, 9, 10, 3, 12, 13],
                    stripHtml: false
                },
                customize: function (win) {
                    $(win.document.body).find('table').css({
                        'font-family': '"Trebuchet MS", Arial, Helvetica, sans-serif',
                        'border-collapse': 'collapse',
                        'border': '1px solid #ddd', 
                        'width': '100%',
                        'text-align': 'center'
                    });
                    $(win.document.body).find('th').css({
                        'background-color': '#27395c',
                        'border': '1px solid #ddd',
                        'text-align': 'center'
                    });
                    $(win.document.body).find('td').css({
                        'border': '1px solid #ddd',
                        'text-align': 'center'
                    });
                }
			},
        ],
        pageLength: 50,
        responsive : true,
        processing : true,  
        ajax : '/gestion-prestamos', 
        columns : [ 
            { data : 'gos_prestamo_id', name : 'id','visible' : false },
            { data : 'FechaPrestamo', class:'text-center p-2', width:'100px'},
            { data : 'Nombre', class:'text-center p-2'},
            { data : 'observaciones', class:'text-center p-2'},
            { data : 'MontoPrestado', class:'text-center p-2', width:'100px'},
            { data : 'saldo', class:'text-center p-2', width:'100px'},
            { data : 'fechaUltimoPago', class:'text-center p-2', width:'100px'},
            { data : 'Opciones', name : 'Opciones', orderable : false}
        ],
        order : [ [ 0, 'desc' ] ],
        language : {"url" : '/gos/Spanish.json'}
    });

    $('body').on('click','#btn-Nuevo-Prestamo',function() {
        $('#titlemodalPrestamo').text('Nuevo Prestamo');
        $('#modalPrestamo').modal('show');
    });

    $('body').on('click','#btn-editar',function() {
        var gos_prestamo_id = $(this).data('id');
		$.get('/gestion-prestamos/' + gos_prestamo_id + '/edit',
			function (data) {
                $('#title-error').hide();
                $('#product_code-error').hide();
                $('#description-error').hide();
                $('#FormNuevoPrestamo').trigger('reset');
                $('#titlemodalPrestamo').text('Editar Prestamo');
                $('#modalPrestamo').modal('show');
                $('#gos_prestamo_id').val(data.gos_prestamo_id);
                $('#gos_usuario_id').val(data.gos_usuario_id);
                $('#gos_usuario_id').change();
                $('#observaciones').val(data.observaciones);
                $('#fecha').val(data.FechaPrestamo);
                $('#monto').val(data.MontoPrestado);
        });
    });

    $('#btn_guardar_prestamo').click(function(event){
        var $errores = 0
        if($('#gos_usuario_id').val().trim() == '' ){$('.gos_usuario_id').text('Campo obligatorio');$errores++;}
        else{$(this).focus(function(){$('.gos_usuario_id').text('');if($errores > 0){$errores-1;}});}

        if($('#monto').val().trim() == '' ){$('.monto').text('Debe ingresar un monto valido');$errores++;}
        else{$(this).focus(function(){$('.monto').text('');if($errores > 0){$errores-1;}});}

        if($errores != 0){event.preventDefault();}
        else{$('#btn_guardar_prestamo').html('Guardando...');
             $.ajax({
                contenttype : 'application/json; charset=utf-8',
                data: $('#FormNuevoPrestamo').serializeArray(),
                url : '/gestion-prestamos',
                type : 'POST',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown,data) {
                    $('#btn_guardar_prestamo').html('Guardar');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                    }
                },
                success : function(data) {
                    $('#gos_prestamo_id').val('');
                    $('#FormNuevoPrestamo').trigger('reset');
                    $('#titlemodalPrestamo').text('Nuevo Prestamo');
                    $('#modalPrestamo').modal('hide');
                    $('#dt-Prestamos').DataTable().ajax.reload();
                    $('#btn_guardar_prestamo').html('Guardar');
                }
            });
        }
    });

    $('body').on('click','#btn-borrar',function() {
        var gos_prestamo_id = $(this).data('id');
        if (confirm('Esta seguro que desea borrar!!')) {
            $.ajax({
                type : 'DELETE',
                url : '/gestion-prestamos/'+ gos_prestamo_id,
                success : function(data) {
                    $('#dt-Prestamos').DataTable().ajax.reload();
                },
                error : function(data) {
                    console.log('Error:',data);
                }
            });
        }
    });

    $('body').on('click','#btn-abonar',function() {
        var gos_prestamo_id = $(this).data('id');
		$.get('/gestion-prestamos/' + gos_prestamo_id + '/edit',
			function (data) {
                $('#title-error').hide();
                $('#product_code-error').hide();
                $('#description-error').hide();
                $('#FormNuevoPago').trigger('reset');
                $('.importePago').text('');
                $('#gos_prestamo_idPago').val(data.gos_prestamo_id);
                $('#NombreEmpleado').val(data.Nombre);
                $('#fechaPrestamo').val(data.FechaPrestamo);
                $('#montoPrestamo').val(data.MontoPrestado);
                $('#SaldoPendiente').val(data.saldo);   
                $('#modalPago').modal('show');
        });
    });

    $('#btn_guardar_pago').click(function(event){
        var regex_numeros = /^([0-9.])*$/;
        if($('#SaldoPendiente').val() == 0){
            $('.importePago').text('El Saldo Pendiente es 0');
        } else if ($('#importePago').val().trim() == '' || !regex_numeros.test($('#importePago').val())){
            $('.importePago').text('Campo Numerico');
        } else if($('#SaldoPendiente').val()-$('#importePago').val() < 0){
            $('.importePago').text('El importe ingresado es Mayor al saldo');
        } else {           
            $('#btn_guardar_pago').html('Registrando ...');
			var datosForm1=$('#FormNuevoPago').serializeArray();
            $.ajax({contenttype : 'application/json; charset=utf-8',
                data: datosForm1,
                url : '/gestion-prestamos-pagos',
                type : 'POST',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,errorThrown) {
                    $('#btn_guardar_pago').html('Guardar');
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ errorThrown);
                    }
                },
                success : function(data) {
                    $('#btn_guardar_pago').html('Guardar');
                    $('#FormNuevoPago').trigger('reset');
                    $('.importePago').text('');
					$('#dt-Prestamos').DataTable().ajax.reload();
					$('#modalPago').modal('hide');
                }
            });
        }
    });
    
    $('body').on('click','#btn-ver',function() {
        $('#titlemodalHistorialPrestamos').text('');
        $('#dt-Historial-Prestamos').DataTable().clear().destroy();

        var datos = $(this).data('id');
        var splited = datos.split('|');
        var gos_usuario_id = splited[0];
        var nombre = 'Historial Prestamos de '+splited[1];
        
        $('#dt-Historial-Prestamos').DataTable({
            dom : "<'row'<'col-6 w-75'f><'col-6'p>>" +
				"<'row'<'col-sm-12'tr>>",
            responsive : true,
            processing : true,  
            ajax : '/gestion-prestamos-historial/' + gos_usuario_id, 
            columns : [ 
                { data : 'Tipo', class:'p-2'},
                { data : 'Fecha', class:'text-center p-2'},
                { data : 'Prestamo', class:'text-center p-2'},
                { data : 'Pago', class:'text-center p-2'}
            ],
            order : [ [ 2, 'desc' ] ],
            language : {"url" : '/gos/Spanish.json'},
            footerCallback: function ( row, data, start, end, display ) {
                $('#titlemodalHistorialPrestamos').text(nombre);
                $('#modalHistorialPrestamos').modal('show');   
            }
        });     

          
    });
});