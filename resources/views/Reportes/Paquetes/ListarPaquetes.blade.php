@extends('Layout')

@section('Content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Paquetes
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <button class="btn btn-brand btn-elevate btn-icon-sm" id="Paquete-Nuevo" style="width:150px;" type="button">
                        <i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-sm table-hover" id="dt-Paquetes">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th class="text-center" style="width:3%;"></th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>

@include('Paquetes/modalPaquete')

@endsection

@section('ScriptporPagina')

<script src="{{env('APP_URL')}}/gos/ajax-paquete.js"></script>
{{-- <script src="{{env('APP_URL')}}/gos/js/PAQ-items.js"></script> --}}

@endsection