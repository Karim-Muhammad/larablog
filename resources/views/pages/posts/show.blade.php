<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Show Post</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <h1>Show Post</h1>
    </x-slot>
</x-app-layout>
