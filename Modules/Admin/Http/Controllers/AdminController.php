<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Order\Entities\Order;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin::index');
    }

    public function getOrders()
    {
        $orders = Order::with(['products', 'contact', 'org'])->orderByDesc('created_at')->get();
        //$orders = $org->orders()->with(['products', 'contact', 'org'])->get();
        return view('admin::order-list', ["orders" => $orders]);
    }
}
