var options='<option value="0">ND</option>';
var options2='<option value="0">ND</option>';
var dataUbicaciones='';
var dataProvedores='';
var Mid=0;
$(document).ready(function() {
Mid=document.getElementById("gos_os_id").value;

	console.log("ajax-refacciones");
	var $Osid=document.getElementById("gos_os_id").value;

	var app_url = $('#app_url').attr('url');

	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


		$.ajax({
			type: 'get',
			url: '/orden-servicio-gen/ubicaciones',
			success: function(data) {
			dataUbicaciones=data;
			}});

      $.ajax({
        type: 'get',
        url: '/orden-servicio-gen/Proveedores',
        success: function(data) {
        dataProvedores=data;
        }});

	$('#dt-Refacciones').DataTable({
		dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
		"iDisplayLength": 100,
		responsive : true,
		processing : true,
		ajax : '/orden-servicio-generada/'+$Osid+'/datatable',
		columnDefs: [
			{ "width": "8%", "targets": 2 },
			{ "width": "5%", "targets": 3 },

			{ "width": "8%", "targets": 6 },
			{ "width": "5%", "targets": 7 }
		  ],
		columns : [
			 {data : 'gos_os_refaccion_id',render: function(data, type, row){
		          return '<input  class="form-control" name="ref_id'+data+'" value="'+data+'"hidden></input><p>'+data+'</p>'
		          },'visible' : false},
					{data : 'nombre'},
					{data : 'nro_parte',render: function(data, type, meta){
						var id = meta.gos_os_refaccion_id;
 					 return '<input  class="form-control" name="parte'+id+'" value="'+data+'"></input>'
 				   }},
          {data : 'observaciones',render: function(data, type, meta){
						var id = meta.gos_os_refaccion_id;
 					 return '<input  class="form-control" name="obs'+id+'" value="'+data+'"></input>'
 				   }},
          {data : 'proveedor', render: function(data,row,meta){
            options2='<option value="0">Sin Asignar</option>';
              var id = meta.gos_os_refaccion_id;
              	for (var i = 0; i < dataProvedores.length; i++) {
                  	if (dataProvedores[i].gos_proveedor_id==data) {options2=options2+'<option value="'+dataProvedores[i].gos_proveedor_id+'" selected>'+dataProvedores[i].nomb_proveedor+'</option>';}
                      else{options2=options2+'<option value="'+dataProvedores[i].gos_proveedor_id+'" >'+dataProvedores[i].nomb_proveedor+'</option>';}
                    }
            var htselect2= '<select class="form-control" name="prov'+id+'">'+options2+'</select>';
             var refprov='';
             for (var i = 0; i < dataProvedores.length; i++) {
                 if (dataProvedores[i].gos_proveedor_id==data) {refprov='<a href="javascript:void(0);" onclick="AsignadProvRef('+id+');" style="color: inherit;text-decoration: inherit;">'+dataProvedores[i].nomb_proveedor+'</a>';}

                  }
                  if ( refprov=='') {refprov='<a href="javascript:void(0);" onclick="AsignadProvRef('+id+');" style="color: inherit;text-decoration: inherit;">Sin Asignar</a>';}

          	return  refprov;
          }},
					{data : 'fechas',render: function(data, meta){
						data.split('|');
						var x = data.split('|');
						$(function () {
							$('[data-toggle="popover"]').popover();
						  })

            var html="";
             if (x[0]!="") {html=html+'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Solicitud"><i class="fas fa-circle" style="color: #339af0;"></i>FS:'+x[0]+'</p>';}
						 if (x[2]!="") {html=html+'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Asignado"><i class="fas fa-caret-square-down" style="color: blue;"></i> FA:'+x[2]+'</p>';}
						 if (x[1]!="") {html=html+'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Promesa"><i class="fas fa-square" style="color: yellow;"></i> FP:'+x[1]+'</p>';}
						 if (x[4]!="") {html=html+'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Refacción Recibida"><i class="fas fa-caret-square-right" style="color: green;"></i>FR:'+x[4]+'</p>' ;}
						 if (x[5]!="") {html=html+ '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Refacción Entregada"><i class="fas fa-caret-square-left" style="color: red;"></i>ET:'+x[5]+'</p>';}
						 if (x[6]!="") {html=html+ '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Portal"><i class="fas fa-circle" style="color: #339af0;"></i>FP:'+x[6]+'</p>' ;}
						 if (x[3]!="") {html=html+ '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Cancelado"><i class="fas fa-ban" style="color: red;"></i> FC:'+x[3]+'</p>';}

						 return html;
						/*return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Solicitud"><i class="fas fa-circle" style="color: #339af0;"></i>FS:'+x[0]+'</p>'+
            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Asignado"><i class="fas fa-caret-square-down" style="color: blue;"></i> FA:'+x[2]+'</p>'+
						'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Promesa"><i class="fas fa-square" style="color: yellow;"></i> FP:'+x[1]+'</p>'+
						'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Refacción Recibida"><i class="fas fa-caret-square-right" style="color: green;"></i>FR:'+x[4]+'</p>'+
						'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Refacción Entregada"><i class="fas fa-caret-square-left" style="color: red;"></i>ET:'+x[5]+'</p>'+
						'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha de Portal"><i class="fas fa-circle" style="color: #339af0;"></i>FP:'+x[6]+'</p>'+
						'<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Cancelado"><i class="fas fa-ban" style="color: red;"></i> FC:'+x[3]+'</p>';*/
					}
				},
				{data : 'gos_os_refaccion_estatus',render: function(data,row,meta){
					var x = meta.fechas.split('|');
					var fp=x[1];
					var d = new Date();
					d = d.getFullYear() + "-" +
					("0" + (d.getMonth()+1)).slice(-2) + "-" +
					("0" + d.getDate()).slice(-2) + " " +
					("0" + d.getHours()).slice(-2) + ":" +
					("0" + d.getMinutes()).slice(-2) + ":" +
					("0" + d.getSeconds()).slice(-2);
					if (data=='En Proceso') {
					if(fp < d){return "Vencida";}
					 else {return data;}
				  }
					else{return data;}
				  }},


					{data : 'ubicacion', render: function(data,row,meta){
						options='<option value="0">ND</option>';
					  var id = meta.gos_os_refaccion_id;
						for (var i = 0; i < dataUbicaciones.length; i++) {
							if (dataUbicaciones[i].gos_producto_ubicacion_id==data) {
                options=options+'<option value="'+dataUbicaciones[i].gos_producto_ubicacion_id+'" selected>'+dataUbicaciones[i].nomb_ubicacion+'</option>';
							}
							else {
								options=options+'<option value="'+dataUbicaciones[i].gos_producto_ubicacion_id+'">'+dataUbicaciones[i].nomb_ubicacion+'</option>';
							}
						 }
						var htselect= '<select class="form-control" name="ubica'+id+'">'+options+'</select>';
						return  htselect;
					}
				},
					{data : 'fecha_recibido', render: function(data,row,meta){
						var id = meta.gos_os_refaccion_id;
					  if(data!=null){var x="checked disabled"}
						return '<div class="form-check" style="text-align-last: center;"><input class="form-check-input position-static" type="checkbox" name="chekRecibido'+id +'" value="1" '+x+' onclick="UpdateFecha('+id+',0)" ></div>';
					}
				},
					{data : 'fecha_entregado', render: function(data,row,meta){
						var id = meta.gos_os_refaccion_id;
					  if(data!=null){var x="checked disabled"}
						return '<div class="form-check" style="text-align-last: center;"><input class="form-check-input position-static" type="checkbox" name="chekEntregado'+id +'" value="1" '+x+' onclick="UpdateFecha('+id+',1)"  ></div>';
					}},
					{data : 'fecha_portal', render: function(data,row,meta){
						var id = meta.gos_os_refaccion_id;
					  if(data!=null){var x="checked disabled"}
						return '<div class="form-check" style="text-align-last: center;"><input class="form-check-input position-static" type="checkbox" name="chekPortal'+id +'" value="1" '+x+' onclick="UpdateFecha('+id+',2)"  ></div>';
					}},
					 { data : 'Opciones',
						 name : 'Opciones', orderable : false}
					],
		order : [ [ 0, 'desc' ] ],
		language : {'url' : '/gos/Spanish.json'}
	});

});



	function Agregaritem(){
		var $id=document.getElementById("gos_os_id").value;
		var Request = $('#refaccioness_form').serialize();
		$.ajax({
				type: 'POST',
				url: '/orden-servicio-generada/'+$id+'/AgregarRefaccion',
				data: Request,
				success: function(data) {

				}
		});
      document.getElementById("gos_os_refaccion_id").value=0;
		   $("#nomb_refaccion").val(0);
			 $("#proveedor").val(0);
		   $('#nomb_refaccion').selectpicker('refresh');
			 $('#proveedor').selectpicker('refresh');
			 document.getElementById("proveedor_email").value = "";
			 document.getElementById("fecha_promesa").value = "";
			 $('#dt-Refacciones').DataTable().ajax.reload();
	}


	function MostrarSelectProveedor(sel){
	 var idprov=sel.value;
					$.ajax({
						type: 'get',
						url: '/orden-servicio-generada/'+idprov+'/provedor',
						success: function(data) {
								 $("#proveedor_email").val(data[0].email);
						 }});
      	}



				function getselectrefaciones() {
					var x =document.getElementById("selnombreref").getElementsByClassName("bs-searchbox")[0];
			     var insert=x.childNodes[0].value;
				  var obj = { name: insert, taller: 0};
					$.ajax({
				      type: 'POST',
				      url: '/Presupuesto/Agregar/NuevoConcepto',
				      data: obj,
				      success: function(data) {
				          $('#nomb_refaccion').append('<option value="'+data+'" selected>'+insert+'</option>');
				          $('#nomb_refaccion').selectpicker('refresh');
				      }
				  });
					document.getElementById('inputnombreref').value="";
					$('#divinputnombreref').hide();
					$('#selnombreref').show();
				}

	function borrarref(id) {
    $idrefcan=id;
		$.ajax({
			type: 'get',
			url: '/orden-servicio-generada/'+id+'/EliminarRefaccion',
			success: function(data) {
				console.log(data);
        	$('#dt-Refacciones').DataTable().ajax.reload();
			 }});

		 $('#proveedor').selectpicker('refresh');
		 $('#nomb_refaccion').selectpicker('refresh');
		}

		function Cancelarref(id){
    document.getElementById('refaccionidcancelar').value=id;
     $('#modalrefaccionesCancelar').modal('show');
		}
    function cancelarRefPost(){
      var id=document.getElementById('refaccionidcancelar').value
      var estatus=document.getElementById('motivocancelacionid').value;
      if (estatus<1) {
       alert("seleccione motivo de cancelacion");
      }
   else {
     obj = {idrefaccion: id , idestatus: estatus};
     $.ajax({
       type: 'post',
       url: '/orden-servicio-generada/CancelarRefaccion/',
       data: obj,
       success: function(data) {
         console.log(data);
          $('#dt-Refacciones').DataTable().ajax.reload();
          $('#modalrefaccionesCancelar').modal('hide');

        }});
      $('#proveedor').selectpicker('refresh');
      $('#nomb_refaccion').selectpicker('refresh');

    }
  }


 function editarref(id){
	$.ajax({
		type: 'get',
		url: '/orden-servicio-generada/'+id+'/refaccion',
		success: function(data) {
			var idref=data.gos_os_refaccion_id;
		$("#gos_os_refaccion_id").val(data.gos_os_refaccion_id);
		document.getElementById("gos_os_refaccion_id").value=idref;
		$("#nomb_refaccion").val(data.nombre).change();
		if(data.proveedor!=null){	$("#proveedor").val(data.proveedor).change();}
    var fs=data.fecha_solicitud;
    var fp=data.fecha_promesa;
    var res1 = fs.split(" ");
    var res2 = fp.split(" ");
		$("#fecha_solicitud").val(res1[0]);
	  $("#fecha_promesa").val(res2[0]);
    $('#dt-Refacciones').DataTable().ajax.reload();
		 }});
 }

 function GuardarRefacciones(){
  Mid=document.getElementById("gos_os_id").value;
	 var Request = $('#dtreffrom').serialize();
	 $.ajax({
			 type: 'POST',
			 url: '/orden-servicio-generada/'+Mid+'/guardar',
			 data: Request,
			 success: function(data) {
         	 $('#dt-Refacciones').DataTable().ajax.reload();
			 }
	 });
   $('#modal-refaccionesOS').modal('hide');
 }

