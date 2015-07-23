<?php

namespace laravel\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;
use laravel\Models\Frontend\Contact;

class NewMessages extends AbstractWidget
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
        $listMessages = Contact::where('displayed', 0)->get();
        return view("Backend.Widgets.new_messages", [
            'listMessages' => $listMessages,
            'count' => count($listMessages),
        ]);
    }
}