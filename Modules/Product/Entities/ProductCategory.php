<?php
// Modules\Product\Entities\ProductCategory
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // protected $fillable = [];

    public function org()
    {
        return $this->belongsTo('Modules\Org\Entities\Org');
    }

    public function category_type()
    {
        return $this->belongsTo('Modules\Product\Entities\CategoryType');
    }

    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product');
    }
}
