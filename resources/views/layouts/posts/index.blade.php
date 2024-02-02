<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>All Posts</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="bg-red-500 text-white text-xl w-fit p-3 round-3 mx-[auto]">{{ $error }}</div>
            @endforeach
        @endif
        
        <div class="my-7">
            <a href="{{ route('admin.posts.create') }}" class="bg-green-700 text-white py-2 px-4">Add Post</a>
        </div>

        <h1 class="text-xl my-7 text-center dark:text-white text-black">Table of Posts</h1>

        <table class="border-separate table-bordered w-full text-center">
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="p-4">Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($posts as $post)
                    <tr class="p-3 odd:bg-gray-600 dark:odd:bg-slate-300 dark:odd:text-black | dark:even:bg-gray-600 dark:even:text-white even:bg-slate-200 even:text-black">
                        <td class="p-4">{{ $post->id }}</td>
                        <td>
                            <img src="{{\Illuminate\Support\Str::startsWith($post->image, "http")? $post->image: asset("storage/".$post->image)}}"/>
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td class="text-sm">{{ $post->status }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <div class="flex justify-center">
                                
                                <x-form-data method="POST" http-method="DELETE" class="mx-[auto] w-full my-7 max-w-sm" action="{{ route('admin.posts.destroy', $post->id) }}">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="py-2 px-4 bg-indigo-300 text-black block w-full">Edit</a>
                                    <x-slot name="btnValue">Trash</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>
                                
                                {{-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-4 bg-red-400 text-white">Delete</button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No posts found</td>
                    </tr>
                @endforelse
            </tbody>
    </x-slot>
</x-app-layout>
