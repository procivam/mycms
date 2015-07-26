<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Backend\Pages;

class PagesController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Страницы';

    /**
    * Validation rights
    *
    * @access private
    */
    private $rights = [
        'name'    => 'required|max:255',
        'alias'   => 'required|max:255',
        'title'   => 'required|max:255',
        'h1'      => 'required|max:255',
        'text'    => 'required'
    ];

    /**
    * Function redirect to
    * Defines the actio after save or update actions
    *
    * @param integer id default null
    * @access private 
    */
    private function redirectTo($id = null)
    {
        $button = \Input::get('action');
        if (isset($button)) {
            switch ($button) {
                case 'Сохранить':
                    $fullAction = app('request')->route()->getAction();
                    $controller = class_basename($fullAction['controller']);
                    $controller = str_replace('store', 'edit', $controller);
                    return redirect()->action('Backend\\'.$controller, [$id]);
                    break;
                case 'Сохранить и просмотреть':
                    return redirect()->action('Backend\PagesController@edit', [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\PagesController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // Show list with all items (Pages) with controll elements
        $list = Pages::all();

        /**
        * View make
        */

        // make controlls row
        $controls = view('Backend.Widgets.control', [
            'createLong' => true,
            'date_range' => true
        ]);

        // render all view
        $content = view('Backend.Pages.index', [
            'result' => $list, 
            'moduleName' => $this->moduleName, 
            'controls' => $controls
        ]);

        return view('Backend.index', ['content' => $content]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        /**
        * View make
        */
        // make controlls row
        $controls = view('Backend.Widgets.control_create', [
            'actionName'  => 'Создание страницы', 
            'save'        => true,
            'saveAndExit' => true,
            'saveAndLook' => true,
            'close'       => true,
        ]);

        // render all wiev
        $content = view('Backend.Pages.form', [ 
            'controls' => $controls,
        ]);

        return view('Backend.index', ['content' => $content]);
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

        $pages = new Pages;

        $pages->name        = $request->name;
        $pages->alias       = $request->alias;
        $pages->title       = $request->title;
        $pages->status      = $request->status ? $request->status : 0;
        $pages->h1          = $request->h1;
        $pages->text        = $request->text;
        $pages->keywords    = $request->keywords;
        $pages->description = $request->description;
        
        $pages->save();

        // Redirect
        return $this->redirectTo($pages->id);
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
        //
        $obj = Pages::find($id);
        /**
        * View
        */
        // make controlls row
        $controls = view('Backend.Widgets.control_create', [
            'actionName'  => 'Редактирование страницы', 
            'save'        => true,
            'saveAndExit' => true,
            'saveAndLook' => true,
            'close'       => true,
        ]);
        // render all wiev
        $content = view('Backend.Pages.form', [
            'obj' => $obj,
            'controls' => $controls,
        ]);

        return view('Backend.index', ['content' => $content]);

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

        $page = Pages::find($id);
        $page->name        = $request->name;
        $page->alias       = $request->alias;
        $page->title       = $request->title;
        $page->status      = $request->status ? $request->status : 0;
        $page->h1          = $request->h1;
        $page->text        = $request->text;
        $page->keywords    = $request->keywords;
        $page->description = $request->description;
        
        $page->save();

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
        // remove page
        Pages::find($id)->delete();

        return redirect()->action('Backend\PagesController@index');
    }
}
