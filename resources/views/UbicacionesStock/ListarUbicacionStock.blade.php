@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Ubicacion Stock
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<button class="btn btn-brand btn-elevate btn-icon-sm" id="nuevaUbicacionStock" style="width:150px;" type="button">
						<i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
					</button>
                </div>
            </div>
        </div>
    </div>
	<div class="kt-portlet__body">
		<div class="table-responsive">
            <table class="table table-sm table-hover" id="Ubicaciones-stock-DataTable">
                <thead class="thead-light">
                    <tr>
											  <th>ID</th>
                        <th>Producto</th>
                        <th>Ubicacion</th>
                        <th>Concepto</th>
                        <th>Fecha</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                        <th>Costo</th>
                        <th class="text-center" style="width:3%;"></th>
                    </tr>
                </thead>
            </table>
		</div>
	</div>
</div>
@include('UbicacionesStock/modalUbicacionStock')
@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/InventarioInterno/ajax-ubicaciones-stock.js"></script>
@endsection
