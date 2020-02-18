<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('Modules\Product\Entities\Product')->withPivot('price', 'quantity')->withTimestamps();
    }

    public function contact()
    {
        return $this->belongsTo('Modules\Contact\Entities\Contact');
    }
}
