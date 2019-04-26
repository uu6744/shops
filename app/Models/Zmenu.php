<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zmenu extends Model
{
    protected $table="zmenu";

    public function getChildMenu()
    {
        return $this->hasMany('App\Models\Zmenu', 'pid', 'id');
    }
}
