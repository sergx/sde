<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\CategoryType;
use Modules\Org\Entities\Org;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return "product::category-show ".$id;
        return view('product::category-index');
    }

    /** Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $org = Org::find($request->org_id);

        if(auth()->user()->id !== $org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }
        $category_types = CategoryType::all();
        return view('product::category-create', ['org' => $org, 'category_types' => $category_types]);
    }

    /** Store a newly created resource in storage.
     * @param Request $request
     * @return Response */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'org_id' => 'required',
            'category_type_id' => 'required',
        ]);
        $org = Org::find($request->input('org_id'));

        if(auth()->user()->id !== $org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }

        $productCategory = new ProductCategory;
        $productCategory->org_id = $request->org_id;
        $productCategory->name = $request->name;
        $productCategory->category_type_id = $request->category_type_id;
        $productCategory->description = $request->description;
        $productCategory->save();

        return redirect()->route('org.show', ['id' => $org->id])->with('success', "Категория товаров <strong>".$request->input('name')."</strong> создана");
    }

    /** Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "product::category-show ".$id;
        return view('product::category-show');
    }

    /** Show the form for editing the specified resource.
     * @param  \Modules\Product\Entities\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::with(['org'])->where('id', $id)->first();

        if(auth()->user()->id !== $productCategory->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }
        $category_types = CategoryType::all();
        return view('product::category-edit', ['productCategory' => $productCategory, 'category_types' => $category_types]);
    }

    /** Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_type_id' => 'required',
        ]);
        $productCategory = ProductCategory::with(['org'])->where('id', $id)->first();

        if(auth()->user()->id !== $productCategory->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }
        $productCategory->name = $request->name;
        $productCategory->description = $request->description;
        $productCategory->category_type_id = $request->category_type_id;
        $productCategory->save();

        return redirect()->route('org.show', ['id' => $productCategory->org->id])->with('success', "Категория товаров обновлена");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
