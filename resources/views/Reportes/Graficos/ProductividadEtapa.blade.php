<!--begin::Page Vendors Styles(used by this page) -->
<link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />


<div class="row">
    <div class="col-xl-9 col-lg-9 order-lg-2 order-xl-1">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__body">

                <div id="kt_amcharts_1" style="height:300px;"></div>
            </div>
        </div>

        <!--end::Portlet-->
    </div>

    <div class="col-xl-3 col-lg-3 order-lg-2 order-xl-1">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__body">
              <h3 class="kt-portlet__head-title" style="font-size: 1.2em;">
                <br>
              </h3>
                <div id="kt_amcharts_2" style="height:300px;"></div>
            </div>
        </div>

        <!--end::Portlet-->
    </div>
</div>





	{{-- <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"> --}}

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->

		<!--begin::Global Theme Bundle(used by all pages) -->

		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		<script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		{{-- <script src="assets/js/pages/components/charts/amcharts/charts.js" type="text/javascript"></script> --}}
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


    <!--begin:: Vendor Plugins -->
    <script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>


    {{-- <script src="assets/js/pages/components/charts/amcharts/charts.js" type="text/javascript"></script> --}}

    </script>
    <script type="text/javascript">
	    var KTamChartsChartsDemo = function() {

      var demo1 = function() {
        var chart = AmCharts.makeChart("kt_amcharts_1", {
          "rtl": KTUtil.isRTL(),
          "type": "serial",
          "theme": "light",
          "dataProvider": [{
              "Etapa": "Por entregar producto",
              "Productividad": 60
          }, {
              "Etapa": "Notificacion de llegada",
              "Productividad": 240
          }, {
              "Etapa": "Valuacion de datos",
              "Productividad": 40
          }, {
              "Etapa": "Autorizacion",
              "Productividad": 350
          }, {
              "Etapa": "Refacciones inundados",
              "Productividad": 70
          }, {
              "Etapa": "Laminado",
              "Productividad": 0
          }, {
              "Etapa": "Armado y pulido",
              "Productividad": 20
          }, {
              "Etapa": "Varillaje",
              "Productividad": 44
          }],
          "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0
          }],
          "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [{
              "balloonText": "[[category]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "Productividad"
          }],
          "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
          },
          "categoryField": "Etapa",
          "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0,
              "tickPosition": "start",
              "tickLength": 20
          },
          "export": {
              "enabled": true
          }

      });

			var chart = AmCharts.makeChart("kt_amcharts_2", {
				"rtl": KTUtil.isRTL(),
				"type": "serial",
				"theme": "light",
				"dataProvider": [{
						"Etapa": "Ordenes",
						"Productividad": 242
				}],
				"valueAxes": [{
						"gridColor": "#FFFFFF",
						"gridAlpha": 0.2,
						"dashLength": 0
				}],
				"gridAboveGraphs": true,
				"startDuration": 1,
				"graphs": [{
						"balloonText": "[[category]]: <b>[[value]]</b>",
						"fillAlphas": 0.8,
						"lineAlpha": 0.2,
						"type": "column",
						"valueField": "Productividad"
				}],
				"chartCursor": {
						"categoryBalloonEnabled": false,
						"cursorAlpha": 0,
						"zoomable": false
				},
				"categoryField": "Etapa",
				"categoryAxis": {
						"gridPosition": "start",
						"gridAlpha": 0,
						"tickPosition": "start",
						"tickLength": 20
				},
				"export": {
						"enabled": true
				}
		});
  }

      return {
          // public functions
          init: function() {
              demo1();
          }
      };
    }();

    jQuery(document).ready(function() {
        KTamChartsChartsDemo.init();
    });
  </script>
