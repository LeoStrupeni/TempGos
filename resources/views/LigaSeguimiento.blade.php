@include('Layout/head')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">

<link rel="stylesheet" href="../gos/css/progress-circle.css">
<script>
  $(document).ready(function() {
                                  
    $('#img-os-cliente').magnificPopup({
          delegate: '.popup-link-img', // child items selector, by clicking on it popup will open
          type: 'image',
          gallery:{enabled:true,tCounter: '%curr% de %total%'},
          image: {
              cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
                      
              titleSrc: function(item) {
              return '<small>Imágenes Cliente</small>';
              },
          
              verticalFit: true, // Fits image in area vertically
          
              tError: '<a href="%url%">La Imagen</a> No ha sido cargada.' // Error message
          }
      });
    });
</script>

<div class="col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 offset-md-0 kt-portlet kt-portlet--mobile">

{{-- Arranca el Cuerpo --}}
    <div class="kt-portlet__body p-1">
       
        <div style="margin-top:5%;" class="kt-portlet__head-label kt-align-center">
        <img src="../storage/{{$logo}}" alt="logo" style="width: 13rem;">
            <h2 class="kt-portlet__head-title ">¡Hola! {{$os->nombre}}</h2>
            <h5>Conoce el avance de tu unidad.</h5>
        </div>
      
      <div class="row mt-8 mb-4">
        <div style="margin-top:5%;" class="row col-12">
          <div style="margin:0 auto;" class="col-12 col-md-6">
            <h4 class="kt-portlet__head-title kt-align-center" style="font-size: 2rem;">
            Avance
            </h4>
            <div class="col-sm-4 col-md-8" style="margin: auto;">
              <div class="progress1" data-percentage="{{$porcentajeavance2}}">
                <span class="progress1-left">
                <span class="progress1-bar"></span>
                </span>
                <span class="progress1-right">
                <span class="progress1-bar"></span>
                </span>
                <div class="progress1-value">
                  <div>
                  {{$porcentajeavance1}}%<br>
                  <span>completado</span>
                  </div>
                </div>
              </div>
            </div>
            
              <h4 class="kt-portlet__head-title kt-align-center">
                Orden #{{$number}}
              </h4>
              <div  style="margin-top: 2%;"class="kt-widget14__content d-flex justify-content-center">
                  <div class="col-0 col-sm-0 col-md-4"style="border-right-style: outset; text-align-last: end;">
                    <img style="width: 5rem;margin-left:25%;"src="../img/car-liga.jpg" alt="">
                    <div style=font-size:1.5rem; class="kt-align-center">
                      <p>{{$os->marca_vehiculo}}<br>{{$os->modelo_vehiculo}}. <br> {{$os->anio_vehiculo}}</p>
                    </div>
                  </div>
                <div class="col-0 col-sm-0 col-md-4">
                    <img style="width:3rem;margin-left:10%;"src="../img/calendar.png" alt=""><br>
                  <div style="margin:10%; font-size: 1.25rem;" class="">
                    <td>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Apertura de la orden">
                        <i class="fas fa-circle" style="color: #339af0;"></i>
                        {{$os->fecha_creacion_os}}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Ingreso a reparacion">
                        <i class="fas fa-caret-square-right" style="color: green;"></i>
                        {{ ($os->fecha_ingreso_v_os ==0 ) ? 'Fecha reparacion' : $os->fecha_ingreso_v_os}}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha promesa">
                        <i class="fas fa-square" style="color: yellow;"></i>
                        {{ ($os->fecha_promesa_os == 0)  ? 'Fecha promesa' :  $os->fecha_promesa_os}}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha terminado">
                        <i class="fas fa-circle" style="color: #339af0;"></i>
                        {{($os->fecha_terminado == 0 ) ? 'Fecha terminado' : $os->fecha_terminado}}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha entregado">
                        <i class="fas fa-caret-square-left" style="color: red;"></i>
                        {{($os->fecha_entregado ==0 ) ? 'Fecha entregado' : $os->fecha_entregado}}
                      </p>
                    </td>
                  </div>
                </div>
              </div>
          </div>
          <div style="margin-top:0%;" class="col-12 col-md-5">
              <div  class="">
                <!--begin::Section-->
                <div class="kt-section kt-section--last">
                  <h3 class="kt-portlet__head-title kt-align-center">
                    Etapa
                  </h3>
                  <div style="max-height:20rem; overflow-y:scroll;">

                   <input type="hidden" name="gos_os_id" id="gos_os_id"
                    value="{{$os->gos_os_id}}"> @if(isset($listaEtapasA))
                    @foreach ($listaEtapasA as $key => $etapa)
                    <div class="form-group">
                      <span>{{$etapa->nombre}}</span>
                      <div class="progress">
                        @if ($etapa->estado_etapa == 'A')
                        <div class="progress-bar" role="progressbar" style="width: 100%;color:white;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">                          
                        Etapa Activa
                        @elseif ($etapa->estado_etapa == 'F')
                        <div class="progress-bar" role="progressbar" style="background-color: green; width: 100%;color:white;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                          Terminado
                        @else
                        <div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;-webkit-text-stroke-width: medium;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                          0%
                        @endif
                        </div>
                      </div>
                    </div>

                     @endforeach @endif

                  </div>

                </div>
                <!--end::Section-->
              </div>
          </div>
        </div>
        <div class="container-fluid mt-5">
          <h3 class="kt-portlet__head-title kt-align-center">
            Fotos
          </h3>

          <div class="tab-pane col-12 col-sm-8 offset-sm-2" id="collapseClientes" role="tabpanel">
            <div class="row" id="img-os-cliente">
            @foreach ($listaImgCliente as $key => $imgCli)
                    <div class='col-4 text-center mb-2'>
                        <a class="popup-link-img" href='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}'>
                            <img src='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}' class="img-fluid" alt="Responsive image" style='border-radius:50%; height: 150px; width: 150px;' >
                        </a>
                    </div>
                @endforeach
            
              </div>
          </div>

        </div>

        <div class="container-fluid mt-5">
          <h3 class="kt-portlet__head-title kt-align-center">
            Comentarios
          </h3>
          <div class="kt-portlet col-6 m-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalComentario">Mandar mensaje</button>
          </div>

          <!--begin:: Widgets/Support Tickets -->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
              <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                  Comentarios
                </h3>
              </div>

            </div>
            <div class="kt-portlet__body">
              <div class="kt-widget3">
               @if(isset($mensajes))
				         @foreach ($mensajes as $key => $mensaje)
                <div class="kt-widget3__item">
                  <div class="kt-widget3__header">
                    <div class="kt-widget3__user-img">
                      <i class="flaticon2-user kt-font-brand"></i>
                    </div>
                    <div class="kt-widget3__info">
                      <a href="#" class="kt-widget3__username">
                      {{$mensaje->nombre}}
                      </a><br>
                      <span class="kt-widget3__time">
                      {{$mensaje->fecha}}
                      </span>
                    </div>
                    <span class="kt-widget3__status kt-font-info">
                    {{($mensaje->leido == 1) ? "Leído": 'Pendiente'}}
                    </span>
                  </div>
                  <div class="kt-widget3__body">
                    <p class="kt-widget3__text">
                      {{$mensaje->cuerpo}}
                    </p>
                  </div>
                </div>
                @endforeach @endif


              </div>
            </div>
          </div>
          <!--end:: Widgets/Support Tickets -->



        </div>


    </div>
    {{-- modal comentario --}}
    <div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Añadir comentario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" >
                        @csrf
                        <div class="kt-portlet__body p-0">

                            <div class="form-group">
                                <label style="font-size: 1.25rem;" for="">Comentarios</label>
                                <textarea name="comentarios"  rows="8" placeholder="Respuesta..." style="inline-size: -webkit-fill-available;"></textarea>
                            </div>
                            <button  type="submit" id="btn-mensajecliente-ligaseg" class="btn btn-success col-6 m-auto" >Enviar</button>
                            <button  type="button" style="display:none;" id="easteregg" class="btn btn-success col-6 m-auto" >Enviando...</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
    <input type="hidden" id="gos_os_id" name="gos_os_id" value="{{$os->gos_os_id}}"/>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .chart--container {
            min-height: 150px;
            width: 100%;
            height: 100%;
        }

        .zc-ref {
            display: none;
        }

        zing-grid[loading] {
            height: 480px;
        }
    </style>
    @section('ScriptporPagina')
<script>
  $('body').on('click', '#btn-mensajecliente-ligaseg', function () {
  
    $('#btn-mensajecliente-ligaseg').html('Enviando...');  
    // $( "#btn-mensajecliente-ligaseg" ).prop( "disabled", true );
    // $( "#easteregg" ).prop( "disabled", false );
    document.getElementById('btn-mensajecliente-ligaseg').style.visibility = "hidden";
		document.getElementById('easteregg').style.display = "inline";
   
  });


  var count = 0 ;
    $("#easteregg").click(function(){
        count+=1;
        if (count==5) {  
		
			    alert('Alto!! Tu mensaje se esta enviando');
        }
        else if (count > 5) {
          alert('Alto!! Tu mensaje se esta enviando');
        }
    });
</script>
   
    <script>
    $(function(){$('[data-toggle="popover"]').popover()});   
    </script>
