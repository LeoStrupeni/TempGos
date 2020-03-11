"use strict";
var GosTablaFuenteDatosAjax = function() {
	var iniciaTablaMarcasVehiculos = function() {
		var table = $('#gos_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: '/datos-marcas-vehiclos',
			// ajax: { "url": "/datos-marcas-vehiclos", "type": "POST" },
			columns: [
				{data: 'gos_vehiculo_marca_id'},
				{data: 'marca_vehiculo'},				
				{data: 'Acciones', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Editar/a>
                                <a class="dropdown-item" href="#"><i class="la la-trash"></i> Borrar</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generar Reporte</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				}
				
			],
			language : {"url" : "/gos/Spanish.json"}
		});
	};

	return {

		// funcion principal que inicializa modulo
		init: function() {
			iniciaTablaMarcasVehiculos();
		},

	};

}();

jQuery(document).ready(function() {
	GosTablaFuenteDatosAjax.init();
});