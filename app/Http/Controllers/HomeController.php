<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Citys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function welcome() {
        if (Auth::check()) return redirect()->route('dashboard');
        
        $products = Product::inRandomOrder()->distinct()->limit(4)->get();
        return view('welcome', [
            "products" => $products
        ]);
    }

    public function dashboard() {
        $products = Product::orderBy('id', 'desc')->paginate(21);

        $categories = Categories::leftJoin('products', 'categories.category', '=', 'products.category')
        ->selectRaw('categories.category, count(products.id) as length')
        ->groupBy('categories.id')
        ->get();

        $citys = Citys::leftJoin('users', 'citys.city', '=', 'users.city')
        ->selectRaw('citys.city, count(users.city) as length')
        ->groupBy('citys.id')
        ->get();

        return view('dashboard', [
            "products" => $products,
            "categories" => $categories,
            "citys" => $citys
        ]);
    }

}
