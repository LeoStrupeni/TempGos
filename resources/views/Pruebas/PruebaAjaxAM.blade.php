<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Prueba AM</title>
		<meta name="description" content="Server-side processing examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->

		<!--begin:: Vendor Plugins -->

		<!--end:: Vendor Plugins -->
		<link href="{{env('APP_URL')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin:: Vendor Plugins for custom pages -->


		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->


		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{env('APP_URL')}}/assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="index.html">
					<img alt="Logo" src="{{env('APP_URL')}}/assets/media/logos/logo-light.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>



				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
						<div class="kt-header__topbar">






					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">

								<div class="kt-portlet__body">

									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
										<thead>
											<tr>
												<th>Cliente</th>
<<<<<<< HEAD
												<th>Vehículo</th>
												<th># económico</th>
												<th># serie</th>
												<th></th>
												<th>Status</th>
												<th>Type</th>
												<th>Actions</th>
=======
												<th>Vehiculo</th>
												<th>economico</th>
												<th>serie</th>
												<th>Menu</th>
>>>>>>> 4314ebb9d1d58b052cb410fc1543b93ce11d5372
											</tr>
										</thead>
									</table>

									<!--end: Datatable -->
								</div>
							</div>
						</div>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->


					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->



		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->


		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/quill/dist/quill.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/raphael/raphael.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/general/dompurify/dist/purify.js" type="text/javascript"></script>

		<!--end:: Vendor Plugins -->
		<script src="{{env('APP_URL')}}/assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--begin:: Vendor Plugins for custom pages -->
		<script src="{{env('APP_URL')}}/assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/datatables.net-select/js/dataTables.select.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jstree/dist/jstree.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/uppy/dist/uppy.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/tinymce/themes/silver/theme.js" type="text/javascript"></script>
		<script src="{{env('APP_URL')}}/assets/plugins/custom/tinymce/themes/mobile/theme.js" type="text/javascript"></script>

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
<<<<<<< HEAD
		<script src="{{env('APP_URL')}}/assets/js/pages/crud/datatables/data-sources/ajax-server-side.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>
=======
		<script src="{{env('APP_URL')}}/assets/js/pages/crud/datatables/data-sources/prueba-ajaxAM.js" type="text/javascript"></script>
>>>>>>> 4314ebb9d1d58b052cb410fc1543b93ce11d5372

	<!-- end::Body -->
</html>
