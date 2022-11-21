<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyImage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Citys;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminActionController extends Controller
{
    
    public function editCompany($id) {
        $company = User::find($id);
        if (Auth::user()->role != "admin" || empty($company)) abort(404);

        return view("adminEditCompany", [
            "company" => $company
        ]);
    }
    
    public function editProduct($id) {
        $product = Product::find($id);
        if (Auth::user()->role != "admin" || empty($product)) abort(404);
        $categories = Categories::get("category");

        return view("adminEditProduct", [
            "product" => $product,
            "categories" => $categories
        ]);
    }
    
    public function editCity($id) {
        $city = Citys::find($id);
        if (Auth::user()->role != "admin" || empty($city)) abort(404);

        return view("adminEditCitys", [
            "city" => $city
        ]);
    }
    
    public function editCategory($id) {
        $category = Categories::find($id);
        if (Auth::user()->role != "admin" || empty($category)) abort(404);

        return view("adminEditCategories", [
            "category" => $category
        ]);
    }


    // ---------------------------------


    public function updateCity(Request $request) {
        
        $request->validate([
            'id' => ['required'],
            'city' => ['required', 'string', 'max:255']
        ]);

        $city = Citys::find($request->id);
        if (Auth::user()->role != "admin" || empty($city)) abort(404);

        if ($request->hasFile("image")) {
            $path = public_path() . '/storage/city/' . $city->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $imageExtention = $image->getClientOriginalExtension();
            $imageFullName = time() . '-' . rand(1111, 9999) . '.' . $imageExtention;
            $image->move(public_path() . '/storage/city/', $imageFullName);

            $city->image = $imageFullName;
        }

        $city->city = $request->city;
        $city->save();
        return redirect()->route("adminCity");

    }

    public function updateCategory(Request $request) {

        $request->validate([
            'id' => ['required'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['max:255']
        ]);

        $category = Categories::find($request->id);
        if (Auth::user()->role != "admin" || empty($category)) abort(404);

        if ($request->hasFile("image")) {
            $path = public_path() . '/storage/category/' . $category->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $imageExtention = $image->getClientOriginalExtension();
            $imageFullName = time() . '-' . rand(1111, 9999) . '.' . $imageExtention;
            $image->move(public_path() . '/storage/category/', $imageFullName);

            $category->image = $imageFullName;
        }

        $category->category = $request->category;
        $category->type = $request->type;
        $category->save();
        return redirect()->route("adminCategory");

    }


    // ---------------------------------


    public function updateCompany(Request $request) {
        
        $request->validate([
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'login' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/[0-9]/'],
            'city' => ['nullable', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'about_us' => ['nullable', 'max:1000'],
        ]);

        $company = User::find($request->id);
        if (Auth::user()->role != "admin" || empty($company)) abort(404);

        $logo = $request->logo;
        $images = $request->images;

        $company->name = $request->name;
        $company->email = $request->email;
        $company->login = $request->login;
        $company->phone = $request->phone;
        $company->city = $request->city;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->about_us = $request->about_us;

        if ($request->password) {
            $company->password = Hash::make($request->password);
        }

        if ($request->hasFile("logo")) {
            $path = public_path() . '/storage/company/' . $company->logo;
            if ($company->logo && file_exists($path)) {
                unlink($path);
            }
            $logo = $request->logo;
            $logoExtention = $logo->getClientOriginalExtension();
            $logoFullName = time() . '-' . rand(11111, 99999) . '.' . $logoExtention;
            $logo->move(public_path() . '/storage/company/', $logoFullName);
            $company->logo = $logoFullName;
        }


        if ($request->hasFile("images")) {
            $images = $company->images;

            for ($i = 0; $i < 4; $i++) {

                if (isset($request->images[$i . ','])) {
                    if (isset($images[$i])) {
                        $oldImage = $images[$i];
                        $path = public_path() . '/storage/company/' . $oldImage->image;
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $images[$i]->delete();
                    }

                    $image = $request->images[$i . ','];
                    $imageExtention = $image->getClientOriginalExtension();
                    $imageFullName = time() . '-' . rand(11111, 99999) . '.' . $imageExtention;
                    $image->move(public_path() . '/storage/company/', $imageFullName);
                    CompanyImage::create([
                        "id_user" => $company->id,
                        "image" => $imageFullName
                    ]);
                }

            }
            
        }

        $company->save();
        return redirect()->back();

    }

    
    // ---------------------------------
    

    public function deleteCompany($id) {
        $company = User::find($id)->with(["products", "images"])->first();
        if (Auth::user()->role != "admin" || empty($company)) abort(404);

        $logoPath = public_path() . "/storage/company/" . $company->logo;
        if (file_exists($logoPath) && $company->logo) {
            unlink($logoPath);
        }

        foreach ($company->images as $image) {
            $path = public_path() . "/storage/company/" . $image->image;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($company->products as $product) {
            $images = ProductImage::where("id_product", $product->id)->get();
            foreach ($images as $image) {
                $path2 = public_path() . "/storage/product/" . $image->image;
                if (file_exists($path2)) {
                    unlink($path2);
                }
            }
            $images->each->delete();
        }

        $company->products()->delete();
        $company->images()->delete();
        $company->delete();
        return redirect()->route("adminIndex");
    }
    
    public function deleteProduct($id) {
        $product = Product::find($id)->with(["images"])->get();
        if (Auth::user()->role != "admin" || empty($product)) abort(404);

        foreach ($product->images as $image) {
            $path = public_path() . "/storage/product/" . $image->image;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->images()->delete();
        $product->delete();
        return redirect()->route("adminProducts");
    }
    
    public function deleteCity($id) {
        $city = Citys::find($id);
        if (Auth::user()->role != "admin" || empty($city)) abort(404);

        $path = public_path() . "/storage/city/" . $city->image;
        if (file_exists($path)) {
            unlink($path);
        }

        $city->delete();
        return redirect()->route("adminCity");
    }
    
    public function deleteCategory($id) {
        $category = Categories::find($id);
        if (Auth::user()->role != "admin" || empty($category)) abort(404);

        $path = public_path() . "/storage/category/" . $category->image;
        if (file_exists($path)) {
            unlink($path);
        }

        $category->delete();
        return redirect()->route("adminCategory");
    }


    // ---------------------------------
    
    
    public function addCompany() {
        if (Auth::user()->role != "admin") abort(404);
        return view("adminaAddCompany");
    }
    
    public function addCity() {
        if (Auth::user()->role != "admin") abort(404);
        return view("adminaAddCity");
    }
    
    public function addCategory() {
        if (Auth::user()->role != "admin") abort(404);
        return view("adminaAddCategory");
    }


    // ---------------------------------

    
    public function createCompany(Request $request) {

        if (Auth::user()->role != "admin") abort(404);
        $company = new User;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/[0-9]/'],
            'city' => ['nullable', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'about_us' => ['nullable', 'max:1000'],
        ]);

        $validateOne = User::where("email", $request->email)->first();
        if (!empty($validateOne)) {
            return redirect()
            ->back()
            ->withErrors($errors = "Аккаунт с такой email существует")
            ->withInput();
        }

        $validateTwo = User::where("login", $request->login)->first();
        if (!empty($validateTwo)) {
            return redirect()
            ->back()
            ->withErrors($errors = "Аккаунт с такой login существует")
            ->withInput();
        }

        $validatethree = User::where("phone", $request->phone)->first();
        if (!empty($validatethree)) {
            return redirect()
            ->back()
            ->withErrors($errors = "Аккаунт с такой phone существует")
            ->withInput();
        }

        $logo = $request->logo;
        $images = $request->images;

        $company->role = "user";
        $company->status = "active";
        $company->name = $request->name;
        $company->email = $request->email;
        $company->login = $request->login;
        $company->password = Hash::make($request->password);
        $company->phone = $request->phone;
        $company->city = $request->city;
        $company->address = $request->address;
        $company->about_us = $request->about_us;

        if ($request->hasFile("logo")) {
            $path = public_path() . '/storage/company/' . $company->logo;
            if ($company->logo && file_exists($path)) {
                unlink($path);
            }
            $logo = $request->logo;
            $logoExtention = $logo->getClientOriginalExtension();
            $logoFullName = time() . '-' . rand(11111, 99999) . '.' . $logoExtention;
            $logo->move(public_path() . '/storage/company/', $logoFullName);
            $company->logo = $logoFullName;
        }


        if ($request->hasFile("images")) {
            $id = User::max("id") + 1;
            foreach ($request->images as $image) {
                $imageExtention = $image->getClientOriginalExtension();
                $imageFullName = time() . '-' . rand(11111, 99999) . '.' . $imageExtention;
                $image->move(public_path() . '/storage/company/', $imageFullName);
                CompanyImage::create([
                    "id_user" => $id,
                    "image" => $imageFullName
                ]);
            }
        }

        $company->save();
        return redirect()->route("adminIndex");

    }
    
    public function createProduct(Request $request) {
        
    }
    
    public function createCity(Request $request) {
        
    }
    
    public function createCategory(Request $request) {
        
    }

}
