<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

   /**
    * 商品列表图片访问器
    *
    * @param [type] $value
    * @return void
    */
    public function getImgAttribute($value)
    {
        // return "{$this->first_name} {$this->last_name}";
        return env("APP_URL")."/uploads/".$value;
    }

    //修改器
    public function setBannerAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['banner'] = json_encode($pictures);
        }
    }

    //访问器
    public function getBannerAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    //修改器
    public function setSpecGroupAttribute($data)
    {
        if (is_array($data)) {
            $this->attributes['spec_group'] = json_encode($data);
        }
    }

    //访问器
    public function getSpecGroupAttribute($data)
    {
        return json_decode($data, true);
    }
}
