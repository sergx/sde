<?php

namespace Modules\Catalog\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Org\Entities\Org;
use Modules\Product\Entities\CategoryType;

class CatalogController extends Controller
{

    public function index()
    {
        $category_types = CategoryType::all();
        $orgs = Org::with(['productCategories', 'productCategories.products'])->get();
        return view('catalog::index', ['orgs' => $orgs, 'category_types' => $category_types]);
    }
    public function filteredByType($category_type_alias){
        $category_types = CategoryType::all();

        if(in_array($category_type_alias, $category_types->pluck('alias')->all()))
        {
            $category_type = $category_types->where('alias',$category_type_alias)->first();
        
            $orgs = Org::with(['productCategories', 'productCategories.products'])->whereHas('productCategories', function($q) use ($category_type){
                $q->where("category_type_id", $category_type['id']);
            })->get();
            return view('catalog::type-category', ['orgs' => $orgs, 'category_types' => $category_types, 'category_type' => $category_type]);
        }
        else
        {
            return redirect()->route('index');
        }
        return $category_type;
    }
}
