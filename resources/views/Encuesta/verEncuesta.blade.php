@extends('Layout')

@section('Content')

  <div class="row">
      <div class="col-12">
          <div class="card">
            <div style="border-top-style: solid; border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top: 5%;margin-bottom:3%;" class="ordenesbotones">
             <img style="width: 15%; margin: 5% 40%"src="../img/survey.png" alt="">
            </div>
            <div style="margin: 2% 22%;" class="col">
                <a style="width: 50%;" class="btn btn-success" href="{{url('Encuesta/editar')}}" role="button">Abrir encuesta de servicio y entregar vehículo</a>
            </div>

          </div>
      </div>
  </div>

@endsection
 <!-- <div class="col-lg-6">
        <div class="kt-portlet">
          <div class="kt-portlet__body">
            <div style="height:450"class="kt-infobox">
              <form>
                  <div style="border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%; padding-bottom:4%;" class="form-group">
                    <label style="font-style: bold"; for="exampleInputEmail1">¿Se cumplio la fecha de promesa de entrega?</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cumplio" value="si" {{-- {{(isset($gos_encuesta->cumplio) ? 'checked=""' : '')}} --}} id="exampleRadios1" value="option1" checked>
                      <label class="form-check-label" for="exampleRadios1">
                        Si
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cumplio"  value="no"  {{-- {{(isset($gos_encuesta->cumplio) ? 'checked=""' : '')}} --}} id="exampleRadios2" value="option2">
                      <label class="form-check-label" for="exampleRadios2">
                        No
                      </label>
                    </div>
                  </div>


                  <div style="border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%; padding-bottom:4%;" class="form-group">
                    <label for="exampleInputEmail1">La calidad de la atención del CDR fue:</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad" value="muuy bueno" id="exampleRadios1" {{-- {{(isset($gos_encuesta->calidad) ? 'checked=""' : '')}} --}} value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Muy bueno
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad" value="bueno" id="exampleRadios2"{{-- {{(isset($gos_encuesta->calidad) ? 'checked=""' : '')}} --}} value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                    Bueno
                    </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="calidad" value="regular" id="exampleRadios1" {{-- {{(isset($gos_encuesta->calidad) ? 'checked=""' : '')}} --}} value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Regular
                  </label>
                </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="calidad" value="malo" id="exampleRadios1" {{-- {{(isset($gos_encuesta->calidad) ? 'checked=""' : '')}} --}} value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Malo
                  </label>
                </div>
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Fue informado sobre el proceso de reparación</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="informado" value="muy bueno" {{-- {{(isset($gos_encuesta->informado) ? 'checked=""' : '')}} --}} id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="informado">
                      Muy bueno
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="informado" value="bueno" {{-- {{(isset($gos_encuesta->informado) ? 'checked=""' : '')}} --}} id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                    Bueno
                    </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="informado" value="regular"{{-- {{(isset($gos_encuesta->informado) ? 'checked=""' : '')}} --}} id="exampleRadios1" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Regular
                  </label>
                </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="informado" value="malo"{{-- {{(isset($gos_encuesta->informdo) ? 'checked=""' : '')}} --}} id="exampleRadios1" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Malo
                  </label>
                  </div>
                </div>
              </form>


            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="kt-portlet">
          <div class="kt-portlet__body">
            <div style="height:"class="kt-infobox">
              <div style="border-bottom-style: solid;border-width: 0.5px; border-color:rgba(240,240,240); margin-top:2%; padding-bottom:4%;" class="form-group">
                <label for="exampleInputEmail1">¿Recomendaría este centro de reparación?</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="recomendacion" value="si"{{-- {{(isset($gos_encuesta->recomendacion) ? 'checked=""' : '')}} --}} id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                  Si
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="recomendacion" value="no" {{-- {{(isset($gos_encuesta->recomendacion) ? 'checked=""' : '')}} --}} id="exampleRadios2" value="option2">
                <label class="form-check-label" for="exampleRadios2">
                  No
                </label>
              </div>
            </div>
            {{-- Firma del Cliente --}}
                         <div class="" style="text-align:center;">
                           <button class="btn btn" id="clear">Borrar</button>
                         </div>
                         <div style="border-style: solid;border-width: 0.5px; border-color:rgb(240,240,240); margin-bottom: 5%;"class="wrapper">
                          <canvas id="canvasFirmaCliente" class="signature-pad" width="290" height="170"></canvas>
                         </div>

              <button style="margin:; width: 100%;"type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </div>
      </div> -->
