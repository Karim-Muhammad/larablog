<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>All Tags</b>
    </x-slot>

    <x-slot name="content">
        <div>
            <a href="{{ route('admin.tags.create') }}" class="bg-green-700 text-white py-2 px-4">Add Tag</a>
        </div>

        @if (session()->has('error'))
            <div class="bg-red-500 text-white text-xl w-fit p-3 round-3 mx-[auto]">{{ session()->get('error') }}</div>
        @endif

        <table class="border-separate table-bordered w-full text-center">
            <h1 class="text-xl my-4 text-white text-center">Table of Categories</h1>
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4">Tag Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tags as $tag)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a>
                        </td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                        <td>
                            <div class="flex justify-center">

                                <x-form-data method="post" http-method="DELETE" class="mx-[auto] w-full my-7 max-w-sm"
                                    action="{{ route('admin.tags.destroy', $tag->id) }}">
                                    <a class="block py-2 px-4 bg-indigo-300 text-black"
                                        href="{{ route('admin.tags.edit', $tag->id) }}">Edit</a>
                                    <x-slot name="btnValue">Delete</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No tags found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
