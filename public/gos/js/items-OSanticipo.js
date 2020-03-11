


fetch("/api/prueba")
// PRIMER THEN RETORNA LA RESPUESTA DEL LLAMADO
.then(function(response) {
    return response.json();
})// SOLICITUD DE QUE HARA CON LA RESPUESTA OBTENIDA
.then(function(data){
    for (item of data) {
        var Tipo = item.tipo;
        var Importe = item.Importe;
        var Fecha = item.fecha_anticipo;
        var Observaciones = item.observaciones;
        var borrar =    `<form class="dropdown-item" action="{{route(anticipo.destroy,$item->gos_item_id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-outline-hover-danger w-100 text-left p-0">
                                <i class="la la-trash"></i>
                            </button>
                        </form>`;
        // FALTA AGREGAR EL TOKEN DE LARAVEL EN EL BTN DELETE
        var col = "<tr><td>"+Tipo+"</td><td>"+Importe+"</td><td>"+Fecha+"</td><td>"+Observaciones+"</td><td class='text-center'>"+borrar+"</td></tr>";

        $("#listaAnticipo").append(col);
    }
})
