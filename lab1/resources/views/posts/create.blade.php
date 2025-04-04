<x-navbar>
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Create New Post</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="mb-6">
                    <label for="posted_by" class="block text-gray-700 font-medium mb-2">Posted By</label>
                    <select name="posted_by" id="posted_by"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Ahmed">Ahmed</option>
                        <option value="Mohamed">Mohamed</option>
                        <option value="Ali">Ali</option>
                        <option value="Mustafa">Mustafa</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('posts.home') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md shadow-md mr-3 transition duration-200 ease-in-out">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-md transition duration-200 ease-in-out">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-navbar>