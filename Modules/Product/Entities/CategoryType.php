<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    protected $fillable = [];

    public function product_categories()
    {
        return $this->hasMany('Modules\Product\Entities\ProductCategory');
    }
}
