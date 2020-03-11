<!DOCTYPE html>

<html lang="es">

	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>Pro Order</title>
		<meta name="description" content="Sistema GOS">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<link href="{{env('APP_URL')}}/assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/gos/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

		<!--end:: Vendor Plugins -->
		<link href="{{env('APP_URL')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin:: Vendor Plugins for custom pages -->
		@yield('estiloPorPagina')
	

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{env('APP_URL')}}/assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="icon" href="{{env('APP_URL')}}/assets/media/logos/favicon.ico"/>
		
		{{-- Estilos generales --}}
		<link rel="stylesheet" href="/gos/css/styleGeneral.css">
		<link rel="stylesheet" href="/gos/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="/gos/css/rowReorder.bootstrap4.min.css">
		<link rel="stylesheet" href="/gos/css/inventario.css">
		<link rel="stylesheet" href="../gos/css/busqueda-headtable.css">
		<link rel="stylesheet" href="../gos/css/menu_vertical.css">
		<link rel="stylesheet" href="../gos/css/botones.css">
		<link rel="stylesheet" href="../gos/css/progress-bar.css">
		<link href="https://transloadit.edgly.net/releases/uppy/v0.25.2/dist/uppy.min.css" rel="stylesheet">
	</head>

	<!-- end::Head -->
