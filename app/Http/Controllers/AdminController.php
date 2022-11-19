<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Citys;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index() {
        if (Auth::user()->role != "admin") abort(404);
        $companies = User::orderBy("id", "desc")->paginate(25);
        return view("adminListCompany", [
            "companies" => $companies
        ]);
    }

    public function products() {
        if (Auth::user()->role != "admin") abort(404);
        $products = Product::orderBy("id", "desc")->paginate(25);
        return view("adminListProducts", [
            "products" => $products
        ]);
    }

    public function city() {
        if (Auth::user()->role != "admin") abort(404);
        $citys = Citys::orderBy("id", "desc")->paginate(25);
        return view("adminListCity", [
            "citys" => $citys
        ]);
    }

    public function category() {
        if (Auth::user()->role != "admin") abort(404);
        $categories = Categories::orderBy("id", "desc")->paginate(25);
        return view("adminListCategory", [
            "categories" => $categories
        ]);
    }

}
