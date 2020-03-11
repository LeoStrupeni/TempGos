<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
        <div></div>
        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">

          <div class="kt-header__topbar-item kt-header__topbar-item--user">
              <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                  <div class="kt-header__topbar-user">
                      <span class="kt-header__topbar-welcome kt-hidden-mobile"><a id="tickets" >Tickets:</a></span>

                  </div>
              </div></div>

      <!--begin: Notificaciones de mensajes -->

    <div class="kt-header__topbar-item dropdown">
		<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
			<span class="kt-header__topbar-icon">
				<i class="flaticon2-chat-1"></i>
				<span id="badge_mensajes" class="kt-badge kt-badge--success" style="align-self: normal;"></span>

			</span>
		</div>
		<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
			<form>
                <!--begin: Head -->
                <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                    <h3 class="kt-head__title" style="padding-left: 2rem; text-align:initial;">
                        Mensajes
                        &nbsp;
                        <span id="badge_mensajes_2" class="kt-badge kt-badge--inline" style="background-color: #0abb87;font-size: small; font-weight: bolder;"></span>
                    </h3>
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">


                    </ul>
                </div>
                <!--end: Head -->

                <div class="tab-content">
                    <div  class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                               <a id="n_mensajes">


                               </a>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>
	<!--end: Notifications -->

        <!--begin: Notificaciones de mensajes -->
               <!--begin: Notifications -->

            <div class="kt-header__topbar-item dropdown">
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px"
                        aria-expanded="true">
                        <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                            <i class="flaticon2-bell-alarm-symbol"></i>
                            <span class="kt-pulse__ring"></span>
                        </span>
                    </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                    <div class="kt-notification">
                        <a href=""
                            class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon-bell-1 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Notificaciones
                                </div>
                                <div class="kt-notification__item-time">
                                    No hay ninguna notificación
                                </div>
                            </div>
                        </a>
                    </div>
                        <!--begin: Head -->
                </div>
            </div>
          
            <!--end: Quick Actions -->

            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                        <span class="kt-header__topbar-welcome kt-hidden-mobile">Hola,</span>
                        <span class="kt-header__topbar-username kt-hidden-mobile">{{ Session::get('usr_Data.nombre_apellidos') }} <?php if (Session::get('usr_Data.nombre_apellidos')==NULL): ?>  Usuario Indefinido  <?php endif; ?></span>
                            <span class="kt-header__topbar-icon">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    </div>
                </div>

                <div
                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                      
                        <a href="{{ url('gestion-taller') }}"
                            class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="kt-menu__link-icon fas fa-tools kt-font-warning"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Mi Taller
                                </div>
                                <div class="kt-notification__item-time">
                                       {{ Session::get('usr_Data.taller_nomb') }} <?php if (Session::get('usr_Data.taller_nomb')==NULL): ?> Taller Indefinido  <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        <!--  -->
                        <a href="/elearn"
                            class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="kt-menu__link-icon fas fa-book kt-font-info" ></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    E-learning
                                </div>
                                <div class="kt-notification__item-time">
                                       {{ Session::get('usr_Data.taller_nomb') }} <?php if (Session::get('usr_Data.taller_nomb')==NULL): ?> Taller Indefinido  <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        <!--  -->
                        <!--  -->
                        <a href="/soporte"
                            class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="kt-menu__link-icon fas fa-headset kt-font-secondary" style="color:rgb(39, 57, 92);"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Soporte
                                </div>
                                <div class="kt-notification__item-time">

                                          {{ Session::get('usr_Data.taller_nomb') }} <?php if (Session::get('usr_Data.taller_nomb')==NULL): ?> Taller Indefinido  <?php endif; ?>
                                </div>
                            </div>
                        </a>


                        <div class="kt-notification__custom kt-space-between">
                            <a href="/Logout/{{ Session::get('usr_Data.email') }}/session" target=""
                                class="btn btn-label btn-label-brand btn-sm btn-bold">Cerrar sesión</a>
                        </div>
                    </div>
                    <!--end: Navigation -->
                </div>
            </div>
            <!--end: User Bar -->
        </div>
        <!-- end:: Header Topbar -->
    </div>
    <!-- end:: Header -->
    @include('Layout/ModalMensaje')

@section('ScriptporPagina')
	<script src="{{env('APP_URL')}}/gos/ajax-inicio.js"></script>
@endsection
