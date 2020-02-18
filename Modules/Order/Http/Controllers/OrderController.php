<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Contact\Entities\Contact;
use Modules\Order\Entities\Order;


use Cart;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        // @todo Make SRP (Single responsibility principle)
        if (auth()->check()) {
            Cart::session(auth()->user()->id);
        }

        // Создаем запись в контактах
        $contact = new Contact;
        $contact->name = $request->input("name");
        $contact->phone = $request->input("phone");
        $contact->address = $request->input("adress");

        if (auth()->check()) {
            $contact->user_id = auth()->user()->id;
        }
        $contact->save();

        $cart = Cart::getContent();

        // Создаем заказ
        $order = new Order;
        if (auth()->check()) {
            $order->user_id = auth()->user()->id;
        }
        
        $order->products_price = Cart::getTotal();
        $order->delivery_price = 0;
        $order->org_id = $cart->first()->associatedModel->product_category()->first()->org()->first()->id;
        $order->status = 0; // @todo Add Constant
        $order->contact_id = $contact->id;
        $order->save();

        // Attach products to order
        //$cart_product_ids = [];
        foreach($cart as $item){
            //$cart_product_ids[] = $item->id;
            $order->products()->attach($item->id, ['price' => $item->price, 'quantity' => $item->quantity]);
        }
        //$order->products()->attach($cart_product_ids);
        
        // Очистить корзину
        Cart::clear();

        return redirect()->route('cart.thanks')->with('order_id', $order->id);
    }
}
