<style>
    div#seccionActiva {
    height: 100%!important;
    display: grid;
    }
    img {
    margin-top: -1.75rem;
    }
    img#vehiculotipoidcanvasover {
    width: 100%!important;
    height: 100%!important;
    }


    @media screen and (max-width: 1020px) {
        #canvas {
            width: 100%!important;
            background-size: 100% !important;
        }
        div#seccionGolpes {
        height: 100%!important;
        }
        .wrapper-autos{
            height:300px;
        }
        
        div#seccionActiva {
        height: 100%!important;
        display: grid;
        }
        canvas#canvasFirmaCliente {
        
        height: 100%!important;
        }
        canvas#canvasFirmaEncargado {
        
        height: 100%!important;
        }
        .wrapper {
        position: relative;
        margin: 10px auto;
        width: 100% !important;
        height: 300px !important;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }
    }
    @media screen and (max-width: 536px) {
        #canvas {
            background-size: 100% !important;
            width: 100%!important;
        }
        .wrapper-autos{
            height:200px;
        }
       
        div#seccionActiva {
        height: 100%!important;
        display: grid;
        }
        canvas#canvasFirmaCliente {
        
        height: 100%!important;
        }
        canvas#canvasFirmaEncargado {
        
        height: 100%!important;
        }
        .wrapper {
        position: relative;
        margin: 10px auto;
        width: 100% !important;
        height: 300px !important;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }
    }
</style>

