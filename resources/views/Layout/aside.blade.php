<!-- begin:: Aside -->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

	<!-- begin:: Aside -->
	<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand"style='background-color: white;'>
		<div class="kt-aside__brand-logo">
			<a a href="{{ url('/') }}" >
				<img style="width:5em;" src="../img/logo.png">
			</a>
		</div>
		<div class="kt-aside__brand-tools">
			<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
				<span><svg xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
						height="24px" viewBox="0 0 24 24" version="1.1"
						class="kt-svg-icon">
                            <g stroke="none" stroke-width="1"
							fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path
							d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
							fill="#000000" fill-rule="nonzero"
							transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                <path
							d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
							fill="#000000" fill-rule="nonzero" opacity="0.3"
							transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                            </g>
                        </svg></span> <span><svg
						xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
						height="24px" viewBox="0 0 24 24" version="1.1"
						class="kt-svg-icon">
                            <g stroke="none" stroke-width="1"
							fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path
							d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
							fill="#000000" fill-rule="nonzero" />
                                <path
							d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
							fill="#000000" fill-rule="nonzero" opacity="0.3"
							transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                            </g>
                        </svg></span>
			</button>


		</div>
	</div>

	<!-- end:: Aside -->

	<!-- begin:: Aside Menu -->
	<link rel="stylesheet" href="../assets/css/skins/aside/asidemenu.css">
	<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper"style='background-color: #eeeef6;'>
			<div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" style='background-color: #27395c;'>
			<ul class="kt-menu__nav ">

	<?php $auth = Session::get('Clientes');if($auth == null){$auth=0;}else {$auth = $auth[0]->ver;}if ($auth): ?>

				<!-- Clientes -->
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"> <i
						class="kt-menu__link-icon fas fa-user-tie"></i> <span
						class="kt-menu__link-text">Clientes</span> <i
						class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{route('gestion-clientes.index')}}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
								  <span class="kt-menu__link-text">Ver Clientes</span>
						  </a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{(route('gestion-aseguradoras.index'))}}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Ver Aseguradoras</span>
							</a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('gestion-otrotaller.index') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
								  <span class="kt-menu__link-text">Ver Otros Talleres</span>
						  </a>
							</li>
						</ul>
					</div>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{(route( 'gestion-encuestas.index'))}}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Encuestas</span>
							</a>
							</li>
						</ul>
					</div>
					<!-- <div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ url('/agregarEncuesta') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Agregar Encuesta</span>
							</a>
							</li>
						</ul>
					</div> -->

				</li>
					<?php endif; ?>




					<?php $auth = Session::get('Vehiculos');if($auth == null){$auth=0;}	else {	$auth = $auth[0]->ver;	}	if ($auth): ?>
				<!-- Vehiculos -->
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"> <i
						class="kt-menu__link-icon fas fa-car"></i> <span
						class="kt-menu__link-text" id="idvehiculo">Vehiculos</span> <i
						class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ route('gestion-vehiculos.index') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
								  <span class="kt-menu__link-text" id="idvehiculo1">Ver Vehiculos</span>
						  </a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu"><a href="{{ route('vehiculos-marcas.index') }}" class="kt-menu__link "><i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
							  <span class="kt-menu__link-text" id="idmarcas">Ver Marcas</span>
					      </a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu"><a href="{{ route('vehiculos-modelos.index') }}" class="kt-menu__link "><i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
							  <span class="kt-menu__link-text" id="idmodelos">Ver Modelos</span>
					      </a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu"><a href="{{ route('vehiculos-colores.index') }}" class="kt-menu__link "><i
								class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
						  	<span class="kt-menu__link-text" id="idcolores">Ver Colores</span>
					  		</a>
							</li>
						</ul>
					</div>
				</li>
					<?php endif; ?>


					<?php	$auth = Session::get('Presupuestos');	if($auth == null)	{$auth=0;	}else {$auth = $auth[0]->ver;	}	if ($auth): ?>
				<!-- Presupuestos-->
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"> <i
						class="kt-menu__link-icon fas fa-file-signature"></i> <span
						class="kt-menu__link-text">Presupuestos</span> <i
						class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ url('/ListarPresupuestos') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Ver Presupuestos</span>
							</a>
							</li>
							<?php $auth = Session::get('Presupuestos');if($auth == null){$auth=0;}else {$auth = $auth[0]->agregar;}if ($auth): ?>
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ url('Presupuestos/Agregar') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Agregar Presupuesto</span>
							</a>
							</li>
							<?php endif ?>
						</ul>
					</div>
				</li>
				<?php endif; ?>

				<?php	$auth = Session::get('Ordenes');if($auth == null){	$auth=0;}else {$auth = $auth[0]->ver;	}if ($auth): ?>
				<!-- Ordenes -->
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"> <i
						class="kt-menu__link-icon fas fab fa-sitemap"></i> <span
						class="kt-menu__link-text">Ordenes</span> <i
						class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="{{ route('ordenes-servicio.index') }}" class="kt-menu__link ">
									<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
								<span class="kt-menu__link-text">Ver Ordenes</span>
								</a>
							</li>
							<?php	$auth = Session::get('Ordenes');if($auth == null){$auth=0;}	else {$auth = $auth[0]->agregar;}if ($auth): ?>
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="{{ url('ordenes-serv/Agregar') }}" class="kt-menu__link ">
									<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Agregar Orden</span>
								</a>
							</li>
							<?php endif ?>
							<!-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="{{ url('AsignadasQualitas') }}" class="kt-menu__link ">
									<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Asignadas Qualitas</span>
								</a>
							</li> -->
						</ul>
					</div>
				</li>
					<?php endif; ?>


					<?php	$auth = Session::get('Facturacion');if($auth == null){$auth=0;	}else {$auth = $auth[0]->ver;}if ($auth): ?>
				<!-- Facturacion -->
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"> <i
						class="kt-menu__link-icon flaticon-interface-3"></i> <span
						class="kt-menu__link-text">Facturacion</span> <i
						class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ url('/gestion-facturas') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
									<span class="kt-menu__link-text">Ver Facturas</span>
							</a>
							</li>
				
						</ul>
					</div>
				</li>
				<?php endif; ?>

				<?php	$auth = Session::get('Paquetes');if($auth == null){	$auth=0;}else {	$auth = $auth[0]->ver;}if ($auth): ?>
				<!-- Paquetes -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas fa-box-open "></i> <span
						class="kt-menu__link-text ">Paquetes</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-etapas.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Etapas</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-servicios.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Servicios</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-paquetes.index')}} " class="kt-menu__link "> <i
								class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
								<span class="kt-menu__link-text ">Ver Paquetes</span>
							</a>
							</li>
						</ul>
					</div>
				</li>
					<?php endif; ?>


					<?php	$auth = Session::get('Compras');	if($auth == null){$auth=0;}else {$auth = $auth[0]->ver;}if ($auth): ?>

				<!-- Compras -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas fa-shopping-cart "></i> <span
						class="kt-menu__link-text ">Compras</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-compras.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Compras</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-proveedores.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Proveedores</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'gestion-requisicion.index')}}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Requisiciones</span>
							</a>
							</li>
						</ul>
					</div>
				</li>
				<?php endif; ?>


			<?php if (Session::get('usr_Data.gos_usuario_perfil_id') == 51): ?>

				<!-- Equipo de Trabajo -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fab fas fa-users "></i> <span
						class="kt-menu__link-text ">Equipo de Trabajo</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">

							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ route('gestion-equipo-trabajo.index') }} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Equipo de Trabajo</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="/permisos" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Permisos</span>
							</a>
							</li>


							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ route('gestion-prestamos.index') }} " class="kt-menu__link "> <i
								class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
								<span class="kt-menu__link-text ">Ver Prestamos</span>
							</a>
							</li>

						</ul>
					</div>
				</li>
				<?php endif ?>

				<?php	$auth = Session::get('Inventario');if($auth == null){$auth=0;}else {	$auth = $auth[0]->ver;}if ($auth): ?>
				<!-- Inventario -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas fa-warehouse "></i> <span
						class="kt-menu__link-text ">Inventario</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'inventario-interno.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Inventario Interno</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'inventario-externo.index')}}" class="kt-menu__link "> <i
								class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
								<span class="kt-menu__link-text ">Ver Inventario Externo</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'familias.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Familias</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'ubicaciones.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Ubicaciones</span>
							</a>
							</li>
							<!-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'ubicacionesstock.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Ubicaciones Stock</span>
							</a>
							</li>-->
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'marcas-productos.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Marcas</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{route( 'unidadesMedidas-productos.index')}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Unidades de Medida</span>
							</a>
							</li>
						</ul>
					</div>
				</li>

				<!-- Venta de Productos -->
				<!-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fa fa-cart-arrow-down "></i> <span
						class="kt-menu__link-text ">Venta de Productos</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href=" " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Productos</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href=" " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Agregar Producto</span>
							</a>
							</li>
						</ul>
					</div>
				</li> -->
					<?php endif ?>










