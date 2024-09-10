<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::where('name', '!=', '');

        if (isset($request->id) && $request->id !== '') {
            $products = $products->where('id', $request->id);
        }

        $products = $products->get();

        return response()->json([
            'status' => true,
            'messsage' => 'Product retrieved successfully',
            'data' => $products
        ], 200);
    }
}
