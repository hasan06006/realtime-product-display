<?php



namespace App\Http\Controllers;

use App\Events\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    // Fetch products from the Fake Store API and store them in the database
    public function fetchProducts()
    {
        // Fetch products from the API
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();
    
        // Store products in the database
        foreach ($products as $product) {
            // Use updateOrCreate to avoid duplicates
            $newProduct = Product::updateOrCreate(
                ['name' => $product['title']],
                [
                    'description' => $product['description'],
                    'price' => $product['price']
                ]
            );

            // Broadcast the product update event for each new or updated product
            broadcast(new ProductUpdated($newProduct))->toOthers();
        }
    
        return response()->json(['message' => 'Products fetched and stored successfully']);
    }

    public function index()
    {
        // Fetch products directly from the API
        $response = Http::get('https://fakestoreapi.com/products');
        $products = collect($response->json()); // Convert to a collection
    
        return view('products.index', compact('products'));
    }
}
