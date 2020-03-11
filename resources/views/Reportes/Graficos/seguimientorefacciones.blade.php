<link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />



<!--begin::Portlet-->
<div class="kt-portlet">
  <input type="hidden" id="RSOL" value="{{$RSOL}}">
	<input type="hidden" id="REP" value="{{$REP}}">
	<input type="hidden" id="RFV" value="{{$RFV}}">
	<input type="hidden" id="RFREC" value="{{$RFREC}}">
	<input type="hidden" id="RNA" value="{{$RNA}}">
	<input type="hidden" id="RFCN" value="{{$RFCN}}">
	<input type="hidden" id="RAUT" value="{{$RAUT}}">
	<input type="hidden" id="RRECH" value="{{$RRECH}}">


    <div class="kt-portlet__body">
        <h3 class="kt-portlet__head-title">
            Estado de refacciones
        </h3>
        <div id="kt_amcharts_13" style="height: 500px;"></div>
    </div>
</div>

<!--end::Portlet-->

{{-- </div>
						</div> --}}

<!-- end:: Content -->



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


<!--begin:: Vendor Plugins -->
<script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>



<script type="text/javascript">
var RSOL=parseInt(document.getElementById('RSOL').value);
var REP=parseInt(document.getElementById('REP').value);
var RFV=parseInt(document.getElementById('RFV').value);
var RFREC=parseInt(document.getElementById('RFREC').value);
var RAUT=parseInt(document.getElementById('RAUT').value);
var RNA=parseInt(document.getElementById('RNA').value);
var RFCN=parseInt(document.getElementById('RFCN').value);
var RRECH=parseInt(document.getElementById('RRECH').value);
    var KTamChartsChartsDemo = function() {
        var demo13 = function() {
            /**
             * Define data for each year
             */
            var chartData = {
                2020: [{
                        "sector": "Pendiente Autorizacion",
                        "size": RSOL

                    },
                    {
                        "sector": "En Proceso(En Tiempo)",
                        "size": REP
                    },
                    {
                        "sector": "En Proceso(Fuera Tiempo)",
                        "size": RFV
                    },
                    {
                        "sector": "Recibidas",
                        "size": RFREC
                    },
                    {
                        "sector": "Sin Provedor",
                        "size": RAUT
                    },
										{
												"sector": "No Autorizado",
												"size": RNA
										},
                    {
                        "sector": "Canceladas",
                        "size": RFCN
                    },
										{
												"sector": "Rechazadas",
												"size": RRECH
										}
                ]

            };

            /**
             * Create the chart
             */
            var currentYear = 2020;
            var chart = AmCharts.makeChart("kt_amcharts_13", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [],
                "valueField": "size",
                "titleField": "sector",
                "startDuration": 0,
                "innerRadius": 95,
                "pullOutRadius": 20,
                "marginTop": 30,
                "titles": [{
                    "text": ""
                }],
                "allLabels": [{
                    "y": "54%",
                    "align": "center",
                    "size": 25,
                    "bold": true,
                    "text": "",
                    "color": "#555"
                }, {
                    "y": "49%",
                    "align": "center",
                    "size": 15,
                    "text": "",
                    "color": "#555"
                }],
                "listeners": [{
                    "event": "init",
                    "method": function(e) {
                        var chart = e.chart;

                        function getCurrentData() {
                            var data = chartData[currentYear];
                            currentYear++;
                            if (currentYear > 2020)
                                currentYear = 2020;
                            return data;
                        }

                        function loop() {
                            chart.allLabels[0].text = currentYear;
                            var data = getCurrentData();
                            chart.animateData(data, {
                                duration: 1000,
                                complete: function() {
                                    setTimeout(loop, 3000);
                                }
                            });
                        }

                        loop();
                    }
                }],
                "export": {
                    "enabled": true
                }
            });
        }


        return {
            // public functions
            init: function() {
                demo13();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTamChartsChartsDemo.init();
    });
</script>
