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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show list with all items (Pages) with controll elements
        $list = Pages::all();

        // make controlls row
        $controls = view('Backend.Widgets.control', [
            'createLong' => true,
            'date_range' => true
        ]);

        // render all view
        $content = view('Backend.Pages.index', [
            'result' => $list, 
            'moduleName' => $this->moduleName, 
            'controller' => 'pages', 
            'controls' => $controls
        ]);

        return view('Backend.index', ['content' => $content]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
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
            'controller' => 'pages', 
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
