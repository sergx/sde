<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Product\Entities\CategoryType;

class AdminCategoryTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categoryTypes = CategoryType::all();
        return view('admin::category-type.index')->with('categoryTypes', $categoryTypes);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::category-type.create');
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
            'sort_order' => 'required:numeric',
            'image_icon' => 'mimes:png|nullable|max:1999',
        ]);

        // Handle file upload
        if( $request->hasFile('image_icon')){
            // Get filename with the extention
            // $filenameWithExt = $request->file('image_icon')->getClientOriginalName();
            // Get just filename
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('image_icon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = "type_image/".$request->alias."_".time().".".$extention;
            // Upload image
            $path = $request->file('image_icon')->storeAs('public/', $fileNameToStore);
        }else{
            $fileNameToStore = 'type_image/noimage.png';
        }
        $fileNameToStore = 'storage/'.$fileNameToStore;

        $categoryType = new CategoryType;
        $categoryType->name = $request->name;
        $categoryType->alias = $request->alias;
        $categoryType->image_icon = $fileNameToStore;
        $categoryType->sort_order = $request->sort_order ?: 1;
        $categoryType->save();

        return redirect()->route('admin.category-type.index')->with('success', "Тип категории <strong>".$request->name."</strong> добавлен");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route('admin.category-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $categoryType = CategoryType::find($id);
        if($categoryType){
            return view('admin::category-type.edit')->with('categoryType', $categoryType);
        }else{
            return redirect()->route('admin.category-type.index')->with('warning', 'Тип категории с идентификатором «'.$id.'» не найден');
        }
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
            'sort_order' => 'required:numeric',
            'image_icon' => 'mimes:png|nullable|max:1999',
        ]);

        // Handle file upload
        if( $request->hasFile('image_icon')){
            // Get filename with the extention
            // $filenameWithExt = $request->file('image_icon')->getClientOriginalName();
            // Get just filename
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extention = $request->file('image_icon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = "type_image/".$request->alias."_".time().".".$extention;
            // Upload image
            $path = $request->file('image_icon')->storeAs('public/', $fileNameToStore);
            $fileNameToStore = 'storage/'.$fileNameToStore;
        }

        $categoryType = CategoryType::find($id);
        $categoryType->name = $request->name;
        $categoryType->alias = $request->alias;
        if( $request->hasFile('image_icon')){
            $categoryType->image_icon = $fileNameToStore;
        }
        $categoryType->sort_order = $request->sort_order ?: 1;
        $categoryType->save();
        
        return redirect()->route('admin.category-type.index')->with('success', "Тип категории <strong>".$request->name."</strong> обновлен");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        // Проверить - нет ли категорий, к которым привязан этот тип
        $existing_check = Modules\Product\Entities\ProductCategory::where('category_type_id', $id)->get();

        $categoryType = CategoryType::find($id);
        $categoryType->delete();
    }
}
