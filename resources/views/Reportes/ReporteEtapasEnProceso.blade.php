@extends('Layout')

@section('Content')
<div class="kt-portlet kt-portlet--mobile" style="margin-botton:0 !important;">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
    Reporte de etapas en Proceso
        </h3>
      </div>
    </div>

    <div class="container-fluid">
                           @if (session('notification'))
                           <div class="alert alert-success">
                            {{session('notification')}}
                            </div> @endif

                            @if (count($errors)>0)
              <div class="alert alert-danger">
                <ul>
                  <?php foreach ($errors->all() as $error): ?>
                    <li>
                      {{ $error }}
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
           </div>
           @endif

    	<div class="col">
        <form class="" action="/ReporteEtapasEnProceso/filtrar" method="post">
          @csrf
          <div class="form-row">
            <div class="form-group col-6 col-sm-2">
							<label>Aseguradora</label>
							<select class="form-control kt-selectpicker"  name="aseguradora_id" id="aseguradora_id">
								<option value=""></option>
                @foreach($listaAseguradoras as $aseg)
                <option value="{{$aseg->gos_aseguradora_id}}" <?php if ($asegg == $aseg->gos_aseguradora_id ): ?>selected<?php endif; ?>>{{$aseg->empresa }}</option>
                @endforeach

							</select>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>


            <div class="form-group col-6 col-sm-2">
							<label>Tipo de orden</label>
							<select class="form-control kt-selectpicker"  name="tipo_orden" id="tipo_orden">
								<option value=""></option>
                @foreach($listaTipoOrden as $lto)
                <option value="{{$lto->gos_os_tipo_o_id}}"<?php if ($tord == $lto->gos_os_tipo_o_id ): ?>selected<?php endif; ?>>{{$lto->tipo_orden}}</option>
                @endforeach

							</select>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>


            <div class="form-group col-6 col-sm-2">
							<label>Tipo de daño</label>
							<select class="form-control kt-selectpicker"  name="tipo_dano" id="tipo_dano">
								<option value=""></option>
                @foreach($listaDanios as $ld)
                <option value="{{$ld->gos_os_tipo_danio_id}}"<?php if ($tdanio == $ld->gos_os_tipo_danio_id ): ?>selected<?php endif; ?>>{{$ld->tipo_danio}}</option>
                @endforeach
							</select>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>


            <div class="form-group col-6 col-sm-2">
							<label>Etapas</label>
							<select class="form-control kt-selectpicker"  name="etapas" id="etapas">
								<option value=""></option>
                @foreach($listaEtapas as $le)
                <!-- <option value="{{$le->gos_paq_etapa_id}}">{{$le->nomb_etapa}}</option> -->
                <option value="{{$le->nomb_etapa}}"<?php if ($et == $le->nomb_etapa ): ?>selected<?php endif; ?>>{{$le->nomb_etapa}}</option>
                @endforeach

							</select>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>

            <div class="form-group col-6 col-sm-2">
							<label>Filtrar</label>
							  <button type="submit" class="btn btn-primary btn-block mb-3">Ver</button>
							<small style="font-style: italic;" class="tipo_venta form-text text-danger"></small>
						</div>

          </div>


        </form>
      </div>

    <div id="chart">
      <div id="donut-example"></div>
    </div>

    <div class="kt-portlet__body">
        <div class="row">

            <div class="col-sm-12 col-lg-12 px-1">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="fechaPromesa" role="tabpanel">


                        <div class="table-responsive">
                            <table class="table table-sm table-hover nowrap" id="etapas">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="align-middle text-center">Etapa</th>
                                        <th class="align-middle text-center">activas</th>
                                        <th class="align-middle text-center">por activar</th>
                                        <th class="align-middle text-center">terminadas</th>
                                        <th class="align-middle text-center">total</th>
                                        <th class="align-middle text-center">Avance</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($listaAsegurados as $tabla)
                            <?php
                                if($tabla->countF == 0){

                                    $total = 0;
                                }
                                else{
                                    $div = $tabla->countNA+$tabla->countA+$tabla->countF;
                                    $total = $tabla->countF*100/$div;

                                }

                                ?>

                                    <tr>
                                        <td class="align-middle text-center">
                                        {{$tabla->nombre}}
                                        </td>
                                        <td class="align-middle text-center">
                                        <button class="col-2 btn btn-primary  btn-sm" style="" id="btnOs" data-id="{{$tabla->nombre}}"> {{$tabla->countA}}</button>

                                        </td>

                                        <td class="align-middle text-center">{{$tabla->countNA}}
                                        </td>
                                        <td class="align-middle text-center">{{$tabla->countF}}
                                        </td>
                                        <td class="align-middle text-center">{{$tabla->countNA+$tabla->countA+$tabla->countF}}</td>
                                        <?php if (round($total)==0): ?> <td class="align-middle text-center"><div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar"
                                            style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round($total)}}%</div></div></td>
                                        <?php elseif(round($total)>=100): ?><td class="align-middle text-center"><div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar"
                                            style="background-color: green; width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round($total)}}%</div></div></td>
                                        <?php else: ?><td class="align-middle text-center"><div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar"
                                        style="background-color: rgb(39, 57, 92);width: {{ round($total)}}%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round($total)}}%</div></div></td>
                                        <?php endif; ?>


                                    </tr>
                            @endforeach
                            </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="Citas" role="tabpanel" aria-labelledby="profile-tab">
                        <h2>Citas</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
                    </div>
                    <div class="tab-pane fade" id="Recordatorios" role="tabpanel" aria-labelledby="contact-tab">
                        <h2>Recordatorios</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-os-clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ordenes en Proceso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="kt-portlet kt-portlet--mobile">
                    <input type="hidden" name="gos_cliente_os_id" id="gos_cliente_os_id" >
                        <div class="kt-portlet__body">
                            <div class="table-responsive">
                            <input type="hidden" id="app_url" name="app_url" url=".."/>
                                <div class="table-responsive table-sm p-1" >
                                    <table class="table table-sm table-hover nowrap" id="dt-ordenes-servicios" style="font-size: 1rem;">
                                        <thead class="thead-light">
                                            <tr style="font-weight: 500;">
                                                <th>ID</th>
                                                <th>Orden</th>
                                                <th>Fecha</th>
                                                <th>Días</th>
                                                <th>Cliente</th>
                                                <th><?php if ($taller_conf_ase->nomb_campo_ase!=null): ?>{{$taller_conf_ase->nomb_campo_ase ??''}}<?php else: ?>Aseguradora<?php endif; ?></th>
                                                <th><?php if ($taller_conf_vehiculo->nomb_modulo_camp_vehiculo!=null): ?>{{$taller_conf_vehiculo->nomb_modulo_camp_vehiculo ??''}}<?php else: ?>Vehiculo<?php endif; ?></th>
                                                <th>Estatus</th>
                                                <th>Asesor</th>
                                                <th>Total</th>
                                                <th>Avance</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                        </div>
                    </div>

                        </div>

                    </div>
                </div>
            </div>
            </div>

    </div>