<!-- Reportes -->
<?php	$auth = Session::get('Reportes');if($auth == null){$auth=0;}else {$auth = $auth[0]->ver;}if ($auth): ?>

			<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
					class="kt-menu__link-icon  fa fa-flag-checkered"></i> <span
					class="kt-menu__link-text ">Reportes</span> <i
					class="kt-menu__ver-arrow la la-angle-right "></i>
			</a>
				<div class="kt-menu__submenu ">
					<span class="kt-menu__arrow "></span>
					<ul class="kt-menu__subnav ">



						<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
								class="kt-menu__link-icon  fa fa-flag-checkered "></i> <span
								class="kt-menu__link-text ">Ingresos y egresos</span> <i
								class="kt-menu__ver-arrow la la-angle-right "></i>
						</a>
							<div class="kt-menu__submenu ">
								<span class="kt-menu__arrow "></span>
								<ul class="kt-menu__subnav ">

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteCorteDiario')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Corte diario </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteCompras')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Compras </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReportePorPagarProveedores')}} " class="kt-menu__link "> <i
										class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
										<span class="kt-menu__link-text ">Por pagar </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteProductosVendidos')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Productos vendidos </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteUtilidadUnidad')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Ver Utilidades </span>
									</a>
									</li>
								</ul>
							</div>
						</li>




						<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
								class="kt-menu__link-icon  fa fa-flag-checkered"></i> <span
								class="kt-menu__link-text ">WIP</span> <i
								class="kt-menu__ver-arrow la la-angle-right "></i>
						</a>
							<div class="kt-menu__submenu ">
								<span class="kt-menu__arrow "></span>
								<ul class="kt-menu__subnav ">

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteEtapasEnProceso')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Etapas en proceso </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteCalendario')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Fechas promesa </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteProductividadEtapa')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Tiempo por Etapa </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteSeguimientoRefacciones')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Seguimiento de refacciones</span>
									</a>
									</li>

								</ul>
							</div>
						</li>




						<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
								class="kt-menu__link-icon  fa fa-flag-checkered"></i> <span
								class="kt-menu__link-text ">Kpis</span> <i
								class="kt-menu__ver-arrow la la-angle-right "></i>
						</a>
							<div class="kt-menu__submenu ">
								<span class="kt-menu__arrow "></span>
								<ul class="kt-menu__subnav ">

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteUtilidadUnidad')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Reporte de Utilidad </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteOrdenesProcesadas')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Órdenes procesadas </span>
									</a>
									</li>
									
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteImprimirOs')}} " class="kt-menu__link "> <i
										class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
										<span class="kt-menu__link-text ">Ordenes imprimir </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteOrdenesTecnicos')}} " class="kt-menu__link "> <i
										class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
										<span class="kt-menu__link-text ">Ordenes por Tecnico </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="/ReporteVSM" class="kt-menu__link "> <i
												class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
												<span class="kt-menu__link-text ">VSM </span>
										</a>
										</li>

										<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteEncuestaOS')}} " class="kt-menu__link "> <i
												class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
												<span class="kt-menu__link-text ">Encuestas de servicio </span>
										</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href=" " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Indicadores de desempeño </span>
									</a>
									</li>
									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteSeguimientoAlCliente')}}" class="kt-menu__link "> <i
										class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
										<span class="kt-menu__link-text ">Reporte de seguimiento al cliente</span>
									</a>
									</li>
								</ul>
							</div>
						</li>




						<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
								class="kt-menu__link-icon  fa fa-flag-checkered"></i> <span
								class="kt-menu__link-text ">Equipo de Trabajo</span> <i
								class="kt-menu__ver-arrow la la-angle-right "></i>
						</a>
							<div class="kt-menu__submenu ">
								<span class="kt-menu__arrow "></span>
								<ul class="kt-menu__subnav ">

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/ReporteNomina')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Nomina </span>
									</a>
									</li>

									<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{url('/')}} " class="kt-menu__link "> <i
											class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
											<span class="kt-menu__link-text ">Prestamos</span>
									</a>
									</li>

								</ul>
							</div>
						</li>




					</ul>
				</div>
			</li>


	<?php endif ?>










				<!-- Encuesta -->
				{{-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fa fa-users "></i> <span
						class="kt-menu__link-text ">Usuarios</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{(route( 'gestion-usuarios-tecnicos.index'))}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Técnicos</span>
							</a>
							</li>
						</ul>
					</div>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{(route( 'gestion-usuarios-admin.index'))}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Administrativos</span>
							</a>
							</li>
						</ul>
					</div>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{(route( 'gestion-equipo-trabajo.index'))}} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Usuarios</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}

				<!-- Compras -->
				{{-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas fa-dollar-sign "></i> <span
						class="kt-menu__link-text ">Pagos</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ route( 'gestion-pagos-multiples.index') }} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Multiples</span>
							</a>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ route( 'gestion-pagos.index') }} " class="kt-menu__link ">
									<i class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Unico</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}

				<!-- Gastos Administrativos -->
				{{-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fa fa-truck-loading "></i> <span
						class="kt-menu__link-text ">Gastos Administrativos</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href=" " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Terminar Menu</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}
				<!-- Ventas -->
				{{-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas flaticon2-plus "></i> <span
						class="kt-menu__link-text ">Ventas</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ url('/ListarVentas') }} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ventas</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}
				<!-- Encuesta -->
				<!-- <li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fa fa-clipboard-list "></i> <span
						class="kt-menu__link-text ">Encuestas</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{(route( 'gestion-encuestas.index'))}}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver Encuestas</span>
							</a>
							</li>
						</ul>
					</div>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ url('/agregarEncuesta') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Agregar Encuesta</span>
							</a>
							</li>
						</ul>
					</div>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ url('/Encuesta') }}" class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Encuesta</span>
							</a>
							</li>
						</ul>
					</div>
				</li> -->
				{{-- <!-- Anticipo -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas flaticon2-reply-1 "></i> <span
						class="kt-menu__link-text ">Anticipo</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ route( 'gestion-anticipos.create') }} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Agregar</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}
				{{-- <!-- Comentario Email -->
				<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="javascript:; " class="kt-menu__link kt-menu__toggle "> <i
						class="kt-menu__link-icon fas fab flaticon2-send "></i> <span
						class="kt-menu__link-text ">Comentario E-mail</span> <i
						class="kt-menu__ver-arrow la la-angle-right "></i>
				</a>
					<div class="kt-menu__submenu ">
						<span class="kt-menu__arrow "></span>
						<ul class="kt-menu__subnav ">
							<li class="kt-menu__item kt-menu__item--submenu " aria-haspopup="true " data-ktmenu-submenu-toggle="hover "><a href="{{ url( 'ComentarioEmail') }} " class="kt-menu__link "> <i
									class="kt-menu__link-bullet kt-menu__link-bullet--dot "><span></span></i>
									<span class="kt-menu__link-text ">Ver</span>
							</a>
							</li>
						</ul>
					</div>
				</li> --}}
			</ul>
		</div>
	</div>
</div>
<!-- end:: Aside Menu -->

@section('ScriptporPagina')
<script>
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url : '/gestion-taller/consultar/1',
		type : "get",
		done : function(response) {console.log(response);},
			success : function(data) {
				var nmcv = data.taller_conf_vehiculo.nomb_modulo_camp_vehiculo;
				var nmarca = data.taller_conf_vehiculo.nomb_marca;
				var nmodelo = data.taller_conf_vehiculo.nomb_modelo;
				var ncolor = data.taller_conf_vehiculo.nomb_color;


				if(nmcv!=null){
					document.getElementById("idvehiculo").innerHTML = nmcv;
					document.getElementById("idvehiculo1").innerHTML ="Ver ".concat(nmcv);
				}
				if(nmarca!=null){
					document.getElementById("idmarcas").innerHTML ="Ver ".concat(nmarca);
				}
				if(nmodelo!=null){
					document.getElementById("idmodelos").innerHTML ="Ver ".concat(nmodelo);
				}
				if(ncolor!=null){
					document.getElementById("idcolores").innerHTML ="Ver ".concat(ncolor);
				}
			}
	});
});
</script>
@endsection
