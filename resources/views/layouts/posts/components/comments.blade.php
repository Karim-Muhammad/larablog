@foreach ($comments as $comment)
    <article class="relative p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
        <footer class="relative flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900 dark:text-white">
                    <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('storage/' . $comment->user->image) }}"
                        alt="Michael Gough">{{ $comment->user->name }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                        title="February 8th, 2022">Feb. 8, 2022</time></p>
            </div>

            @if ($comment->user_id === Auth::user()->id)
                <div class="settings" x-data="{ pressed: false }">
                    <button @click="pressed = ! pressed" {{-- id="" data-dropdown-toggle="dropdownComment1" --}}
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:text-gray-400 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        type="button">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                    <!-- Dropdown menu -->

                    <div x-show="pressed" {{-- id="dropdownComment1" --}}
                        :class="[
                            pressed ? 'block' : 'hidden',
                            'absolute right-0 z-10 w-48 py-1 mt-2 overflow-hidden text-sm bg-white rounded-md shadow-xl dark:bg-gray-900 dark:text-gray-400'
                        ]">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownMenuIconHorizontalButton">
                            {{-- TODO: DELETE form reply --}}
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>

                            {{-- TODO: UPDATE form reply --}}
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            {{-- <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            @endif
        </footer>

        <p> {{ $comment->content }} </p>

        <div class="mt-4 space-x-4" x-data="{ open: false }">

            <button type="button" @click="open = ! open"
                class="flex items-center font-medium text-sm text-gray-500 hover:underline dark:text-gray-400">
                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 18">
                    <path
                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                </svg>
                Reply
            </button>

            {{-- <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $comment->post->id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Reply" />
                </div>
                <hr />
            </form> --}}
            <div class="block">
                @include('pages.admin.posts.components.comments-replies', [
                    'comments' => $comment->replies,
                ])
            </div>

            <form x-show="open" class="mb-6 block" method="post" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />

                <div
                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" rows="6" name="content"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                        placeholder="Write a comment..." required></textarea>
                </div>
                <button type="submit"
                    class="items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-500 hover:bg-blue-600 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900">
                    Post comment
                </button>
            </form>
        </div>

    </article>
@endforeach
