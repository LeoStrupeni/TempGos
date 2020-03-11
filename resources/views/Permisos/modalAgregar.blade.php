<div class="container">



  <!-- Modal -->
  <div class="modal fade" id="myModalAgregar" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
					<h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal"></button>

        </div>
        <div class="modal-body">
					<label>Puesto</label>
          <form action="/permisos_add"role="form" name="PermisoForm" id="PermisoForm" method="post">
						@csrf
						<select class="form-control" name="selectPermisos">
		 					@foreach ($perfiles as $perfil)
		 							<option value="{{$perfil->gos_usuario_perfil_id}}">{{$perfil->nomb_perfil}}</option>
		 					@endforeach
		 			 </select>

					 <div class="form-group row">
						 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
							 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
							 <div class="col-5">
									 <label>Área</label>
							 </div>
							 <div class="col-1 mr-4 pl-0" style="">
									 <label>Agregar</label>
							 </div>
							 <div class="col-1 mr-4" style="">
									 <label>Editar</label>
							 </div>
							 <div class="col-1" style="">
									 <label>Ver</label>
							 </div>
							 <div class="col-1 mr-4" style="">
									 <label>Eliminar</label>
							 </div>

							 </div>
					 </div>
					 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
						 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
						 <div class="col-5">
								 <label>Clientes</label>
						 </div>
						 <div class="col-1" style="margin: 0 auto;">
							 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
							 <input value="1" name="agregarClientes" type="checkbox"><span></span>
						 </label>
						 </div>
						 <div class="col-1" style="margin: 0 auto;">
							 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
							 <input value="1"name="editarClientes"type="checkbox"><span></span>
						 </label>
						 </div>
						 <div class="col-1" style="margin: 0 auto;">
							 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
							 <input value="1"name="verClientes"type="checkbox"><span></span>
						 </label>
						 </div>
						 <div class="col-1" style="margin: 0 auto;">
							 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
							 <input value="1"name="eliminarClientes"type="checkbox"><span></span>
						 </label>
						 </div>
						 <div class="col-1" style="margin: 0 auto;">

						 </div>
						 </div>
				 </div>

				 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
					 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
					 <div class="col-5">
							 <label>Vehiculos</label>
					 </div>
					 <div class="col-1" style="margin: 0 auto;">
						 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
						 <input value="1" name="agregarVehiculos" type="checkbox"><span></span>
					 </label>
					 </div>
					 <div class="col-1" style="margin: 0 auto;">
						 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
						 <input value="1" name="editarVehiculos"type="checkbox"><span></span>
					 </label>
					 </div>
					 <div class="col-1" style="margin: 0 auto;">
						 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
						 <input value="1" name="verVehiculos"type="checkbox"><span></span>
					 </label>
					 </div>
					 <div class="col-1" style="margin: 0 auto;">
						 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
						 <input value="1" name="eliminarVehiculos"type="checkbox"><span></span>
					 </label>
					 </div>
					 <div class="col-1" style="margin: 0 auto;">

					 </div>
					 </div>
			 </div>
			 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
				 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
				 <div class="col-5">
						 <label>Presupuestos</label>
				 </div>
				 <div class="col-1" style="margin: 0 auto;">
					 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
					 <input value="1" name="agregarCot"type="checkbox"><span></span>
				 </label>
				 </div>
				 <div class="col-1" style="margin: 0 auto;">
					 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
					 <input value="1" name="editarCot"type="checkbox"><span></span>
				 </label>
				 </div>
				 <div class="col-1" style="margin: 0 auto;">
					 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
					 <input value="1" name="verCot"type="checkbox"><span></span>
				 </label>
				 </div>
				 <div class="col-1" style="margin: 0 auto;">
					 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
					 <input value="1" name="eliminarCot"type="checkbox"><span></span>
				 </label>
				 </div>
				 <div class="col-1" style="margin: 0 auto;">

				 </div>
				 </div>
		 </div>
		 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
			 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
			 <div class="col-5">
					 <label>Ordenes</label>
			 </div>
			 <div class="col-1" style="margin: 0 auto;">
				 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
				 <input value="1" name="agregarOrd"type="checkbox"><span></span>
			 </label>
			 </div>
			 <div class="col-1" style="margin: 0 auto;">
				 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
				 <input value="1" name="editarOrd"type="checkbox"><span></span>
			 </label>
			 </div>
			 <div class="col-1" style="margin: 0 auto;">
				 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
				 <input value="1" name="verOrd"type="checkbox"><span></span>
			 </label>
			 </div>
			 <div class="col-1" style="margin: 0 auto;">
				 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
				 <input value="1" name="eliminarOrd"type="checkbox"><span></span>
			 </label>
			 </div>
			 <div class="col-1" style="margin: 0 auto;">

			 </div>
			 </div>
	 </div>

	 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
		 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
		 <div class="col-5">
				 <label>Facturacion</label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="agregarFacturas"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="editarFacturas"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="verFacturas"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="eliminarFacturas"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">

		 </div>
		 </div>
 </div>

	 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
		 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
		 <div class="col-5">
				 <label>Paquetes</label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="agregarPaquetes"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="editarPaquetes"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="verPaquetes"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">
			 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
			 <input value="1" name="eliminarPaquetes"type="checkbox"><span></span>
		 </label>
		 </div>
		 <div class="col-1" style="margin: 0 auto;">

		 </div>
		 </div>
 </div>

 <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
	 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
	 <div class="col-5">
			 <label>Compras</label>
	 </div>
	 <div class="col-1" style="margin: 0 auto;">
		 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
		 <input value="1" name="agregarCompras"type="checkbox"><span></span>
	 </label>
	 </div>
	 <div class="col-1" style="margin: 0 auto;">
		 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
		 <input value="1" name="editarCompras"type="checkbox"><span></span>
	 </label>
	 </div>
	 <div class="col-1" style="margin: 0 auto;">
		 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
		 <input value="1" name="verCompras"type="checkbox"><span></span>
	 </label>
	 </div>
	 <div class="col-1" style="margin: 0 auto;">
		 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
		 <input value="1" name="eliminarCompras"type="checkbox"><span></span>
	 </label>
	 </div>
	 <div class="col-1" style="margin: 0 auto;">

	 </div>
	 </div>