function UpdateFecha(id,typo){
   var Request="";
   $.ajax({
			 type: 'get',
			 url: '/orden-servicio-generada/'+id+'/'+typo+'/fecha',
			 data: Request,
			 success: function(data) {
          $('#dt-Refacciones').DataTable().ajax.reload();
			 }
	 });
}


$('#modal-refaccionesOS').on('hide.bs.modal', function (e) {
  $("#nomb_refaccion").val(0);
  $("#proveedor").val(0);
  $('#nomb_refaccion').selectpicker('refresh');
  $('#proveedor').selectpicker('refresh');
  document.getElementById("proveedor_email").value = "";
  document.getElementById("fecha_promesa").value = "";
  $('#dt-Refacciones').DataTable().ajax.reload();
  });

var refid=0;
function AsignadProvRef(id){
	$('#dropdwnaddprovref').hide();  $('#asignarporvrefdiv').show();  $('#btnsaveprovref').show();
$('#modalrefaccionesProvedor').modal('show');
refid=id;
document.getElementById('gos_os_refaccion_id2').value=refid;
}

function AsignarProvRefac(){
 var val=0;
 var Provedor=document.getElementById('selectprovedorrefac').value;
 var fechaprom=document.getElementById('refaprovfp').value;
 if (Provedor==0) {
   alert("Seleccione Provedor");
  val=1;
 }
 if(fechaprom==""){
    alert("Ingrese Fecha Promesa");
    val=1;
 }
  if(val==0){
  console.log("entro");
  var  Request={ idrefacion:refid ,idprov:Provedor,fechaprom:fechaprom };
    $.ajax({
        type: 'POST',
        url: '/orden-servicio-gen/Proveedores/refaccion',
        data: Request,
        success: function(data) {
            console.log(data);
            $('#dt-Refacciones').DataTable().ajax.reload();
            $('#modalrefaccionesProvedor').modal('hide');
        }
    });

  }

}
function dropdwnagregarprovref(val){
	if(val==0){ $('#dropdwnaddprovref').hide();  $('#asignarporvrefdiv').show();  $('#btnsaveprovref').show();}

	if(val==1){ $('#dropdwnaddprovref').show(); $('#asignarporvrefdiv').hide();  $('#btnsaveprovref').hide(); }
}

