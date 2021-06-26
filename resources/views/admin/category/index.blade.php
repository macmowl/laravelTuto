<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All categories
        </h2>
        <p>Total categories <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ count($categories) }}</span></p>
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
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">ID</th>
                                        <th class="py-3 px-6 text-left">Name</th>
                                        <th class="py-3 px-6 text-center">Creator</th>
                                        <th class="py-3 px-6 text-center">Created At</th>
                                        <th class="py-3 px-6 text-center">CRUD</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ( $categories as $category)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <span class="font-medium">{{ $category->id }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <span>{{ $category->category_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $category->user->name }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $category->created_at->diffForHumans() ?? 'No data' }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="{{ url('category/edit/'.$category->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="{{ url('softdelete/category/'.$category->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                            <br />
                            <h3 class="font-semibold my-2">Trashed categories</h3>
                            <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-center">Creator</th>
                                    <th class="py-3 px-6 text-center">Created At</th>
                                    <th class="py-3 px-6 text-center">CRUD</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ( $trashCat as $category)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <span class="font-medium">{{ $category->id }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ $category->category_name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $category->user->name }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span>{{ $category->created_at->diffForHumans() ?? 'No data' }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ url('category/restore/'.$category->id) }}">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.27217 17.7742L6.13672 18.7794C6.49826 19.1862 6.89103 19.5641 7.31153 19.9096L8.27136 18.7363C7.91336 18.4425 7.57926 18.1208 7.27217 17.7742Z" fill="#4b5563"/>
                                                        <path d="M5.77998 15.4321L4.38867 16.0294C4.60379 16.5307 4.85922 17.0137 5.15245 17.4737L6.42946 16.6622C6.18042 16.2702 5.96321 15.8589 5.77998 15.4321Z" fill="#4b5563"/>
                                                        <path d="M18.9049 3.15871C17.3484 2.25626 15.5813 1.78075 13.782 1.78027C8.66473 1.78851 4.34138 5.5782 3.66295 10.6504L1.07035 8.05778L0 9.12813L4.31999 13.4481L8.63999 9.12813L7.56964 8.05778L5.22835 10.396C6.11793 5.67647 10.6651 2.57168 15.3846 3.46126C20.1042 4.35083 23.209 8.89797 22.3194 13.6175C21.4298 18.337 16.8827 21.4419 12.1631 20.5523C11.1957 20.37 10.2662 20.0246 9.41436 19.5311L8.65361 20.8398C13.5361 23.6707 19.789 22.0074 22.6198 17.1249C25.4507 12.2424 23.7875 5.98952 18.9049 3.15871Z" fill="#4b5563"/>
                                                        <path d="M12.6465 5.18652V13.5132L15.9771 16.0111L16.8855 14.8L14.1604 12.7562V5.18652H12.6465Z" fill="#4b5563"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ url('pdelete/category/'.$category->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $trashCat->links() }}
                        </div>
                        <div class="bg-white p-4 shadow-md rounded">
                            <form action="{{ route('store.category') }}" method="post" class="w-100 flex flex-col gap-3">
                                @csrf
                                <input type="text" name="category_name" id="category" placeholder="Add category" class="border border-gray-300 p-2 my-2 rounded-md focus:outline-none focus:ring-2 ring-blue-200" maxlength="40">
                                @error('category')
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
