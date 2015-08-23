<?php

namespace laravel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Frontend\Contact as Model;

class ContactController extends Controller
{
    /**
     * rights for validation
     * 
     * @var array
     * @access protected
     */
    protected $rights = [
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'message' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $messages = Model::all();
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
    public function store(Request $request)
    {
         // Validate incoming data
        $this->validate($request, $this->rights);

        $model = new Model;

        $model->name       = $request->name;
        $model->email       = $request->email;
        $model->message  = $request->message;

        $res = $model->save();

        if ($res) {
            $currNoty = [
                'text' => 'Данные успешно сохранены',
                'type' => 'success',
            ];
            addMessage($currNoty);
            // Redirect
            return redirect()->action('Frontend\ContactController@index');
        }
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
