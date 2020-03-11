<!DOCTYPE html>

<html lang="en" >
<!-- begin::Head -->
@include('Layout/head')

<head>
    <meta charset="utf-8"/>
    <title>Encuesta</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!--begin::Page Custom Styles(used by this page) -->
    <link href="../assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../gos/css/login.css">
<style>
    input.form-check-input/*checkbox class name*/ {
    width :1.25rem ;
    height :1.25rem ;
    }
    .form-group label {
      
    font-size: 1.25rem;
    font-weight: 400;
    }
    .wrapper {
    position: relative;
    margin: 10px auto;
    width: 100% !important;
    height: 300px !important;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }
    @media screen and (max-width: 1220px) {
      input.form-check-input/*checkbox class name*/ {
      width :2rem ;
      height :2rem ;
      }
      .form-group label {
      font-size: 2rem;
      font-weight: 400;
      }
      #canvas {

          background-size: 60% !important;
      }   
      canvas#canvasFirmaCliente {
        height: 100%!important;
      }
        
    }
    @media screen and (max-width: 764px) {
      input.form-check-input/*checkbox class name*/ {
      width :2rem ;
      height :2rem ;
      }
      .form-group label {
      font-size: 2rem;
      font-weight: 400;
      }
      #canvas {

          background-size: 60% !important;
      }   
      canvas#canvasFirmaCliente {
        height: 100%!important;
      }
         
    }
    @media screen and (max-width: 630px) {
      input.form-check-input/*checkbox class name*/ {
      width :2rem ;
      height :2rem ;
      }
      .form-group label {
      font-size: 2rem;
      font-weight: 400;
      }
      #canvas {

          background-size: 60% !important;
      }   
      canvas#canvasFirmaCliente {
        height: 100%!important;
      }
     
    }
    
    @media screen and (max-width: 1040px) {
      input.form-check-input/*checkbox class name*/ {
      width :2rem ;
      height :2rem ;
      }
      .form-group label {
      font-size: 2rem;
      font-weight: 400;
      }
      #canvas {
          background-size: 40% !important;
      }        
      canvas#canvasFirmaCliente {
        height: 100%!important;
      }  
        
    }
