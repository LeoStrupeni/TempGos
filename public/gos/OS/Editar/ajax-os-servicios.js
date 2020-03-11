$(document).ready(function() {

	var app_url = $('#app_url').attr('url');
	var id = $("#gos_os_id").val();
	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	// get de listado o index tomado del controller para el
	// Objeto DataTable
	$('#dt-Servicios').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		responsive : true,
		processing : true,
		ajax : app_url+'/servicios-os/'+id,    //completar URL
		columns : [	{data : 'gos_os_item_id',name : 'id','visible' : false},
					{data : 'servicio'},
					{data : 'descripcion'},
					{data : 'codigo_sat',render: function(data, type, meta){
						var id = meta.gos_os_item_id;
							if(data==null){data="Sin Asignar";}
 					 return '<label>'+data+'</label>'
 				   }},
					{data : 'tecnico_nueva',render: function(data, type, meta){
						var id = meta.gos_os_item_id;
							if(data==null){data="Sin Asignar";}
 					 return '<a href="javascript:void(0);" onclick="AsignarAsesorShow('+id+');" style="color: inherit;text-decoration: inherit;">'+data+'</a>'
 				   }},
					{data : 'nombre'},
          {data : 'precio_mo'},

          {data : 'descuento',render: function(data, type, meta){
						var id = meta.gos_os_item_id;
							if(data==null){data=0;}
 					 return '<input type="number" min="0"  class="form-control"  name="descuento'+id+'"  value="0"></input>'
 				   }},
          {data : 'precio_etapa'},
					{data : 'estado_etapa',render: function(data, type, meta){
						var id = meta.gos_os_item_id;
             if(data=="F"){var x='checked="checked"'}
					 return '<label style="margin-bottom: 1rem;" class="kt-checkbox"><input type="checkbox"'+x+' disabled> <span></span></label>'
					 }},
					{ data : 'Opciones',
					  name : 'Opciones', orderable : false}
					],
		order : [ [ 0, 'asc' ] ],
		language : {'url' : app_url+'/gos/Spanish.json'}
	});

});


$( "#btnmodalservicios" ).click(function() {
    $osid=document.getElementById("gos_os_id_serv").value;
	$.ajax({
		type: 'get',
		url: '/orden-servicio-generada/tecnicoAutoCalc/'+$osid,
		data: Request,
		success: function(data) {
				console.log(data);
		}
	});
	$('#dt-Servicios').DataTable().ajax.reload();
	$('#kt_modal_7').modal('show');
});


function MostrarSelectServicio(sel){
		var id=document.getElementById("gos_os_id_serv").value;
				 $.ajax({
					 type: 'get',
					 url: '/orden-servicio-generada/'+id+'/Itemsserv',
					 success: function(data){
							 console.log(data);

						}});
			}

function MostrarSelectEtapa(sel){
		$("#descripcion_servicio").val("desc");
}

function AgregarServicio(){
 	var id=document.getElementById("gos_os_id_serv").value;
		var Request = $('#servicio_form').serialize();
		$.ajax({
				type: 'POST',
				url: '/orden-servicio-generada/'+id+'/AgregarServicio',
				data: Request,
				success: function(data) {
						console.log(data);
				}
		});
		$("#gos_servicio_id").val(0);
		$('#gos_servicio_id').selectpicker('refresh');
		document.getElementById("descripcion_servicio").value = "";
		document.getElementById("gos_servicio_cantidad").value = "";
			document.getElementById("gos_servicio_venta").value = "";
		$('#dt-Servicios').DataTable().ajax.reload();
}

function AsignarAsesorShow(id){

	  document.getElementById("OSitemid").value =id;
	 $('#modalAsignarAsesor').modal('show');
}
var Ttipo="";
function tecnicopc(){
	var div = document.getElementById("swctec");
	var btn  = document.getElementById("btntec");
	var lbl  = document.getElementById("lbltec");
  if (div.style.display === "none") {
    div.style.display = "block";
     btn.innerHTML = "$";
		 lbl.innerHTML="Precio";
		 Ttipo = "$";
		 document.getElementById("Sinput").value="$";
  } else {
    div.style.display = "none";
		 lbl.innerHTML="Porcentaje";
	   btn.innerHTML =  "%";
		 Ttipo =  "%";
		 document.getElementById("Sinput").value="%";
  }
}

function postAsesor(){

	var estatus = $("#btnmodalservicios").val();

		var Request = $('#formTecnicoServicios').serialize();
		console.log(Request);
		$.ajax({
				type: 'POST',
				url: '/orden-servicio-generada/tecnico',
				data: Request,
				success: function(data) {
					if(data == 'Transito'){
						alert('No se puede asignar un tecnico a una orden en transito');
					}
						console.log(data);
				}
		});
		$('#modalAsignarAsesor').modal('hide');
  	$('#dt-Servicios').DataTable().ajax.reload();

 }

function GuardarServicio(){
	var id=document.getElementById("gos_os_id_serv").value;
	var Request=$('#formtableServicios').serialize();
	console.log(Request);
 $.ajax({
		 type: 'POST',
		 url: '/orden-servicio-generada/'+id+'/Guardar',
		 data: Request,
		 success: function(data) {
				 console.log(data);
				 window.location.reload();
		 }
 });
 $('#dt-Servicios').DataTable().ajax.reload();
  	$('#kt_modal_7').modal('hide');
}

function EliminarServ(id) {
	$.ajax({
			type: 'POST',
			url: '/orden-servicio-generada/'+id+'/Eliminar',
			data: Request,
			success: function(data) {
					console.log(data);
			}
	});
		$('#dt-Servicios').DataTable().ajax.reload();
}

function getParamsTec(sel){
	var div = document.getElementById("swctec");
	var btn  = document.getElementById("btntec");
	var lbl  = document.getElementById("lbltec");
	$.ajax({
			type: 'Get',
			url: '/orden-servicio-generada/'+sel+'/tecnicoPreferencias',
			data: Request,
			success: function(data) {
					console.log(data.tipo_comision);
					if(data.tipo_comision=="PORCIENTO"){
						 console.log("%");
						 div.style.display = "none";
						 lbl.innerHTML="Porcentaje";
						 btn.innerHTML =  "%";
						 document.getElementById("inputPoPid").value =data.monto_comision;
						 document.getElementById("Sinput").value="%";
					 }
					 if(data.tipo_comision=="PESOS"){
						 console.log("$");
						 div.style.display = "block";
							btn.innerHTML = "$";
							lbl.innerHTML="Precio";
							document.getElementById("inputPoPid").value =data.monto_comision;
							document.getElementById("Sinput").value="$";
 					 }
			}
	});
}

 $('#modalAsignarAsesor').on('hide.bs.modal', function (e) {
    document.getElementById("Sinput").value="";
		document.getElementById("OSitemid").value="";
		document.getElementById("Cantidadid").value=0;
		document.getElementById("inputPoPid").value=0;
		$("#selectecnico").val(0);
		$('#selectecnico').selectpicker('refresh');
 });