</div>

    @endsection

@section('ScriptporPagina')
<script>
$(document).ready(function() {

  // var tabla = $('#etapas').DataTable({
  //       responsive : true,
  //       processing : true,
  //       paging: false,
  //   ordering: false
  // });

var js_array =<?php echo json_encode($listaAsegurados );?>;
//console.log(js_array)
var data = js_array;
var arrres =[];
for (var i = 0; i < data.length; i++) {
if(data[i].countA >0)
arrres.push({label: data[i].nombre,value:data[i].countA})
}
  Morris.Donut({
    element: 'donut-example',
    data:arrres
  });
/*
  $( "#aseguradora_id" ).change(function() {
    var id = $(this).children(":selected").attr("value");

//aseguradora(id);


});

$( "#tipo_dano" ).change(function() {
  var id = $(this).children(":selected").attr("value");

//danio(id);
});


$( "#tipo_orden" ).change(function() {
  var id = $(this).children(":selected").attr("value");

//orden(id);
});

$( "#etapas" ).change(function() {
  var id = $(this).children(":selected").attr("value");

//etapas(id);
});
*/

});

function aseguradora(id){

  $.ajax({contenttype : 'application/json; charset=utf-8',

      url : '/ReporteEtapasEnProceso/aseguradora/'+id,
      type : 'GET',
      //dataType : 'json',
      done : function(response) {console.log(response);},
      error : function(jqXHR,textStatus,errorThrown,data) {

        if (console && console.log) {
          console.log('La solicitud a fallado: '+ textStatus);
          console.log('La solicitud a fallado: '+ errorThrown);
        }
      },
      success : function(data) {
      //  console.log(data.length);

        	var arrres =[];
        for (var i = 0; i < data.length; i++) {
          if(data[i].countA >0)
        	arrres.push({label: data[i].nombre,value:data[i].countA})
        }
        $('#chart').empty();
        $('#chart').append("<div id='donut-example'></div>");

        var js_array = data;
        Morris.Donut({
          element: 'donut-example',
          data: arrres
        });


      }
    }); //ajax
};

