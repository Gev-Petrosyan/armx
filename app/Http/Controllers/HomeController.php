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
        
        $categories = Categories::whereNull('categoryID')
        ->leftJoin('products', 'categories.category', '=', 'products.subcategory')
        ->select('categories.id', 'categories.image')
        ->selectRaw('categories.category, count(products.id) as length')
        ->groupBy('categories.id')
        ->get();
        $products = Product::inRandomOrder()->distinct()->limit(4)->get();

        return view('welcome', [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    public function dashboard() {
        $products = Product::orderBy('id', 'desc')->paginate(21);

        $subcategories = Categories::whereNull('categoryID')
        ->leftJoin('products', 'categories.category', '=', 'products.subcategory')
        ->selectRaw('categories.category, count(products.id) as length')
        ->groupBy('categories.id')
        ->get();
        $citys = Citys::leftJoin('users', 'citys.city', '=', 'users.city')
        ->selectRaw('citys.city, count(users.city) as length')
        ->groupBy('citys.id')
        ->get();

        return view('dashboard', [
            "products" => $products,
            "subcategories" => $subcategories,
            "citys" => $citys
        ]);
    }

    public function dashboardWithCategory($category) {
        if (empty($category)) return redirect()->route("dashboard");

        $getCategory = Categories::find($category);
        $getSubcategory = Categories::where('categoryID', $getCategory->id)->get(['category']);
        $products = Product::where('subcategory', $getCategory->category)->orderBy('id', 'desc')->paginate(21);

        $subcategories = Categories::whereNull('categoryID')
        ->leftJoin('products', 'categories.category', '=', 'products.subcategory')
        ->selectRaw('categories.category, count(products.id) as length')
        ->groupBy('categories.id')
        ->get();
        $citys = Citys::leftJoin('users', 'citys.city', '=', 'users.city')
        ->selectRaw('citys.city, count(users.city) as length')
        ->groupBy('citys.id')
        ->get();

        return view('dashboard', [
            "products" => $products,
            "subcategories" => $subcategories,
            "citys" => $citys,
            "category" => $getCategory->category,
            "subcategory" => $getSubcategory
        ]);
    }

}
