<?php

namespace laravel\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget; 
use DB;

class LeftSide extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $result = DB::table('backend_menu')
            ->where('status', 1)
            ->orderBy('sort')
            ->get();
        $menu = [];
        foreach ($result as $value) {
            $menu[$value->parent_id][] = $value;
        }

        return view("Backend.Widgets.left_side", [
            'user' => \Auth::user(),
            'menu' => $menu,
        ]);
    }
}