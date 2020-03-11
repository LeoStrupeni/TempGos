$(document)
	.ready(
		function () {
			$('.datatablaList')
				.DataTable(
					{
						dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
						"<'row'<'col-sm-12'tr>>" +
						"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
						"iDisplayLength": 50,
						responsive : true,
						processing : true,
						rowReorder: {
							update: false
						},
						
						language : {"url" : "/gos/Spanish.json"}
					});

		
		});