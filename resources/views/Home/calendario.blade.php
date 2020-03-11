@section('estiloPorPagina')
      <link href="assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
  		<link href="assets/plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css" />
  		<link href="assets/plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css" />
  		<link href="assets/plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css" />
  		<link href="assets/plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css" />
      <link href="assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
  		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
@endsection


	<!-- begin::Body -->
	{{-- <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"> --}}
<!-- begin:: Header Topbar -->
    <!--begin::Portlet-->

        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="flaticon-map-location"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Calendario
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="#" class="btn btn-brand btn-elevate">
                    <i class="la la-plus"></i>
                    Añadir Evento 
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div id="kt_calendar" style="height: 300px !important;"></div>
        </div>



		<!--begin:: Vendor Plugins -->
		<script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
		<script src="assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>

		<script src="assets/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>


		<!--end:: Vendor Plugins -->
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--begin:: Vendor Plugins for custom pages -->
		<script src="assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>

		<!--begin::Page Scripts(used by this page) -->
		{{-- <script src="assets/js/pages/components/calendar/basic.js" type="text/javascript"></script> --}}

		<!--end::Page Scripts -->

    <script type="text/javascript">
    "use strict";

    var KTCalendarBackgroundEvents = function() {

        return {
            //main function to initiate the module
            init: function() {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {                    
                  locale: 'es',
                    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                    isRTL: KTUtil.isRTL(),
                    header: {
                        left: 'prev,next',
                        center: 'title',
                      
                    },
                    displayEventTime: false,
                    height: 400,
                    contentHeight: 480,
                    aspectRatio: 20,
                    // height: 300,
                    // contentHeight: 480,
                    // aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: { buttonText: 'mes' }                                                
                    },

                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    editable: false,
                    eventLimit: 1,
                    
                    // views: {
                        
                    //     eventLimit: 1 // adjust to 6 only for timeGridWeek/timeGridDay
                        
                    // }, // allow "more" link when too many events
                    navLinks: true,
                    businessHours: true, // display business hours
                    events: [
                        @foreach($os as $gos)
                        {
                            id: '{{$gos->gos_os_id}}',
                            title : '{{ $gos->nro_orden_interno}}',
                            start : '{{ $gos->fecha_promesa_os }}',
                            description : 'Orden de servicio - {{$gos->nro_orden_interno}}',
                            className: "fc-event-success"
                        },
                        @endforeach
                    ],                   
                    eventClick: function(info) {
                        // calendar.setOption('eventLimit',0);
                        $("#ordenes-en-proceso").modal('show');
                        $("#gos_os_id").val(info.event.id);
                        $("#fecha_promesa_os").val(info.event.start);
                        var fecha = info.event.start;
                        let formatted_date = fecha.getDate() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getFullYear()
                        
                        var tabla = $('#dt-ordenes-servicios').DataTable();
                        tabla.clear().destroy();
                    
                        $('#dt-ordenes-servicios').DataTable({
                            dom : "<'row'<'col-sm-3'l><'col-sm-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-8 col-md-6'i><'col-sm-8 col-md-6'p>>",
                            responsive : true,
                            processing : true,
                            ajax : '/ordenes-servicio-calendario/' +  formatted_date,
                            columns : [
                                {data : 'gos_os_id', visible:false},
                            {data : 'nro_orden_interno',name : 'id', render: function(data, type, meta){
                                    
                                        var id = meta.gos_os_id;
                                        return '<a href="orden-servicio-generada/'+ id+'"> # '+data+'</a>';
                                        }}, // #ORDEN
                                        {data : 'fecha_creacion',render: function(data, meta){
                                            data.split('|');
                                            var x = data.split('|');
                                            $(function () {
                                                $('[data-toggle="popover"]').popover();
                                            })
                                            return '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Apertura de la orden"><i class="fas fa-circle" style="color: #339af0;"></i>'+x[0]+'</p>'+
                                            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha Ingreso a reparacion"><i class="fas fa-square" style="color: yellow;"></i>'+x[1]+'</p>'+
                                            '<p class="m-0" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Fecha promesa"><i class="fas fa-caret-square-right" style="color: green;"></i>'+x[2]+'</p>';
                                        }}, // FECHA
                                        
                                        {data : 'dias'}, // DIAS
                                        {data : 'nomb_cliente', render: function(data, type, row){						
                                            return data.split('|').join( '<br>');
                                        }
                                        }, // CLIENTE
                                        {data : 'nomb_aseguradora_min', render: function(data, type, row){
                                            var splited = data.split('|');						
                                            // return data.split('|').join( '<br>');
                                            return splited[0]
                                            +'<br>'+splited[1]+'<strong style="color:#27395C; font-weight: 500;">'+splited[2]+'</strong>'
                                            +'<br>'+splited[3]+'<strong style="color:#27395C; font-weight: 500;">'+splited[4]+'</strong>'
                                            ;
                    
                                        }
                                        },// ASEGURADORA
                                        { data: 'detallesVehiculo', render: function(data, type, row){
                                            data.split('|').join( '<br>');
                                            var color = data.split('|');
                                            var checkbox = '<div class="circle-tile-heading" style="background-color:#'+color[0]+' "></div>';
                                            return checkbox+' '+color[1]+'<br>'+color[2] +'<br>'+ color[3]+'<br>'+ color[4]}
                                        },
                                        {data : 'tiempo'}, // TIEMPO
                                        {data : 'asesor'}, // ASESOR
                                        {data : 'nomb_etapa', render: function(data, type, row){
                                               
                                                if(data== null){
                                                     return '<div  style="color:#32b89d; -webkit-text-stroke-width: medium; font-size:1rem; text-align-last: center;">'+'Finalizada'+'</div>';
                                        
                                                }
                                                else{
                                                    return '<div  style="color: rgb(39, 57, 92);-webkit-text-stroke-width: medium; font-size:1rem; text-align-last: center;">'+data+'</div>';
                                                }
                                            }
                                        }, // TOTAL
                                        {data : 'porcentaje', render: function(data, type, meta){
                                            var e = Math.round(data);
                                            var FT = meta.fecha_terminado;
						                    var FE = meta.fecha_entregado;
                                            // return ("$"+data.tbl_pexpenses.cost*data.tbl_pexpenses.quantity);}
                                            if(data== null){
                                                    return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: #ebedf2 ;width: 100%;color:black;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'0%'+'</div></div>';                                        
                                                }
                                               
                                                else if(FT!==null && FE==null){
                                                    return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Terminada'+'</div></div>';
                                                                                
                                                }
                                                else if(FE!==null && FT!==null){
                                                    return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Entregada'+'</div></div>';
                                                                                
                                                }
                                                else if(data=="100.0000"){
                                                    return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92); width: 100%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+'Finalizada'+'</div></div>';
                                                }
                                                else{
                                                    return '<div class="progress"style="height: 2rem;"><div class="progress-bar" role="progressbar" style="background-color: rgb(39, 57, 92);width: '+e+'%;color:white;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+e+'%</div></div>';
                                                }
                                            }
                                           
                                        }, // AVANCE
                                        {data : 'Opciones',name : 'Opciones',orderable : false}
                                    ],
                                    order : [ [ 0, 'desc' ] ],
                            language : {'url' : '/gos/Spanish.json'}
                        });
                    },
                    eventRender: function(info) {
                        var element = $(info.el);
                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            }
                        }
                    }
                });

                calendar.render();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTCalendarBackgroundEvents.init();
    });
    </script>
