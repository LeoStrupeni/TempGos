$(document).ready(function() {
 console.log("ajax-facturacion-DREADY");


 $('#nueva-factura').click(function() {
  window.location.href="/gestion-factura/nueva";
	});

	$('#crear-facturacion').click(function() {
		$('#titleModalFacturacion').html('Factura complemento de pago ');
		$('#modalFacturacion').modal('show');
    });

    $('#crear-multiple-facturacion').click(function() {
        $('#titleModalFacturacionMultiple').html('Agregar Pago Múltiple ');
		$('#modalFacturacionMultiple').modal('show');
	});

	var date = new Date();
	var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
	var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

	$('#rangoFechas').daterangepicker({
		buttonClasses: ' btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
		startDate: primerDia,
		endDate: ultimoDia,
		locale: {"applyLabel": "Aplicar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "hasta","customRangeLabel": "Custom",
            "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            "firstDay": 1}
	});

});


function carpetatodos(){
  $( "#carpeta-todas" ).show();
  $( "#carpeta-facturas").hide();
  $( "#carpeta-notasremison" ).hide();
  $( "#carpeta-canceladas" ).hide();
  $( "#carpeta-historico" ).hide();
  //____________________________
  $( "#headertodos" ).addClass( "active" );
  $( "#headerfacuras" ).removeClass( "active" );
  $( "#headerremisiones" ).removeClass( "active" );
  $( "#headercanceladas" ).removeClass( "active" );
  $( "#headernotascredito" ).removeClass( "active" );
  $( "#headerhistorico" ).removeClass( "active" );

}
function carpetaFacturas(){
  $( "#carpeta-todas" ).hide();
  $( "#carpeta-facturas").show();
  $( "#carpeta-notasremison" ).hide();
  $( "#carpeta-canceladas" ).hide();
  $( "#carpeta-historico" ).hide();
  //_______________________________
  $( "#headertodos" ).removeClass( "active" );
  $( "#headerfacuras" ).addClass( "active" );
  $( "#headerremisiones" ).removeClass( "active" );
  $( "#headercanceladas" ).removeClass( "active" );
  $( "#headernotascredito" ).removeClass( "active" );
  $( "#headerhistorico" ).removeClass( "active" );
}
function carpetasremision(){
  $( "#carpeta-todas" ).hide();
  $( "#carpeta-facturas").hide();
  $( "#carpeta-notasremison" ).show();
  $( "#carpeta-canceladas" ).hide();
  $( "#carpeta-historico" ).hide();
  //___________________________________
  $( "#headertodos" ).removeClass( "active" );
  $( "#headerfacuras" ).removeClass( "active" );
  $( "#headerremisiones" ).addClass( "active" );
  $( "#headercanceladas" ).removeClass( "active" );
  $( "#headernotascredito" ).removeClass( "active" );
  $( "#headerhistorico" ).removeClass( "active" );
}
function carpetascanceladas(){
  $( "#carpeta-todas" ).hide();
  $( "#carpeta-facturas").hide();
  $( "#carpeta-notasremison" ).hide();
  $( "#carpeta-canceladas" ).show();
  $( "#carpeta-historico" ).hide();
  //____________________________________________
  $( "#headertodos" ).removeClass( "active" );
  $( "#headerfacuras" ).removeClass( "active" );
  $( "#headerremisiones" ).removeClass( "active" );
  $( "#headercanceladas" ).addClass( "active" );
  $( "#headernotascredito" ).removeClass( "active" );
  $( "#headerhistorico" ).removeClass( "active" );
}
function carpetasnotacredito(){
    $( "#carpeta-todas" ).hide();
    $( "#carpeta-facturas").hide();
    $( "#carpeta-notasremison" ).hide();
    $( "#carpeta-canceladas" ).hide();
    $( "#carpeta-historico" ).hide();
    //______________________________________________
    $( "#headertodos" ).removeClass( "active" );
    $( "#headerfacuras" ).removeClass( "active" );
    $( "#headerremisiones" ).removeClass( "active" );
    $( "#headercanceladas" ).removeClass( "active" );
    $( "#headernotascredito" ).addClass( "active" );
    $( "#headerhistorico" ).removeClass( "active" );
}
function carpetashistorico(){
  $( "#carpeta-todas" ).hide();
  $( "#carpeta-facturas").hide();
  $( "#carpeta-notasremison" ).hide();
  $( "#carpeta-canceladas" ).hide();
  $( "#carpeta-historico" ).show();
  //____________________________________________
  $( "#headertodos" ).removeClass( "active" );
  $( "#headerfacuras" ).removeClass( "active" );
  $( "#headerremisiones" ).removeClass( "active" );
  $( "#headercanceladas" ).removeClass( "active" );
  $( "#headernotascredito" ).removeClass( "active" );
  $( "#headerhistorico" ).addClass( "active" );
}
