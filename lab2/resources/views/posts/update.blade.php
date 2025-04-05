<x-navbar>
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('posts.update', $post['id']) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post['title'] }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post->description}}</textarea>
                </div>

                <div class="mb-6">
                    <label for="posted_by" class="block text-gray-700 font-medium mb-2">Posted By</label>
                    <select name="user_id" id="user_id"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $post->user_id== $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="flex justify-end">
                    <a href="{{ route('posts.index') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md shadow-md mr-3 transition duration-200 ease-in-out">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition duration-200 ease-in-out">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-navbar>