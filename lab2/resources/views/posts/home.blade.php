<x-navbar>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">ITI Blog</h1>
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('posts.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create Post</a>
        </div>
        <table class="table-auto w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Slug</th>
                    <th class="px-4 py-2">Posted By</th>
                    <th class="px-4 py-2">Created At</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $post->id }}</td>
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->slug }}</td>
                        <td class="px-4 py-2">{{ $post->user->name ?? 'Not Found' }}</td>
                        <td class="px-4 py-2">{{ $post->created_at }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow-sm hover:bg-blue-700 transition duration-200">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="inline-block px-3 py-1 bg-green-600 text-white text-sm rounded-md shadow-sm hover:bg-green-700 transition duration-200">Edit</a>
                            <a href="{{ route('posts.delete', $post->id) }}"
                                class="inline-block px-3 py-1 bg-red-600 text-white text-sm rounded-md shadow-sm hover:bg-red-700 transition duration-200">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-4 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</x-navbar>
