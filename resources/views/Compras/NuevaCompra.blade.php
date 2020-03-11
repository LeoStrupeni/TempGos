@extends( 'Layout' )

@section( 'Content' )
    <link rel="stylesheet" href="../gos/css/menu_vertical.css">
    <div class="kt-portlet kt-portlet--mobile" id="modal-compra-1" >
        <div class='container-fluid'>
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">{{isset($compra->gos_compra_id) ? 'Editar compra' : 'Nueva compra'}}</h3>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body p-2">
            <div class='container-fluid p-0' style="margin-top: 2rem;">
                @include('Compras/EditarCompras_Desglose/EditarCompra')
            </div>
            <div class='container-fluid p-0'>
                @include('Compras/EditarCompras_Desglose/EditarCierre')
            </div>
            @include('Compras/EditarCompras_Desglose/ModalGuardar')
            @include('Compras/EditarCompras_Desglose/ModalCompraUnida')
        </div>
    </div>
    <input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>
@endsection

@section('ScriptporPagina')
    {{-- <script src="{{env('APP_URL')}}/gos/InventarioInterno/ajax-productos.js"></script>     --}}
    <script src="{{env('APP_URL')}}/gos/ajax-compras.js"></script>
@endsection
