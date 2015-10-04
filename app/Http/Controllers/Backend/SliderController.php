<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;

use laravel\Models\Backend\Sliders as Model;
use laravel\Models\Miscellaneous;

class SliderController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Слайдер';

    /**
    * Validation rights
    *
    * @access private
    */
    private $rights = [
        'name'         => 'required|max:255'
    ];

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
     *
     * @return redirect
     */
    private function redirectTo($id = null)
    {
        $button = \Input::get('button_action');
        if (isset($button)) {
            switch ($button) {
                case 'save':
                    $fullAction = app('request')->route()->getAction();
                    $controller = class_basename($fullAction['controller']);
                    $controller = str_replace('store', 'edit', $controller);
                    return redirect()->action('Backend\\'.$controller, [$id]);
                    break;
                case 'save and look':
                    return redirect()->action('Backend\SliderController@edit', [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\SliderController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $list = Model::orderBy('sort')->get();

        // Render
        return view('Backend.Slider.index', [
            'result' => $list,
            'h1'     => $this->moduleName,
            'control' => [
                'createLong' => true,
                ]
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        // Render
        return view('Backend.Slider.form', [
            'h1' => $this->moduleName,
            'control_create' => [
                'actionName'  => 'Создание слайда', 
                'save'        => true,
                'saveAndExit' => true,
                'close'       => true,
            ], 
        ]);
    }

    /**
     * Store a newly created resource into storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $this->validate($request, $this->rights);

        $model = new Model;

        $model->name        = $request->name;
        $model->description = $request->description;
        $model->url         = $request->url;
        $model->status      = $request->status ? $request->status : 0;

        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'slider']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }
        if (isset($image) && $image !== false) {
            $model->image = $image;
        }
        
        $res = $model->save();

        if ($res) {
            addMessage([
                'text' => 'Данные успешно сохранены',
                'type' => 'success',
            ]);
        }
        // Redirect
        return $this->redirectTo($model->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $obj = Model::findOrFail($id);
        
        // Render
        return view('Backend.Slider.form', [
            'obj' => $obj,
            'h1' => $this->moduleName,
            'control_create' => [
                'actionName'  => 'Редактирование новости', 
                'save'        => true,
                'saveAndExit' => true,
                'close'       => true,
            ], 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        // Validate incoming data
        $this->validate($request, $this->rights);

        $model = Model::findOrFail($id);
        $model->name        = $request->name;
        $model->description = $request->description;
        $model->url         = $request->url;
        $model->status      = $request->status ? $request->status : 0;
        
        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'slider']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }
        if (isset($image) && $image !== false) {
            $model->image = $image;
        }

        $res = $model->save();
        if ($res) {
            $currNoty = [
                'text' => 'Данные успешно обновлены',
                'type' => 'success',
            ];
            addMessage($currNoty);
        }

        return $this->redirectTo($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    	$model = Model::findOrFail($id);

    	Miscellaneous::removeImages('slider', $model->image);

        // remove resource
        $res = $model->delete();

     	if ($res) {
            addMessage([
                'text' => 'Данные успешно удалены',
                'type' => 'success',
            ]);
        }

        return redirect()->action('Backend\SliderController@index');
    }

     /**
     * Remove image.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyImage($id)
    {
        $page = Model::findOrFail($id);

        if ($page->image) {
            
            $res = Miscellaneous::removeImages('slider', $page->image);
            
            $page->image = null;
            $page->save();

            addMessage([
                'text' => 'Изображения успешно удалены',
                'type' => 'success',
            ]);
        }

        return redirect()->action('Backend\SliderController@edit', [$id]);
    }
}