<div class="modal fade" id="modalInventario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modalInventario"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Layout/errores')
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body p-2">
                        <form id="Inventario-form">
                            @csrf
                            <input type='hidden' name='gos_vehiculo_inventario_id' id='gos_vehiculo_inventario_id' value={{$inventario->gos_vehiculo_inventario_id ?? ''}}>
                            <div class="accordion" id="Inventario">
                            <!-- Interiores -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#Interior" aria-expanded="false">
                                        Interiores
                                        </div>
                                    </div>
                                    <div id="Interior" class="collapse" data-parent="#Inventario" >
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <table class="table  table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td style="display:none;">ID</td>
                                                            <td class="py-3 text-left">Descripción</td>
                                                            <td class="py-3">Cantidad</td>
                                                            <td style="width:10%;">Si</td>
                                                            <td style="width:10%;">No</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody >
                                                        @foreach ($listaInteriores as $interior)
                                                        <tr>
                                                            <td style="display:none;">
                                                                <input type="hidden" name="{{$interior->gos_vehiculo_parte_id}}_gos_vehiculo_inventario_parte_id" value="{{$interior->gos_vehiculo_inventario_parte_id}}">
                                                            </td>
                                                            <td class="col-2 text-left">{{$interior->nomb_parte_vehiculo}}</td>
                                                            <td class="p-1">
                                                                <input type="number" min="0" class="form-control" name="{{$interior->gos_vehiculo_parte_id}}_cantidad" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?>
                                                                id="{{$interior->gos_vehiculo_parte_id}}_cantidad" {{$interior->revisada == '1' ? '' : 'disabled' }} value={{$interior->cantidad > 0 ? $interior->cantidad : '' }}>
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$interior->gos_vehiculo_parte_id}}_revisada" value="si" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$interior->revisada == '1' ? 'checked' : '' }}                                                                    
                                                                    onclick="document.getElementById('{{$interior->gos_vehiculo_parte_id}}_cantidad').disabled = false;"><span></span>
                                                                </label>
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$interior->gos_vehiculo_parte_id}}_revisada" value="no" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$interior->revisada == '0' ? 'checked' : '' }}
                                                                    onclick="document.getElementById('{{$interior->gos_vehiculo_parte_id}}_cantidad').disabled = true;"><span></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Motor -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#Motor" aria-expanded="false">
                                        Motor
                                        </div>
                                    </div>
                                    <div id="Motor" class="collapse" data-parent="#Inventario">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <table class="table  table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td style="display:none;">ID</td>
                                                            <td class="py-3 text-left">Descripción</td>
                                                            <td class="py-3">Cantidad</td>
                                                            <td style="width:10%;">Si</td>
                                                            <td style="width:10%;">No</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($listaMotores as $motor)
                                                        <tr>
                                                            <td style="display:none;">
                                                                <input type="hidden" name="{{$motor->gos_vehiculo_parte_id}}_gos_vehiculo_inventario_parte_id" value="{{$motor->gos_vehiculo_inventario_parte_id}}">
                                                            </td>
                                                            <td class="col-2 text-left">{{$motor->nomb_parte_vehiculo}}</td>
                                                            <td class="p-1">
                                                                <input type="number" min="0" class="form-control" name="{{$motor->gos_vehiculo_parte_id}}_cantidad" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?>
                                                                id="{{$motor->gos_vehiculo_parte_id}}_cantidad" {{$motor->revisada == '1' ? '' : 'disabled'}} value={{$motor->cantidad > 0 ? $motor->cantidad : '' }}>
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$motor->gos_vehiculo_parte_id}}_revisada" value="si" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$motor->revisada == '1' ? 'checked' : '' }}
                                                                    onclick="document.getElementById('{{$motor->gos_vehiculo_parte_id}}_cantidad').disabled = false;"><span></span>
                                                                </label>
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$motor->gos_vehiculo_parte_id}}_revisada" value="no" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$motor->revisada == '0' ? 'checked' : '' }}
                                                                    onclick="document.getElementById('{{$motor->gos_vehiculo_parte_id}}_cantidad').disabled = true;"><span></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Exteriores -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#Exterior" aria-expanded="false">
                                        Exteriores
                                        </div>
                                    </div>
                                    <div id="Exterior" class="collapse" data-parent="#Inventario">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <table class="table  table-bordered  " >
                                                    <thead>
                                                        <tr>
                                                            <td style="display:none;">ID</td>
                                                            <td class="py-3 text-left">Descripción</td>
                                                            <td class="py-3">Cantidad</td>
                                                            <td style="width:10%;">Si</td>
                                                            <td style="width:10%;">No</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($listaExteriores as $exterior)
                                                        <tr>
                                                            <td style="display:none;">
                                                                <input type="hidden" name="{{$exterior->gos_vehiculo_parte_id}}_gos_vehiculo_inventario_parte_id" value="{{$exterior->gos_vehiculo_inventario_parte_id}}">
                                                            </td>
                                                            <td class="col-2 text-left">{{$exterior->nomb_parte_vehiculo}}</td>
                                                            <td class="p-1">
                                                                <input type="number"  min="0" class="form-control" name="{{$exterior->gos_vehiculo_parte_id}}_cantidad" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?>
                                                                id="{{$exterior->gos_vehiculo_parte_id}}_cantidad" {{$exterior->revisada == '1' ? '' : 'disabled'}} value={{$exterior->cantidad > 0 ? $exterior->cantidad : '' }}>
                                                            </td>
                                                            <td class="py-1"><label class="kt-radio mt-2">
                                                                <input type="radio" name="{{$exterior->gos_vehiculo_parte_id}}_revisada" value="si" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$exterior->revisada == '1' ? 'checked' : '' }}
                                                                onclick="document.getElementById('{{$exterior->gos_vehiculo_parte_id}}_cantidad').disabled = false;"><span></span></label>
                                                            </td>
                                                            <td class="py-1"><label class="kt-radio mt-2">
                                                                <input type="radio" name="{{$exterior->gos_vehiculo_parte_id}}_revisada" value="no" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$exterior->revisada == '0' ? 'checked' : '' }}
                                                                onclick="document.getElementById('{{$exterior->gos_vehiculo_parte_id}}_cantidad').disabled = true;"><span></span></label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Cajuela -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#Cajuela" aria-expanded="false">
                                        Cajuela
                                        </div>
                                    </div>
                                    <div id="Cajuela" class="collapse" data-parent="#Inventario">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <table class="table  table-bordered  " >
                                                    <thead>
                                                        <tr>
                                                            <td style="display:none;">ID</td>
                                                            <td class="py-3 text-left">Descripción</td>
                                                            <td class="py-3">Cantidad</td>
                                                            <td style="width:10%;">Si</td>
                                                            <td style="width:10%;">No</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($listaCajuela as $cajuela)
                                                        <tr>
                                                            <td style="display:none;">
                                                                <input type="hidden" name="{{$cajuela->gos_vehiculo_parte_id}}_gos_vehiculo_inventario_parte_id" value="{{$cajuela->gos_vehiculo_inventario_parte_id}}">
                                                            </td>
                                                            <td class="col-2 text-left">{{$cajuela->nomb_parte_vehiculo}}</td>
                                                            <td class="p-1">
                                                                <input type="number"  min="0" class="form-control" name="{{$cajuela->gos_vehiculo_parte_id}}_cantidad" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?>
                                                                id="{{$cajuela->gos_vehiculo_parte_id}}_cantidad" {{$cajuela->revisada == '1' ? '' : 'disabled'}} value={{$cajuela->cantidad > 0 ? $cajuela->cantidad : '' }} >
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$cajuela->gos_vehiculo_parte_id}}_revisada" value="si" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$cajuela->revisada == '1' ? 'checked' : '' }}
                                                                    onclick="document.getElementById('{{$cajuela->gos_vehiculo_parte_id}}_cantidad').disabled = false;"><span></span>
                                                                </label>
                                                            </td>
                                                            <td class="py-1">
                                                                <label class="kt-radio mt-2">
                                                                    <input type="radio" name="{{$cajuela->gos_vehiculo_parte_id}}_revisada" value="no" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?> {{$cajuela->revisada == '0' ? 'checked' : '' }}
                                                                    onclick="document.getElementById('{{$cajuela->gos_vehiculo_parte_id}}_cantidad').disabled = true;"><span></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--   Medidor de gasolina  -->
                            <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#MedidorGasolina" aria-expanded="false">
                                        Medidor de gasolina
                                        </div>
                                    </div>
                                    <div id="MedidorGasolina" class="collapse" data-parent="#Inventario">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Tanque de gasolina</label>
                                                    
                                                    <select name="medidor_gasolina" class="custom-select" id="medidor_gasolina" onchange="medgas(this.value);" <?php if ($inventario->firma_cliente!==null): ?>disabled<?php endif; ?>>
                                                   
                                                        @isset($listaMedidorGas)
                                                        @foreach ($listaMedidorGas as $medidor)
                                                        <option value="{{$medidor->gos_vehiculo_medidor_gas_id}}"
                                                            @isset($inventario->gos_vehiculo_medidor_gas_id)
                                                                {{$medidor->gos_vehiculo_medidor_gas_id == $inventario->gos_vehiculo_medidor_gas_id ? 'selected' : ''}}
                                                            @endisset
                                                            >{{$medidor->nomb_medidor}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>


                                                </div>
                                                <style>                                               
                                                div1{
                                                    background-image: url("../img/medidor-1.png");
                                                    
                                                    background-repeat:no-repeat;
                                                    
                                                    
                                                }
                                                </style>
                                                <div1 class="col-9" style="background-size: 102px; background-position: left;">
                                                    <div class="col-2 offset-2" style="width: 30rem;margin-left: 7rem;margin-bottom: 1rem;">
                                                       <div class="" style="max-width: 15rem: max-height:15rem; padding-top: 7px;">
                                                         <button id="MGF" type="button" style="width: 15rem;  " class="btn btn-sm bg-success text-light" name="button" onclick="medgas(17);">F</button><br>
                                                         <button id="MG78" type="button" style="width: 13rem;  " class="btn btn-sm bg-success text-light" name="button" onclick="medgas(16);">7/8</button><br>
                                                         <button id="MG68" type="button" style="width: 11rem;" class="btn btn-sm btn-info  " name="button" onclick="medgas(15);">6/8</button><br>
                                                         <button id="MG58" type="button" style="width: 9.5rem;" class="btn btn-sm btn-info  " name="button" onclick="medgas(14);">5/8</button><br>
                                                         <button id="MG48" type="button" style="width: 8rem;" class="btn btn-sm btn-info  " name="button" onclick="medgas(13);">1/2</button><br>
                                                         <button id="MG38" type="button" style="width: 7rem;" class="btn btn-sm btn-info  " name="button" onclick="medgas(12);">3/8</button><br>
                                                         <button id="MG28" type="button" style="width: 5rem;" class="btn  btn-sm btn-warning text-light " name="button" onclick="medgas(11);">2/8</button><br>
                                                         <button id="MG18" type="button" style="width: 4rem;" class="btn btn-sm btn-warning text-light " name="button" onclick="medgas(10);">1/8</button><br>
                                                         <button id="MGE" type="button" style="width: 3rem;" class="btn btn-sm btn-danger  " name="button" onclick="medgas(9);">E</button><br>
                                                       </div>
                                                     </div>
                                                 

                                                </div1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <!--  Condiciones de carroceria  -->
                             <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#CondicionCarroceria" aria-expanded="false">
                                            Condiciones de carroceria
                                        </div>
                                    </div>
                                    <div id="CondicionCarroceria" class="collapse" data-parent="#Inventario">
                                        <input type="hidden" name="gos_vehiculo_inventario_carroceria_id" value={{$inventario->gos_vehiculo_inventario_carroceria_id ?? ''}}>
                                        <div class="card-body p-1">
                                            <div class="kt-portlet">
                                                <div class="kt-portlet__body p-1">
                                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                                        <li class="nav-item">
                                                            <?php if ($inventario->gos_vehiculo_tipo_id==null): ?>
                                                            <select class="custom-select" name="modelo_vehiculo" id="modelo_vehiculo" onchange="selec_vehi(this)" >
                                                                @foreach ($listaTipoVehiculo as $vehiculo)
                                                                <option value="{{$vehiculo->gos_vehiculo_tipo_id}}"
                                                                    @isset($inventario->gos_vehiculo_tipo_id)
                                                                    {{$vehiculo->gos_vehiculo_tipo_id == $inventario->gos_vehiculo_tipo_id ? 'selected' : ''}}
                                                                    @endisset>
                                                                    {{$vehiculo->tipo_vehiculo}}</option>
                                                                @endforeach
                                                            </select>
                                                            <?php endif; ?>
                                                        </li>
                                                        <div clasS="row">
                                                            <?php if ($inventario->gos_vehiculo_tipo_id==null): ?>
                                                        <li class="nav-item">
                                                            <button class="btn btn-primary" type="button" id="editarCanvasGolpes" >Golpes</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="btn btn-default" type="button" id="editarCanvasRoto" >Roto o Estrellado</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="btn btn-default" type="button" id="editarCanvasRayones" >Rayones</button>
                                                        </li>
                                                          <?php endif; ?>
                                                        </div>
                                                    </ul>
                                                    <div class="form-group" style="text-align:center">
                                                      <?php if ($inventario->gos_vehiculo_tipo_id==null): ?>
                                                        <button class="btn btn-primary" type="button" id="borrarCanvas">Limpiar</button>
                                                      <?php endif; ?>
                                                    </div>
                                                    <div id="seccionActiva" class="tab-content">
                                                        <div id="seccionGolpes" class="tab-pane active wrapper-autos" role="tabpanel">
                                                            <canvas id="canvas" height="500rem;" width="700rem;" style="cursor: crosshair;border:none; background-image: url('img/ccar/1.jpg'); background-repeat: no-repeat;background-size: 100%; <?php if ($inventario->gos_vehiculo_tipo_id!=null): ?>display: none;<?php endif; ?>"></canvas>
                                                               <?php if ($inventario->gos_vehiculo_tipo_id!=null): ?>
                                                              <!-- <img id="vehiculotipoid" src='img/ccar/{{$inventario->gos_vehiculo_tipo_id ??''}}.jpg'  height="500rem;" width="700rem;" > -->
                                                              <img  id="vehiculotipoidcanvasover" src='storage/img/firmasOS/Inventario/cc{{$inventario->gos_os_id ??''}}.png' height="600rem;" width="700rem;" style="background-image: url('img/ccar/{{$inventario->gos_vehiculo_tipo_id ??''}}.jpg');background-size: 100%;background-repeat: no-repeat;">
                                                                 <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Comentarios -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#Comentarios" aria-expanded="false">
                                            Comentarios
                                        </div>
                                    </div>
                                    <div id="Comentarios" class="collapse" data-parent="#Inventario">
                                        <input type="hidden" name="gos_vehiculo_inventario_com_id" value={{$inventario->gos_vehiculo_inventario_com_id ?? ''}}>
                                        <div class="card-body">
                                            <div class="" style="text-align:center">
                                                <?php if ($inventario->firma_cliente!==null): ?>
                                                <button class="btn btn-primary" type="button" id="comentario-updt">Guardar Nuevo comentario</button>
                                                <?php endif; ?>
                                            </div>                                            
                                            <strong><label for="">Comentario</label></strong><br>
                                            <textarea name="comentario_propio_del_inventario" id="comentario_propio_del_inventario" rows="3" style="width:100%">{{$inventario->comentarios ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            <!--  Firma del Cliente  -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#FirmaCliente" aria-expanded="false">
                                            Firma del Cliente
                                        </div>
                                    </div>
                                    <div id="FirmaCliente" class="collapse"  data-parent="#Inventario">
                                        <div class="card-body">
                                            <div class="" style="text-align:center">
                                                <?php if ($inventario->firma_cliente==null): ?>
                                                <button class="btn btn-primary" type="button" id="borrarFirmaCliente">Limpiar</button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="wrapper d-flex justify-content-center">
                                                <canvas id="canvasFirmaCliente" class="signature-pad" width="270" height="300"  <?php if ($inventario->firma_cliente!=null): ?>style=" display: none; " <?php endif; ?>>
                                                    {{-- URL=img/firmasOS/Inventario/{{$inventario->firma_cliente}} --}}
                                                </canvas>
                                                <?php if ($inventario->firma_cliente!=null): ?>
                                                   <img name="imgFirmaCliente" src='{{$inventario->firma_cliente ?? '' }}' id="imgFirmaCliente" width="500" height="300">
                                                <?php endif; ?>
                                            </div>

                                    </div>
                                    </div>
                                </div>
                            <!-- Firma del Encargado -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed divsInventario" data-toggle="collapse" data-target="#FirmaEncargado" aria-expanded="false">
                                        Firma del Encargado
                                        </div>
                                    </div>
                                    <div id="FirmaEncargado" class="collapse" data-parent="#Inventario">
                                        <div class="card-body">
                                            <div class="" style="text-align:center">
                                               <?php if ($inventario->firma_asesor==null): ?>
                                                <button class="btn btn-primary" type="button" id="borrarFirmaEncargado">Limpiar</button>
                                                 <?php endif; ?>
                                                {{-- <button class="btn btn-primary" type="button" id="btnGuardarFirmaEncargado">Confirmar</button> --}}
                                            </div>
                                            <div class="wrapper d-flex justify-content-center">

                                                <canvas id="canvasFirmaEncargado" class="signature-pad" width="270" height="300"   <?php if ($inventario->firma_asesor!=null): ?> style=" display: none;"  <?php endif; ?> >
                                                    {{-- URL=img/firmasOS/Inventario/{{$inventario->firma_asesor}} --}}
                                                </canvas>
                                                <?php if ($inventario->firma_asesor!=null): ?>
                                                <img name="imgFirmaEncargado" src='{{$inventario->firma_asesor ??''}}' id="imgFirmaEncargado" name="firma-encargado" width="500" height="300">
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                              <?php if ($inventario->firma_cliente==null): ?>
                            <button type="button" id="btninventario" class="btn btn-success col-12" style="font-size: 1.1rem;font-weight: 500;">Listo</button>
                              <?php endif; ?>
                        </form>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
