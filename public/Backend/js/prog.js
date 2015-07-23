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
	    	var flag = false;
	    	$('form[name="main_form"]').find('input[type="text"], textarea').each(function(index, el){
	    		if ( $(el).val().length )
	    			flag = true;
	    		return true;
	    	});
	    	if (flag == true) {
    			event.preventDefault();
	    		$.smkConfirm({
		    			text: 'Вы действительно хотите закрыть? Вся информация потеряется',
		    			accept: 'Да',
		    			cancel: 'Нет'
		    		},
		    		function(e) {
		    			if (e) {
		    				location.href = $(it).attr('href');
		    			};
		    		}
	    		);
	    	};
    	});
    };

});