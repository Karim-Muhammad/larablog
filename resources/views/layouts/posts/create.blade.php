<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Create a Post</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <h1>Form Create Post</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="w-2/5 text-xl bg-red-500 mt-4 p-2 rounded-sm">
                    <p class="text-slate-100">{{ $error }}</p>
                </div>
            @endforeach
        @endif

        <x-form-data method="post" http-method="post" enctype="multipart/form-data" class="text-black dark:text-white"
            action="{{ route('admin.posts.store') }}">
            <x-slot name="btnValue">Create</x-slot>
            <x-slot name="btnClass">bg-green-400</x-slot>

            <div class="container my-7 flex flex-wrap gap-3">
                {{-- Left Section --}}
                <div class="wrapper flex-1 w-2/3">

                    <div class="w-full">
                        <label for="title">Blog's title</label>
                        <input type="text" id="title" value="{{ old('title') }}" name="title"
                            class="p-2 w-full border border-gray-200 rounded-md"
                            placeholder="Blog's How to study well..." />
                    </div>

                    <div class="w-full my-7">

                        {{-- Categories --}}

                        <label for="categories_multiple"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                            category</label>
                        <select id="categories_multiple" name="category_id"
                            class="focus:bg-gray-50 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        {{-- Tags --}}

                        <label for="tags_multiple"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                            Tag</label>

                        <select multiple class="tags form-control" id="tags_multiple" name="tags_id[]"
                            class="focus:bg-gray-50 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        file</label>
                    <input name="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file">

                </div>

                {{-- Right Section --}}
                <div class="flex-1 w-1/3">
                    <div class="w-full h-full">
                        <label for="description">Blog's description</label>
                        <textarea id="description" aria-valuemax="{{ old('description') }}" name="description"
                            class="p-2 w-full h-full border border-gray-200 rounded-md" placeholder="Blog's short desciption..." rows="2"></textarea>
                    </div>
                </div>

                <div class="w-full my-2">
                    <label for="content">Blog's Content</label>

                    {{-- CKEditor --}}
                    <textarea class="invisible hidden" id="body" name="body">
                        {!! old('body', '') !!}
                    </textarea>

                    <div class="document-editor border-gray-200 border outline-0">
                        <div class="document-editor__toolbar"></div>
                        <div class="document-editor__editable-container outline-0">
                            <div class="document-editor__editable h-60 border border-gray-200 rounded-md outline-0">
                                {!! old('body', '') !!}
                            </div>
                        </div>
                    </div>

                    {{-- <textarea type="text" id="content" value="{{old('body')}}" name="body" class="p-2 w-full" placeholder="Blog's content..." rows="3"></textarea> --}}
                </div>
            </div>

        </x-form-data>

    </x-slot>

    @section('scripts')
        <script src="{{ asset('assets/vendor/ckeditor5/document/ckeditor.js') }}"></script>
        @include('ckeditor-script')
    @endsection
</x-app-layout>
