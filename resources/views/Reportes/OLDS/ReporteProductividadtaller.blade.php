@extends('Layout')

@section('estiloPorPagina')

@endsection

@section('Content')


<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Productividad Taller</h3>
        </div>
    </div>
    <div class="kt-portlet__body p-2">
      <div class="container-fluid">

      </div>
    </div>
</div>


@endsection
@section('ScriptporPagina')
<script src="{{env('APP_URL')}}/gos/Reportes/ajax-reporteVSM.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>

@endsection
