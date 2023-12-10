<x-app-layout>
    <x-slot name="header">
        <b>Show a Tag</b>
    </x-slot>

    <x-slot name="content">
        <h1 class="text-4xl dark:text-white text-black">Tag "<span class="text-cyan-400">{{ $tag->name }}</span>"</h1>

        <table class="border-separate table-bordered w-full text-center">
            <h1 class="text-xl my-4 dark:text-white text-black text-center">Table of Posts' {{ $tag->name }}</h1>
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Tag Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($posts as $post)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <div class="flex justify-center">

                                <x-form-data method="post" http-method="DELETE"
                                    action="{{ route('admin.posts.destroy', $post->id) }}">
                                    <a class="block py-2 px-4 bg-indigo-300 text-black"
                                        href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                    <x-slot name="btnValue">Delete</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Posts found for this tag.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
