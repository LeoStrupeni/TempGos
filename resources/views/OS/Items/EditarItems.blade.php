<div class="border-top"><!---------------------------Begin Items--------------------------------------->
  <ul class="nav nav-pills my-4">
    <li class="nav-item">
      <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-etapa"> {{-- href="#collapseEtapa" --}}
        <i class="fas fa-plus"></i>Etapa
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-paquete"> {{-- href="#collapsePaquete" --}}
        <i class="fas fa-plus"></i>Paquete
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn btn-primary text-white" data-toggle="tab" role="tab" id="add-item-producto"> {{-- href="#collapseProducto" --}}
        <i class="fas fa-plus"></i>Producto
      </a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane" id="collapseEtapa" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="OS_ItemsEtapas_form">
        @csrf
        <input type="hidden" name="item_tipo" value="Etapa">
        <input type="hidden" name="gos_os_id_EtapaItem" id="gos_os_id_EtapaItem" value="{{isset($os)? $os->gos_os_id:0 }}">
        <input type="hidden" name="nomb_etapa" id="nomb_etapa">
        <input type="hidden" name="nomb_servicio" id="nomb_servicio">
        <input type="hidden" name="descripcion_etapa" id="descripcion_etapa">
        <input type="hidden" name="comision_asesor" id="comision_asesor">
        <input type="hidden" name="comision_asesor_tipo" id="comision_asesor_tipo">
        <input type="hidden" name="tiempo_meta" id="tiempo_meta">
        <input type="hidden" name="materiales" id="materiales">
        <input type="hidden" name="destajo" id="destajo">
        <input type="hidden" name="minimo_fotos" id="minimo_fotos">
        <input type="hidden" name="genera_valor" id="genera_valor">
        <input type="hidden" name="complemento" id="complemento">
        <input type="hidden" name="refacciones" id="refacciones">
        <input type="hidden" name="link" id="link">
        <div class="form-row">
          <div class="form-group col-6 col-sm-4 col-md-2">
            <label>Etapa</label>
            <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="gos_paq_etapa_id" id="gos_paq_etapa_id" onchange="MostrarSelectEtapa();">
              <option></option>
              @foreach ($listaEtapas as $etapa)
              <option value="{{$etapa->gos_paq_etapa_id}}"> {{$etapa->nomb_etapa}}</option>
              @endforeach
            </select>
          <small style="font-style: italic; display: none;" id="smallvaletapa" class=" form-text text-danger">Campo obligatorio</small>
          </div>
          <div class="form-group col-6 col-sm-4 col-md-2">
            <label>Servicio</label>
            <select class="form-control kt-selectpicker" data-size="5" data-live-search="true" name="gos_paq_servicio_id" id="gos_paq_servicio_id" onchange="MostrarSelectServicio();">
              <option></option>
              @foreach ($listaServicios as $servicio)
              <option value="{{$servicio->gos_paq_servicio_id}}"> {{$servicio->nomb_servicio}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-6 col-sm-4 col-md-3">
            <label>Descripción</label>
            <input type="text" class="form-control" name="descripcion_etapa" id="descripcion_etapa" value="" disabled>
          </div>
          <div class="form-group col-6 col-sm-4 col-md-2">
            <label>Asesor</label>
            <input type="text" class="form-control" name="asesor_asignado" id="asesor_asignado" value="" disabled>
           <input type="hidden" name="gos_usuario_tecnico_id" id="gos_usuario_tecnico_id" value="">
          </div>
          <div class="form-group col-5 col-sm-4 col-md-1">
            <label>Total</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text p-1">$</span>
              </div>
              <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_total" value="">
            </div>
          </div>
          <div class="form-group col-5 col-sm-3 col-md-1">
            <label>M. O.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text p-1">$</span>
                </div>
                <input type="text" class="form-control pl-1 pr-0" name="gos_etapa_MO" id="gos_etapa_MO" value="">
            </div>
          </div>
          <div class="form-group col-1 align-self-end">
              <button type="button" id="btn_ItemEtapaOS" class="btn btn-success" style="height:40px;">
                <i class="fas fa-plus p-0" style="color: white!important;"></i>
              </button>
          </div>

        </div>
      </form>
    </div>
    <div class="tab-pane" id="collapsePaquete" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="OS_ItemsPaquetes_form">
        @csrf
        <input type="hidden" name="item_tipo" value="Paquete">
        <input type="hidden" name="gos_os_id_PaqueteItem" id="gos_os_id_PaqueteItem" value="{{isset($os)? $os->gos_os_id:0 }}">
        <div class="form-row">
          <div class="form-group col-6 col-sm-3">
            <label>Paquete</label>
            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_paquete_id" id="gos_paquete_id">
              <option></option>
              @foreach ($listaPaquetes as $paquete)
              <option value="{{$paquete->gos_paquete_id}}">{{$paquete->nomb_paquete}}</option>
              @endforeach
            </select>
            <small style="font-style: italic; display: none;" id="smallvalpaquete" class=" form-text text-danger">Campo obligatorio</small>
          </div>
          <div class="form-group col-6 col-sm-3">
            <label>Descripción</label>
            <input type="text" class="form-control" name="descripcion_paquete" id="descripcion_paquete" disabled>
          </div>
          <div class="form-group col-5 col-sm-2">
            <label>Cantidad</label>
            <input type="text" class="form-control pl-1 pr-0" name="gos_paquete_cantidad" value="">
          </div>
          <div class="form-group col-5 col-sm-2">
            <label>P.Venta.</label>
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text p-1">$</span>
              </div>
              <input type="text" class="form-control pl-1 pr-0" name="gos_paquete_venta" value="">
            </div>
          </div>
          <div class="form-group col-1 col-sm-1 align-self-end">
              <button type="button" id="btn_ItemPaqueteOS" class="btn btn-success" style="height:40px;">
                <i class="fas fa-plus p-0" style="color: white!important;"></i>
              </button>
          </div>
        </div>
      </form>
    </div>
    <div class="tab-pane " id="collapseProducto" role="tabpanel">
      <form class="kt-form kt-form--label-right" id="OS_ItemsProductos_form">
        @csrf
        <input type="hidden" name="item_tipo" value="Producto">
        <input type="hidden" name="gos_os_id_ProductoItem" id="gos_os_id_ProductoItem" value="{{isset($os)? $os->gos_os_id:0 }}">
        <input type="hidden" name="descripcionProducto" id="descripcionProducto">
        <input type="hidden" name="codigo_sat" id="codigo_sat">
        <input type="hidden" name="nomb_producto" id="nomb_producto">
        <div class="form-row">
          <div class="form-group col-6 col-sm-3">
            <label>Código</label>
            <select class="form-control kt-selectpicker" data-size="6" data-live-search="true" name="gos_producto_id" id="gos_producto_id" onchange="MostrarSelectProducto();">
                <option></option>
                @foreach ($listaProductos as $producto)
                <option value="{{$producto->gos_producto_id}}">{{$producto->codigo}}</option>
                @endforeach
            </select>
          <small style="font-style: italic; display: none;" id="smallvalprod" class=" form-text text-danger">Campo obligatorio</small>
          </div>
          <div class="form-group col-6 col-sm-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nomb_producto_real" id="nomb_producto_real" value="" disabled>
          </div>
          <div class="form-group col-5 col-sm-2">
            <label>Cantidad</label>
            <input type="text" class="form-control pl-1 pr-0" name="gos_producto_cantidad"  value="1">
          </div>
          <div class="form-group col-5 col-sm-2">
            <label>P.Venta.</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text p-1">$</span>
              </div>
              <input type="text" class="form-control pl-1 pr-0" name="gos_producto_venta">
            </div>
          </div>
          <div class="form-group col-1 align-self-end">
              <button type="button" id="btn_ItemProductoOS" class="btn btn-success" style="height:40px;">
                <i class="fas fa-plus p-0" style="color: white!important;"></i>
              </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive table-sm p-1">
      <table class="table table-sm table-hover my-4" id="dt-lista-items-os" style="font-size: 1rem;">
          <thead class="thead-light">
              <tr style="font-weight: 500;">
                  <th>ID</th>
                  <th>Orden</th>
                  <th>Etapa</th>
                  <th>Descripción</th>
                  <th>Servicio</th>
                  <th>Código SAT</th>
                  <th>Asesor</th>
                  <th>Precio</th>
                  <th>Materiales</th>
                  <th>Importe</th>
                  <th style="width:3%;"></th>
              </tr>
          </thead>
          <tbody id="dt_lista_items_os_body">

          </tbody>
      </table>
      <small id="smalltableoscreate" class="form-text text-danger"></small>
  </div>
</div>
<div class="table-responsive table-sm p-1">
<table class="table table-sm table-hover my-4" id="dt-lista-producto-os" style="font-size: 1rem;">
					<thead class="thead-light">
						<tr style="font-weight: 500;">
							<th>ID</th>
							<th>Producto</th>
							<th>Descripción</th>
							<th>Código SAT</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Descuento</th>
							<th>Importe</th>
							<th style="width:3%;"></th>
						</tr>
					</thead>
					<tbody id="dt_lista_items_os_body">

					</tbody>
				</table>
      <small id="smalltableoscreate" class="form-text text-danger"></small>
  </div>
</div>
<div class="modal fade" id="modalAsignarAsesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tecnico Original:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form" id="formTecnicoServicios">
            <input type="hidden"  id="OSitemid" name="OSitemid"value="">
            <div class="form-row">
              <div class="col-md-12">
                <label for="">Tecnico</label>
                <select class="form-control kt-selectpicker" data-size="6" data-live-search="true"  name="Tecnico" id="selectecnico" >
                  <option value="0"></option>
                    <?php if ($listadoAsesores!=null): ?>
                      <?php foreach ($listadoAsesores as $tecnico): ?>
                              <option value="{{$tecnico->gos_usuario_id}}">{{$tecnico->nombre_apellidos}} | {{$tecnico->perfil}}</option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                </select>
              </div>

            </div>

           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="postAsesor" >Guardar</button>
        </div>
      </div>
    </div>
  </div><!---------------------------Begin Items--------------------------------------->
