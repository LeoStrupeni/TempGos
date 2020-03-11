<link href="assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-xl-9 col-lg-9 order-lg-2 order-xl-1">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tab">

            <div class="kt-portlet__body" style="padding-right: 0 !important;">
              {{-- <h3 class="kt-portlet__head-title" style="font-size: 1.2em;">
                <br>
              </h3> --}}
                <div id="kt_productividad_1" style="height:300px;"></div>
            </div>
        </div>

        <!--end::Portlet-->
    </div>

    <div class="col-xl-3 col-lg-3 order-lg-2 order-xl-1">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__body">
              {{-- <h3 class="kt-portlet__head-title" style="font-size: 1.2em;">
                <br>
              </h3> --}}
                <div id="kt_productividad_2" style="height:300px;"></div>
            </div>
        </div>

        <!--end::Portlet-->
    </div>
</div>



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


<script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="assets/plugins/general/raphael/raphael.js" type="text/javascript"></script>
<script src="assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>


<!--end:: Vendor Plugins -->
<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>


<script src="assets/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
<script src="assets/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>


<!--begin::Page Scripts(used by this page) -->
{{-- <script src="assets/js/pages/components/charts/morris-charts.js" type="text/javascript"></script> --}}
<script type="text/javascript">
    "use strict";
    // Class definition
    var KTMorrisChartsDemo = function() {

        var productividadEtapas = function() {
            // BAR CHART
            new Morris.Bar({
                element: 'kt_productividad_1',
                data: [{
                    y: 'Por entregar producto',
                    a: 1

                },
                {
                    y: 'Notificación de llegada',
                    a: 5
                },
                {
                    y: 'Valuación',
                    a: 2

                },
                {
                    y: 'Valuación de daños',
                    a: 3

                },
                {
                    y: 'Autorización',
                    a: 1
                },
                {
                    y: 'Refacciones inundados',
                    a: 1
                },
                {
                    y: 'Laminado',
                    a: 2
                },
                {
                    y: 'Armado y pulido',
                    a: 1
                },
                {
                    y: 'Varillaje',
                    a: 5
                }
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: [''],
                barColors: ['#5F9EA0']
            });

            new Morris.Bar({
                element: 'kt_productividad_2',
                data: [{
                    y: 'Órdenes',
                    a: 3
                }],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Órdenes'],
                barColors: ['#F08080']
            });
        }



        return {
            // public functions
            init: function() {
                productividadEtapas();

            }
        };
    }();

    jQuery(document).ready(function() {
        KTMorrisChartsDemo.init();
    });
</script>
