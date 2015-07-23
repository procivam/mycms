<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Backend\Pages;

class PagesController extends Controller
{
    public $moduleName = 'Страницы';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show list with all items (Pages) with controll elements
        $list = Pages::all();
        $controls = view('Backend.Widgets.control', [
            'controller' => 'pages', 
            'create' => true,
            'edit' => true,
            'publish' => false,
            'delete' => true,
            'date_range' => true
        ]);
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
        //
        $controls = view('Backend.Widgets.control_create', [
            'actionName' => 'Создание страницы', 
            'controller' => 'pages', 
            'save' => true,
            'saveAndExit' => true,
            'saveAndLook' => true,
            'close' => true,
        ]);
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
