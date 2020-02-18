<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Product\Entities\Product;

use Cart; // https://github.com/darryldecode/laravelshoppingcart

class CartController extends Controller
{

    public function __construct()
    {   
        // Конструкция для того чтобы получить доступ к сессии и пользователю из конструктора
        $this->middleware(function ($request, $next)
        {    
            if (auth()->check()) {
                Cart::session(auth()->user()->id);
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $cart = Cart::getContent();
        $total = Cart::getTotal();
        $totalQuantity = Cart::getTotalQuantity();
        //dd($cart);
        return view('cart::index', [
            'cart' => $cart,
            'total' => $total,
            'totalQuantity' => $totalQuantity,
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::find($request->get("product_id"));
        $success_msgs = 'Товар <strong>'.$product->name.'</strong> добавлен в корзину';
        $cart = Cart::getContent();
        if(count($cart))
        {
            if(
                $product->product_category()->first()->org()->first()->id
                !==
                $cart->first()->associatedModel->product_category()->first()->org()->first()->id)
            {
                $success_msgs .= ". Товары другого заведения были удалены.";
                Cart::clear();
            }
        }
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return back()->with('success', $success_msgs);
    }
    
    public function more($id)
    {
        Cart::update($id, [
            'quantity' => +1
        ]);
        return back();
    }
    
    public function less($id)
    {
        Cart::update($id,[
            'quantity' => -1
        ]);
        return back();
    }
    
    public function removeItem($id)
    {
        Cart::remove($id);
        return back()->with('success', 'Товар удален из корзины');
    }
    
    public function clear()
    {
        Cart::clear();
        return view('cart::index', ['cart' => [], 'success', 'Корзина очищена']);
    }

    public function thanks()
    {
        $order_id = session("order_id");
        return view('order::thanks')->with('order_id', $order_id);
    }
}
