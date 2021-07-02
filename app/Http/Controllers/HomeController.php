<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;

class HomeController extends Controller
{
    public function AllSliders() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider() {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request) {
        $data = $request->validate([
            'title' => "required|min:4",
            'description' => "required",
            'image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'title.required' => 'Please Input Slider title',
        ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('images/sliders/' . $name_gen);

        $last_img = 'images/sliders/' . $name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.slider')->with('success', 'Slider successfully added');
    }
}
