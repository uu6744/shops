<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecValue extends Model
{
    protected $table = 'spec_value';

    protected $fillable = ['name', 'sort'];

    public function spec()
    {
        return $this->belongsTo(Spec::class, 'spec_id');
    }
}
