<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected $table = 'spec';

    public function specvalues()
    {
        return $this->hasMany(SpecValue::class, 'spec_id');
    }

     
}
