
<div class="modal fade" id="modal-mensaje" name="modal-mensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModalFamilia">Reenviar mensaje de Bienvenida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img  class="offset-1" src="/img/phoneCover.png" alt="" style="width: 80%;">
                    <div class="container" style="overflow-wrap: break-word;">
                      <p style="color: #fff;position:absolute;margin-top: -80%;margin-left: 22%;width: 14rem;">
                      Bienvenido(a) <label style="font-size: 1rem; -webkit-text-stroke: medium;">{{$os->nombre ?? ''}}&nbsp
                      {{$os->apellidos ?? ''}}</label> a <label style="font-size: 1rem; -webkit-text-stroke: medium;"> {{$taller->taller_nomb}}  </label> 
                      , para un mejor seguimiento de tu <label style="font-size: 1rem; -webkit-text-stroke: medium;">&nbsp{{$os->marca_vehiculo ?? ''}}&nbsp{{$os->modelo_vehiculo ?? ''}}&nbsp
                      {{$os->anio_vehiculo ?? ''}}</label>
                        ingresa a
                        http://proordersistem.com.mx{{$os->gos_os_liga_seguimiento ??''}}
                        . Dudas al {{$taller->taller_tel_principal ?? $taller->correo_respuestas }}. Gracias por elegirnos.
                      </p>
                    </div>
                </div>
                <div style="align-self: center;" class="col-lg-6 col-md-12">
                           <div class="row d-flex justify-content-center">
                                <?php $modelo = str_replace("&","and",$os->modelo_vehiculo);?>                            
                               <form id="form-reenviar-liga">
                               @CSRF
                                <a class="" id=""  target="_blank" style="-webkit-text-stroke-width: medium;" onclick="Reenvia()"  href="https://api.whatsapp.com/send?phone=52{{$os->celular}}&text=Bienvenido(a) {{$os->nombre}} a {{$taller->taller_nomb}}, para un mejor seguimiento de tu {{$os->marca_vehiculo}} {{$modelo}} {{$os->anio_vehiculo}} ingresa a http://proordersistem.com.mx{{$os->gos_os_liga_seguimiento}} Dudas al {{$taller->taller_tel_principal ?? $taller->correo_respuestas }} . Gracias por elegirnos.&source=&data=" target="_blank">
                                    <div class="kt-demo-icon kt-font-success">
                                        <div class="kt-demo-icon__preview">
                                            <i class="socicon-whatsapp"></i>
                                        </div>
                                        <div class="">
                                            Enviar Whatsapp
                                        </div>
                                    </div>
                                </a>
                                <input type="hidden" id="cuerpo_liga" name="cuerpo_liga" value="Bienvenido(a) {{$os->nombre}}, para un mejor seguimiento de tu {{$os->marca_vehiculo}} {{$modelo}} {{$os->anio_vehiculo}} ingresa a http://proordersistem.com.mx{{$os->gos_os_liga_seguimiento}} Dudas al {{$taller->taller_tel_principal ?? $taller->correo_respuestas }} . Gracias por elegirnos.">
                                <input type="hidden" id="idos_liga" name="idos_liga" value="{{$os->gos_os_id}}">
                                <input type="hidden" id="userid" name="userid" value="{{$user->gos_usuario_id}}">
                                </form>
                            </div>

                    <div >
                      <button type="submit" style="width: -webkit-fill-available;" class="btn btn-block btn-success">Enviar SMS</button>
                    </div>
                </div>

              </div>
            </div>
        </div>
    </div>
</div>
<script>
function Reenvia(){ 
  
		$.ajax({contenttype : 'application/json; charset=utf-8',
			data: $('#form-reenviar-liga').serialize(),
			url : '/reenviar-mensajes-ligaseg',
			type : 'POST',				
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
                
                // console.log(data);
                alert('Liga de seguimiento Enviada al Cliente!!!');
                $('#modal-mensaje').hide();
              location.reload();
				
			}
		});
}
</script>