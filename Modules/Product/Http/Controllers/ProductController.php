<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $product_category = ProductCategory::with(['org'])->where('id', $request->product_category_id)->first();
        //dd($product_category);
        if(auth()->user()->id !== $product_category->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }
        return view('product::create')->with('product_category', $product_category);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'product_category_id' => 'required:numeric',
            'sort_order' => 'sometimes:numeric',
            'main_image' => 'image|nullable|max:1999',
        ]);
        $productCategory = ProductCategory::with(['org'])->where('id', $request->product_category_id)->first();

        if(auth()->user()->id !== $productCategory->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }

        // Handle file upload
        if( $request->hasFile('main_image')){
            // Get filename with the extention
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = "main_image/".$filename."_".time().".".$extention;
            // Upload image
            $path = $request->file('main_image')->storeAs('public/', $fileNameToStore);
        }else{
            $fileNameToStore = 'main_image/noimage.jpg';
        }
        $fileNameToStore . "storage/";

        $product = new Product;
        $product->product_category_id = $request->input('product_category_id');
        $product->sort_order = $request->input('sort_order')?: 1;
        $product->name = $request->input('name');
        $product->url = empty($request->input('url'))? str_slug($request->input('name')) : str_slug($request->input('url'));
        $product->main_image = $fileNameToStore;
        $product->price = $request->input('price');
        $product->action_price = $request->input('action_price');
        $product->is_popular = $request->input('is_popular');
        $product->is_new = $request->input('is_new');
        $product->save();

        return redirect()->route('org.show', $productCategory->org->id)->with('success', "Товар ".$request->input('name')." создан в категории ".$productCategory->name);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::with('product_category','product_category.org')->where('id',$id)->first();

        if(auth()->user()->id !== $product->product_category->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }
        return view('product::edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'sort_order' => 'sometimes|numeric',
            'main_image' => 'image|nullable|max:1999',
        ]);

        $product = Product::with('product_category','product_category.org')->where('id',$id)->first();

        if(auth()->user()->id !== $product->product_category->org->user_id){
            return redirect('/home')->with('error', "Unauthorized Page");
        }

        // Handle file upload
        if( $request->hasFile('main_image')){
            // Get filename with the extention
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = "main_image/".$filename."_".time().".".$extention;
            // Upload image
            $path = $request->file('main_image')->storeAs('public/', $fileNameToStore);
            $fileNameToStore = "storage/".$fileNameToStore;
        }else{
            $fileNameToStore = $product->main_image;
        }

        $product->sort_order = $request->input('sort_order')?: 1;
        $product->name = $request->input('name');
        $product->url = empty($request->input('url'))? $this->getUrl($request->input('name')) : str_slug($request->input('url'));
        $product->main_image = $fileNameToStore;
        $product->price = $request->input('price');
        $product->action_price = $request->input('action_price');
        $product->is_popular = $request->input('is_popular');
        $product->is_new = $request->input('is_new');
        $product->save();

        return redirect()->route('org.show', $product->product_category->org->id)->with('success', "Товар ".$request->input('name')." обновлен в категории ".$product->product_category->name);
    }

    /**
     * Remove the specified resource from storage.
     * @param Modules\Product\Entities\Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getUrl($str){
        return str_slug($str);
    }
}
