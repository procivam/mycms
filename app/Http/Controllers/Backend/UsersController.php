<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;

use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;
use laravel\Models\User;
use laravel\Models\Miscellaneous;

class UsersController extends Controller
{
    /**
    * Module name for view
    *
    * @access private
    */
    private $moduleName = 'Пользователи';

    /**
    * Validation rights
    *
    * @access private
    */
    private $rights = [
        'name'    => 'required|max:255',
        'email'    => 'required|max:255|email'
    ];

    /**
    * Constructor
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
                    return redirect()->action('Backend\UsersController@edit', [$id]);
                    break;
            }
        }
        return redirect()->action('Backend\UsersController@index');
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
            $result = User::whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])
                ->get();
        }
        else {
            // Show list with all items (Pages) with controll elements
            $result = User::get();
        }
        // Render
        return view('Backend.Users.index', [
            'h1'       => $this->moduleName,
            'result'   => $result,
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
        return view('Backend.Users.form', [ 
            'h1' => $this->moduleName,
            'control_create' => [
                'actionName'  => 'Создание пользователя', 
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

        $user = new user;

        $user->name = $request->name;
        $user->email = $request->email;

        // Create password
        if ($request->new_password != '') {
            $this->validate($request, ['new_password' => 'required|confirmed|min:6']);
            $user->password = bcrypt($request->new_password);
        }

        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'users']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }
        if ($image !== false) {
            $user->image = $image;
        }

        $res = $user->save();

        if ($res) {
            addMessage([
                'text' => 'Данные успешно сохранены',
                'type' => 'success',
            ]);
        }
        // Redirect
        return $this->redirectTo($user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $obj = User::findOrFail($id);

        // Render
        return view('Backend.Users.form', [ 
            'h1' => $this->moduleName,
            'obj' => $obj,
            'control_create' => [
                'actionName'  => 'Редактирование пользователя', 
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

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Change password
        if ($request->new_password != '') {
            $this->validate($request, ['new_password' => 'required|confirmed|min:6']);
            $user->password = bcrypt($request->new_password);
        }

        try {
            $image = Miscellaneous::uploadImage($request, ['path' => 'users']);
        } catch (\Exception $e) {
            addMessage(['text' => $e->getMessage(), 'type' => 'danger', 'time' => 10]);
        }
        if (isset($image) && $image !== false) {
            $user->image = $image;
        }
        $res = $user->save();
        

        if ($res) {
            addMessage([
                'text' => 'Данные успешно обновлены',
                'type' => 'success',
            ]);
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
        $res = User::findOrFail($id)->delete();

        if ($res) {
            addMessage([
                'text' => 'Данные успешно удалены',
                'type' => 'success',
            ]);
        }

        return redirect()->action('Backend\UsersController@index');
    }

    /**
     * Remove image.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyImage($id)
    {
        $user = User::findOrFail($id);

        if ($user->image) {
            
            $res = Miscellaneous::removeImages('users', $user->image);
            
            $user->image = null;
            $user->save();

            addMessage([
                'text' => 'Изображение успешно удалено',
                'type' => 'success',
            ]);
        }

        return redirect()->action('Backend\UsersController@edit', [$id]);
    }
}
