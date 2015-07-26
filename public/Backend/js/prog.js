jQuery(document).ready(function(){
	// Init datatables plugin
  	if ($('#datatables').length) {
  	  var oldStart = 0;
  	  $("#datatables").dataTable({
  	  	language: {
	        processing:     "Загрузка...",
	        search:         "Поиск&nbsp;:",
	        lengthMenu:     "Показывать _MENU_ элементов",
	        info:           "Показано с _START_ по _END_ из _TOTAL_ записей",
	        infoEmpty:      "Показано с 0 по 0 из 0 записей",
	        infoFiltered:   "(Всего отфильтовано _MAX_ элементов)",
	        infoPostFix:    "",
	        loadingRecords: "Загрузка записей...",
	        zeroRecords:    "Записи отсутствуют",
	        emptyTable:     "Данные отсутствуют",
	        paginate: {
	            first:      "Первая",
	            previous:   "Предыдущая",
	            next:       "Следующая",
	            last:       "Последняя"
	        },
	        aria: {
	            sortAscending:  ": сортировать по возрастанию",
	            sortDescending: ": сортировать по убыванию"
	        }
	    },
	    pageLength: 50,
	    scrollCollapse: true,
	    stateSave: true,
	    lengthMenu: [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ],
		  "fnDrawCallback": function (o) {
            if ( o._iDisplayStart != oldStart ) {
            	var targetOffset = $('#datatables').closest('.box-body').offset().top;
                $('html,body').animate({scrollTop: targetOffset}, 500);
                oldStart = o._iDisplayStart;
            }
        }
	    });
  	};

  	// CkEditor init
  	if ($('#ckeditor').length) {
  		// Replace the <textarea id="ckeditor"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
  	};

  	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"]:not(.switcher), input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    // Botstrap switch
    if ($('.switcher').length) {
    	$('.switcher').bootstrapSwitch({
    		size: "small",
    		inverse: true,
    		onText: "Включено",
    		offText: "Выключено"
    	});
    };

    // Bootstrap taginput
    if ($('.taginput').length) {
    	$('.taginput').tagsinput();
    };

    // Confirm close create or edit forms
    if ($('.close_form').length) {
    	$('.close_form').click(function(event){
    		var it = $(this);
    		if ($('form[name="main_form"]').attr('data-changed') == 'true') {
    			event.preventDefault();
	    		$.smkConfirm({
		    			text: 'Вы действительно хотите закрыть? Вся информация будет утеряна!',
		    			accept: 'Да',
		    			cancel: 'Нет'
		    		},
		    		function(e) {
		    			if (e) {
		    				location.href = $(it).attr('href');
		    			};
		    	});
	    	}
    	});
    };
    // binding some form changes
    if ($('form[name="main_form"]').length) {
    	$("input, textarea").bind("keyup keydown keypress change blur", function() {
	        $('form[name="main_form"]').attr('data-changed', true);
    	});
    };

    if ($('#daterange-btn').length) {

      $('#daterange-btn').click(function(event){
        event.preventDefault();
      });
      
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          locale: {
            format: "DD/MM/YYYY",
            separator: "-",
            applyLabel: "Применить",
            cancelLabel: "Отмена",
            fromLabel: "От",
            toLabel: "До",
            customRangeLabel: "Пользовательский",
            daysOfWeek: [
                "Нд",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            monthNames: [
                "Январь",
                "Феврать",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            firstDay: 1
          },
          ranges: {
            'Сегодгя': [moment(), moment()],
            'Вчера': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Последние 7 дней': [moment().subtract('days', 6), moment()],
            'Последние 30 дней': [moment().subtract('days', 29), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Предыдущий месяц': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          }
        },
        function (start, end, label) {
          $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + '_' + end.format('YYYY-MM-DD'));
          $('form[name="control_form"]').submit();
        });
      // Set start and end dates 
      // if ($('#daterange-btn').attr('data-dates')) {
      //   var dates = $('#daterange-btn').attr('data-dates').split('_');
      //   $('#daterange-btn').data('daterangepicker').setStartDate(dates[0]);
      //   $('#daterange-btn').data('daterangepicker').setEndDate(dates[1]);
      // };
    };
});