function AgregarProvyasignarref(){
  var cadmsn="Inserte: \n"; var val=0;
	var nombre=document.getElementById('nombreprov').value;
	var contactoprov=document.getElementById('contactoprov').value;
	var telprov=document.getElementById('telprov').value;
	var mailprov=document.getElementById('mailprov').value;
	var fpprov=document.getElementById('fpprov').value;
  if (nombre=="") {cadmsn=cadmsn+"- Nombre "; val=1;}
	if (contactoprov=="") {cadmsn=cadmsn+"- Contacto"; val=1;}
	if (telprov=="") {cadmsn=cadmsn+"- Telefono"; val=1;}
	if (mailprov=="") {cadmsn=cadmsn+"- Mail"; val=1;}
	if (fpprov=="") {cadmsn=cadmsn+"- FechaPromesa "; val=1;}
	//validations
  if (val==1) {
  alert(cadmsn);
  }
  else{
		var Request = $('#formnuevoprovasignar').serialize();
		$.ajax({
				type: 'POST',
				url: '/orden-servicio-gen/AgregarProvedorAsig/refaccion',
				data: Request,
				success: function(data) {
						console.log(data);
						refreshprov();
				}
		});


	}
}
function refreshprov(){
	$.ajax({
		type: 'get',
		url: '/orden-servicio-gen/Proveedores',
		success: function(data) {
		dataProvedores=data;
		$('#modalrefaccionesProvedor').modal('hide');
		$('#dt-Refacciones').DataTable().ajax.reload();
		}});
}

