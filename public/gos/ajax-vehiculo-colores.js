$(document).ready(function() {
   console.log("ajax-colores.ready");
  $('#agregarColoresVehiculo').click(function() {
      $('#gos_vehiculo_marca_id').val('');
      $('#colorVehiculoForm').trigger("reset");
      $('#modalColorVehiculo').modal('show');
  });

  $('#btnGuardarColorVehiculo').click(function() {
      var $errores = 0
      if($('#nomb_color').val() == 0 ){
          $('.nomb_color').text('Campo obligatorio');
          $errores++;
          } else {
          $(this).focus(function(){
              $('.nomb_color').text('');
              if($errores > 0){
                  $errores-1;
              }
          });
      }

      if($errores != 0){
          event.preventDefault();
      } else {
         document.getElementById("btnGuardarColorVehiculosubmit").click();
        $('#modalColorVehiculo').modal('hide');
      }


  });

 });
