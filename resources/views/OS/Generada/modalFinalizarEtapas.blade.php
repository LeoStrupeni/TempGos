<div class="modal fade" id="modal-finalizar-etapa" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align-last: center;" id="titleModalfinalizarEtapa">Finalizar Orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                @include('Layout/errores')
                <form id="finalizar-etapa-form">
                    @csrf 
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <img class="offset-1" src="/img/phoneCover.png" alt="" style="width:80%;">
                            <p style="color: #fff;position:absolute;margin-top:-66%;margin-left: 22%;width: 14rem;">
                            <input type="hidden" name="gos_os_id" id="gos_os_id" value="{{$os->gos_os_id}}">
                            Hola
                            <label style="font-size: 1rem; -webkit-text-stroke: medium;">{{$os->nombre}}</label>
                            le informamos que su 
                            <label style="font-size: 1rem; -webkit-text-stroke: medium;">{{$os->marca_vehiculo}}, {{$os->modelo_vehiculo}}. {{$os->anio_vehiculo}}</label>
                            está listo.
                            Fecha de entrega:  {{$fecha_terminado ?? $fechahoy}}
                            <label style="font-size: 1rem; -webkit-text-stroke: medium;">{{-- {{$mensaje->link}} --}}</label>, hora: <label style="font-size: 1rem; -webkit-text-stroke: medium;">{{-- {{$mensaje->link}} --}}</label>.
                            Dudas al {{$taller->taller_tel_principal ?? $taller->correo_respuestas }}. Gracias por elegirnos.</p>
                        </div>
                        <input id="nombre" type="hidden" value="{{$os->nombre}}">
                        <input id="marca_vehiculo" type="hidden" value="{{$os->marca_vehiculo}}">
                        <input id="modelo_vehiculo_n" type="hidden" value="{{$os->modelo_vehiculo}}">
                        <input id="celular" type="hidden" value="{{$os->celular}}">
                        <input id="taller_tel_principal" type="hidden" value=" {{$taller->taller_tel_principal ?? $taller->correo_respuestas }}">
                    
                        <div style="align-self: center;" class="col-lg-6 col-md-12">
                            <div class="row d-flex justify-content-center">
                                <a class="" id="whatsapp"  style="-webkit-text-stroke-width: medium;">
                                    <div class="kt-demo-icon kt-font-success">
                                        <div class="kt-demo-icon__preview">
                                            <i class="socicon-whatsapp"></i>
                                        </div>
                                        <div class="">
                                            Enviar Whatsapp                 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="row d-flex justify-content-center mb-4"style="font-size: medium;" >
                                <input style="align-self: center;-webkit-text-orientation: sideways; width: 1.25rem; height: 1.25rem;" type="checkbox" name="enviar_sms" id="enviar_sms" value="">
                                <span>Enviar SMS</span>
                            </div>
                            <div class="input-group date" >
                                <input type="text" class="form-control" placeholder="Selecciona fecha y hora" name="fecha_entrega" id="kt_datetimepicker_2" value="<?= date("Y-m-d h:i:s")?>" />
                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="la la-calendar glyphicon-th"></span>
                                    </div>                                    
                                </span>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <button type="button" id="btnFinalizar" class="btn btn-success btn-block mt-4">Guardar</button>
                                </div>
                            </div>  
                            
                        </div>                        
                    </div>                   
                                     
                </form>
            </div>
        </div>
    </div>
</div>