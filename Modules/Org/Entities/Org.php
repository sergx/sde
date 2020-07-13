<?php

namespace Modules\Org\Entities;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    // protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function productCategories()
    {
        return $this->hasMany('Modules\Product\Entities\ProductCategory');
    }
    
    public function orders()
    {
        return $this->hasMany('Modules\Order\Entities\Order');
    }

    public function actions()
    {
        return $this->hasMany('Modules\Action\Entities\Action');
    }
}
