<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Backend\Articles as Model;

class ArticlesController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Статьи';

    /**
    * Validation rights
    *
    * @access private
    */
    private $rights = [
        'name'  => 'required|max:255',
        'alias' => 'required|max:255',
        'title' => 'required|max:255',
        'h1'    => 'required|max:255',
        'text'  => 'required'
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
                    return redirect()->action('Backend\ArticlesController@edit', [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\ArticlesController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // Filter daterange
        if (trim(\Input::get('daterange')) !== '') {
            list($start, $end) = explode('_', \Input::get('daterange'));
            $list = Model::whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])
                ->get();
        }
        else {
            // Show list with all items with controll elements
            $list = Model::orderBy('created_at', 'DESC')->get();
        }

        // Render
        return view('Backend.Articles.index', [
            'h1'       => $this->moduleName,
            'result'   => $list,
            'control' => [
                'createLong' => true,
                'dateRange' => true,
            ],
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
        return view('Backend.Articles.form', [
            'h1' => $this->moduleName,
            'control_create' => [
                'actionName'  => 'Создание новости', 
                'save'        => true,
                'saveAndExit' => true,
                'saveAndLook' => true,
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
        $model->alias       = $request->alias;
        $model->title       = $request->title;
        $model->status      = $request->status ? $request->status : 0;
        $model->state       = $request->state;
        $model->h1          = $request->h1;
        $model->text        = $request->text;
        $model->keywords    = $request->keywords;
        $model->description = $request->description;
        
        $res = $model->save();

        if ($res) {
            $currNoty = [
                'text' => 'Данные успешно сохранены',
                'type' => 'success',
            ];
            addMessage($currNoty);
        }
        // Redirect
        return $this->redirectTo($model->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $obj = Model::find($id);
        
        // Render
        return view('Backend.Articles.form', [ 
            'h1' => $this->moduleName,
            'obj' => $obj,
            'control_create' => [
                'actionName'  => 'Редактирование статьи', 
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

        $model = Model::find($id);
        $model->name        = $request->name;
        $model->alias       = $request->alias;
        $model->title       = $request->title;
        $model->status      = $request->status ? $request->status : 0;
        $model->state       = $request->state;
        $model->h1          = $request->h1;
        $model->text        = $request->text;
        $model->keywords    = $request->keywords;
        $model->description = $request->description;
        
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
        // remove resource
        Model::find($id)->delete();

        return redirect()->action('Backend\ArticlesController@index');
    }
}
