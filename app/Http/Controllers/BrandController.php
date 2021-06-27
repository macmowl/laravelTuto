<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request) {
        $data = $request->validate([
            'brand_name' => "required|unique:brands|min:4",
            'brand_image' => 'required|mimes:jpg.jpeg,png',
        ],[
            'brand_name.required' => 'Please Input brand name',
            'brand_image.min' => 'Brand longer than 4 characters',
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_extension = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_extension;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location, $last_img);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('succes', 'Brand successfully added');
    }
}
