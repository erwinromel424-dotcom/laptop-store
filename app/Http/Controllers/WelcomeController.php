<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['images' => function ($query) {
            $query->where('is_primary', true);
        }])->latest()->take(8)->get();

        return view('welcome', compact('products'));
    }
}
