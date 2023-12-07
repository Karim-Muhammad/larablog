<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Edit a Category</b>
    </x-slot>

    <x-slot name="content">
        <div class="container text-white">
            <h1>Form Edit Category</h1>

            <form class="w-full mx-[auto] my-7 max-w-sm" method="POST" action="{{route('admin.category.update', $category->id)}}">
                @csrf
                @method("PUT")

                <div class="flex items-center border-b border-teal-500 py-2">
                    <input name="name" value="{{$category->name}}" class="@error('name') is-invalid @enderror appearance-none bg-transparent text-white border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name">
                    
                    <button type="submit" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-1 px-2 rounded">
                      Update
                    </button>
    
                    <a href="{{route("admin.category.index")}}" class="flex-shrink-0 border-transparent border-4 text-green-700 hover:text-green-900 text-sm py-1 px-2 rounded cursor-pointer">
                      Cancel
                    </a>

                  </div>
                  @error("name")
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                  @enderror
              </form>
        
              {{-- 
                <x-form-data method="post" {{-- http-method="DELETE" --} http-method="DELETE" action="/asd/">
                    <x-slot name="btnValue">ADD</x-slot>
                    <input type="email" />
                </x-form-data>
                --}}
        </div>
    
        </x-slot>
</x-app-layout>
