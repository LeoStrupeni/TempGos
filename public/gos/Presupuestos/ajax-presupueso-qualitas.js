$(document).ready(function() {
  console.log("ajax-presupuestos-qualitas.js");
});


$('#guardarpresqualitas').click(function() {
    var val = Validar();
    //console.log(val + "val");
    var cliente = $('#presupuesto-form').serialize();
    var totales = $('#presupuesto-cierre-form').serialize();
    var presform = $('#ItemsPresupuestos_form').serialize();
    var table = document.getElementById('tbody_itemprod');
    var tablelength = document.getElementById("tbody_itemprod").rows.length;
    var items = new Array(tablelength);
    for (var i = 0; i < tablelength; i++) {

        var item = {
            id: table.children[i].children[0].innerHTML,
            desc: table.children[i].children[1].innerHTML,
            parte: table.children[i].children[3].children[0].value,
            obser: table.children[i].children[4].children[0].value,
            nomen: table.children[i].children[5].innerHTML,
            Pserv: table.children[i].children[6].innerHTML,
            Ppin: table.children[i].children[7].innerHTML,
            Pref: table.children[i].children[8].innerHTML,
            total: table.children[i].children[9].innerHTML
        };
        items[i] = item;
    }
    if (val == "0") {
        var ItemsarrayJson = JSON.stringify(items);
        var req = presform+ '&' +cliente + '&' + totales + '&Jsnitems=' + ItemsarrayJson;
        $.ajax({
            type: 'POST',
            url: '',
            data: req,
            success: function(data) {
                console.log(data);
                Swal.fire(
                  'Presupuesto Guardado!',
                  'Redireccionando A Bandeja!',
                  'success'
                )
            }
        });
       window.location = "/BandejaQualitas"
    }
});
function Validar() {
    errores = 0;
    var items = document.getElementById("tbody_itemprod").rows.length;
    if (items == 0) {
        errores = errores + 1;
    }
    if (errores>0) {
      swal.fire('Inserta Al Menos Un Item.',
      '',
      'error'
      )
    }

    return (errores);
}
function btndis(){
  Swal.fire('UPS....Para Realizar Esta Accion  Necesitas Guardas Los Cambios')
}


//_____________________editar pres qualitas
$('#editarpresqualitas').click(function() {
    var osid=document.getElementById('idos').value;
    var val = Validar();
    var Reqst = $('#ItemsPresupuestos_form').serialize();
    var table = document.getElementById('tbody_itemprod');
    var tablelength = document.getElementById("tbody_itemprod").rows.length;
    var items = new Array(tablelength);
    for (var i = 0; i < tablelength; i++) {
      var item = {
            id: table.children[i].children[0].innerHTML,
            desc: table.children[i].children[1].innerHTML,
            parte: table.children[i].children[3].children[0].value,
            obser: table.children[i].children[4].children[0].value,
            nomen: table.children[i].children[5].innerHTML,
            Pserv: table.children[i].children[6].innerHTML,
            Ppin: table.children[i].children[7].innerHTML,
            Pref: table.children[i].children[8].innerHTML,
            total: table.children[i].children[9].innerHTML
        };
        items[i] = item;
    }
    var ELitems = eliminaritem.split(",");
    if (val == "0") {

        var ItemsarrayJson = JSON.stringify(items);
        var ELTiemsarrayJson = JSON.stringify(ELitems);
        var req=Reqst + '&Jsnitems=' + ItemsarrayJson+ '&JsnELitems=' +ELTiemsarrayJson;
        $.ajax({
            type: 'POST',
            url: '/Presupuestos/Qualitas/'+osid+'/Editar',
            data: req,
            success: function(data) {
              console.log(data);
              Swal.fire(
                'Presupuesto Guardado!',
                'Redireccionando A Bandeja!',
                'success'
              )
            }
        });
      window.location = "/BandejaQualitas"
    }
});

//------------Actions WS PRO __________________________________________________________________

function WsValuacion(osid){
  $.ajax({
      type: 'get',
      url: '/Presupuestos/Qualitas/'+osid+'/enviarval/0',
      success: function(data) {
        console.log(data);
        Swal.fire(
          'valuacion Enviada!',
            data,
          'success'
        )
        window.location = "/BandejaQualitas"
      }
  });
}

function displmodalfotos(){
 $('#modalfotosqlts').modal('show');
}
