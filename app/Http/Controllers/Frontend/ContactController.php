<?php

namespace laravel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use DB;
use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $messages = Contact::all();
        return view('Frontend.contact', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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

    /**
    *
    * Get dont viewed messages for header notifier
    *
    * @return null
    */
    public function compose($view) 
    {
        $list_messages = Contact::where('displayed', 0)->get();
        $view->with('list_messages', $list_messages);
    }
}
