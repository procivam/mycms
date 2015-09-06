<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Backend\Pages;
use laravel\Models\Miscellaneous;

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
        // Filter daterange
        if (trim(\Input::get('daterange')) !== '') {
            list($start, $end) = explode('_', \Input::get('daterange'));
            $list = Pages::whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])
                ->orderBy('sort')
                ->get();
        }
        else {
            // Show list with all items (Pages) with controll elements
            $list = Pages::orderBy('sort')->get();
        }
        $result = [];
        foreach ($list as $key => $item) {
            $result[$item->parent_id][] = $item;
        }

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
            'result' => $result,
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
        $pages->state       = $request->state;
        $pages->h1          = $request->h1;
        $pages->text        = $request->text;
        $pages->keywords    = $request->keywords;
        $pages->description = $request->description;
        
        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'pages']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }
        if ($image !== false) {
            $pages->image = $image;
        }

        $res = $pages->save();

        if ($res) {
            $currNoty = [
                'text' => 'Данные успешно сохранены',
                'type' => 'success',
            ];
            addMessage($currNoty);
        }
        // Redirect
        return $this->redirectTo($pages->id);
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
        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'pages']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }

        $page = Pages::find($id);
        $page->name        = $request->name;
        $page->alias       = $request->alias;
        $page->title       = $request->title;
        $page->status      = $request->status ? $request->status : 0;
        $page->state       = $request->state;
        $page->h1          = $request->h1;
        $page->text        = $request->text;
        $page->keywords    = $request->keywords;
        $page->description = $request->description;
        
        if (isset($image) && $image !== false) {
            $page->image = $image;
        }
        $res = $page->save();
        

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
        // remove page
        $res = Pages::find($id)->delete();

        if ($res) {
            $currNoty = [
                'text' => 'Данные успешно удалены',
                'type' => 'success',
            ];
            addMessage($currNoty);
        }

        return redirect()->action('Backend\PagesController@index');
    }

    /**
     * Remove image.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyImage($id)
    {
        $page = Pages::findOrFail($id);

        if ($page->image) {
            
            $res = Miscellaneous::removeImages('pages', $page->image);
            
            $page->image = null;
            $page->save();

            $currNoty = [
                'text' => 'Изображения успешно удалены',
                'type' => 'success',
            ];
            addMessage($currNoty);
        }

        return redirect()->action('Backend\PagesController@edit', [$id]);
    }
}
