<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all products
        $products = Product::with('feedBacks.user')->get();
        return response()->json(['data' => $products], Response::HTTP_OK);
    }

    public function show(Product $product)
    {
        // Show a specific product
        return response()->json(['data' => $product], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $data = $request->all() + ['user_id' => Auth::id()];
        // Create a new product
        $product = Product::create($data);

        return response()->json(['data' => $product], Response::HTTP_CREATED);
    }

    public function update(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Update the product
        $product->update($request->all());

        return response()->json(['data' => $product], Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        // Delete a specific product
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