</style>
  
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >
<img  src="../img/logo.png" id="icon" alt="User Icon" style="width: 9rem;align-self: center;"/>

  <div class="col-12 col-md-6 offset-md-3">
    <div id="">            
      <div class="col-lg-12">
        <div class="kt-portlet">
          <div class="kt-portlet__head">

          <div class="table-responsive p-1">
								<table class="table table-sm table-hover" id="OS_DataTable_Encuesta">
									<thead class="thead-light">
										<tr>
											<th style="text-align:center;">#Órden</th>
                      <th>Fecha</th>
											<th>Cliente</th>                      
											<th>Vehículo</th>
                      <th>Aseguradora</th>
											
										</tr>
									</thead>
									<tbody>
								
										<tr>
											<td style="text-align:center;vertical-align: middle;">#{{$numorden}}</td>
                      <td>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Apertura de la orden">
                      <i class="fas fa-circle" style="color: #339af0;"></i>
                      Apertura de la orden: {{$OSProceso[0]->fecha_creacion_os }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Ingreso a reparacion">
                      <i class="fas fa-caret-square-right" style="color: green;"></i>
                      Ingreso a reparacion: {{ $OSProceso[0]->fecha_ingreso_v_os ?? '' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Fecha promesa">
                      <i class="fas fa-square" style="color: yellow;"></i> 
                      Fecha promesa: {{($OSProceso[0]->fecha_promesa_os == 0) ? '':$OSProceso[0]->fecha_promesa_os }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Fecha terminado">
                      <i class="fas fa-circle" style="color: #339af0;"></i> 
                      Fecha terminado: {{$OSProceso[0]->fecha_terminado ?? '' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Fecha entregado">
                      <i class="fas fa-caret-square-left" style="color: red;"></i> 
                      Fecha entregado: {{$OSProceso[0]->fecha_entregado ?? '' }}
                      </p>
                      <!-- <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Fecha facturado">
                      <i class="fas fa-circle" style="color: #339af0;"></i> 
                      Fecha facturado: {{$OSProceso[0]->fecha_facturado ?? '' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                      data-placement="top" data-content="Fecha de pago">
                      <i class="fas fa-circle" style="color: #339af0;"></i> 
                      Fecha de pago: {{$OSProceso[0]->fecha_pago ?? '' }}
                      </p> -->
                      </td>
                      <?php $cl=explode("|", $OSProceso[0]->nomb_cliente);?>
								      <td style="vertical-align: middle;"> {{$cl[0]}} <br>{{$cl[1]}} <br>{{$cl[2]}}</td>
											<?php $vhc=explode("|", $OSProceso[0]->detallesVehiculo);?>
											<td style="vertical-align: middle;"> <i class="fas fa-circle ml-5"style="background-color:#{{$vhc[0]}} ; color: #{{$vhc[0]}};font-size: medium;border: 1px solid black;border-radius: 100%;"></i><br>{{$vhc[1]}}<br>{{$vhc[2]}}<br>{{$vhc[3]}}<br>{{$vhc[4]}} </td>
											<?php $asg=explode("|", $OSProceso[0]->nomb_aseguradora_min);?>
											<td style="vertical-align: middle;">{{$asg[0]}}<br>{{$asg[1]}}{{$asg[2]}}<br>{{$asg[3]}}<br>{{$asg[4] ?? 'f'}}</td>
										
										</tr>
								
									</tbody>
								</table>
							</div>
                    {{--<div class="kt-portlet__head-label">
                      <h3 class="kt-portlet__head-title" id="TitleOrden"><label style="font-weight: bold;" for="">Nombre de Encuesta: </label> @isset($encuesta){{$encuesta->nombre_encuesta}} @endisset<br><label style="font-weight: bold;" for="">Descripción: </label> {{$encuesta->descripcion}} </h3>
                    

                    </div>
                    <div class="kt-portlet__head-toolbar">
                      <div class="kt-portlet__head-actions">
                        <h5 class="kt-portlet__head-title" id="TitleOrden" style="text-align: right; color: #48465b;"> @if(isset($detaseg)){{$detaseg->empresa}} @endif<label style="font-weight: bold;" for="">:Aseguradora</label> <br>  {{$encuesta->fecha}} <label style="font-weight: bold;" for="">:Fecha de creación</label></h5>             
                      </div>
                    </div>--}}
          </div>  
          <div class="kt-portlet__body">
            <div class="kt-infobox">
                
              <form id="encuestaOs-form"  action="/Orden-terminada/Encuesta/respuestaEncuesta" method="post" >
              @CSRF
                    <!-- Preguntas encuesta -->       
                <div id="Preguntas-encuesta"  style=" display: none; " >
                  @if(isset($preguntasenc))
                    @foreach($preguntasenc as $preg)
                    <div style="border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%; padding-bottom:4%;" class="form-group">
                      <label style="font-style: bold"; for="exampleInputEmail1">{{$preg->pregunta}}</label>
                                        
                      <?php if ($preg->gos_encuesta_item_id==$preg->gos_encuesta_item_id): 
                            $gos_encuesta_item_id=$preg->gos_encuesta_item_id;
                            $respuestasenc = DB::select( DB::raw('SELECT *
                            FROM gos_v_encuestas
                            WHERE gos_encuesta_item_id = '.$gos_encuesta_item_id.'')); ?>
                          @foreach($respuestasenc as $resenc)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox"  name="check[]" value="{{$resenc->gos_encuesta_respuestas_id}}" id="exampleRadios1"  >
                          <label class="form-check-label pl-4" for="exampleRadios1">
                     
                          {{$resenc->tipo_respuestas}}
                          </label>
                        </div>
                        @endforeach
                      <?php endif; ?>

                    </div>                
                    @endforeach
                    @endif
                </div>
                <!-- end encuesta -->
                 <!-- Comentarios -->                          
                  <div id="Comentarios-encuesta" style=" display: none; border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%; padding-bottom:4%;" class="form-group" >
                      
                      <div class="container-fluid">
                                                             
                          <strong><label for="">Comentario</label></strong><br>
                          <textarea name="comentario_encuesta" id="comentario_encuesta" rows="3" style="width:100%"></textarea>
                      </div>
                  </div>                                
                <!--  Firma del Cliente  -->
                <div id="contestar-encuesta" style=" display: none; "  class="form-group">
                  <strong><label for="" class="d-flex justify-content-center">Firma Cliente</label></strong><br>
                    <div style=" margin-bottom: 5%;"class="wrapper d-flex justify-align-center">
                      <canvas id="canvasFirmaCliente" class="signature-pad" width="270" height="300"></canvas>
                                                      
                    </div>
                    <div class="pb-5" style="text-align:center">                                               
                      <button class="btn btn-primary" type="button" id="borrarFirmaCliente">Limpiar</button>
                    </div>
                    <input type="hidden" name="canvas" id="canvas" value=""> 

                  <button style="margin:; width: 100%;"type="button" id="guardar-firma" class="btn btn-primary">Guardar Firma</button>
                  <button class="btn btn-success" id="enviar-encuestaOs" type="submit" style="display: none; width: 100%;">Enviar Encuesta</button>
                </div>
                <input id="gos_os_id" name="gos_os_id" type="hidden" value="{{$gos_os_id}}">
                <input id="gos_aseguradora_id" name="gos_aseguradora_id" type="hidden" value="{{$gos_aseguradora_id}}">
                <input id="gos_encuesta_id" name="gos_encuesta_id" type="hidden" value="{{$encuesta->gos_encuesta_id}}">

               
                <div class="row d-flex justify-content-center" id="botones-encuesta"  >
                    <div class=" form-group m-2" style="text-align:center">                                               
                      <button class="btn btn-primary" type="button" id="contestar"   onclick="displayencuesta()">Contestar Encuesta</button>
                      <input id="contesto" name="contesto" type="hidden" value="">
                    </div>
                    <div class=" form-group m-2" style="text-align:center">                                               
                      <button class="btn btn-primary" type="button" id="nocontestar" name="nocontestar" value="0" onclick="displayendenc()">No contestar Encuesta</button>
                    </div>
                </div>
               
              </form>    
                
            </div>
          </div>
        </div>          
      </div>
  </div>
  <script src="{{env('APP_URL')}}/assets/plugins/general/jquery/dist/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
  <script>
  
    var canvasFirmaCliente = new SignaturePad(document.getElementById('canvasFirmaCliente'));
    // capturo la etiqueta imagen
    var imgFirmaCliente = document.getElementById('imgFirmaCliente');
    // clic en borrar
    document.getElementById('borrarFirmaCliente').addEventListener('click', function() {
      canvasFirmaCliente.clear();
    });

    function displayencuesta(){ 
    
      $('#Preguntas-encuesta').show();
      $('#contestar-encuesta').show();
      $('#Comentarios-encuesta').show();
      document.getElementById("botones-encuesta").style.visibility = "collapse";
      $('#contesto').val(1);
    }
    function displayendenc(){
    
      $('#Preguntas-encuesta').hide();
      $('#contestar-encuesta').show();
      $('#Comentarios-encuesta').show();
      document.getElementById("botones-encuesta").style.visibility = "collapse";
      $('#contesto').val(0);
    }
    
 

    $('#guardar-firma').click(function() {
      var idos=document.getElementById("gos_os_id").value;
      var canvasCL = document.getElementById("canvasFirmaCliente");
      var ctxCL=canvasCL.getContext("2d");
      var urlCL = canvasCL.toDataURL();
      var newImgCL = document.createElement("img");
      newImgCL.src = urlCL;
    
      var req = urlCL+idos;
      $('#canvas').val(req);
      // console.log($('#canvas').val());
      document.getElementById("enviar-encuestaOs").style.display = "inline";
      document.getElementById("guardar-firma").style.display = "none";

    });





  </script>

	


</body>
</html>
