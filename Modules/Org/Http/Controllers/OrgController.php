<?php

namespace Modules\Org\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Org\Entities\Org;

class OrgController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'/*, ['except' => ['index','show']] */);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('org::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('org::create');
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
            'address' => 'required',
        ]);

        $org = new Org;
        $org->user_id = auth()->user()->id;
        $org->name = $request->input('name');
        $org->address = $request->input('address');
        $org->description = $request->input('description');
        $org->work_time = $request->input('work_time');
        $org->save();

        return redirect('/home')->with('success', "Заведение создано");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $org = Org::with(['productCategories', 'productCategories.products'])->where('id', $id)->first();

        if(auth()->user()->id !== $org->user_id){
            return redirect()->route('home')->with('error', "Unauthorized Page");
        }

        return view('org::show')->with('org', $org);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $org = Org::find($id);

        if(auth()->user()->id !== $org->user_id){
            return redirect()->route('home')->with('error', "Unauthorized Page");
        }

        return view('org::edit')->with("org", $org);
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
            'address' => 'required',
        ]);

        $org = Org::find($id);

        if(auth()->user()->id !== $org->user_id){
            return redirect()->route('home')->with('error', "Unauthorized Page");
        }

        //$org->user_id = auth()->user()->id;
        $org->name = $request->input('name');
        $org->address = $request->input('address');
        $org->description = $request->input('description');
        $org->work_time = $request->input('work_time');
        $org->save();

        return redirect()->route('org.show', $id)->with('success', "Заведение обновлено");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $org = Org::find($id);
        if(auth()->user()->id !== $org->user_id){
            return redirect()->route('home')->with('error', "Unauthorized Page");
        }
    }

    public function getOrders($id)
    {
        $org = Org::find($id);

        if(auth()->user()->id !== $org->user_id){
            return redirect()->route('home')->with('error', "Unauthorized Page");
        }
        
        $orders = $org->orders()->with(['products', 'contact'])->get();
        return view('org::order-list', ["orders" => $orders, "org" => $org]);
    }
}
