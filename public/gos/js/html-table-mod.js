"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
	// Private functions

	// demo initializer
	var demo = function() {

		var datatable = $('.kt-datatable').KTDatatable({
			data: {
				saveState: {cookie: false},
			},
			search: {
				input: $('#generalSearch'),
			},
			columns: [
				{
					field: 'Nombre',
					type: 'text',
				},
				{
					field: 'Descripción',
					type: 'text',
				},
			],
		});


    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// Public functions
		init: function() {
			// init dmeo
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableHtmlTableDemo.init();
});