@include('Layout/head')

<!-- begin::Body -->
<body
	class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">
	<!-- begin:: Page -->

	@include('Layout/headerMobile')

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div
			class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			@include('Layout/aside')

			<div
				class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"
				id="kt_wrapper">

				<!-- begin:: Header -->
				@include('Layout/header')
				<!-- end:: Header -->

				<div
					class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor py-2"
					id="kt_content">
					<!-- begin:: Content -->
					<div
						class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid px-2">
						@yield('Content')</div>
					<!-- end:: Content -->

				</div>
				<!-- begin:: Footer -->
				<div
					class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop"
					id="kt_footer">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-footer__copyright">
							2020&nbsp;&copy;&nbsp;<a href="" target="_blank" class="kt-link">Sistema
								de Gestión de Ordenes de Servicios de Taller</a>
						</div>
						<div class="kt-footer__menu">
							<a href="" target="_blank" class="kt-footer__menu-link kt-link">Acerca
								de</a> <a href="" target="_blank"
								class="kt-footer__menu-link kt-link">Contacto</a>
						</div>
					</div>
				</div>
				<!-- end:: Footer -->
			</div>
		</div>
	</div>

	<!-- end:: Page -->



	@include('Layout/script')
	<!-- Inicio Scripts de la pagina -->
	@yield('ScriptporPagina')
	<!-- Fin Scripts de la pagina -->
</body>

<!-- end::Body -->
</html>