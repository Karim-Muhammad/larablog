<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>All Users</b>
    </x-slot>

    <x-slot name="content">
        <div>
            <a href="{{ route('admin.users.create') }}" class="bg-green-700 text-white py-2 px-4">Add Category</a>
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
                    <th>ID</th>
                    <th class="p-4">User Name</th>
                    <th>Email</th>
                    <th>No. Posts</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->id }}</a>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="bg-green-500 text-white rounded-full px-2 py-1">{{ $user->posts->count() }}</span>
                        </td>
                        <td>
                            <div class="flex justify-center">
                                
                                <x-form-data method="post" http-method="DELETE" class="mx-[auto] w-full my-7 max-w-sm" action="{{ route('admin.users.destroy', $user->id) }}">
                                    <a class="block py-2 px-4 bg-indigo-300 text-black" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                    <x-slot name="btnValue">Delete</x-slot>
                                    <x-slot name="btnClass">bg-red-500</x-slot>
                                </x-form-data>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
