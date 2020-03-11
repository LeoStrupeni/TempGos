<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  </head>
  <body>
<div class="container">
  <table>

  </table>
</div>
<table class="kt-datatable" id="html_table">
    <thead>
        <tr>
            <th title="Field #1">Cliente</th>
            <th title="Field #2">Vehiculo</th>
            <th title="Field #3"># económico</th>
            <th title="Field #4"># de serie</th>
            <th title="Field #4"></th>
            <th title="Field #5"></th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($ordenes as $orden) --}}
        <tr>
            <td>{{-- {{$orden->nombre}} --}}</td>
            <td>{{-- {{$orden->marca_vehiculo}} --}}</td>
            <td>{{-- {{$orden->precio_economico}} --}}</td>
            <td>{{-- {{$orden->serie}} --}}</td>
            <td><button type="button" class="btn btn-success" >Seleccionar</button>
            </td>
        </tr>
        {{-- @endforeach --}}

    </tbody>
</table>
    <script type="text/javascript" class="init">
    		$( document ).ready( function () {
    			$( '#example' ).DataTable( {
    				"processing": true,
    				"serverSide": true,
    				"ajax": "/respuesta-get-ajax-yois",
    				"columns": [ {
    					"data": "first_name"
    				}, {
    					"data": "last_name"
    				}, {
    					"data": "position"
    				}, {
    					"data": "office"
    				}, {
    					"data": "start_date"
    				}, {
    					"data": "salary"
    				} ]
    			} );
    		} );
    	</script>

  </body>
</html>
