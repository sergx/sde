<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [];

    // public  $table = "product";
    
    public function product_category()
    {
        return $this->belongsTo('Modules\Product\Entities\ProductCategory');
    }

    public function orders()
    {
        return $this->belongsToMany('Modules\Order\Entities\Order')->withPivot('price', 'quantity')->withTimestamps();
    }
}
