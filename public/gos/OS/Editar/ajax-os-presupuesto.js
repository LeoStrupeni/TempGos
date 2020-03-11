var counter = 0;
var subtotal = 0;
var errores = 0;
var Manodeobra=0;
var Manoobrapintura=0;
var Manoobrarefacciones=0;
var eliminaritem="";


$(document).ready(function() {
     console.log("ondocready ajax-os-");
     Mo();
     CalcTotal();

});

function CalcTotal() {
    //console.log("ctotal");
    var Subtotal = parseFloat(document.getElementById("subtotal").value);
    if (isNaN(Subtotal)) Subtotal = 0;
    var Descuento = parseFloat(document.getElementById("descuento1").value);
  //  console.log(Descuento);
    if (isNaN(Descuento)) Descuento = 0;
    var Iva = parseFloat(document.getElementById("iva").value);
    if (isNaN(Iva)) Iva = 0;
    if (Descuento > 0) {
      var desct=document.getElementById("desctipe").value;
    //  console.log(desct);
      if (desct=="%") {
      Descuento = (Subtotal * Descuento) / 100;
      Subtotal = Subtotal - Descuento;
    }else{  Subtotal = Subtotal - Descuento; }
    }
    Iva = (Subtotal * Iva) / 100;
    var total = Subtotal + Iva;
    document.getElementById("totalFinal").value = total;
    document.getElementById("totalFinal2").value = total;
}

function Mo(){
  molam=0;
  momec=0;
  motot=0;
  pin=0;
  Manoobrarefacciones=0;
  manopintura=0;
  subtotal=0;
  var table = document.getElementById('tbody_itemprod');
  var tablelength = document.getElementById("tbody_itemprod").rows.length;
      for (var i = 0; i < tablelength; i++) {
        var SerT=(table.children[i].children[5].innerHTML);
        var ser=parseFloat((table.children[i].children[6].innerHTML));
        var pin=parseFloat((table.children[i].children[7].innerHTML));
        var ref=parseFloat((table.children[i].children[8].innerHTML));
        var totl=parseFloat((table.children[i].children[9].innerHTML));
         Manoobrarefacciones=Manoobrarefacciones+ref;
         manopintura=manopintura+pin;
         subtotal=totl+subtotal;
         var splitsert=SerT.split("");
         if (splitsert[1]=="L") {
           molam=molam+ser;
         }
         if (splitsert[1]=="M") {
           momec=momec+ser;
         }
         if (splitsert[1]=="T") {
           motot=motot+ser;
         }
      }
      document.getElementById("molaminado").value = molam;
      document.getElementById("momecanica").value = momec;
      document.getElementById("motot").value = motot;
      document.getElementById("PPintura").value = manopintura;
      document.getElementById("manoobraref").value = Manoobrarefacciones;
      document.getElementById("subtotal").value = subtotal;
      document.getElementById("subtotal2").value = subtotal;
}

function deleteRowEditar(rowid) {
    subtotal=parseFloat(document.getElementById("subtotal").value);
    var row = rowid.parentNode.parentNode;
    var tdtotal = row.children[9].innerHTML;
    var itemid = row.children[0].innerHTML;
    eliminaritem=eliminaritem+itemid+",";
  //  console.log(eliminaritem);
    var menossub = parseFloat(tdtotal);
    subtotal = subtotal - menossub;
    document.getElementById("subtotal").value = subtotal;
    document.getElementById("subtotal2").value = subtotal;
    row.parentNode.removeChild(row);
    CalcTotal();
    Mo();
}

