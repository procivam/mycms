<?php

namespace laravel\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'settings';

    public $timestamps = false;
}
