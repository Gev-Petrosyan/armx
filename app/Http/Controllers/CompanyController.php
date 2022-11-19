<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CompanyController extends Controller
{

    public function settings() {
        return view("settings");
    }
    
    public function update(Request $request) {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/[0-9]/'],
            'city' => ['nullable', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'about_us' => ['nullable', 'max:1000'],
        ]);

        $logo = $request->logo;
        $images = $request->images;

        Auth::user()->name = $request->name;
        Auth::user()->phone = $request->phone;
        Auth::user()->city = $request->city;
        Auth::user()->phone = $request->phone;
        Auth::user()->address = $request->address;
        Auth::user()->about_us = $request->about_us;

        if (Auth::user()->email != $request->email) {
            $email = $request->email;
            $user = User::where("email", $email)->first();
            if (empty($user)) {
                Auth::user()->email = $email;
            }
        }

        if (Auth::user()->login != $request->login) {
            $login = $request->login;
            $user = User::where("login", $login)->first();
            if (empty($user)) {
                Auth::user()->login = $login;
            }
        }

        if ($request->password) {
            Auth::user()->password = Hash::make($request->password);
        }

        if ($request->hasFile("logo")) {
            $path = public_path() . '/storage/company/' . Auth::user()->logo;
            if (Auth::user()->logo && file_exists($path)) {
                unlink($path);
            }
            $logo = $request->logo;
            $logoExtention = $logo->getClientOriginalExtension();
            $logoFullName = time() . '-' . rand(11111, 99999) . '.' . $logoExtention;
            $logo->move(public_path() . '/storage/company/', $logoFullName);
            Auth::user()->logo = $logoFullName;
        }


        if ($request->hasFile("images")) {
            $images = Auth::user()->images;

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
                        "id_user" => Auth::user()->id,
                        "image" => $imageFullName
                    ]);
                }

            }
            
        }

        Auth::user()->save();
        return redirect()->back();

    }

}
