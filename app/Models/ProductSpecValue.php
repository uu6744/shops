<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecValue extends Model
{
    protected $table = 'product_spec_value';

    public function specvalues()
    {
        return $this->hasMany(SpecValue::class, 'spec_id');
    }
}
