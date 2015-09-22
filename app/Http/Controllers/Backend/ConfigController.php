<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use laravel\Models\Backend\Config as Model;


class ConfigController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Настройки';

    /**
    * Constructor
    *
    */
    public function __construct() {
        \Setting::set('controller_name', $this->moduleName);
    }

    /**
    * Function redirect to
    * Defines the actio after save or update actions
    *
    * @param integer id default null
    * @access private 
    */
    private function redirectTo($id = null)
    {
        $button = \Input::get('button_action');
        if (isset($button)) {
            switch ($button) {
                case 'save':
                    $fullAction = app('request')->route()->getAction();
                    $controller = class_basename($fullAction['controller']);
                    return redirect()->action('Backend\\'.$controller, [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\ConfigController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $result = Model::where('status', 1)->get();
        
        // Render
        return view('Backend.Config.form', [
            'result' => $result,
            'h1' => $this->moduleName,
            'control_create' => [
                'actionName'  => 'Редактирование настроек', 
                'save'        => true,
                'close'       => true,
            ], 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $res = [];
        $data = $request->input('DATA');
        foreach ($data as $id => $value) {
            $model = Model::find($id);
            if ($model->value == $value) {
                continue;
            }
            $model->value = $value;
            $res[] = $model->save();
        }

        if (!in_array(false, $res)) {
            addMessage([
                'text' => 'Данные успешно обновлены',
                'type' => 'success',
            ]);
        }
        // Redirect
        return $this->redirectTo($pages->id);
    }
}
