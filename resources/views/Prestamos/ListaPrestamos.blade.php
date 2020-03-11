@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Prestamos
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-actions">
                <button class="btn btn-brand btn-elevate btn-icon-sm" id="btn-Nuevo-Prestamo" style="width:150px;" type="button">
                    <i class="fa fa-plus kt-shape-font-color-1"></i> Nuevo
                </button>
            </div>
        </div>
    </div>
	<div class="kt-portlet__body p-2">
		<div class="table-responsive">
            <table class="table table-sm table-hover" id="dt-Prestamos">
				<thead class="thead-light">
					<tr>
                        <th class="text-center p-2">ID</th>
                        <th class="text-center p-2">Fecha</th>
                        <th class="text-center p-2">Empleado</th>
                        <th class="text-center p-2">Detalles</th>
                        <th class="text-center p-2">Monto</th>
                        <th class="text-center p-2">Saldo</th>
                        <th class="text-center p-2">Ultimo Pago</th>
						<th class="text-center p-2" style="width:3%;"></th>
					</tr>
                </thead>
               
			</table>
		</div>
	</div>
</div>
@include('Prestamos/ModalPrestamos')
@include('Prestamos/ModalPrestamosAbonar')
@include('Prestamos/ModalPrestamosHistorial')
@endsection

@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/ajax-prestamos.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
@endsection
