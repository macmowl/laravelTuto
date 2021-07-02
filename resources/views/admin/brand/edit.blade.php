@extends('admin.admin_master')

@section('admin')

<div class="py-12">
        <div class="overflow-x-auto">
            <div class="min-w-screen flex justify-center font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">

                    <div class="grid grid-cols-3 gap-4 my-6">
                        <div class="col-span-2 bg-white p-4 shadow-md rounded">
                            <h1>Update Brand</h1>
                            <div class="flex">
                                <div class="flex-grow">
                                    <form action="{{ url('brand/update/'.$brand->id) }}" method="post" class="w-100 flex flex-col gap-3" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                        <input type="text" name="brand_name" id="brand_name" placeholder="update brand" class="border border-gray-300 p-2 my-2 rounded-md focus:outline-none focus:ring-2 ring-blue-200" value="{{ $brand->brand_name }}" maxlength="40">
                                        @error('brand_name')
                                            <p class="text-red-400">{{ $message }}</p>
                                        @enderror
                                        <input type="file" name="brand_image" id="brand_image" class="border border-gray-300 p-2 my-2 rounded-md focus:outline-none focus:ring-2 ring-blue-200" value="{{ $brand->brand_image }}" maxlength="40">
                                        @error('brand_image')
                                            <p class="text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                        <div class="flex justify-center items-center mx-4">
                                            <img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}" class="h-16">
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full bg-blue-500 rounded-lg font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">Add brand</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