function Rechazarref(id){
  var Request="";
  $.ajax({
      type: 'get',
      url: '/orden-servicio-gen/rechasada/'+id+'/refaccion',
      data: Request,
      success: function(data) {
         $('#dt-Refacciones').DataTable().ajax.reload();
      }
  });
}

function NOautoref(id){
  var Request="";
  $.ajax({
      type: 'get',
      url: '/orden-servicio-gen/noauorizada/'+id+'/refaccion',
      data: Request,
      success: function(data) {
         $('#dt-Refacciones').DataTable().ajax.reload();
      }
  });
}
function atorizarallrefac(osid){
  var Request="";
  $.ajax({
      type: 'get',
      url: '/orden-servicio-gen/AutorizarRef/'+osid+'/refacciones',
      data: Request,
      success: function(data) {
         console.log(data);
         $('#dt-Refacciones').DataTable().ajax.reload();
      }
  });
}

function entregarallrefac(osid){
	var Request="";
  $.ajax({
      type: 'get',
      url: '/orden-servicio-gen/EntrgarRef/'+osid+'/refacciones',
      data: Request,
      success: function(data) {
         console.log(data);
         $('#dt-Refacciones').DataTable().ajax.reload();
      }
  });
}
function portalallrefac(osid){
	var Request="";
  $.ajax({
      type: 'get',
      url: '/orden-servicio-gen/FPortarlRef/'+osid+'/refacciones',
      data: Request,
      success: function(data) {
         console.log(data);
         $('#dt-Refacciones').DataTable().ajax.reload();
      }
  });
}


