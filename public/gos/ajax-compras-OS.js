$(document).ready(function () {
/**
 * Ajax listado de Ordenes de Servicios
 */
	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

$('#dt-OS-compras').DataTable({
  responsive: true,
  searchDelay: 500,
  processing: true,
  ajax: '/ordenes-servicio',
  columns: [
  {data: 'gos_os_id'},
  {data: 'detallesVehiculo'},
  {data: 'nomb_cliente'},
  {data: 'cantidad'},
  {defaultContent:`<button class="btn btn-success btn-unir">Unir</button>`}
  ],
  language : {'url' : '/gos/Spanish.json'}
});
/**
 * Evento clic en el Boton seleccionar abre modal confirmando union de compra a OS
 */
	$('#dt-OS-compras tbody').on('click', '.btn-unir', function () {
		  $('#gos_os_id').val(data.gos_os_id);
			$('#modal-compra-unida').modal('show');
		});
});
