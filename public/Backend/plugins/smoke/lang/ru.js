(function($){
    $.fn.smkValidate.Languaje = {
        ru: {
             // Mensaje de error para los input vacíos
            textEmpty        : 'Заполните это поле',
            // Mensaje de error para el input email
            textEmail        : 'Введите валидный email',
            // Mensaje de error para el input alphanumeric
            textAlphanumeric : 'Допустимы только цыфры и/или буквы',
            // Mensaje de error para el input number
            textNumber       : 'Допустимы только цыфры',
            // Mensaje de error para el input number range
            textNumberRange  : 'Диапазон значени должен быть больше <b> {@} </b> и меньше <b> {@} </b>',
            // Mensaje de error para el input decimal
            textDecimal      : 'Допустимо только десятичные числа',
            // Mensaje de error para el input currency
            textCurrency     : 'Введите денежную сумму',
            // Mensaje de error para el input select
            textSelect       : 'Необходимо выбрать значение',
            // Mensaje de error para el input checkbox y radio
            textCheckbox     : 'Необходимо выбрать значение',
            // Mensaje de error para longitud de caracteres
            textLength       : 'Количество символов должно быть равно <b> {@} </b>',
            // Mensaje de error para rango de caracteres
            textRange        : 'Количество символов должно быть больше <b> {@} </b> и меньше <b> {@} </b>',
            // Mensaje de error para strongPass Default
            textSPassDefault : 'Необходо минимум 4 символа',
            // Mensaje de error para strongPass Weak
            textSPassWeak    : 'Необходо минимум 6 смволов',
            // Mensaje de error para strongPass Madium
            textSPassMedium  : 'Необходо минимум 6 символов и цыфер',
            // Mensaje de error para strongPass Strong
            textSPassStrong  : 'Необходо минимум 6 символа и цыфер'
        }
    };

    $.smkEqualPass.Languaje = {
        ru: {
            // Mensaje de error para el input repassword
            textEqualPass    : 'Пароли не совпадают'
        }
    };
    $.smkDate.Languaje = {
        ru: {
            shortMonthNames : ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
            monthNames : ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]
        }
    };

}(jQuery));