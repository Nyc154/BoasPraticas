<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('comprar')->with('success', 'Produto adicionado com sucesso!');
    }

    public function index()
    {
        $products = Product::all();
        return view('comprar', compact('products'));
    }
}
