<!--  /**
* Mensajes Whatssap y otros
* Table: gos_etapa_asesor_mensaje
* Columns:
* gos_paq_etapa_mensaje_id[] int(11) AI PK
* gos_paq_etapa_id[] int(11)
* mensaje_cuerpo text
* mensaje_nomb varchar(255)
*/ -->

@isset($listaMensajeWhatsapp)
    @for ($i=0; $i< 3; $i++) {{-- cant_mensajes --}}
        <div class="form-group">
            <label style="font-size: 1rem;">Titulo del Mensaje (Opcion {{$i+1}})</label>
            <input type="text" class="form-control" name="mensaje_nomb[]" id="mensaje_nomb[]" value="{{isset($listaMensajeWhatsapp[$i]) ? $listaMensajeWhatsapp[$i]['mensaje_nomb']:''}}">
        </div>
        <div class="form-group">
            <label style="font-size: 1rem;">Mensaje de Whatsapp {{$i+1}} <i class="flaticon-information"></i></label>
            <textarea class="form-control" rows="3" name="mensaje_cuerpo[]" id="mensaje_cuerpo[]">
                {{isset($listaMensajeWhatsapp[$i]) ? $listaMensajeWhatsapp[$i]['mensaje_cuerpo']:''}}
            </textarea>
        </div>
        <input type="hidden" name="gos_paq_etapa_mensaje_id[]" value="{{$listaMensajeWhatsapp[$i]['gos_paq_etapa_mensaje_id']}}">
    @endfor
@endisset