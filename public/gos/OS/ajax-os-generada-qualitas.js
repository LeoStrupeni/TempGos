$( document ).ready(function() {
    console.log( "ajax-qlts-ready!" );
});

function modaldocsqlt(typo){
    $( "#appendinnerdocqlts" ).empty();
    $(".fileclassall").hide();


   if (typo==1) {document.getElementById('titlemodalqualitas').innerHTML="Notificacion Firmada";
                 document.getElementById('tipofileqlt').value=1;
                  document.getElementById('carpetaqlts').value=1;
                  $('#inputenviarfiles').show();
                   $(".fileclass"+1).show();
                }
   if (typo==2) {document.getElementById('titlemodalqualitas').innerHTML="Orden De Admision";
                 document.getElementById('tipofileqlt').value=0;
                 document.getElementById('carpetaqlts').value=2;
                    $(".fileclass"+2).show();
                }
   if (typo==3) {document.getElementById('titlemodalqualitas').innerHTML="Fotos";
                 $('#inputenviarfiles').hide();
                 $("#appendinnerdocqlts").append('<div class="col-4 offset-4"> <button class="btn btn-md btn-secondary m-2">EnviarFotosCliente</button>'+
                                                  '<button class="btn btn-md btn-secondary m-2">EnviarFotosInterna</button> </div>');
                 }
   if (typo==4) {document.getElementById('titlemodalqualitas').innerHTML="Documentos";
                 document.getElementById('tipofileqlt').value=3;
                     document.getElementById('carpetaqlts').value=3;
                 $('#inputenviarfiles').show();
                   $(".fileclass"+3).show();
                }
   if (typo==5) {document.getElementById('titlemodalqualitas').innerHTML="Informe De Daños";
                $('#inputenviarfiles').show();
                    document.getElementById('carpetaqlts').value=4;
                     $(".fileclass"+4).show();
                }
   if (typo==6) {document.getElementById('titlemodalqualitas').innerHTML="Fotos SSERV";
                 document.getElementById('carpetaqlts').value=5;
                  $(".fileclass"+5).show();
                 $('#inputenviarfiles').show();
                }
   if (typo==7) {document.getElementById('titlemodalqualitas').innerHTML="Fotos Complementos";
                     document.getElementById('carpetaqlts').value=6;
                      $(".fileclass"+6).show();
                  $('#inputenviarfiles').show();
                 }
   if (typo==8) {document.getElementById('titlemodalqualitas').innerHTML="Valuacion";
                     document.getElementById('carpetaqlts').value=7;
                      $(".fileclass"+7).show();
                 $('#inputenviarfiles').show();
                }
   if (typo==9) {document.getElementById('titlemodalqualitas').innerHTML="Refacciones";
                      document.getElementById('carpetaqlts').value=8;
                       $(".fileclass"+8).show();
                $('#inputenviarfiles').show();
                 }
   if (typo==10){document.getElementById('titlemodalqualitas').innerHTML="Otros Documentos";
                        document.getElementById('carpetaqlts').value=9;
                         $(".fileclass"+9).show();
                   document.getElementById('tipofileqlt').value=0;
                   $('#inputenviarfiles').show();
                }

    $('#dropdowndocumentos').show();
}

function cerrardrwpdwnqls(){
  $('#dropdowndocumentos').hide();
}


function Guardarfiles(){
 document.getElementById("btnenviarfiles").click();
}
