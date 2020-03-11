  var counter = 0;
  var subtotal = 0;
  var errores = 0;
  var Manodeobra=0;
  var Manoobrapintura=0;
  var Manoobrarefacciones=0;
  var eliminaritem="";


  $(document).ready(function() {
       console.log("ondocready jsitempres");
       CalcTotal();
       Mo();
  });


  $('#btn-ItemPresupuesto').click(function() {
      couneter = counter++;
      var descripcion = document.getElementById("descripcion").value;
      if (descripcion == "") {
          descripcion = "ND";
      }
      var textodescripcion = $("#descripcion option:selected").text();;
      if (textodescripcion == "") {
          textodescripcion = "ND";
      }
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
      var totalItem = Pser + Ppin + Prefa;
      subtotal = subtotal + totalItem;
      document.getElementById("subtotal").value = subtotal;
      document.getElementById("subtotal2").value = subtotal;
      $('#tbody_itemprod').append('<tr><td>' + counter + '</td><td style="display: none;">' + descripcion + '</td><td >' + textodescripcion + '</td><td><input class="form-control" type="text" value="' + parte + '"></td><td><input class="form-control" type="text" value="..."></td><td>' + CodOP + '</td><td>' + Pser + '</td><td>' + Ppin + '</td><td>' + Prefa + '</td><td>' + totalItem + '</td><td> <button onclick = "deleteRow(this)" type="button" id="eliminar-item" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td></tr>');
      document.getElementById("precio_servicio").value = 0;
      document.getElementById("precio_pintura").value = 0;
      document.getElementById("precio_refacciones").value = 0;
      document.getElementById("descripcion").value = 0;
      $('#descripcion').selectpicker('refresh');
      CalcTotal();
      Mo();
  });

  $('#btnguardar_presupuesto').click(function() {
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
          var req = cliente + '&' + totales + '&Jsnitems=' + ItemsarrayJson;
          $.ajax({
              type: 'POST',
              url: '/Presupuestos/Agregar',
              data: req,
              success: function(data) {
                  console.log(data);
              }
          });
          window.location = "/ListarPresupuestos"
      }
  });

  function deleteRow(rowid) {
      var row = rowid.parentNode.parentNode;
      var tdtotal = row.childNodes[9];
      var menossub = parseFloat(tdtotal.firstChild.nodeValue);
      subtotal = subtotal - menossub;
      document.getElementById("subtotal").value = subtotal;
      document.getElementById("subtotal2").value = subtotal;
      row.parentNode.removeChild(row);
      CalcTotal();
      Mo();
  }

  function CalcTotal() {
      var Subtotal = parseFloat(document.getElementById("subtotal2").value);
      if (isNaN(Subtotal)) Subtotal = 0;
      var Descuento = parseFloat(document.getElementById("descuento").value);

      if (isNaN(Descuento)) Descuento = 0;
      var Iva = parseFloat(document.getElementById("iva").value);
      if (isNaN(Iva)) Iva = 0;
      if (Descuento > 0) {
          var desct=document.getElementById("desctipe").value;
          console.log(desct);
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

  function Validar() {
      errores = 0;
      var x = document.getElementById("errorespresupuestos");
      var Ecl = document.getElementById("errorespresupuestoscliente");
      var Evh = document.getElementById("errorespresupuestosvehi");
      var Epol = document.getElementById("errorespresupuestospol");
      var Esin = document.getElementById("errorespresupuestossin");
      var Ekm = document.getElementById("errorespresupuestoskm");
      var Edt = document.getElementById("errorespresupuestosdt");
      var Eitm = document.getElementById("errorespresupuestositms");
      var Edesc = document.getElementById("errorespresupuestosdesc");
      $(x).empty()
      var cliente = document.getElementById('nomb_cliente').value;
      var Vehiculo = document.getElementById('detallesVehiculo').value;
      var poliza = document.getElementById('nro_poliza').value;
      var sin = document.getElementById('nro_siniestro').value;
      var kilometraje = document.getElementById('kilometraje').value;

      var items = document.getElementById("tbody_itemprod").rows.length;
      if (cliente == "") {
          errores = errores + 1;
          Ecl.style.display = "block";
      } else {
          Ecl.style.display = "none";
      }

      if (Vehiculo == "") {
          errores = errores + 1;
          Evh.style.display = "block";
      } else {
          Evh.style.display = "none";
      }

      if (poliza == "") {
          errores = errores + 1;
          Epol.style.display = "block";
      } else {
          Epol.style.display = "none";
      }

      if (sin == "") {
          errores = errores + 1;
          Esin.style.display = "block";
      } else {
          Esin.style.display = "none";
      }

      if (kilometraje == "") {
          errores = errores + 1;
          Ekm.style.display = "block";
      } else {
          Ekm.style.display = "none";
      }
      if (items == 0) {
          errores = errores + 1;
          Eitm.style.display = "block";
      } else {
          Eitm.style.display = "none";
      }

      if (errores>0) {
        swal.fire('UPS... Olvidaste llenar algunos campos.',
        '',
        'error'
        )
      }

      return (errores);
  }

  function Mo(){
    subtotal=0;
    molam=0;
    momec=0;
    motot=0;
    MPin=0;
    Manoobrarefacciones=0;
    manoPintura=0;
    var table = document.getElementById('tbody_itemprod');
    var tablelength = document.getElementById("tbody_itemprod").rows.length;
        for (var i = 0; i < tablelength; i++) {
          var SerT=(table.children[i].children[5].innerHTML);
          var ser=parseFloat((table.children[i].children[6].innerHTML));
          var MPin=parseFloat((table.children[i].children[7].innerHTML));
          var ref=parseFloat((table.children[i].children[8].innerHTML));
          var totalitem=parseFloat((table.children[i].children[9].innerHTML));
          Manoobrarefacciones=Manoobrarefacciones+ref;
          manoPintura=manoPintura+MPin;
          subtotal=subtotal+totalitem;
          var splitsert=SerT.split("");
          //sconsole.log(splitsert[1]);
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
        document.getElementById("PPintura").value = manoPintura;
        document.getElementById("manoobraref").value = Manoobrarefacciones;
        document.getElementById("subtotal").value = subtotal;
        document.getElementById("subtotal2").value = subtotal;
  }

  //_____________________________________________EDITAR PRESUPUESTO______________________________
  function deleteRowEditar(rowid) {
      subtotal=parseFloat(document.getElementById("subtotal").value);
      var row = rowid.parentNode.parentNode;
      var tdtotal = row.children[9].innerHTML;
      var itemid = row.children[0].innerHTML;
      eliminaritem=eliminaritem+itemid+",";
      var menossub = parseFloat(tdtotal);
      if (isNaN(menossub)) menossub = 0;
      subtotal = subtotal - menossub;
      row.parentNode.removeChild(row);
      CalcTotal();
      Mo();
  }
  $('#btn-ItemPresupuestoEditar').click(function() {
      subtotal=parseFloat(document.getElementById("subtotal").value);
      couneter = counter++;
      var descripcion = document.getElementById("descripcion").value;
      if (descripcion == "") {
          descripcion = "ND";
      }
      var textodescripcion = $("#descripcion option:selected").text();;
      if (textodescripcion == "") {
          textodescripcion = "ND";
      }
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
      var totalItem = Pser + Ppin + Prefa;
      subtotal = subtotal + totalItem;
      document.getElementById("subtotal").value = subtotal;
      document.getElementById("subtotal2").value = subtotal;
      $('#tbody_itemprod').append('<tr><td style="display: none;">0</td><td style="display: none;">'+ descripcion +'</td><td>'+textodescripcion+'</td><td><input class="form-control" type="text" value=""></td><td><input class="form-control" type="text" value=""></td><td>'+CodOP+'</td><td>'+Pser+'</td><td>'+Ppin+'</td><td>'+Prefa+'</td><td>'+totalItem+'</td><td><button onclick = "deleteRowEditar(this)" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td></tr>');
      document.getElementById("precio_servicio").value = 0;
      document.getElementById("precio_pintura").value = 0;
      document.getElementById("precio_refacciones").value = 0;
      document.getElementById("descripcion").value = 0;
      $('#descripcion').selectpicker('refresh');
      CalcTotal();
      Mo();
  });
  $('#btneditar_presupuesto').click(function() {
      var val = Validar();
      //console.log(val + "val");
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
      if (val == "0") {
          var ItemsarrayJson = JSON.stringify(items);
          var ELTiemsarrayJson = JSON.stringify(ELitems);
          var req=Reqst + '&Jsnitems=' + ItemsarrayJson+ '&JsnELitems=' +ELTiemsarrayJson;
          $.ajax({
              type: 'POST',
              url: '/Presupuestos/Qualitas/{osid}/Editar',
              data: req,
              success: function(data) {

              }
          });
        window.location = "/ListarPresupuestos"
      }
  });

//------------------------
function getselect() {
  var x =document.getElementById("inpgrpdesc").getElementsByClassName("bs-searchbox")[0];
  var insert=x.childNodes[0].value;
  var obj = { name: insert, taller: 0};
  $.ajax({
      type: 'POST',
      url: '/Presupuesto/Agregar/NuevoConcepto',
      data: obj,
      success: function(data) {
          console.log(data);
          $('#descripcion').append('<option value="'+data+'" selected>'+insert+'</option>');
          $('#descripcion').selectpicker('refresh');
      }
  });
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
