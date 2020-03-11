 @extends('Layout') @section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Proveedores
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
          <?php

					$auth = Session::get('Compras');

					if($auth == null)
					{
						$auth=0;

					}
					else {
						$auth = $auth[0]->agregar;
					}

					if ($auth): ?>
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="NuevoProveedor" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
          <?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body p-1">
		<div class="table-responsive">
			<table class="table table-sm table-hover" id="dt-proveedores">
				<thead class="thead-light">
					<tr>
						<th>#Proveedor</th>
						<th>Nombre del Proveedor</th>
						<th>Contacto</th>
						<th>Teléfono</th>
						<th>Email</th>
						<th>Saldo pendiente</th>
						<th style="width: 3%;"></th>
					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>

@include('Proveedores/modalProveedores')
@include('Proveedores/ModalComprasProveedor')
@include('Proveedores/modalPagos')
@include('Proveedores/modalCompra')

@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/ajax-proveedores.js"></script>
{{-- <script src="{{env('APP_URL')}}/gos/ajax-compras.js"></script> --}}
@endsection
