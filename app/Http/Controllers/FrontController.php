<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::with(['category', 'images' => function ($q) {
            $q->where('is_primary', true);
        }]);

        // Fitur Pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Kategori
        if ($request->filled('kategori')) {
            $category = Category::where('slug', $request->kategori)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('front.catalog', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Load relasi kategori dan semua gambar
        $product->load(['category', 'images']);

        // Rekomendasi produk di kategori yang sama
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images' => function ($q) {
                $q->where('is_primary', true);
            }])
            ->take(4)
            ->get();

        return view('front.product', compact('product', 'relatedProducts'));
    }
}
