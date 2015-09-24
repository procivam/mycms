<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Параметр :attribute должен быть включен.',
    'active_url'           => 'Параметр :attribute не валидный URL.',
    'after'                => 'Параметр :attribute должен быть датой позже чем :date.',
    'alpha'                => 'Параметр :attribute может содержать только буквы.',
    'alpha_dash'           => 'Параметр :attribute может содержать только буквы, цифры, и тире.',
    'alpha_num'            => 'Параметр :attribute может содержать только буквы и цифры.',
    'array'                => 'Параметр :attribute должен быть массивом.',
    'before'               => 'Параметр :attribute должен быть датой раньше чем :date.',
    'between'              => [
        'numeric' => 'Параметр :attribute должен быть больше :min и меньше :max.',
        'file'    => 'Параметр :attribute должен быть больше :min и меньше :max килобайт.',
        'string'  => 'Параметр :attribute должен быть больше :min и меньше :max символов.',
        'array'   => 'Параметр :attribute должен иметь больше :min и меньше :max элементов.',
    ],
    'boolean'              => 'Поле :attribute должно быть истиной или ложью.',
    'confirmed'            => 'Параметр :attribute не совпадает.',
    'date'                 => 'Параметр :attribute не валидный формате даты.',
    'date_format'          => 'Параметр :attribute не соответствует формату :format.',
    'different'            => 'Параметр :attribute и :other должны быть различными.',
    'digits'               => 'Параметр :attribute должен быть :digits цифр.',
    'digits_between'       => 'Параметр :attribute должен быть больше :min и меньше :max цифр.',
    'email'                => 'Параметр :attribute должен быть действительным email адресом.',
    'filled'               => 'Поле :attribute обязательное для заполнения.',
    'exists'               => 'Выбраный :attribute не валидный.',
    'image'                => 'Параметр :attribute должен быть изображением.',
    'in'                   => 'Выбраный :attribute не валидный.',
    'integer'              => 'Параметр :attribute должен быть целым числом.',
    'ip'                   => 'Параметр :attribute должен быть валидным IP адресом.',
    'max'                  => [
        'numeric' => 'Параметр :attribute не может быть больше :max.',
        'file'    => 'Параметр :attribute не может быть больше :max килобайт.',
        'string'  => 'Параметр :attribute не может быть больше :max символов.',
        'array'   => 'Параметр :attribute may not have more than :max элементов.',
    ],
    'mimes'                => 'Параметр :attribute должен быть полем типа: :values.',
    'min'                  => [
        'numeric' => 'Параметр :attribute не должен быть меньше :min.',
        'file'    => 'Параметр :attribute не должен быть меньше :min килобайт.',
        'string'  => 'Параметр :attribute не должен быть меньше :min символов.',
        'array'   => 'Параметр :attribute не должен иметь меньше :min элементов.',
    ],
    'not_in'               => 'Выбраный :attribute не валидный.',
    'numeric'              => 'Параметр :attribute должен быть числом.',
    'regex'                => 'Формат :attribute не валидный.',
    'required'             => 'Поле :attribute обязательное для заполения.',
    'required_if'          => 'Поле :attribute обязательное как только :other будет равен :value.',
    'required_with'        => 'Поле :attribute обязательное как только :values будет присутствовать.',
    'required_with_all'    => 'Поле :attribute обязательное как только :values будет присутствовать.',
    'required_without'     => 'Поле :attribute обязательное как только :values не будет присутствовать.',
    'required_without_all' => 'Поле :attribute обязательное как только никто из :values не будет присутствовать.',
    'same'                 => 'Параметр :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Параметр :attribute должен быть :size.',
        'file'    => 'Параметр :attribute должен быть :size килобайт.',
        'string'  => 'Параметр :attribute должен быть :size символов.',
        'array'   => 'Параметр :attribute должен иметь :size элементов.',
    ],
    'timezone'             => 'Параметр :attribute должен быть валидной зоной.',
    'string'               => 'Параметр :attribute должен быть строкой.',
    'unique'               => 'Параметр :attribute должен быть уникальным.',
    'url'                  => 'Формат :attribute должен быть валидный URL.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'Название',
        'title' => 'Заголовок (Title)',
        'text' => 'Содержание',
    ],

];
