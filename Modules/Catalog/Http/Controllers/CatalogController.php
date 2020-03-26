<?php

namespace Modules\Catalog\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Org\Entities\Org;
use Modules\Product\Entities\CategoryType;

use Cart; // https://github.com/darryldecode/laravelshoppingcart

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

    public function getOrg($org_id)
    {
        $org = Org::with(['productCategories', 'productCategories.products', 'productCategories.category_type'])->where('id', $org_id)->first();
        $category_types = $org->productCategories->pluck( 'category_type.name', 'category_type.alias')->all();

        if (auth()->check()) {
            Cart::session(auth()->user()->id);
        }

        $cart = Cart::getContent();
        $cart_total = Cart::getTotal();
        $cart_totalQuantity = Cart::getTotalQuantity();

        return view('catalog::org', ['org' => $org, 'category_types' => $category_types, 'cart' => $cart, 'cart_total' => $cart_total, 'cart_totalQuantity' => $cart_totalQuantity,]);
    }
}
