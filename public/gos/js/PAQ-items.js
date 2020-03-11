// FUNCIONO PARA AGREGAR A BASE EL ITEM ETAPA
$('#btn-ItemEtapaPAQ').click(function(){
    var OS_ID=document.getElementById("gos_paquete_id"); 
    var valorid = OS_ID.value;
    if (valorid==''){
        alert("Para agregar una etapa debe primero completar el nombre del paquete!!!")
    } 
    else {
        var datosForm=$('#form-ItemEtapaPAQ').serializeArray();
        console.log(datosForm); // UNA VEZ QUE FUNCIONE BORRAR ESTA LINEA
        $.ajax({
        type:"POST",
        url:"",//guardar-datos-inventario
        data: datosForm,
        success:function(r){
            if (r==1) {
            alert('agregado con exito');
            }
            else {
            alert('error en insertar datos');
            }
        }
        });
    return false;
    }    
});


fetch("/api/pruebaPaquete")
// PRIMER THEN RETORNA LA RESPUESTA DEL LLAMADO
.then(function(response) {
    return response.json();
})// SOLICITUD DE QUE HARA CON LA RESPUESTA OBTENIDA
.then(function(data){
    var token = $("input[name='_token']").val();
    for (item of data) {
        var id = item.gos_producto_id;
        var Nombre = item.nomb_producto;
        var Descripcion = item.descripcion;
        var CodigoSAT = item.codigo_sat;
        var Asesor = `item.asesor`;
        var Cantidad = item.cantidad;
        var Precio = item.venta;
        var Descuento = `item.Descuento`;
        var Importe = Cantidad * Precio;
        var borrar= `<form class="m-0">
                        <input type="hidden" name="_token" value="`+token+`"> 
                        <input type="hidden" name="id" value="`+id+`">                        
                        <button type="button" class="btn btn-danger p-0" onclick="QuitarItem(`+id+`);">
                            <i class="fas fa-times p-0"></i>
                        </button>
                    </form>`
        // FALTA AGREGAR EL TOKEN DE LARAVEL EN EL BTN DELETE
        var markup = "<tr><td class='text-truncate' style='max-width: 150px;font-size: 1vw;'>"+Nombre+"</td><td class='text-truncate' style='max-width: 150px;font-size: 1vw;'>"+Descripcion+"</td><td style='font-size: 1vw;'>"+CodigoSAT+"</td><td style='font-size: 1vw;'>"+Asesor+"</td><td style='font-size: 1vw;'>"+Cantidad+"</td><td style='font-size: 1vw;'>"+Precio+"</td><td style='font-size: 1vw;'>"+Descuento+"</td><td style='font-size: 1vw;'>"+Importe+"</td><td class='text-center'>"+borrar+"</td></tr>";

        $("#dt-listaItemsPaquete").append(markup);
    }

    $('.datatablaRowReorder').DataTable({
        // retrieve: true,
        responsive: true,
        rowReorder: { update: false },
        paging: false,
        searching: false,
        ordering: false,
        scrollX: true,
		language : {"url" : "/gos/Spanish.json"}
    });
});


function QuitarItem(id) {
    console.log(id);
    $.ajax({
        type: 'DELETE',
        //url: '/api/prueba/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
        },
    });
};