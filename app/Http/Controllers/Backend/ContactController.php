<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\Backend\Contact as Model;

class ContactController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Контактная форма';

    /**
    * Validation rights
    *
    * @access private
    */
    private $rights = [
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
                    return redirect()->action('Backend\ContactController@edit', [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\ContactController@index');
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
            // Show list with all items (News) with controll elements
            $list = Model::get();
        }


        /**
        * View make
        */

        // make controlls row
        $controls = view('Backend.Widgets.control', [
            'date_range' => true
        ]);

        // render all view
        $content = view('Backend.Contact.index', [
            'result' => $list,
            'controls' => $controls
        ]);

        return view('Backend.index', ['content' => $content]);
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
        $obj = Model::find($id);

        // Change displayed flag
        if ($obj->displayed == 0) {
            $obj->displayed = 1;
            $obj->save();
        }
        /**
        * View
        */
        // make controlls row
        $controls = view('Backend.Widgets.control_create', [
            'actionName'  => 'Редактирование формы', 
            'save'        => true,
            'saveAndExit' => true,
            'close'       => true,
        ]);
        // render all wiev
        $content = view('Backend.Contact.form', [
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

        $model = Model::find($id);
        $model->status = $request->status ? $request->status : 0;
        
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
        $res = Model::find($id)->delete();
        dd($res);
        return redirect()->action('Backend\ContactController@index');
    }
}
