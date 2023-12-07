<x-app-layout>
    {{-- {{ header }} --}}
    <x-slot name="header">
        <b>Edit a Post</b>
    </x-slot>

    {{-- {{ slot }}  --}}
    {{-- <x-slot:content>
        <h1>Bom</h1>
    </x-slot:content> --}}
    {{-- Equivalent --}}
    <x-slot name="content">
        <h1>Edit The Post</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="w-2/5 text-xl bg-red-500 mt-4 p-2 rounded-sm">
                    <p class="text-slate-100">{{ $error }}</p>
                </div>
            @endforeach
        @endif

        <x-form-data method="post" http-method="PATCH" enctype="multipart/form-data" class="text-black dark:text-white"
            action="{{ route('admin.posts.update', $post->id) }}">
            <x-slot name="btnValue">Update</x-slot>
            <x-slot name="btnClass">bg-green-400</x-slot>

            <div class="container my-7">
                <div class="w-full">
                    <label for="title">Blog's Title</label>
                    <input type="text" id="title" value="{{ old('title', $post->title) }}" name="title"
                        class="p-2 w-full" placeholder="Blog's How to study well..." />
                </div>

                <div class="w-full my-2">
                    <label for="description">Blog's Description</label>
                    <textarea id="description" name="description" class="p-2 w-full" placeholder="Blog's short desciption..."
                        rows="2">{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="w-full my-2">
                    <label for="content">Blog's Content</label>

                    {{-- CKEditor --}}
                    <textarea class="invisible hidden" id="body" name="body"></textarea>

                    <div class="document-editor border-gray-200 border outline-0">
                        <div class="document-editor__toolbar"></div>
                        <div class="document-editor__editable-container outline-0">
                            <div class="document-editor__editable h-full border border-gray-200 rounded-md outline-0">
                                {!! old('body', $post->body) !!}
                            </div>
                        </div>
                    </div>

                    {{-- <textarea type="text" id="content" value="{{old('body')}}" name="body" class="p-2 w-full" placeholder="Blog's content..." rows="3"></textarea> --}}
                </div>

                <div class="w-full my-7">
                    <label for="image">Blog's Image</label>
                    <input type="file" id="image" name="image" />
                </div>

                <div>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="image" />
                </div>

                <div class="w-full my-7">

                    <label for="categories_multiple"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an category</label>
                    <select id="categories_multiple" name="category_id"
                        class="focus:bg-gray-50 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option {{ $post->category_id === $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </x-form-data>

    </x-slot>


    @section('scripts')
        <script src="{{ asset('assets/vendor/ckeditor5/document/ckeditor.js') }}"></script>

        @include('ckeditor-script')
    @endsection
</x-app-layout>
