jQuery(document).ready(function(){
    // Init datatables plugin
        if ($('#datatables').length) {
            var oldStart = 0;
            var table = $("#datatables").dataTable({
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
                ordering: false,
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

            if ($('#datatables').data('order') == 'no-order') {
                // Код отключения сортировки или указания колонки для сортировки
                alert(23);
                table.dataTable.aoColumns = [ { sWidth: "45%" }, { sWidth: "45%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ];
            };
        };

        // CkEditor init
        if ($('#ckeditor').length) {
            // Replace the <textarea id="ckeditor"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('ckeditor');
        };

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"]:not(.switcher):not(.switch), input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //Red color scheme for iCheck
        $('input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
        //Blue color scheme for iCheck
        $('input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
        //Flat green color scheme for iCheck
        $('input[type="radio"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
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

        // Botstrap switch yes | no
        if ($('.switcherBoolean').length) {
            $('.switcherBoolean').bootstrapSwitch({
                inverse: true,
                onText: "Да",
                offText: "Нет"
            });
        };

        // Just switcher
        if ($('.switch').length) {
            $('.switch').bootstrapSwitch();
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

        // Events to main form
        if ($('form[name="main_form"]').length) {
            var main_form = $('form[name="main_form"]');
            // binding some form changes
            $("input, textarea").bind("keyup keydown keypress change", function() {
                    $(main_form).attr('data-changed', true);
            });

            // Form validate using somke plugin
            $(main_form).on('click', 'button[name="action"]', function (event) {
                $("input[name='button_action']").val($(this).val());
                // Disable validation
                if ($(main_form).data('valid') == false) {
                    $(main_form).submit();
                };
                if($(main_form).smkValidate({lang:'ru'}) ) {
                    $(main_form).submit();
                }
            });

            // $(main_form).submit(function(event){
            // });
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


        // Init smoke notifications if need
        jQuery.getJSON('/backend/notifications', function(data) {
            if (data.length) {
                for (var i = 0; i < data.length; i++) {
                    // init Smoke notification
                    var oneNoty = data[i];
                    $.smkAlert(oneNoty);
                };
            };
        });

        // Slugify for url alias
        if ($('#slugify_source').length) {
            $('#slugify_target').slugify('#slugify_source');
        };

        // Date time picker
        if ($('#datetimepicker').length) {
            $('#datetimepicker').datetimepicker({
                locale: 'ru',
                format: 'YYYY-MM-DD HH:mm'
            });
        };

        // Nestable plugin
        if ($('.nestable').length) {
            $('.nestable').nestable({
                rootClass       : 'nestable',
                expandBtnHTML   : '',
                collapseBtnHTML : '',
            })
            .on('change', updateSort);

            // Function update sort in DB
            function updateSort(e) {
                var list  = e.length ? e : $(e.target),
                    table = $(e.target).data('table');
                if (window.JSON) {
                    if (table == undefined) {
                        $.smkAlert({text:'Название таблицы не определено', type:'danger', time:3});
                        return false;
                    };
                    var json = window.JSON.stringify(list.nestable('serialize'));
                    // Send ajax to server
                    $.post(
                        '/backend/updateSort',
                        {
                            table: table,
                            json : json
                        },
                        function(data){
                            if (data.smoke == true) {
                                $.smkAlert(data);
                            };
                        },
                        'json');
                } else {
                    $.smkAlert({text:'Ваш браузер не поддрживает JSON', type:'info', time:3});
                }
            }

        };

});