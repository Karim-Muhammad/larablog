<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Create a Category</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <div class="container text-white">
            <h1>Form Create Category</h1>

            @if (session()->has('error'))
                <div class="bg-red-200 text-2xl text-center">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form class="w-full mx-[auto] my-7 max-w-sm" method="POST" action="{{ route('admin.category.store') }}">
                @csrf

                <div class="flex items-center border-b border-teal-500 py-2">
                    <input name="name"
                        class="@error('name') is-invalid @enderror appearance-none bg-transparentborder-none w-full text-black mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text" placeholder="Jane Doe" aria-label="Full name">

                    <button type="submit"
                        class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-1 px-2 rounded">
                        Create
                    </button>

                    <a href="{{ route('admin.category.index') }}"
                        class="flex-shrink-0 border-transparent border-4 text-green-700 hover:text-green-900 text-sm py-1 px-2 rounded cursor-pointer">
                        Cancel
                    </a>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </form>
        </div>

    </x-slot>
</x-app-layout>
