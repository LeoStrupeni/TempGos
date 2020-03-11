
<div>
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link btn text-white mr-2" id="btn-os-ajustes" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseAjustes" data-toggle="tab" role="tab">
                <i class="fas fa-tools fa-2x pl-2 my-3"></i>
                <p class="mb-0">Ajustes <br> 0/10</p>
                <i class="fas fa-chevron-down pl-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn text-white mr-2" id="btn-os-clientes" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseClientes"  data-toggle="tab" role="tab">
                <i class="fas fa-camera fa-2x pl-2 my-3"></i>
                <p class="mb-0" id="cantidadClientes">Clientes <br> {{$countImgCliente}}/30</p>
                <i class="fas fa-chevron-down pl-2"></i>
                <input type="hidden" id="cantidadClientesOculto" value={{$countImgCliente}}>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn text-white mr-2" id="btn-os-internas" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseInternas" data-toggle="tab" role="tab">
                <i class="fas fa-camera fa-2x pl-2 my-3"></i>
                <p class="mb-0" id="cantidadInternas">Internas <br> {{$countImgInternas}}/50</p>
                <i class="fas fa-chevron-down pl-2"></i>
                <input type="hidden" id="cantidadInternasOculto" value={{$countImgInternas}}>
            </a>
        </li>
        <li class="nav-item">
            <a class="btn text-white mr-2" id="btn-os-archivos" style="background-color:#32B89D; border-radius:50%; height: 100px; width: 100px; text-align:center;" href="#collapseArchivos" data-toggle="tab" role="tab">
                <i class="fas fa-folder-open fa-2x pl-2 my-3"></i>
                <p class="mb-0" id="cantidadDocs">Archivos <br> {{$countDocumentos}}/10</p>
                <i class="fas fa-chevron-down pl-2"></i>
                <input type="hidden" id="cantidadDocsOculto" value={{$countDocumentos}}>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="collapseAjustes" role="tabpanel">
            <form class="kt-form kt-form--label-right" id="ajustes_form">
                @csrf
                <div class="form-row">
                    {{-- @foreach ($listaAjuste as $ajuste) --}}
                    <div class="form-group col-2 text-center mb-2">
                        <img src="../img/logo.png" alt="" style="border-radius:50%; border: 1px solid grey;height: 100px; width: 100px;">
                    </div>
                    {{-- @endforeach --}}
                </div>
            </form>
        </div>
<!-- ----------------------- imagenes con modal ------------------------------------------------------------------------------------------------------------------------------------------------- -->

