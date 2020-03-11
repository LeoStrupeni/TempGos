
<div class="border-top">
  <ul style="margin:3%;" class="nav nav-pills mt-4">
    <li class="nav-item">


      <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapsePresupuesto" role="tab" id="add-item-presupuesto">
        <i class="fas fa-plus"></i>Presupuesto
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapsePaquete" role="tab" id="add-item-paquete">
        <i class="fas fa-plus"></i>Paquete
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn btn-primary text-white" data-toggle="tab" href="#collapseProducto" role="tab" id="add-item-producto">
        <i class="fas fa-plus"></i>Producto
      </a>
    </li>
  </ul>
  <div class="tab-content">

    <div class="tab-pane" id="collapsePresupuesto" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="ItemsPresupuestos_form">

        {{ csrf_field() }}
        <div class="form-row">
          <div class="row col-12 col-md-12">
            <div class="col-12 col-sm-8 col-lg-3 col-xl-3 mt-4 mb-2">
              <label>Descripción</label>
              <div class="input-group" id="inpgrpdesc">

                <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="" id="descripcion">
                  @isset($listaConceptos)
                  <option value="0">Agregar</option>
                    @foreach ($listaConceptos as $concepto)
                    <option value="{{$concepto->gos_pres_concepto_id}}"> {{$concepto->nomb_concepto}}</option>
                    @endforeach
                  @else
                    <option value="0">Agregar</option>
                  @endisset
                </select>
                <div class="input-group-append">
                  <button class="btn btn-brand p-1" type="button"name="button" onclick="getselect();">
                    <i class="fas fa-plus p-0" style="color: white!important;"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class=" col-6 col-sm-6 col-lg-4 col-xl-2 mt-2 mb-2">
              <label >Tipo Servicio</label>
              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_pres_servicio_id" id="gos_pres_servicio_id">
                @isset($listaServicios)
                  @foreach ($listaServicios as $servicio)
                  <option value="{{$servicio->gos_servicio_taller_id}}"> {{$servicio->nomb_servicio}}</option>
                  @endforeach
                @else
                  <option value="C">Cambio</option>
                  <option value="R">Reparación</option>
                  <option value="D">D/M</option>
                @endisset
              </select>
            </div>
            <div class=" col-6 col-sm-6 col-lg-4 col-xl-2 mt-4 mb-2">
              <label >Sección</label>
              <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_seccion_id" id="gos_seccion_id" onchange="">
                @isset($listaSeccion)
                  @foreach ($listaSeccion as $seccion)
                  <option value="{{$seccion->gos_seccion_taller_id}}"> {{$seccion->nomb_seccion}}</option>
                  @endforeach
                @else
                  <option value="L">Laminado</option>
                  <option value="M">Mecánica</option>
                  <option value="T">Tot</option>
                @endisset
              </select>
            </div>

            {{-- <div class=" col-2 mt-4 mb-2">
              <label >Asesor</label>
              <input type="text" class="form-control" name="gos_etapa_asesor_id" id="gos_etapa_asesor_id"
              disabled>
            </div> --}}

            <div class="col-4 col-sm-3 col-lg-3 col-xl-1 mt-4 mb-2">
              <label >Servicio</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text p-1">$</span>
                </div>
                <input type="text" class="form-control" name="precio_servicio" id="precio_servicio" value="0" min="0">
              </div>
            </div>
            <div class="col-4 col-sm-3 col-lg-4 col-xl-1 mt-4 mb-2">
              <label >Pintura</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text p-1">$</span>
                  </div>
                  <input type="text" class="form-control" name="precio_pintura" id="precio_pintura" value="0" min="0">
              </div>
            </div>
            <div class="col-4 col-sm-3 col-lg-3 col-xl-1 mt-4 mb-2">
              <label >Refaccion</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text p-1">$</span>
                  </div>
                  <input type="text" class="form-control" name="precio_refacciones" id="precio_refacciones" value="0" min="0">
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-1 align-self-end">
                <button type="button" id="btn-ItemPresupuesto" class="btn btn-block btn-success mb-2" style="height:40px;">
                  <i class="fas fa-plus p-0" style="color: white!important;"></i>
                </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="tab-pane" id="collapsePaquete" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="ItemsPaquetes_form">
        {{ csrf_field() }}
        <input type="hidden" name="Item-Tipo" value="Paquete">
        <input type="hidden" name="gos_os_id" value="{{isset($os)?$os->gos_os_id:0}}">
        <input type="hidden" name="gos_taller_id" value="1">

        <div class="form-row">
        <div class="row col-12 col-sm-6">
          <div class="col-6 col-md-6 col-sm-6 col-lg-6 mt-4 mb-2">
            <label >Paquete</label>
            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paquete_id" id="gos_paquete_id" onchange="MostrarSelectPaquete();">
              @isset($listapaquetes)
                @foreach ($listapaquetes as $paquete)
                <option value="{{$paquete->gos_paquete_id}}">{{$paquete->nomb_paquete}}</option>
                @endforeach
              @endisset
            </select>
          </div>
          <div class="col-6 col-md-6 col-sm-6 col-lg-6 mt-4 mb-2">
            <label >Descripción</label>
            <input type="text" class="form-control" name="descripcion_paquete" id="descripcion_paquete"
            disabled>
          </div>
          </div>
          <div class="row col-12 col-sm-6">
          <div class="col-6 col-md-5 col-lg-5 col-sm-5 mt-4 mb-2">
            <label >Cantidad</label>
            <input type="text" class="form-control" name="gos_paquete_cantidad" value="">
          </div>
          <div class="col-5 col-sm-6 col-lg-6 col-sm-6 mt-4 mb-2">
            <label >P.Venta.</label>
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text p-1">$</span>
              </div>
              <input type="text" class="form-control" name="gos_paquete_venta" value="">
            </div>
          </div>
          <div class="col-1  col-lg-1 col-sm-1 mb-2 align-self-end">
              <button type="button" id="btn_ItemPaquete" class="btn btn-success" style="height:35.6px;">
                <i class="fas fa-plus p-0" style="color: white!important;"></i>
              </button>
          </div>
          </div>
        </div>
      </form>
    </div>


    <div class="tab-pane " id="collapseProducto" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="ItemsProductos_form">
        {{ csrf_field() }}
        <input type="hidden" name="Item-Tipo" value="Producto">
        <input type="hidden" name="gos_os_id" value="{{isset($os)?$os->gos_os_id:0}}">
        <input type="hidden" name="gos_taller_id" value="1">

        <div class="form-row">
        <div class="row col-12 col-md-6">
          <div class="col-6 col-md-6 col-sm-6 col-lg-6 mt-4 mb-2">
            <label >Código</label>
            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true"
              name="gos_producto_id" id="gos_producto_id" onchange="MostrarSelectProducto();">
              @isset($listaProductos)
                @foreach ($listaProductos as $producto)
                <option value="{{$producto->gos_producto_id}}">{{$producto->gos_producto_id}}</option>
                @endforeach
              @endisset
            </select>
          </div>
          <div class="col-6 col-md-6 col-sm-6 col-lg-6 mt-4 mb-2">
            <label >Nombre</label>
            <input type="text" class="form-control" name="nomb_producto" id="nomb_producto"
            disabled>
          </div>
          </div>
          <div class="row col-12 col-sm-6">
          <div class="col-6 col-md-5 col-lg-5 col-sm-5 mt-4 mb-2">
            <label >Cantidad</label>
            <input type="text" class="form-control" name="gos_producto_cantidad" value="">
          </div>
          <div class="col-5 col-sm-6 col-lg-6 col-sm-6 mt-4 mb-2">
            <label >P.Venta.</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text p-1">$</span>
              </div>
              <input type="number" class="form-control" name="gos_producto_venta" value="">
            </div>
          </div>
          <div class="col-1  col-lg-1 col-sm-1 mb-2 align-self-end">
              <button type="button" id="btn_ItemProducto" class="btn btn-success" style="height:35.6px;">
                <i class="fas fa-plus p-0" style="color: white!important;"></i>
              </button>
          </div>
        </div>
        </div>
      </form>
    </div>
  </div>

  <div class="table-responsive table-bordered table-striped  p-1">
    <table class="table table-sm table-hover" id="dt-lista-items-presupuesto">
      <thead  class="thead-light">
        <tr>
          <th class="p-2">id</th>
          <th class="p-2">Descripcion</th>
          <th class="p-2">#Parte</th>
          <th class="p-2">Observaciones</th>
          <th class="p-2">#NM</th>
          <th class="p-2">Servicio</th>
          <th class="p-2">Pintura</th>
          <th class="p-2">Refacción</th>
          <th class="p-2">total</th>
          <th style="width:3%;"></th>
        </tr>
      </thead>
      <tbody id="tbody_itemprod">

      </tbody>

    </table>
     <label  id="errorespresupuestositms" style="display: none; color:red;">Agregar Item</label>
  </div>
</div>
