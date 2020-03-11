@extends('Layout' )
@section('Content' )

<style media="screen">
.vertical-menu a{
  background: #fff;
}
.vertical-menu a:hover {
  background-color: #eeeef6;
}

@media screen and (max-width: 900px){
  div .card{
    font-size: 0.5rem;
  }
  .tittle5{
    display: none;
  }

  #verticalE {
    max-width: 17%;
}
  /* i {
    padding-left: 2.5rem;
  } */
}

@media screen and (max-width: 575px){
  .tittle5{
    display: contents;
  }
  .menuv{
    padding-top: 2rem;
  }
  #verticalE {
    max-width: 100%;
}
}
</style>



<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">E-Learning</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
				</div>
			</div>
		</div>
	</div>
  <div class="kt-portlet__body p-0">
    <div class="d-flex justify-content-between">
    <div class='container-fluid'>
        <div class ='row'>
          <div id="verticalE" class='col-12 col-sm-3'>
              <div class="vertical-menu" style="padding-top: 0.34rem;">
                <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                  <div class="card">
                    <div class="card-header" id="headingZero4">
                      <div class="divtittle card-title collapsed" data-toggle="collapse" data-target="#collapseZero4" aria-expanded="false" aria-controls="collapseZero4">
                        <i class="fas fa-user-circle"></i><h5 class="tittle5" id="clientes">Log in</h5>
                        <!-- <input type="hidden"  class="idName" name="" value="Clientes"> -->
                      </div>
                    </div>
                    <div id="collapseZero4" class="collapse" aria-labelledby="headingZero" data-parent="#accordionExample4">
                      <div class="card-body">
                      <div class="btn-group dropright ">
                      <button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                       Material Audio Visual
                      </button>
                      <div class="dropdown-menu"  style="margin-left: 3.5rem;">
                        <a class="dropdown-item" href="/elearning/videos/18">Ingreso al sistema (Log in)</a>
                      </div>
                      </div>

                      <div class="btn-group dropright ">
                      <button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" >
                       Material Escrito
                      </button>
                      <div class="dropdown-menu"  style="margin-left: 5rem;">
                        <a class="dropdown-item" href="/elearning/docs/14">Ingreso al sistema (Log in)</a>
                      </div>
                      </div>

                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingOne4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                        <i class="fas fa-user-tie"></i><h5 class="tittle5" id="clientes">Clientes</h5>
												<!-- <input type="hidden"  class="idName" name="" value="Clientes"> -->
                      </div>
                    </div>
                    <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                      <div class="card-body">
											<div class="btn-group dropright ">
										  <button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
										   Material Audio Visual
										  </button>
										  <div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/0">Agregar clientes</a>
                        <a class="dropdown-item" href="/elearning/videos/1">Agregar aseguradoras</a>
                        <a class="dropdown-item" href="/elearning/videos/2">Agregar otro taller</a>
										  </div>
									  	</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/0">Agregar Clientes </a>
												<a class="dropdown-item" href="/elearning/docs/1">Agregar Aseguradoras</a>
												<a class="dropdown-item" href="/elearning/docs/2">Agregar Otro Taller</a>
											</div>
											</div>

                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                        <i class="fas fa-car"></i> <h5 class="tittle5" id="vehiculos">Vehiculos</h5>
                      </div>
                    </div>
                    <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample4">
                      <div class="card-body">
                        <div class="btn-group dropright ">
  										  <button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  										   Material Audio Visual
  										  </button>
  										  <div class="dropdown-menu"  style="margin-left: 3.5rem;">
  												<a class="dropdown-item" href="/elearning/videos/3">Agregar vehiculos</a>
  												<a class="dropdown-item" href="/elearning/videos/4">Agregar marcas y modelos</a>
  												<a class="dropdown-item" href="/elearning/videos/5">Agregar color</a>
  										  </div>
  									  	</div>

  											<div class="btn-group dropright ">
  											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
  											 Material Escrito
  											</button>
  											<div class="dropdown-menu"  style="margin-left: 5rem;">
                          <a class="dropdown-item" href="/elearning/docs/3">Agregar Vehiculos</a>
  												<a class="dropdown-item" href="/elearning/docs/4">Agregar Marcas y Modelos</a>
  												<a class="dropdown-item" href="/elearning/docs/5">Agregar Colores</a>
  											</div>
  											</div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingThree4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                        <i class="fas fa-file-signature"></i><h5 class="tittle5" id="presupuestos">Presupuestos</h5>
                      </div>
                    </div>
                    <div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/20">Video 1</a>
												<a class="dropdown-item" href="/elearning/videos/20">Video 2</a>
												<a class="dropdown-item" href="/elearning/videos/20">Video 3</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/60">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/70">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingFour4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour4" aria-expanded="false" aria-controls="collapseThree4">
                        <i class="fas fab fa-sitemap"></i><h5 class="tittle5" id="ordenes">Ordenes</h5>
                      </div>
                    </div>
                    <div id="collapseFour4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/19">Agregar Orden de Servicio</a>
												<a class="dropdown-item" href="/elearning/videos/7">Funciones del Menu de la Orden de Servicio</a>
												<a class="dropdown-item" href="/elearning/videos/8">Agregar Fotos en Orden de Servicio</a>
												<a class="dropdown-item" href="/elearning/videos/9">Mensajes a Cliente por API WhatsApp</a>
												<a class="dropdown-item" href="/elearning/videos/10">Agregar Documentos a la Orden de Servicio</a>
												<a class="dropdown-item" href="/elearning/videos/11">Asociar o Cargar Productos Internos y Externos</a>
												<a class="dropdown-item" href="/elearning/videos/23">Agregar etapas simultaneas</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
                        						<a class="dropdown-item" href="/elearning/docs/8">Agregar Orden de Servicio</a>
												<a class="dropdown-item" href="/elearning/docs/9">Funciones Menu Orden</a>
												<a class="dropdown-item" href="/elearning/docs/10">Carga Fotos Cliente y Valuacion</a>
												<a class="dropdown-item" href="/elearning/docs/11">Carga Documentos</a>
                        						<a class="dropdown-item" href="/elearning/docs/12">Asociar o Cargar Productos  Internos y Externos</a>
                        						<a class="dropdown-item" href="/elearning/docs/13">Servicios y asignacion de tecnicos</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingFive4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive4" aria-expanded="false" aria-controls="collapseFive4">
                        <i class="flaticon-interface-3"></i> <h5 class="tittle5" id="facturacion">Facturacion</h5>
                      </div>
                    </div>
                    <div id="collapseFive4" class="collapse" aria-labelledby="headingFive1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/40">Video 1</a>
												<a class="dropdown-item" href="/elearning/videos/40">Video 2</a>
												<a class="dropdown-item" href="/elearning/videos/40">Video 3</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingSix4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix4" aria-expanded="false" aria-controls="collapseSix4">
                        <i class="fas fa-box-open"></i> <h5 class="tittle5" id="paquetes">Paquetes</h5>
                      </div>
                    </div>
                    <div id="collapseSix4" class="collapse" aria-labelledby="headingSix1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
											<a class="dropdown-item" href="/elearning/videos/22">Agregar etapa</a>
											<a class="dropdown-item" href="/elearning/videos/21">Agregar servicio</a>
											<a class="dropdown-item" href="/elearning/videos/20">Agregar un paquete</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingSeven4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSeven4" aria-expanded="false" aria-controls="collapseSeven">
                        <i class="fas fa-shopping-cart"></i> <h5 class="tittle5" id="compras">Compras</h5>
                      </div>
                    </div>
                    <div id="collapseSeven4" class="collapse" aria-labelledby="headingSeven1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/60">Video 1</a>
												<a class="dropdown-item" href="/elearning/videos/60">Video 2</a>
												<a class="dropdown-item" href="/elearning/videos/60">Video 3</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingEight4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEight4" aria-expanded="false" aria-controls="collapseEight4">
                        <i class="fab fas fa-users"></i> <h5 class="tittle5" id="equipop">Equipo de Trabajo</h5>
                      </div>
                    </div>
                    <div id="collapseEight4" class="collapse" aria-labelledby="headingEight1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/70">Video 1</a>
												<a class="dropdown-item" href="/elearning/videos/70">Video 2</a>
												<a class="dropdown-item" href="/elearning/videos/70">Video 3</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingNine4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseNine4" aria-expanded="false" aria-controls="collapseNine4">
                        <i class="fas fa-warehouse"></i> <h5 class="tittle5" id="inventario">Inventario</h5>
                      </div>
                    </div>
                    <div id="collapseNine4" class="collapse" aria-labelledby="headingNine1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/16">Agregar Inventario</a>

											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/15">Crear Inventario de Vehiculo</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTen4">
                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTen4" aria-expanded="false" aria-controls="collapseTen4">
                        <i class="fa fa-flag-checkered"></i> <h5 class="tittle5" id="reportes">Reportes</h5>
                      </div>
                    </div>
                    <div id="collapseTen4" class="collapse" aria-labelledby="headingTen1" data-parent="#accordionExample4">
											<div class="card-body">
											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											 Material Audio Visual
											</button>
											<div class="dropdown-menu"  style="margin-left: 3.5rem;">
												<a class="dropdown-item" href="/elearning/videos/90">Video 1</a>
												<a class="dropdown-item" href="/elearning/videos/90">Video 2</a>
												<a class="dropdown-item" href="/elearning/videos/90">Video 3</a>
											</div>
											</div>

											<div class="btn-group dropright ">
											<button type="button" class="btn  btn-md btn-block  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
											 Material Escrito
											</button>
											<div class="dropdown-menu"  style="margin-left: 5rem;">
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 1</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 2</a>
												<a class="dropdown-item" href="/elearning/docs/80">Pdf 3</a>
											</div>
											</div>

											</div>
                    </div>
                  </div>

                </div>
              </div>
          </div>
          <div class='menuv col-12 col-sm-9' style="text-align: center; background: #fff;">
            <div class="jumbotron bg-light"style="padding-bottom:1rem; margin-bottom: 0px;">
              <h1 class="display-4  bg-light">Bienvenido!</h1>
              <p class="lead  bg-light">En esta seccion veras como utilizar todos los modulos correctamente</p>
              <div class="row">
                <div class="col-sm" style="text-align: center;" >
                  <video width="100%" height="auto" controls autoplay controlsList="nodownload autoplay">
					<source src="/elearning/videos/01 Como Hacer Login v06feb2020.mp4" type="video/mp4"/>
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

    @endsection

    @section('ScriptporPagina')

    @endsection
