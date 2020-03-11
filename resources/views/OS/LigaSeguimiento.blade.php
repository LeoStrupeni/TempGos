@extends('Layout')
@section('estiloPorPagina')
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
@endsection
@section('Content')
<link rel="stylesheet" href="../gos/css/progress-circle.css">
<div class="col-12 col-sm-12 col-md-12 col-lg-10 offset-lg-1 offset-md-0 kt-portlet kt-portlet--mobile">

{{-- Arranca el Cuerpo --}}
    <div class="kt-portlet__body p-1">
      <div style="margin-top:5%;" class="kt-portlet__head-label kt-align-center">
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
              <div class="progress1" data-percentage="80">
                <span class="progress1-left">
                <span class="progress1-bar"></span>
                </span>
                <span class="progress1-right">
                <span class="progress1-bar"></span>
                </span>
                <div class="progress1-value">
                  <div>
                  80%<br>
                  <span>completado</span>
                  </div>
                </div>
              </div>
            </div>
                <!-- <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                        <div class="kt-widget14__content d-flex justify-content-center">
                            <div class="kt-widget14__chart">
                                <div class="chartjs-size-monitor">
                                </div>
                                <div class="kt-widget14__stat">40
                                    {{--{{$os->porcentaje_completo ?? }}--}}
                                </div>
                                <canvas id="os_{{--{{$key}}--}}" width="250" height="150" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                 </div> 
                </div>-->
              <h4 class="kt-portlet__head-title kt-align-center">
                Orden #{{$os->gos_os_id}}
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
                        {{ $os->fecha_ingreso_v_os ?? 'Fecha reparacion' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha promesa">
                        <i class="fas fa-square" style="color: yellow;"></i> 
                        {{$os->fecha_promesa_os ?? 'Fecha promesa' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha terminado">
                        <i class="fas fa-circle" style="color: #339af0;"></i> 
                        {{$os->fecha_terminado ?? 'Fecha terminado' }}
                      </p>
                      <p class="m-0" data-toggle="popover" data-trigger='hover'
                        data-placement="top" data-content="Fecha entregado">
                        <i class="fas fa-caret-square-left" style="color: red;"></i> 
                        {{$os->fecha_entregado ?? 'Fecha entregado' }}
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
                        <div class="progress-bar" role="progressbar" style="width: {{($etapa->estado_etapa == 'F') ? '100': '0'}}%;color: black;-webkit-text-security: square;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        @if ($etapa->estado_etapa == 'A')
                          Etapa Activa!!
                        
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
            <div class="row" {{-- id="form-img-os-cliente" --}}>
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
                      <!-- <img class="kt-widget3__img" src="/metronic/themes/metronic/theme/default/demo1/dist/assets/media/users/user1.jpg" alt="">   -->
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
                    <form id="comentarios-form">
                        @csrf
                        <div class="kt-portlet__body p-0">
                            <div class="form-group">
                                <label style="font-size: 1.25rem;" for="">Comentarios</label>
                                <textarea name="comentarios"  rows="8" placeholder="Respuesta..." style="inline-size: -webkit-fill-available;"></textarea>
                            </div>                            
                            <button id="btn-guardar-mens-cliente" type="button" class="btn btn-success col-6 m-auto" id="btnGuardarComentario">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />
    <input type="hidden" id="gos_os_id" name="gos_os_id" value="{{$os->gos_os_id}}"/>
</div>
@endsection

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
    
      <script type="text/javascript">
        var ctx = KTUtil.getByID('os_{{--{{$key}}--}}').getContext('2d');
        var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data:	 [70,30],
                backgroundColor: [
                  '#32B89D','#EAEBF1',
                ]
            }],
            labels: ['Completado', 'En Proceso']
        },
        options: {
            cutoutPercentage: 75,
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
                position: 'top',
            },
            title: {
                display: false,
                text: 'Technology'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            tooltips: {
                enabled: true,
                intersect: false,
                mode: 'nearest',
                bodySpacing: 5,
                yPadding: 10,
                xPadding: 10,
                caretPadding: 0,
                displayColors: false,
                backgroundColor: '#5D78FF',
                titleFontColor: '#ffffff',
                cornerRadius: 4,
                footerSpacing: 0,
                titleSpacing: 0
            }
        }
        };
        var ctx = KTUtil.getByID('kt_charty_profit_share1').getContext('2d');
        var myDoughnut = new Chart(ctx, config);

      </script>
    <script>$(function(){$('[data-toggle="popover"]').popover()}); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-os-generada.js"></script>
    <script src="{{env('APP_URL')}}/gos/OS/ajax-inicio.js"></script>
    
    @endsection