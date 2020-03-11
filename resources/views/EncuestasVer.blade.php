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
      width: 430px;
      height: 300px;
      }
      .wrapper {
        display: grid;
      flex-direction: column;   
      padding: 20px;
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
      width: 500px!important;
      height: 300px!important;
      }
      .wrapper {
        display: grid;
      flex-direction: column;   
      padding: 20px;
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
      width: 284px!important;
      height: 300px!important;
      }
      .wrapper {
        display: grid;
      flex-direction: column;   
      padding: 20px;
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
      width: 284px;
      height: 300px;
      }  
      .wrapper {
        display: grid;
      flex-direction: column;   
      padding: 20px;
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
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title" id="TitleOrden"><label style="font-weight: bold;" for="">Nombre de Encuesta: </label> @isset($encuesta){{$encuesta->nombre_encuesta}} @endisset<br><label style="font-weight: bold;" for="">Descripción: </label> {{$encuesta->descripcion}} </h3>
             

            </div>
            <div class="kt-portlet__head-toolbar">
              <div class="kt-portlet__head-actions">
                <h5 class="kt-portlet__head-title" id="TitleOrden" style="text-align: right; color: #48465b;"> @if(isset($detaseg)){{$detaseg->empresa}} @endif<label style="font-weight: bold;" for="">:Aseguradora</label> <br>  {{$encuesta->fecha}} <label style="font-weight: bold;" for="">:Fecha de creación</label></h5>             
              </div>
            </div>
          </div>  
          <div class="kt-portlet__body">
            <div class="kt-infobox">
              <form>
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
                      <input class="form-check-input" type="radio" name="{{$preg->gos_encuesta_item_id}}" value="{{$resenc->tipo_respuestas}}"  id="exampleRadios1" >
                      <label class="form-check-label pl-4" for="exampleRadios1">
                      {{$resenc->tipo_respuestas}}
                      </label>
                    </div>
                    @endforeach
                  <?php endif; ?>

                </div>
                @endforeach
                @endif
              
                <!-- <label style="font-style: bold;-webkit-text-stroke: thin;font-size: larger;" ;="" for="exampleInputEmail1" class="d-flex justify-content-center">Firma Cliente</label>
                <div style=" margin-bottom: 5%;"class="wrapper">
                  <canvas id="canvasFirmaCliente" class="signature-pad" width="500" height="300"></canvas>                                     
                </div>
                <div class="pb-5" style="text-align:center">                                               
                  <button class="btn btn-primary" type="button" id="borrarFirmaCliente">Limpiar</button>
                </div>

                <button style="margin:; width: 100%;"type="submit" class="btn btn-primary">Enviar</button> -->

              </form>                
            </div>
          </div>
        </div>          
      </div>
  </div>
 
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
	
  <script>
    var canvasFirmaCliente = new SignaturePad(document.getElementById('canvasFirmaCliente'));
      // capturo la etiqueta imagen
      var imgFirmaCliente = document.getElementById('imgFirmaCliente');
      // clic en borrar
      document.getElementById('borrarFirmaCliente').addEventListener('click', function() {
        canvasFirmaCliente.clear();
      });
  </script>


</body>
</html>
