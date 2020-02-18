<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // protected $fillable = [];

    public function org()
    {
        return $this->belongsTo('Modules\Org\Entities\Org');
    }

    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product');
    }
}