</div>


<div class="col-12 kt-portlet kt-portlet--mobile mb-1">
 <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
 <div class="col-5">
		 <label>Equipo de Trabajo</label>
 </div>
 <div class="col-1" style="margin: 0 auto;">
	 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
	 <input value="1" name="agregarEdt"type="checkbox"><span></span>
 </label>
 </div>
 <div class="col-1" style="margin: 0 auto;">
	 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
	 <input value="1" name="editarEdt"type="checkbox"><span></span>
 </label>
 </div>
 <div class="col-1" style="margin: 0 auto;">
	 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
	 <input value="1" name="verEdt"type="checkbox"><span></span>
 </label>
 </div>
 <div class="col-1" style="margin: 0 auto;">
	 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
	 <input value="1" name="eliminarEdt"type="checkbox"><span></span>
 </label>
 </div>
 <div class="col-1" style="margin: 0 auto;">

 </div>
 </div>
</div>


<div class="col-12 kt-portlet kt-portlet--mobile mb-1">
<div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
<div class="col-5">
	 <label>Inventario</label>
</div>
<div class="col-1" style="margin: 0 auto;">
 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
 <input value="1" name="agregarInv"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
 <input value="1" name="editarInv"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
 <input value="1" name="verInv"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
 <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
 <input value="1" name="eliminarInv"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">

</div>
</div>
</div>

<div class="col-12 kt-portlet kt-portlet--mobile mb-1">
<div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
<div class="col-5">
 <label>Reportes</label>
</div>
<div class="col-1" style="margin: 0 auto;">
<label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
<input value="1" name="agregarRep"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
<label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
<input value="1" name="editarRep"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
<label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
<input value="1" name="verRep"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">
<label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
<input value="1" name="eliminarRep"type="checkbox"><span></span>
</label>
</div>
<div class="col-1" style="margin: 0 auto;">

</div>
</div>
</div>
					 <button type="submit" class="btn btn-success btn-block" id="">Guardar</button>
					 <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}" />



					</form>
        </div>

      </div>

    </div>
		</div>
		</div>
		</div>