<!-- ---------------------- imagenes con magnific popup------------------------------------------------------------------------------------------------------------------------------------------------ -->
        <div class="tab-pane" id="collapseClientes" role="tabpanel">
            <div class="row" id="img-os-cliente">
                @foreach ($listaImgCliente as $key => $imgCli)
                    <div class='col-4 col-sm-3 col-md-2 text-center mb-2' id='imgcliente_{{$imgCli->gos_os_imagen_cliente_id}}'>
                        <a id="btnborrarImgCliente" data-id="{{$imgCli->gos_os_imagen_cliente_id}}" class="position-absolute w-25 p-0" style="right:0px;"
                            href="javascript:void(0);">
                            <i class="far fa-2x fa-times-circle text-danger"></i>
                        </a>
                        <a class="popup-link-img" href='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}'>
                            <img src='/storage/VehiculoCliente/{{$imgCli->imagen_cliente}}' style='border-radius:50%; height: 100px; width: 100px;'>
                        </a>
                    </div>
                @endforeach
                @if (count($listaImgCliente) < 30)
                    <div class='col-4 col-sm-3 col-md-2 order-last'>
                        <form enctype="multipart/form-data" class="kt-form kt-form--label-right">
                            @csrf
                            <label for="img_clientes">
                                <i class="fas fa-camera fa-4x border border-success rounded-circle p-3 text-success"
                                style="border-width: 10px !important;"></i>
                                <input type="file" name="img_clientes[]" id="img_clientes" class="d-none" accept=".png, .jpg, .jpeg" onchange="scaleImageClient(this);" multiple>
                            </label>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="collapseInternas" role="tabpanel">
          <div class="row" id="img-os-internas">
                 @foreach ($listaImgInternas as $key => $imgInt)
                    <div class='col-4 col-sm-3 col-md-2 text-center mb-2' id="imginterna_{{$imgInt->gos_os_imagen_interna_id}}">
                        <a id="btnborrarImgInterna" data-id="{{$imgInt->gos_os_imagen_interna_id}}" class="position-absolute w-25 p-0" style="right:0px;"
                            href="javascript:void(0);">
                            <i class="far fa-2x fa-times-circle text-danger"></i>
                        </a>
                        <a class="popup-link-img" href='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'>
                            <img src='/storage/VehiculoInterna/{{$imgInt->imagen_interna}}'
                            style='border-radius:50%; height: 100px; width: 100px;'>
                        </a>
                    </div>
                @endforeach
                @if (count($listaImgInternas) < 50)
                <div class="col-4 col-sm-3 col-md-2 order-last">
                    <form enctype="multipart/form-data" class="kt-form kt-form--label-right">
                        @csrf
                        <label for="img_internas">
                            <i class="fas fa-camera fa-4x border border-success rounded-circle p-3 text-success"
                            style="border-width: 10px !important;"></i>
                            <input type="file" name="img_internas[]" id="img_internas" class="d-none" accept=".png, .jpg, .jpeg" onchange="scaleImageInterna(this);" multiple>
                        </label>
                    </form>
                </div>
                @endif
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
        <div class="tab-pane" id="collapseArchivos" role="tabpanel">
            @if (count($listaDocumentos) <= 10)
                <form method="POST" action="{{route('guardarDocumento',$os->gos_os_id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-4 offset-6">
                        <label for="cargaArchivo" class="btn btn-primary">Agregar Archivo
                            <input type="file" name="cargaArchivo[]" id="cargaArchivo" class="d-none" onchange="submit();" multiple>
                        </label>
                    </div>
                </form>
            @endif

            <div class="table-responsive p-5">
                <table class="table table-bordered table-sm table-hover w-75 m-auto text-center">
                    <thead>
                        <tr>
                            <th class="p-1"># Documento</th>
                            <th class="p-1"># Inventario</th>
                            <th class="p-1">Nombre</th>
                            <th class="p-1" style="width:3%;"></th>
                        </tr>
                    </thead>
                    <tbody id="bodydocOS">
                        @foreach ($listaDocumentos as $doc)
                        <tr id='documento_{{$doc->gos_vehiculo_inventario_doc_id}}'>
                            <td>{{$doc->gos_vehiculo_inventario_doc_id}}</td>
                            <td>{{$doc->gos_vehiculo_inventario_id}}</td>
                            <td>{{$doc->documento}}</td>
                            <td>
                                <!-- <a href="javascript:void(0);" id="btnborrarDoc" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $doc->gos_vehiculo_inventario_doc_id }}" class="delete dropdown-item">
                                    <i class="la la-trash"></i>
                                </a> -->
                                <div class="btn-group dropright">
                                  <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Ver" data-id="{{ $doc->gos_vehiculo_inventario_doc_id }}" class=" dropdown-item" onclick="window.open('/storage/VehiculoDocumentos/{{$doc->documento}}')">
                                        <i class="fas fa-eye"></i> Ver archivo
                                    </a>
                                    <a href="javascript:void(0);" id="btnborrarDoc" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $doc->gos_vehiculo_inventario_doc_id }}" class="delete dropdown-item">
                                        <i class="la la-trash"></i> Borrar archivo
                                    </a>
                                  </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container">
              <div class="row">

                  <?php if ($pres!=null): ?>
                    <div class="col-2">
                    <button type="button" class=" btn btn-outline-secondary w-100" id="" onclick="ImprimirPres({{$pres->gos_pres_id ?? '' }});" style="margin-bottom: 1rem;"><i class="fas fa-print"></i>PDF Presupuesto</button>
                    </div>
                      <div class="col-2">
                      <button type="button" class=" btn btn-outline-secondary w-100" id="" onclick="ImprimirPresHV({{$pres->gos_pres_id ?? '' }});" style="margin-bottom: 1rem;"><i class="fas fa-car"></i>Hoja Viajera</button>
                      </div>
                  <?php endif; ?>

              </div>
            </div>
        </div>
    </div>



</div>