function displaycomentariosrefacciones()
{
  $('#dropdown-comentarios').show();
	  $('#ddownhismensajes').hide();
}

function displaycomentariosrefaccioneshistorial()
{
  $('#ddownhismensajes').show();
	  $('#dropdown-comentarios').hide();
}

function changeproveedormensaje(){
	 $( "#appendpiezasrefacciones" ).empty();
	  osid=document.getElementById("gos_os_id").value;
   	var selectedValues = $('#cmprovedor').val();
		if (selectedValues>0) {
			 $('#cmeestatus').attr('disabled', 'disabled');
		}
		$.ajax({
				type: 'get',
				url: '/orden-servicio-generada/'+osid+'/provedores/'+selectedValues+'/piezas',
				success: function(data) {
					$( "#appendpiezasrefacciones" ).append('<label>'+data.provedores+'</label><h6>Piezas:</h6><label>En Proceso :'+data.enrpos+'</label><br><label>Vencidas :'+data.venc+' </label><br><label>Recibidas : '+data.entreg+'</label>');
				}
		});
		if (selectedValues=="") {

				$('#cmeestatus').removeAttr('disabled');
		}
}

function changeestatusmensaje(){
	$( "#appendpiezasrefacciones" ).empty();
	osid=document.getElementById("gos_os_id").value;
	var selectedValues = $('#cmeestatus').val();
	if (selectedValues>0) {
		 $('#cmprovedor').attr('disabled', 'disabled');
		 $.ajax({
				 type: 'get',
				 url: '/orden-servicio-generada/'+osid+'/estatus/'+selectedValues+'/piezas',
				 success: function(data) {
					 console.log(data);
					 $( "#appendpiezasrefacciones" ).append(data);
				 }
		 });
	   }
	else{
		$('#cmprovedor').removeAttr('disabled', 'disabled');
	 }
 }
