var options='<option value="0">ND</option>';
var options2='<option value="0">ND</option>';
var dataUbicaciones='';
var dataProvedores='';
var Mid=0;
var filtroprov=0;
var filtroest=0;



function desplegarref(osid) {
  var link = document.getElementById("irordenmodal");
  link.setAttribute("href", "orden-servicio-generada/"+osid);

  filtroprov=document.getElementById('filtroPROV').value;
  if(filtroprov<0 ||filtroprov=="" || filtroprov==null ){filtroprov=0;}
  filtroest=document.getElementById('filtroPROVEstatus').value;
  if(filtroest<0 || filtroest=="" || filtroest==null ){filtroest=0;}
  console.log(filtroprov);
  console.log(filtroest);
   var tabla = $('#dt-Refacciones').DataTable();
   tabla.clear().destroy();
 $('#ModalDesgloseRef').modal('show')
 $('#dt-Refacciones').DataTable({
   dom : "<'row'<'col-md-4 col-lg-3'l><'col-md-6'f>>" +
   "<'row'<'col-sm-12'tr>>" +
   "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
   "iDisplayLength": 100,
   responsive : true,
   processing : true,
   ajax : '/ReporteRefacciones/'+osid+'/datatable/Povedor/'+filtroprov+'/estatus/'+filtroest,
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
         {data : 'nro_parte'},
         {data : 'observaciones'},
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
           options='';
           var id = meta.gos_os_refaccion_id;
           for (var i = 0; i < dataUbicaciones.length; i++) {
             if (dataUbicaciones[i].gos_producto_ubicacion_id==data) {
               options=dataUbicaciones[i].nomb_ubicacion;
             }
             else {
               options="ND";
             }
            }
           return  options;
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
}


var refid=0;
function AsignadProvRef(id){
$('#modalrefaccionesProvedor').modal('show');
refid=id;
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