$('#btn-ItemPresupuestoEditar').click(function() {
    subtotal=parseFloat(document.getElementById("subtotal").value);
    couneter = counter++;
    var descripcion = document.getElementById("descripcionpres").value;

    var textodescripcion = $("#descripcionpres option:selected").text();;

    var parte = "nopart";
    var tiposer = document.getElementById("gos_pres_servicio_id").value;
    var sec = document.getElementById("gos_seccion_id").value;
    var Pser = parseFloat(document.getElementById("precio_servicio").value);
    if (isNaN(Pser)) Pser = 0;
    var Ppin = parseFloat(document.getElementById("precio_pintura").value);
    if (isNaN(Ppin)) Ppin = 0;
    var Prefa = parseFloat(document.getElementById("precio_refacciones").value);
    if (isNaN(Prefa)) Prefa = 0;
    var CodOP = tiposer + sec;
    if (Ppin > 0) {
        CodOP = CodOP + "P";
    }
    if (Prefa > 0) {
        CodOP = CodOP + "R";
    }
    var totalItem=Pser+Ppin+Prefa;
    document.getElementById("subtotal").value = subtotal;
    document.getElementById("subtotal2").value = subtotal;
    $('#tbody_itemprod').append('<tr><td style="display: none;">0</td><td style="display: none;">'+ descripcion +'</td><td>'+textodescripcion+'</td><td><input class="form-control" type="text" value=""></td><td><input class="form-control" type="text" value=""></td><td>'+CodOP+'</td><td>'+Pser+'</td><td>'+Ppin+'</td><td>'+Prefa+'</td><td>'+totalItem+'</td><td><button onclick = "deleteRowEditar(this)" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td></tr>');
    document.getElementById("precio_servicio").value = 0;
    document.getElementById("precio_pintura").value = 0;
    document.getElementById("precio_refacciones").value = 0;
    document.getElementById("descripcion").value = 0;
    $('#descripcion').selectpicker('refresh');
    Mo();
    CalcTotal();
});

  $('#btneditar_presupuesto').click(function() {
        $('#modal-presupuesto').hide();
        var Reqst = $('#EditarPres').serialize();
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
            var ItemsarrayJson = JSON.stringify(items);
            var ELTiemsarrayJson = JSON.stringify(ELitems);
            var req=Reqst + '&Jsnitems=' + ItemsarrayJson+ '&JsnELitems=' +ELTiemsarrayJson;
            $.ajax({
                type: 'POST',
                url: '/orden-servicio-generada/presupuesto',
                data: req,
                success: function(data) {
                  console.log(data);
                   window.location.reload(true);
                }
            });
      //  window.location.reload(true);
    });

//------------------------




        function getselect() {
           var x =document.getElementById("selectdesc").getElementsByClassName("bs-searchbox")[0];
            var insert=x.childNodes[0].value;
            var obj = { name: insert, taller: 0};
            $.ajax({
                type: 'POST',
                url: '/Presupuesto/Agregar/NuevoConcepto',
                data: obj,
                success: function(data) {
                //    console.log(data);
                    $('#descripcionpres').append('<option value="'+data+'" selected>'+insert+'</option>');
                    $('#descripcionpres').selectpicker('refresh');
                }
            });
            document.getElementById('inputnewdescription').value="";
            $('#inputdesc').hide();
            $('#selectdesc').show();
        }

function changedesc(){

  var tipo =document.getElementById("desctipe").value;
  if (tipo=="%") {
    document.getElementById("desctipe").value="$";
     $('#descpor').hide();
     $('#descpes').show();
   }
  if (tipo=="$") {
    document.getElementById("desctipe").value="%";
    $('#descpor').show();
    $('#descpes').hide();
   }
   CalcTotal();
}

function UnirPresupuesto(){
  var valId=0;
   valId=$('#valuacion').val();
   console.log(valId);
  if (valId=='') {
    swal.fire('UPS... Olvidaste Seleccionar tipo de Valuación.',
    '',
    'error'
    )
  }
  if (valId!='') {

    var Presid=document.getElementById("presidunir").value
    if(Presid>0){
      $.ajax({
        type: 'get',
        url: '/Presupuestos/'+[Presid,valId]+'/Unir/',
        data: Presid,
        success: function(data) {

          alert(data);
          window.location.reload(true);
        }
      });
    }
      else {
        alert("El Presupuesto Se Generara Unido");
        $('#modal-presupuesto').hide();
        var Reqst = $('#EditarPres').serialize();
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
            var ItemsarrayJson = JSON.stringify(items);
            var ELTiemsarrayJson = JSON.stringify(ELitems);
            var req=Reqst + '&Jsnitems=' + ItemsarrayJson+ '&JsnELitems=' +ELTiemsarrayJson;
            $.ajax({
                type: 'POST',
                url: '/Presupuestos/crearyUnir',
                data: req,
                success: function(data) {
                    console.log(data);
                    window.location.reload(true);
                }
            });
        }
    }
  }

function ImprimirPres(id){

if(id==null){alert("Genere Presupuesto antes de Imprimir");}

if(id!=null){window.open('/Presupuestos/'+id+'/Imprimir', '_blank')}


}

function ImprimirPresHV(id){

if(id==null){alert("Genere Presupuesto antes de Imprimir");}

if(id!=null){window.open('/Presupuestos/'+id+'/Imprimir/HV', '_blank')}


}
