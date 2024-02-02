@include('profile.edit', ['user' => $user, "flag" => false ])


<main class="p-4 sm:ml-64">
    <section class="posts">
        <table class="border-separate table-bordered w-full text-center">
            <thead class="bg-gray-200 dark:bg-gray-700 dark:text-gray-100">
                <tr>
                    <th>ID</th>
                    <th class="p-4">Title</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
    
            <tbody>
                @forelse ($user->posts as $post)
                    <tr class="p-3 odd:bg-black odd:text-white even:bg-slate-700 even:text-gray-50">
                        <td class="p-4">
                            <a href="{{ route('admin.users.show', $post->id) }}">{{ $post->id }}</a>
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->description, 20) }}</td>
    
                        <td>
                            <span class="bg-green-500 text-white rounded-full px-2 py-1">{{ $post->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</main>
