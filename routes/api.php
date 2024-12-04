<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;



Route::middleware('auth:sanctum')->put('/products/{id}', function (Request $request, $id) {
    $product = Product::findOrFail($id);
    // Validasi input 
    $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ]);
    // Update data produk 
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);
    return response()->json(['message' => 'Product updated successfully'], 200);
});
// Hapus produk dengan DELETE 
Route::middleware('auth:sanctum')->delete('/products/{id}', function ($id) {
    $product = Product::findOrFail($id);
    // Hapus produk 
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully'], 200);
});

// route logout api
Route::middleware('auth.sanctum')->post('/logout', function (Request $request){
    $request->user()->currentAccsessToken()->delete();
    return response()->json(['message' => 'You have been logged out.'], 200);
});
