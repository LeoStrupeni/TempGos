$( document ).ready(function() {
  $('#table').DataTable({
    dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
    "iDisplayLength": 50,
    responsive : true,
    	processing : true,
    	ordering: false,
          searching: true,
    	paging: true,
    rowReorder: {
      update: false
    },
    language : {"url" : "/gos/Spanish.json"}
    });
});

function Adjudicarexpediente(id){

//clean fields
document.getElementById('nombre-contratante').value="";
document.getElementById('apellidos-contratante').value="";
document.getElementById('nombre').value="";
document.getElementById('apellidos').value="";
document.getElementById('celular').value="";
document.getElementById('email_cliente').value="";
document.getElementById('economico').value="";
//clean fields end
$('#adjudicar-orden').modal('show');

 var modelo=document.getElementById('modelo'+id);
 var placa=document.getElementById('placa'+id);
 var serie=document.getElementById('serie'+id);
 modelo=modelo.innerHTML;
 placa=placa.innerHTML;
 serie=serie.innerHTML;
 document.getElementById('wsreporteid').value=id;
 document.getElementById('anio_vehiculo').value=modelo;
 document.getElementById('placa').value=placa;
 document.getElementById('nro_serie').value=serie;
}

function cambiocheck() {
    var z = document.getElementById("pasar-datos-check").value ;
    //  console.log(z);
    if(z==0){
        // console.log("Print");
    var x = document.getElementById("nombre-contratante").value;
    var y = document.getElementById("apellidos-contratante").value;
    document.getElementById('nombre').value = x;
    document.getElementById('apellidos').value = y;
    document.getElementById("pasar-datos-check").value =1;
    }
    if(z==1){
    // console.log("clean");
    document.getElementById('nombre').value = "";
    document.getElementById('apellidos').value = "";
    document.getElementById("pasar-datos-check").value=0;
    }
}

$("#gos_vehiculo_marca_id").on('change',function(){
  var id = $(this).val();
    console.log(id);
  $('#gos_vehiculo_modelo_id').empty();
  $.ajax({
    url : '/gestion-vehiculos-modelo/'+id,

    type: 'get',
    dataType: 'json',
    success: function(response){

      var len = 0;
      if(response['data'] != null){
      len = response['data'].length;
      }
      if(len > 0){
      var optionBlank = '<option></option>';
      $("#gos_vehiculo_modelo_id").append(optionBlank);
      // Read data and create <option >
      for(var i=0; i<len; i++){

          var id = response['data'][i].gos_vehiculo_modelo_id;
        var name = response['data'][i].modelo_vehiculo;

          var option = "<option value='"+id+"'>"+name+"</option>";
        $("#gos_vehiculo_modelo_id").append(option);
        $("#gos_vehiculo_modelo_id").selectpicker("refresh");
      }
      }

    }
  });
});
