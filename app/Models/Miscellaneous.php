<?php
namespace laravel\Models;

use File;
use Image;
use Illuminate\Http\Request;
use HtmlObject\Input;
use Exception;

class Miscellaneous
{
    /**
     * Upload all images for sets foolders
     * 
     * @param  Request    $request
     * @param  Array|null $data    Custom data for save images. Structure:
     *                             'path' - Name config image path. Ex.: pages, news.
     *                             'image_name' - Name for input tag. Optional.
     * 
     * @throws Excetpion           If some went wrong.
     * 
     * @return string|false        File name or false if file not given.
     */
    public static function uploadImage(Request $request, Array $data = null)
    {
        $imageName = array_key_exists('image_name', $data) ? 
            $data['image_name'] : config('image.image_name');
        if (mb_strlen($imageName) == 0) {
            throw new Exception('Name for input element not set');
        }

        $file = $request->file($imageName);
        
        if ($request->hasFile($imageName) == false) {
            if (array_key_exists('error_no_file', $data)
                AND $data['error_no_file'] == true) {
                throw new Exception(sprintf('No file given with "%s" tag name', $imageName));
            }
            else {
                return false;
            }
        }

        if ($file->isValid() !== true) {
            throw new Exception(sprintf('Input file has error: #%d "%s".',
                $file->getError(),
                $file->getErrorMessage()));
        }

        if (array_key_exists('path', $data) == false
            OR array_key_exists($data['path'], config('image.path')) == false) {
            throw new Exception('Group name not given. Or has not been declared');
        }
        
        $ext = $file->getClientOriginalExtension();
        if (in_array($ext, config('image.extensions.'.config('image.driver'))) == false) {
            throw new Exception(sprintf('Given extension "%s" not allowed.', $ext));
        }
        $name = sha1_file($file);
        $name = sha1($name.microtime()).'.'.$ext;

        foreach (config('image.path.'.$data['path']) as $subPath => $param) {
            /**
             * Operations on the image
             */
            $img = Image::make($file);

            // Resize
            if (array_key_exists('resize', $param) == true 
                AND $param['resize'] == true) {
                $img->resize($param['width'], $param['height']);
            }

            // Croping
            if (array_key_exists('crop', $param) == true
                AND $param['crop'] == true) {
                // Crop
                if (array_key_exists('crop_mode', $param) == true
                    AND $param['crop_mode'] == 'crop') {
                    $img->crop($param['width'], $param['height']);
                // Fit
                } else {
                    $img->fit($param['width'], $param['height']);
                }
            }

            //Watermark
            if (array_key_exists('watermark', $param) == true
                AND $param['watermark'] == true) {
                switch (config('image.watermark.position')) {
                    case 'top-left':
                        $x = 0;
                        $y = 0;
                        break;
                    case 'top':
                        $x = 0;
                        $y = 0;
                        break;
                    case 'top-right':
                    
                        break;
                    case 'left':
                    
                        break;
                    case 'center':
                    
                        break;
                    case 'right':

                        break;

                    case 'bottom-left':

                        break;

                    case 'bottom':

                        break;
                    
                    case 'bottom-right':

                        break;

                    // Bottom right
                    default:

                        break;
                }

                $img->text(config('image.watermark.text'), $x, $y, function($font){
                    $font->file(config('image.watermark.font_file'));
                    $font->size(config('image.watiremark.size'));
                    $font->color('#fdf6e3');
                    $font->align('center');
                    $font->valign('top');
                });
            }

            /**
             * Operations on the storage image
             */
            $path = media_path().'images'.DIRECTORY_SEPARATOR.$data['path'].
                DIRECTORY_SEPARATOR.$subPath.DIRECTORY_SEPARATOR;
            // Create directories if not exists
            if (file_exists($path) === false OR is_dir($path) === false) {
                mkdir($path, 0777, true);
            }

            if (is_writable($path) !== true) {
                throw new Exception(sprintf('The directory "%s" must be writable', $path));
            }
            $img->save($path.$name, config('image.quality'));
        }
        // Return image names
        return $name;
    }

    /**
     * Remove image all versions
     * 
     * @param  string  $path      
     * @param  string  $imageName
     *
     * @throws Excetption          If some went wronk.
     * 
     * @return boolean true|false
     */
    public static function removeImages($path, $imageName)
    {
        if (array_key_exists($path, config('image.path')) == false) {
            throw new Exception(sprintf('Config for path "%s" not set', $path));
        }
        $result = [];
        foreach (config('image.path.'.$path) as $subPath => $value) {
            $fullPath = media_path().'images'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;
            if (is_string($subPath)) {
                $fullPath .= $subPath.DIRECTORY_SEPARATOR;
            }
            $result[] = (boolean) @unlink($fullPath.$imageName);
        }

        if (in_array(false, $result) !== true) {
            return true;
        }
        else {
            return false;
        }
    }
}