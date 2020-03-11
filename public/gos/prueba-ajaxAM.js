// "use strict";
// var TablaClienteVehiculo = function() {
//
// 		// begin first table
// 		table.DataTable({
// 			responsive: true,
// 			searchDelay: 500,
// 			processing: true,
// 			serverSide: true,
// 			ajax: '/lista-clientes-vehiculos/',
// 			columns: [
// 				{data: 'nomb_cliente'}, //Se Precisa nombre y apellido
// 				{data: 'gos_vehiculo_modelo_id'}, //Se precisa Modelo, Marca, Año, Patente, Color.
// 				{data: 'economico'},
// 				{data: 'nro_serie'},
// 				{data: 'Menu', responsivePriority: -1},
// 			],
// 			columnDefs: [
// 				{
// 					targets: -1,
// 					title: 'Acciones',
// 					orderable: false,
// 					render: function(data, type, full, meta) {
// 						return `
//                       <button type="button" class="btn btn-success">Seleccionar</button></td>
// 									 `;
// 					},
// 				},
// 			],
// 		});
// 	};
//
// 	return {
//
// 		//main function to initiate the module
// 		init: function() {
// 			initTable1();
// 		},
//
// 	};
//
// }();
//
// jQuery(document).ready(function() {
// 	TablaClienteVehiculo.init();
// });
function pruebaAjax(){
	fetch("/lista-clientes-vehiculos")
	// PRIMER THEN RETORNA LA RESPUESTA DEL LLAMADO
	.then(function(response) {
		return response.json()
	})// SOLICITUD DE QUE HARA CON LA RESPUESTA OBTENIDA
	.then(function(data){
		console.log(data);
		for (item of data) {
			var Cliente = item.nomb_cliente;
			var Vehiculo = item.gos_vehiculo_modelo_id;
			var Economico = item.economico;
			var Serie = item.nro_serie;
			var Menu = `<button type="button" class="btn btn-success">Seleccionar</button> `;

			var contenido = "<tr><td>"+Cliente+"</td><td>"+Vehiculo+"</td><td>"+Economico+"</td><td>"+Serie+"</td><td>"+Menu+"</td></tr>";

			$("#dt-clientes-vehiculos").append(contenido);
		}
	})
}
