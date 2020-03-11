<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Prueba AJAX-YOIS</title>

<!--los scripts de ajax necesario-->
<script type="text/javascript" language="javascript"
	src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript"
	src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!--objeto de datos-->
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




<script type="text/javascript">
        $(document).ready(function() {
                $('#boton-ajax').click(function(){
                    $.ajax({
                    type:"POST",
                    url : "/prueba-ajax-enzo-post",
                    data:{ } , // do I need to pass data if im GET ting?
                    dataType: 'json',
                    function(){
                    //Codigo para llamar a la ruta del OrdenDeServicioController-->refrescaItemsOrdenServici(id) que traiga
                    //JSON POR FAVOR PARA MI GRILLA AJAX
                    }
                });//end ajax
              });//end click
            });//end rdy
</script>
</head>

<body>

	<section id="clientes">
		<div class="container">
			Prueba YOIS

			<table id="example" class="display" style="width: 100%">
				<thead>
					<tr>
						<th>First name</th>
						<th>Last name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>First name</th>
						<th>Last name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</section>

</body>
</html>
