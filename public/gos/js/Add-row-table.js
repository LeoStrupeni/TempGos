$(document).ready(function(){
    $(".add-row-etapa").click(function(){
        var Nombre = $("#os_etapa_id").val();
        var Descripcion = $("#os_etapa_descripcion").val();
        var CodigoSAT = 'Sin asignar';
        var Asesor = $("#os_etapa_asesor_id").val();
        var Cantidad = '1';
        var Precio = $("#os_etapa_total").val();
        var Descuento = '$0.00';
        var Importe = Cantidad * Precio;

        var markup = "<tr><td>"+Nombre+"</td><td>"+Descripcion+"</td><td>"+CodigoSAT+"</td><td>"+Asesor+"</td><td>"+Cantidad+"</td><td>"+Precio+"</td><td>"+Descuento+"</td><td>"+Importe+"</td></tr>";
        $("table tbody").append(markup);        
    });

    $(".add-row-etapa-os").click(function(){
        var Nombre = $("#os_etapa_id").val();
        var Descripcion = $("#os_etapa_descripcion").val();
        var CodigoSAT = 'Sin asignar';
        var Asesor = $("#os_etapa_asesor_id").val();
        var Cantidad = '1';
        var Precio = $("#os_etapa_total").val();
        var Materiales = "Sin asignar"
        var Descuento = '$0.00';
        var Importe = Cantidad * Precio;

        var markup = "<tr><td>"+Nombre+"</td><td>"+Descripcion+"</td><td>"+CodigoSAT+"</td><td>"+Asesor+"</td><td>"+Cantidad+"</td><td>"+Precio+"</td><td>"+Materiales+"</td><td>"+Descuento+"</td><td>"+Importe+"</td></tr>";
        $("table tbody").append(markup);        
        });


    $(".add-row-paquete").click(function(){
        var Nombre = $("#os_paquete_id").val();
        var Descripcion = $("#os_paquete_descripcion").val();
        var CodigoSAT = 'Sin asignar';
        var Asesor = 'Sin asignar';
        var Cantidad = $("#os_paquete_cantidad").val();
        var Precio = $("#os_paquete_venta").val();
        var Materiales = "Sin asignar";
        var Descuento = '$0.00';
        var Importe = Cantidad * Precio;

        var markup = "<tr><td>"+Nombre+"</td><td>"+Descripcion+"</td><td>"+CodigoSAT+"</td><td>"+Asesor+"</td><td>"+Cantidad+"</td><td>"+Precio+"</td><td>"+Materiales+"</td><td>"+Descuento+"</td><td>"+Importe+"</td></tr>";
        $("table tbody").append(markup);        
        });

    $(".add-row-producto").click(function(){
        var Nombre = $("#os_producto_id").val();
        var Descripcion = $("#os_producto_nombre").val();
        var CodigoSAT = 'Sin asignar';
        var Asesor = 'Sin asignar';
        var Cantidad = $("#os_producto_cantidad").val();
        var Precio = $("#os_producto_venta").val();
        var Materiales = "Sin asignar";
        var Descuento = '$0.00';
        var Importe = Cantidad * Precio;

        var markup = "<tr><td>"+Nombre+"</td><td>"+Descripcion+"</td><td>"+CodigoSAT+"</td><td>"+Asesor+"</td><td>"+Cantidad+"</td><td>"+Precio+"</td><td>"+Materiales+"</td><td>"+Descuento+"</td><td>"+Importe+"</td></tr>";
        $("table tbody").append(markup);        
        });


    });    

