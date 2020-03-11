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
                  <?php

                  $auth = Session::get('Paquetes');

                  if($auth == null)
                  {
                    $auth=0;

                  }
                  else {
                    $auth = $auth[0]->agregar;
                  }

                  if ($auth): ?>
                    <button class="btn btn-brand btn-elevate btn-icon-sm" id="Paquete-Nuevo" style="width:150px;" type="button">
                        <i class="fa fa-plus kt-shape-font-color-1"></i>Agregar
                    </button>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="table-responsive table-sm p-1">
            <table class="table table-sm table-hover" id="dt-Paquetes" style="font-size: 1rem;">
                <thead class="thead-light">
                    <tr style="font-weight: 500;">
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
