$(document).ready(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	   
    $('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
    });

    $("#estado").change(function(){
        var table = $('#dt-EtapasTecnicos').DataTable();
        var valor = $(this).val();
        table.column(0).search(valor).draw();
    });
    
    $('#dt-EtapasTecnicos').DataTable({
        dom : "<'row'<'col-6 pl-3'B><'col-6 d-flex justify-content-end'p>>" +
                "<'row'<'col-12'tr>>" +
                "<'row'<'col-6 d-none'i><'col-6 d-none'f>>",
        buttons:[{extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel p-0"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-verde text-white',
                title: null,
                autoFilter: true,
                exportOptions : {columns: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34]}
            }],
        language : {"url" : "/gos/Spanish.json"}
    });

});