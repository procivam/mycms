<?php

namespace laravel\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;

class HeaderTasks extends AbstractWidget
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
        return view("Backend.Widgets.header_tasks");
    }
}