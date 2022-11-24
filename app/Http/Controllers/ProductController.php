<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function products() {
        $categories = Categories::get("category");

        return view("products", [
            "categories" => $categories
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'images' => ["required", "max:4"],
            'name' => ["required", "string","max:255"],
            'category' => ["required", "string","max:255"],
            'subcategory' => ["required", "string","max:255"],
            'price' => ["required", "integer"],
            'description' => ["required", "string", "max:500"]
        ]);

        $id = Auth::user()->id;

        Product::create([
            "id_user" => $id,
            "name" => $request->name,
            "category" => $request->category,
            "subcategory" => $request->subcategory,
            "price" => $request->price,
            "description" => $request->description,
        ]);

        $maxId = Product::max("id");

        if ($request->hasFile("images")) {
            foreach ($request->images as $image) {
                $imageExtention = $image->getClientOriginalExtension();
                $imageFullName = time() . '-' . rand(1111, 9999) . '.' . $imageExtention;
                $image->move(public_path() . '/storage/product/', $imageFullName);
                ProductImage::create([
                    "id_product" => $maxId,
                    "image" => $imageFullName
                ]);
            }
        }

        return redirect()->back();

    }

    public function getDataValidate(Request $request) {

        $request->validate([
            'subcategory' => ["required", "string","max:255"],
            'category' => ["required", "string","max:255"],
            'city' => ["required", "string","max:255"],
        ]);

        $subcategory = $request->subcategory;
        $category = $request->category;
        $city = $request->city;

        if ($subcategory == "all" && $category == "all" && $city == "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory != "all" && $category == "all" && $city == "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.subcategory", $subcategory)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory == "all" && $category != "all" && $city == "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.category", $category)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory == "all" && $category == "all" && $city != "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->where("users.city", $city)
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory != "all" && $category != "all" && $city == "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.subcategory", $subcategory)
            ->where("products.category", $category)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory == "all" && $category != "all" && $city != "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.category", $category)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->where("users.city", $city)
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else if ($subcategory != "all" && $category == "all" && $city != "all") {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.subcategory", $subcategory)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->where("users.city", $city)
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        } else {
            $products = DB::table("products")
            ->distinct('products.id')
            ->where("products.subcategory", $subcategory)
            ->where("products.category", $category)
            ->leftJoin("users", "users.id", "=", "products.id_user")
            ->where("users.city", $city)
            ->select("products.id", "products.name", "products.category",
            "products.price", "users.city", DB::raw('(select image from product_images where id_product = products.id limit 1) as image'))
            ->limit(90)
            ->get();
        }

        return response()->json([
            "products" => $products
        ]);

    }

    public function delete(Request $request) {
        $id = $request->id;
        $product = Product::find($id);
        if (empty($product) || Auth::user()->id != $product->id_user) return response("error");
        foreach ($product->images as $image) {
            $path = public_path() . "/storage/product/" . $image->image;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $product->images()->delete();
        $product->delete();
    }

    public function edit($id) {
        $product = Product::find($id);
        if (empty($product) || Auth::user()->id != $product->id_user) return abort(404);
        $categories = Categories::get("category");

        return view("editProduct", [
            "product" => $product,
            "categories" => $categories
        ]);
    }

    public function show($id) {
        $product = Product::find($id);
        return view("product", [
            "product" => $product
        ]);
    }

    public function update(Request $request) {

        $request->validate([
            'id' => ["required"],
            'images' => ["max:4"],
            'name' => ["required", "string","max:255"],
            'category' => ["required", "string","max:255"],
            'subcategory' => ["required", "string","max:255"],
            'price' => ["required", "integer"],
            'description' => ["required", "string", "max:500"]
        ]);

        $id = $request->id;

        $product = Product::find($id);
        if (empty($product) || (Auth::user()->id != $product->id_user || Auth::user()->role != "admin")) return abort(404);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile("images")) {
            foreach ($product->images as $image) {
                $path = public_path() . "/storage/product/" . $image->image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $product->images()->delete();
            foreach ($request->images as $image) {
                $imageExtention = $image->getClientOriginalExtension();
                $imageFullName = time() . '-' . rand(1111, 9999) . '.' . $imageExtention;
                $image->move(public_path() . '/storage/product/', $imageFullName);
                ProductImage::create([
                    "id_product" => $id,
                    "image" => $imageFullName
                ]);
            }
        }

        $product->save();
        return (Auth::user()->role != "admin") ? redirect()->route('productShow', $id) : redirect()->route('adminProducts');

    }

}
