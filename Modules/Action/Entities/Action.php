<?php

namespace Modules\Action\Entities;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [];
    
    public function getProductIdsAttribute($value)
    {
        //return $value."123";
        return json_decode($value, true);
    }
    
    public function org()
    {
        return $this->belongsTo('Modules\Org\Entities\Org');
    }
}