function danio(id){

  $.ajax({contenttype : 'application/json; charset=utf-8',

      url : '/ReporteEtapasEnProceso/danio/'+id,
      type : 'GET',
      //dataType : 'json',
      done : function(response) {console.log(response);},
      error : function(jqXHR,textStatus,errorThrown,data) {

        if (console && console.log) {
          console.log('La solicitud a fallado: '+ textStatus);
          console.log('La solicitud a fallado: '+ errorThrown);
        }
      },
      success : function(data) {
      //  console.log(data.length);

        	var arrres =[];
        for (var i = 0; i < data.length; i++) {
          if(data[i].countA >0)
        	arrres.push({label: data[i].nombre,value:data[i].countA})
        }
        $('#chart').empty();
        $('#chart').append("<div id='donut-example'></div>");

        var js_array = data;
        Morris.Donut({
          element: 'donut-example',
          data: arrres
        });


      }
    }); //ajax
};


function orden(id){

  $.ajax({contenttype : 'application/json; charset=utf-8',

      url : '/ReporteEtapasEnProceso/orden/'+id,
      type : 'GET',
      //dataType : 'json',
      done : function(response) {console.log(response);},
      error : function(jqXHR,textStatus,errorThrown,data) {

        if (console && console.log) {
          console.log('La solicitud a fallado: '+ textStatus);
          console.log('La solicitud a fallado: '+ errorThrown);
        }
      },
      success : function(data) {
      //  console.log(data.length);

        	var arrres =[];
        for (var i = 0; i < data.length; i++) {
          if(data[i].countA >0)
        	arrres.push({label: data[i].nombre,value:data[i].countA})
        }
        $('#chart').empty();
        $('#chart').append("<div id='donut-example'></div>");

        var js_array = data;
        Morris.Donut({
          element: 'donut-example',
          data: arrres
        });


      }
    }); //ajax
};

function etapas(id){

  $.ajax({contenttype : 'application/json; charset=utf-8',

      url : '/ReporteEtapasEnProceso/etapas/'+id,
      type : 'GET',
      //dataType : 'json',
      done : function(response) {console.log(response);},
      error : function(jqXHR,textStatus,errorThrown,data) {

        if (console && console.log) {
          console.log('La solicitud a fallado: '+ textStatus);
          console.log('La solicitud a fallado: '+ errorThrown);
        }
      },
      success : function(data) {
      //  console.log(data.length);

        	var arrres =[];
        for (var i = 0; i < data.length; i++) {
          if(data[i].countA >0)
        	arrres.push({label: data[i].nombre,value:data[i].countA})
        }
        $('#chart').empty();
        $('#chart').append("<div id='donut-example'></div>");

        var js_array = data;
        Morris.Donut({
          element: 'donut-example',
          data: arrres
        });


      }
    }); //ajax
};


</script>
<script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporte-etapas-proceso.js"></script>

@endsection
