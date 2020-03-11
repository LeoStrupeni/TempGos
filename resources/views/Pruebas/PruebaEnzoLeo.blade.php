<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<div class="container m-auto border">
  <div class="my-4 border-top">
    <ul class="nav nav-pills mt-4" role="tablist">
      <li class="nav-item">
        <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapseEtapa" role="tab" onclick="changeColor(this)">
          <i class="fas fa-plus"></i>Etapa
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="collapseEtapa" role="tabpanel">
        {{-- <form id="productForm" name="productForm" class="form-horizontal"> --}}
        <form class="kt-form kt-form--label-right" id="formPrueba" name="FormPrueba">
            @csrf
              <div class="form-row">
                <div class="form-group col-3 mt-4 mb-2">
                    <label style="font-size: 0.8vw;">Etapa</label>
                    <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="os_etapa_id" id="os_etapa_id">
                      <option value="1">Prueba</option>
                      {{-- @foreach ($listaEtapas as $etapa) --}}
                      <option value="{{-- {{$etapa->gos_etapa_id}} --}}">{{-- {{$etapa->nomb_etapa}} --}}</option>
                      {{-- @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-2 mt-4 mb-2">
                  <label style="font-size: 0.8vw;">Descripción</label>
                  <input type="text" class="form-control" name="os_etapa_descripcion" id="os_etapa_descripcion"
                  value="" >
                </div>
                <div class="form-group col-2 mt-4 mb-2">
                  <label style="font-size: 0.8vw;">Asesor</label>
                  <input type="text" class="form-control" name="os_etapa_asesor_id" id="os_etapa_asesor_id"
                  value="">
                </div>
                <div class="form-group col-2 mt-4 mb-2">
                  <label style="font-size: 0.8vw;">Total</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                      </div>
                      <input type="text" class="form-control" name="os_etapa_total" id="os_etapa_total"
                      value="" >
                  </div>
                </div>
                <div class="form-group col-2 mt-4 mb-2">
                  <label style="font-size: 0.8vw;">M. O.</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                      </div>
                      <input type="number" class="form-control" name="os_etapa_MO" id="os_etapa_MO"
                      value="" >
                  </div>
                </div>
                <button type="submit" id="boton-ajax" value="btn"
                 class="btn btn-success align-self-end mb-2" style="height:35.6px; width:40px;">
                    <i class="fas fa-plus p-0" style="color: white!important;"></i>
                </button>
                {{-- <button type="submit"  id="saveBtn" value="create" class="btn btn-primary">Save changes</button> --}}
            </div>
        </form>
      </div>
    </div>
  
    <div class="kt-section my-3">
      <div class="kt-section__content">
        <div class="table-responsive">
          <table class="table table-sm table-hover">
            <thead class="thead-light">
              <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Codigo SAT</th>
                <th>Asesor</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Materiales</th>
                <th>Descuento</th>
                <th>Importe</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function changeColor (htmlEl){
    htmlEl.style.backgroundColor="#0abb87";
  }
</script>

{{-- <script>
$(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    $('#boton-ajax').click( function(){
        $.ajax({
            type:"POST",
            url : '/prueba-ajax-enzo-post',
            data:$('#formPrueba').serialize(),
            dataType: 'json',
            sucess: function(data){
              console.log('Prueba', data);
            //Codigo para llamar a la ruta del OrdenDeServicioController-->refrescaItemsOrdenServici(id) que traiga
            //JSON POR FAVOR PARA MI GRILLA AJAX
          }
    });//end ajax
  });//end click
});//end rdy
</script> --}}

<script>
  $('#boton-ajax').click(function (e) {
    e.preventDefault();
    $(this).html('Sending..');
    
    $.ajax({
      data: $('#formPrueba').serialize(),
      url: "/prueba-ajax-enzo-post",
      type: "POST",
      dataType: 'json',

      success: function (data) {
        console.log('FUNCIONA')
      },

      error: function (data) {
          console.log('ERROR');
      }
    });
  });
</script>



</body>
</html>