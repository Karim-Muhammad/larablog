<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>All Categories</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <div>
            <a href="{{ route('category.create') }}" class="bg-green-700 text-white py-2 px-4">Add Category</a>
        </div>

        {{-- `@error` used only with Request Validation --}}
        {{-- @error("error") 
            <div class="bg-red-500 text-white text-xl">{{ $message }}</div>
        @enderror --}}

        {{-- @isset(session()->has("error") !== null) doesn't work as well (cannot accept this expression) --}}

        @if(session()->has("error"))
            <div class="bg-red-500 text-white text-xl w-fit p-3 round-3 mx-[auto]">{{ session()->get("error") }}</div>
        @endif

        <table class="border-separate table-bordered w-full text-center">
            <h1 class="text-xl my-4 text-white text-center">Table of Categories</h1>
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4">Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <div class="flex justify-center">
                                
                                <x-form-data method="post" http-method="DELETE" action="{{ route('category.destroy', $category->id) }}">
                                    <a class="block py-2 px-4 bg-indigo-300 text-black" href="{{ route('category.edit', $category->id) }}">Edit</a>
                                    <x-slot name="btnValue">Delete</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>
                                
                                {{-- <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-4 bg-red-400 text-white">Delete</button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
