<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $products = Product::all();
        return response()->json($products,200);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($request->all());
        
        return response()->json($product, 201);
    }
}
