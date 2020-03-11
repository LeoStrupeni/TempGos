@extends('Layout')

@section('Content')
<div class="container-fluid">
    @if (session('notification'))
        <div class="alert alert-success">
            {{session('notification')}}
        </div> 
    @endif
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors->all() as $error): ?>
            <li>{{ $error }}</li>
            <?php endforeach; ?>
        </ul>
    </div>
    @endif
</div> 
<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-primary">
				Permisos
			</h3>
		</div>
	</div>
    @csrf
	<div class="kt-portlet__body p-2">
        <div class="row">
            <div class="col-1 col-md-2 col-lg-4" ></div>
            <div class="col-10 col-md-6  col-lg-4">
                <div class="container border mt-2 mb-2">
                    <form action="/editarPermisosPost"role="form" name="PermisoForm"  method="post">
                        @csrf
                        <input type="hidden" name="asdf">
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
                                    <?php if ($clientes != null): ?>
                                        <?php if ($clientes[0]->agregar ==1): ?>
                                        <input value="1" name="agregarClientes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarClientes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($clientes != null): ?>
                                        <?php if ($clientes[0]->editar ==1): ?>
                                        <input value="1"name="editarClientes"type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1"name="editarClientes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($clientes != null): ?>
                                        <?php if ($clientes[0]->ver ==1): ?>
                                        <input value="1"name="verClientes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1"name="verClientes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    {{-- <input value="1"name="verClientes" type="checkbox"><span></span> --}}
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                        <?php if ($clientes != null): ?>
                                            <?php if ($clientes[0]->eliminar ==1): ?>
                                            <input value="1"name="eliminarClientes" type="checkbox" checked><span></span>
                                            <?php else: ?>
                                            <input value="1"name="eliminarClientes" type="checkbox"><span></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Vehiculos</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($vehiculos): ?>
                                        <?php if ($vehiculos[0]->agregar ==1): ?>
                                        <input value="1" name="agregarVehiculos" type="checkbox"checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarVehiculos" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($vehiculos): ?>
                                        <?php if ($vehiculos[0]->editar ==1): ?>
                                        <input value="1" name="editarVehiculos" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarVehiculos" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($vehiculos): ?>
                                        <?php if ($vehiculos[0]->ver ==1): ?>
                                        <input value="1" name="verVehiculos" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verVehiculos" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($vehiculos): ?>
                                        <?php if ($vehiculos[0]->eliminar ==1): ?>
                                        <input value="1" name="eliminarVehiculos" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarVehiculos" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Presupuestos</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($presupuestos): ?>
                                        <?php if ($presupuestos[0]->agregar ==1): ?>
                                        <input value="1" name="agregarCot" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarCot" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($presupuestos): ?>
                                        <?php if ($presupuestos[0]->editar ==1): ?>
                                        <input value="1" name="editarCot" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarCot" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($presupuestos): ?>
                                        <?php if ($presupuestos[0]->ver ==1): ?>
                                        <input value="1" name="verCot" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verCot" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($presupuestos): ?>
                                        <?php if ($presupuestos[0]->eliminar ==1): ?>
                                        <input value="1" name="eliminarCot" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarCot" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Ordenes</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($ordenes): ?>
                                        <?php if ($ordenes[0]->agregar ==1): ?>
                                        <input value="1" name="agregarOrd" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarOrd" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($ordenes): ?>
                                        <?php if ($ordenes[0]->editar ==1): ?>
                                        <input value="1" name="editarOrd" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarOrd" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($ordenes): ?>
                                        <?php if ($ordenes[0]->ver ==1): ?>
                                        <input value="1" name="verOrd" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verOrd" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($ordenes): ?>
                                        <?php if ($ordenes[0]->eliminar ==1): ?>
                                        <input value="1" name="eliminarOrd" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarOrd" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Facturacion</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($facturacion): ?>
                                        <?php if ($facturacion[0]->agregar == 1): ?>
                                        <input value="1" name="agregarFacturas" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarFacturas" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($facturacion): ?>
                                        <?php if ($facturacion[0]->editar == 1): ?>
                                        <input value="1" name="editarFacturas" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarFacturas" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($facturacion): ?>
                                        <?php if ($facturacion[0]->ver == 1): ?>
                                        <input value="1" name="verFacturas" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verFacturas" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($facturacion): ?>
                                        <?php if ($facturacion[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarFacturas" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarFacturas" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Paquetes</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($paquetes): ?>
                                        <?php if ($paquetes[0]->agregar == 1): ?>
                                        <input value="1" name="agregarPaquetes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarPaquetes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($paquetes): ?>
                                        <?php if ($paquetes[0]->editar == 1): ?>
                                        <input value="1" name="editarPaquetes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarPaquetes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($paquetes): ?>
                                        <?php if ($paquetes[0]->ver == 1): ?>
                                        <input value="1" name="verPaquetes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verPaquetes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($paquetes): ?>
                                        <?php if ($paquetes[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarPaquetes" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarPaquetes" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Compras</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($compras): ?>
                                        <?php if ($compras[0]->agregar == 1): ?>
                                        <input value="1" name="agregarCompras" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarCompras" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($compras): ?>
                                        <?php if ($compras[0]->editar == 1): ?>
                                        <input value="1" name="editarCompras" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarCompras" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($compras): ?>
                                        <?php if ($compras[0]->ver == 1): ?>
                                        <input value="1" name="verCompras" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verCompras" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($compras): ?>
                                        <?php if ($compras[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarCompras" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarCompras" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Equipo de Trabajo</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($equipodetrabajo): ?>
                                        <?php if ($equipodetrabajo[0]->agregar == 1): ?>
                                        <input value="1" name="agregarEdt" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarEdt" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($equipodetrabajo): ?>
                                        <?php if ($equipodetrabajo[0]->editar == 1): ?>
                                        <input value="1" name="editarEdt" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarEdt" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($equipodetrabajo): ?>
                                        <?php if ($equipodetrabajo[0]->ver == 1): ?>
                                        <input value="1" name="verEdt" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verEdt" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($equipodetrabajo): ?>
                                        <?php if ($equipodetrabajo[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarEdt" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarEdt" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Inventario</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($inventario): ?>
                                        <?php if ($inventario[0]->agregar == 1): ?>
                                        <input value="1" name="agregarInv" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarInv" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($inventario): ?>
                                        <?php if ($inventario[0]->editar == 1): ?>
                                        <input value="1" name="editarInv" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarInv" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($inventario): ?>
                                        <?php if ($inventario[0]->ver == 1): ?>
                                        <input value="1" name="verInv" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verInv" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($inventario): ?>
                                        <?php if ($inventario[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarInv" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarInv" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <div class="col-12 kt-portlet kt-portlet--mobile mb-1">
                            <div class="kt-widget__head row" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                <div class="col-5">
                                    <label>Reportes</label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($reportes): ?>
                                        <?php if ($reportes[0]->agregar == 1): ?>
                                        <input value="1" name="agregarRep" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="agregarRep" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($reportes): ?>
                                        <?php if ($reportes[0]->editar == 1): ?>
                                        <input value="1" name="editarRep" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="editarRep" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($reportes): ?>
                                        <?php if ($reportes[0]->ver == 1): ?>
                                        <input value="1" name="verRep" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="verRep" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;">
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                    <?php if ($reportes): ?>
                                        <?php if ($reportes[0]->eliminar == 1): ?>
                                        <input value="1" name="eliminarRep" type="checkbox" checked><span></span>
                                        <?php else: ?>
                                        <input value="1" name="eliminarRep" type="checkbox"><span></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </label>
                                </div>
                                <div class="col-1" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-3 mb-3" id="">Guardar</button>
                        <?php if ($test != null): ?>
                            <input type="hidden" id="perfilId" name="perfilId" value="{{$test}}" />
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="col-1 col-md-2 col-lg-4"></div>
        </div>
    </div>
</div>
<input type="hidden" id="app_url" name="app_url" url="{{env('APP_URL')}}"/>

@endsection

@section('ScriptporPagina')

@endsection
