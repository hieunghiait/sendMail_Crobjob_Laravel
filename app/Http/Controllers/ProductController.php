<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Client\Request;

class ProductController extends Controller
{
    public function index(){
        return response()->json([
            'status' => 'success',
            'message' => 'Hello World'
        ]);
    }
    public function listProducts(){
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'message' => 'List Products',
            'data' => $products
        ]);
    }
    public function createProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        $product = Product::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }
}
