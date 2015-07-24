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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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

        $res = Pages::where('id', $id)
            ->update([
                'name'        => $request->name,
                'alias'       => $request->alias,
                'title'       => $request->title,
                'h1'          => $request->h1,
                'text'        => $request->text,
                'keywords'    => $request->keywords,
                'description' => $request->description,
            ]);

        return redirect()->action('Backend\PagesController@edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
