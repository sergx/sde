<?php

namespace Modules\Catalog\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Org\Entities\Org;

class CatalogController extends Controller
{

    public function index()
    {
        $orgs = Org::with(['productCategories', 'productCategories.products'])->get();
        return view('catalog::index')->with('orgs', $orgs);
    }
}
