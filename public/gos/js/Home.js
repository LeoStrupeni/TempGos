$( document ).ready(function() {

});
function dtservtec(usrname,serid) {
document.getElementById('labeltecnicoser').innerHTML = usrname;
$('#serv_tecnico').modal('show');
var tabla = $('#ordenesActivasPorTecnico').DataTable();
tabla.clear().destroy();
$('#ordenesActivasPorTecnico').DataTable({
    dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
    responsive : true,
    processing : true,
    ajax : '/ordenes-servicio-tecnivo/'+usrname+'/'+serid+'/servicio',
    columns : [{data : 'gos_os_id',name : 'id', visible:false},
    {data : 'nro_orden_interno',name : 'id', render: function(data, type,meta){
                var id = meta.gos_os_id

                return '<a href="/orden-servicio-generada/'+ id +'"> # '+data+'</a>';
                }}, // #ORDEN
                {data : 'fecha_fin_etapa', render: function(data, type, row){
                    data.split('|');
                    var x = data.split('|');
                if(x[0] == 0){ x[0] = 'Fecha Inicio Etapa';}
                if(x[1] == "0000-00-00 00:00:00"){ x[1] = 'Fecha Meta Etapa';}
                if(x[2] == "0000-00-00 00:00:00"){ x[2] = 'Fecha promesa';}

                $(function () {
                    $('[data-toggle="popover"]').popover();
                  })
                  return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Inicio Etapa"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
                    '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Meta Etapa"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
                    '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';
                }}, // FECHA

                {data : 'nomb_cliente', render: function(data, type, row){
                    return data.split('|').join( '<br>');
                }
                },


                { data: 'detallesVehiculo', render: function(data, type, row){
                    data.split('|').join( '<br>');
                    var color = data.split('|');
                    var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                    return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                },
                {data : 'tiempo', render: function(data, type, row){
                    console.log(data);
                    if (data == 1){
                    return '<i class="fas fa-circle" style="color: #32B89D ;"></i>'+'  Etapa';
                    }
                    else{return '<i class="fas fa-circle" style="color:red ;"></i>'+'  Etapa';}
                }
                }, // TIEMPO
                {data : 'tecnico_nueva'}, // ASESOR

                {data : 'porcentaje', render: function(data, type, meta){
                    var e = Math.round(data);
                    var FT = meta.fecha_terminado;
                    var FE = meta.fecha_entregado;
                    // return ("$"+data.tbl_pexpenses.cost*data.tbl_pexpenses.quantity);}
                    if(data== null){
                            return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'0%'+'</div></div>';
                        }

                        else if(FT!==null && FE==null){
                            return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Terminada'+'</div></div>';

                        }
                        else if(FE!==null && FT!==null){
                            return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Entregada'+'</div></div>';

                        }
                        else if(data=="100.0000"){
                            return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Finalizada'+'</div></div>';
                        }
                        else{
                            return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: '+e+'%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+e+'%</div></div>';
                        }


                    }},
            ],
            order : [ [ 0, 'desc' ] ],
    language : {'url' : '/gos/Spanish.json'}
});
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

function getParamsTec(sel){
	var div = document.getElementById("swctec");
	var btn  = document.getElementById("btntec");
	var lbl  = document.getElementById("lbltec");
	$.ajax({
			type: 'Get',
			url: '/orden-servicio-generada/'+sel+'/tecnicoPreferencias',
			data: Request,
			success: function(data) {
					if(data.tipo_comision=="PORCIENTO"){
						 div.style.display = "none";
						 lbl.innerHTML="Porcentaje";
						 btn.innerHTML =  "%";
						 document.getElementById("inputPoPid").value =data.monto_comision;
						 document.getElementById("Sinput").value="%";
					 }
					 if(data.tipo_comision=="PESOS"){
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
		document.getElementById("Cantidadid").value=0;
		document.getElementById("inputPoPid").value=0;
		$("#selectecnico").val(0);
		$('#selectecnico').selectpicker('refresh');
 });

 function myFunction(req) {
    var vic = $("#btntecnico").val();
    if(vic=="Transito"){
        var vico = $("#estatusid").val(vic);
    }
    else{
        var vico = $("#OSitemid").val(req);
    }
  }

function postAsesor(){

        var gositemid = $("#OSitemid").val();
        var d = new Date();var month = d.getMonth()+1; var day = d.getDate(); var hora = d.getHours();var minuto = d.getMinutes();var segundo = d.getSeconds();
        var fecha_actual = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day +" " + (hora<10 ? '0' : '') +hora + ":" + (minuto<10 ? '0' : '') + minuto + ":" + (segundo<10 ? '0' : '') + segundo;

        var arreglo = [gositemid,fecha_actual]
        if($("#btntecnico"+gositemid).val()=="Piso"){
            var Request = $('#formTecnicoServicios').serialize();
                $.ajax({contenttype : 'application/json; charset=utf-8',
                data: Request,
                url : '/finalizar-etapas-dash/'+arreglo,
                type : 'get',
                done : function(response) {console.log(response);},
                error : function(jqXHR,textStatus,textStatus,data) {
                    //
                    printErrorMsg(textStatus);
                    //
                    if (console && console.log) {
                        console.log('La solicitud a fallado: '+ textStatus);
                        console.log('La solicitud a fallado: '+ textStatus);
                        }
                },
                success : function(data) {
                    if(data == 2){
                        console.log(data);
                        alert("Error");
                    }
                    else if(data == 3){
                        alert("Error de orden de etapas.");
                    }
                    window.location.reload();

                }
            });
            $('#modalAsignarAsesor').modal('hide');
            $('#ordenesActivas-DataTable').DataTable().ajax.reload();
        }
        else{
            alert("No se puede agregar un tecnico a una orden en transito.");

        }


 }
