$(document).ready(function() {
  console.log("comunicacionesJS");

      $.get({

          url :'/revisar-mensajes',
          dataType: 'json',
          success: function(data,response){
          //  console.log(data);
              var htmlinsert='<a></a>';
              var x = data.length;
              var u = x;
              var div = document.getElementById('n_mensajes');
            //  console.log(div);

              for (i = 0; i < x; i++) {
                if(data[i].nombre==null){data[i].nombre=''};
                  htmlinsert='<a type="button" id="mensaje-id" data-id="'+data[i].gos_os_mensaje_id+'"  class="kt-notification__item">'+
                          '<div class="kt-notification__item-icon">'+
                              '<i class="flaticon2-user kt-font-brand"></i>'+
                          '</div>'+
                          '<div class="form-group kt-notification__item-details">'+
                              '<div class="kt-notification__item-title" style="font-weight:bold;">'+
                                ((data[i].de=='taller')?
                                  'Mensaje de Equipo de Trabajo '+data[i].nombre+ ' - Orden #'+ data[i].nro_orden_interno:
                                   (data[i].de=='ref')?
                                    'Mensaje de Refacciones   Orden #'+ data[i].nro_orden_interno
                                  :'Mensaje del '+data[i].de+' '+data[i].nombre+ ' - Orden #'+ data[i].nro_orden_interno)+
                              '</div>'+
                              '<div class="kt-notification__item-content">'
                                  +data[i].cuerpo+
                              '</div>'+
                              '<div class="kt-notification__item-time" style="font-size: smaller;">'+
                                   data[i].fecha+
                              '</div>'+
                          '</div>'+
                      '</a>'+htmlinsert
                  ;
              }
              document.getElementById("badge_mensajes_2").innerText = u +' nuevos';
              $('#badge_mensajes').text(u);
              $('n_mensajes').append("asdasdasd");
                div.innerHTML=htmlinsert;
          }
      });
});

$('body').on('click','#mensaje-id',function() {
var id = $(this).data('id');
    $('#titleModalMensaje').html('Nuevo Mensaje');
    $('#modalMensaje').modal('show');


    $.ajax({

        url :'/mensajes/'+id,
        type: 'get',
        dataType: 'json',
        success: function(data){
        //    console.log(data['listaAdmin'].length);
           $('#myselect').selectpicker();
        //  console.log(data['os']);
            var equipo = data['listaAdmin'];
            var text = "";
            var ind = "";
            var i;
            for (i = 0; i < equipo.length; i++) {
            text += '<option value="'+equipo[i].gos_usuario_id+'">'+equipo[i].apellidos+', '+equipo[i].nombre+'</option> <br>';
                ind+= equipo[i].gos_usuario_id+",";

            }
            var usuario = data['usuario'];
            // console.log(ind);
            var htmlinsert='<a></a>';
                id_os = data['os'].gos_os_id;
                var div = document.getElementById('m_mensaje');
                htmlinsert= '<div class="col-12 col-sm-12">'+
                    '<div class="form-group">'+
                        '<label style="font-size: 1rem;">No. de Orden: </label>  <br>'+
                        '<input type="hidden" value="'+id_os+'" name="gos_os_id" >'+
                        '<input type="hidden" value="'+usuario+'" name="usuario" >'+
                        '<input type="hidden" value="'+id+'" name="gos_os_mensaje_id" id="gos_os_mensaje_id" >'+
                         '<a href="/orden-servicio-generada/'+ id_os +'"  style="font-size: 1.5rem;font-weight: bold;  color: 27395c;"> # '+data['os'].nro_orden_interno+'  </a>'+
                         '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 1rem;">Cliente: <br> '+data['os'].nombre_cliente+' </label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 1rem;">Aseguradora:: <br> '+data['os'].empresa+' </label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 1rem;">Vehículo: <br> '+data['os'].vehiculo+'   '+data['os'].anio_vehiculo+'   '+data['os'].placa+'  </label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 1rem;">Mensaje <br>'+data['os'].cuerpo+'</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 1rem;" for="">Comentarios</label>'+
                            '<textarea name="comentarios" id="comentarios"  rows="8" placeholder="Respuesta..." style="inline-size: -webkit-fill-available;"></textarea>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row col-12 col-sm-12">'+
                        '<div class="form-group col-8">'+
                            '<label>Prioridad</label>'+
                            '<select class="form-control kt-selectpicker" name="Prioridad">'+
                                '<option value="0" selected>Normal</option>'+
                                '<option value="1">Alta</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="form-group col-4 text-center">'+
                            '<span class="form-text text-muted">Visible Cliente</span>'+
                            '<label class="kt-checkbox kt-checkbox--solid">'+
                                '<input type="checkbox" name="visibleCliente1">'+
                                '<span></span>'+
                            '</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label>Notificar equipo de Trabajo</label>'+
                            '<select name="gos_usuario_envio[]" id="myselect" class="form-control kt-selectpicker" data-live-search="true" data-actions-box="true" data-select-all-text="Todas" data-deselect-all-text="No aplica" multiple>'+

                                    text+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="form-group">'+
                            '<label>Notificar por Email        <input type="checkbox" id="email_cliente_Check" value="1" onclick="os_envio_email.disabled = !this.checked"></label>'+
                            '<input type="text" class="form-control" name="os_envio_email" id="os_envio_email" disabled>'+

                        '</div>'+
                    '</div>'+
                    '<div class="col-12 col-sm-12">'+
                        '<div class="row d-flex justify-content-center">'+
                            '<a class="" id="enviar-whatsapp1" target="_blank" style="-webkit-text-stroke-width: medium;">'+
                                '<div class="kt-demo-icon kt-font-success">'+
                                    '<div class="kt-demo-icon__preview">'+
                                        '<i class="socicon-whatsapp"></i>'+
                                    '</div>'+
                                    '<div class="">'+
                                        'Enviar Whatsapp'+
                                    '</div>'+
                                '</div>'+
                            '</a>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12">'+
                    '<button type="button" id="btn-guardar-mensaje" name="boton_mensaje" class="btn btn-success btn-block">Enviar</button>'+
                    '<button  type="button" style="display:none;" id="btn-guardandomensaje-equip" class="btn btn-success btn-block" >Enviando...</button>'+
                    '</div>'
                    ;

            div.innerHTML = htmlinsert
            $('#myselect').selectpicker('val', [ind]);
            // console.log($("textarea#comentarios").val());

        }

    });

    $('body').on('click','#enviar-whatsapp1',function() {

        var NCL= $("input#celular_cliente").val();
        // console.log(NCL);
        var value = $("textarea#comentarios").val();
        var url = "https://api.whatsapp.com/send?phone=52"+NCL+"&text="+value+"&source=&data=";
        // console.log(url);
         window.open(url, '_blank');



    });
});
