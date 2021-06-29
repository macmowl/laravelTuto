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
            'brand_image' => 'required|mimes:jpg,jpeg,png',
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

    public function edit($id) {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'brand_name' => "required|min:4",
        ],[
            'brand_name.required' => 'Please Input brand name',
            'brand_image.min' => 'Brand longer than 4 characters',
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_extension = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_extension;
            $up_location = 'images/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $last_img);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand successfully updated');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand successfully updated');
        }
    }

    public function delete($id) {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        $brand = brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand successfully deleted');
    }
}
