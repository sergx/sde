<?php

namespace Modules\Action\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Org\Entities\Org;
use Modules\Action\Entities\Action;

class ActionController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
    //return view('action::index');
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {
    $org = Org::find($request->org_id);
    if(auth()->user()->id !== $org->user_id){
      return redirect('/home')->with('error', "Unauthorized Page");
    }
    return view('action::create')->with('org', $org);
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
      'action_key' => 'required',
      'org_id' => 'required',
    ]);
    $org = Org::find($request->org_id);

    if(auth()->user()->id !== $org->user_id){
      return redirect('/home')->with('error', "Unauthorized Page");
    }

    $action = new Action;
    $action->org_id = $request->org_id;
    $action->name = $request->name;
    $action->action_key = $request->action_key;
    $action->save();

    return redirect()->route('action.edit', $action->id)->with('success', "Акция ".$request->name." создана.");
  }

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {

    $action = Action::find($id);
    $org = Org::with(['productCategories', 'productCategories.products'])->where('id', $action->org_id)->first();
    if(auth()->user()->id !== $org->user_id){
      return redirect('/home')->with('error', "Unauthorized Page");
    }

    return view('action::edit', ['action' => $action, 'org' => $org]);
  }

  /**
   * Update the specified resource in storage.
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    //dd($request);
    $this->validate($request, [
      'name' => 'required',
      'org_id' => 'required',
      'product_count' => 'required',
      'fixed_price' => 'required',
      'product_ids' => 'required',
    ]);
    $action = Action::find($id);
    $action->name = $request->name;
    switch($action->action_key){
      case "some_of_kind_for_fixed_price":
        $action->product_count = $request->product_count;
        $action->fixed_price = $request->fixed_price;
        $action->product_ids = $request->product_ids;
      break;
      case "gift_from_some_sum":

      break;
    }
    $action->save();

    return redirect()->route('action.edit', $action->id)->with('success', "Акция ".$action->name." обновлена");
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

  public function setAction(){
    
  }

  public function actionGiftOnSumm(){

  }
}
