<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller{
    
    public function saveCart(Request $request){
        session(['cart.items' => $request->items, 'cart.total' => $request->total]);

        return response()->json(['success' => true]);
    }
    public function getCart(){
        $items = session('cart.items', []);
        $total = session('cart.total', 0);

        return response()->json(['items' => $items, 'total' => $total]);
    }
}
