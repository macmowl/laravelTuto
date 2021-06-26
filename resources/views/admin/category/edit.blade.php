<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update category
        </h2>
    </div>

</x-slot>

<div class="py-12">
        <div class="overflow-x-auto">
            <div class="min-w-screen flex justify-center font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    @if (session('success'))
                    <div class="relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md py-5 pl-6 pr-8 sm:pr-6">
                        <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                            <div class="text-green-500">
                                <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="text-sm font-medium ml-3">{{ session('success') }}</div>
                        </div>
                        <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-3 gap-4 my-6">
                        <div class="col-span-2 bg-white p-4 shadow-md rounded">
                            <h1>Update Category</h1>
                            <form action="{{ url('category/update/'.$category->id) }}" method="post" class="w-100 flex flex-col gap-3">
                            @csrf
                            <input type="text" name="category_name" id="category" placeholder="update category" class="border border-gray-300 p-2 my-2 rounded-md focus:outline-none focus:ring-2 ring-blue-200" value="{{ $category->category_name }}" maxlength="40">
                            @error('category_name')
                                <p class="text-red-400">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="w-full bg-blue-500 rounded-lg font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">Add category</button>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
</x-app-layout>
