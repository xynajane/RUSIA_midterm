<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() { return response()->json(Product::all()); }

    public function store(Request $request) { return response()->json(Product::create($request->validate(['name' => 'required|string', 'description' => 'nullable|string', 'price' => 'required|numeric', 'quantity' => 'required|integer'])), 201); }

    public function show(Product $product) { return response()->json($product); }

    public function update(Request $request, Product $product) { return response()->json(tap($product)->update($request->validate(['name' => 'sometimes|string', 'description' => 'sometimes|nullable|string', 'price' => 'sometimes|numeric', 'quantity' => 'sometimes|integer']))); }

    public function destroy(Product $product) { return response()->json(['message' => 'Product deleted'], $product->delete() ? 204 : 500); }
}