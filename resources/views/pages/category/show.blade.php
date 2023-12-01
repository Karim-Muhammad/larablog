<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Show a Category</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <h1 class="text-4xl">Category "<span class="text-cyan-400">{{$category->name}}</span>"</h1>

        <table class="border-separate table-bordered w-full text-center">
            <h1 class="text-xl my-4 text-white text-center">Table of Posts' {{$category->name}}</h1>
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($posts as $post)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="flex justify-center">
                                
                                <x-form-data method="post" http-method="DELETE" action="{{ route('posts.destroy', $post->id) }}">
                                    <a class="block py-2 px-4 bg-indigo-300 text-black" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    <x-slot name="btnValue">Delete</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>
                                
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Posts found for this category.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
