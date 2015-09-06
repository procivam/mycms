<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | More documentation http://image.intervention.io/
    | 
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'imagick',

    /**
     * Default name for input type="file" tag.
     */
    'image_name' => 'image',

    /**
     * Image quality
     */
    'quality' => 70,

    /**
     * Allowed extensions
     */
    'extensions' => [
        'gd' => [
            'jpg',
            'jpeg',
            'png',
            'gif',
        ],
        'imagick' => [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'tif',
            'bmp',
            'ico',
            'psd',
        ],
    ],

    /**
     * Watermark
     *
     * Available parameters:
     * @param string   text         Text for watermark.
     * @param string   position     Position watermark. Params: top-left, top,
     *                              top-right, left, center, right, bottom-left,
     *                              bottom, bottom-right. Default: bottom-right.
     * @param integer  size         Font size watermark. 
     */
    'watermark' => [
        'text'      => $_SERVER['HTTP_HOST'],
        'position'  => 'bottom-right',
        'color'     => '#777',
        'size'      => 20,
        'font_file' => 'public/Frontend/fonts/watermark.ttf',
    ],

    /**
     * Images path
     *
     * Available parameters for image:
     * @param integer  width                    Width image.
     * @param integer  height                   Height image.
     * @param boolean  crop        true|false   Crop image.
     * @param string   crop_mode   crop|fit     crop-just crop. fit - combine cropping
     *                                          and resizing. Default - fit.
     * @param boolean  resize      true|false   Resise image for set sizes.
     * @param boolean  watermark   true|false   Write watermark text into image. 
     *                                          Default - false.
     */
    'path' => [
        'pages' => [
            'small' => [
                'width' => 200,
                'height' => 100,
                'crop' => true,
                'resize' => true,
                'watermark' => false,

            ],
            'medium' => [
                'width' => 400,
                'height' => 600,
                'crop' => true,
                'crop_mode' => 'crop',
            ],
            'original' => [
                'watermark' => false,
            ],
        ],
    ],

);
