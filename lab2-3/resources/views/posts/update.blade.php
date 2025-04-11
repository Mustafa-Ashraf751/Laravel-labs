<x-navbar>
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('posts.update', $post['id']) }}" method="POST" enctype="multipart/form-data">
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
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post->description }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="posted_by" class="block text-gray-700 font-medium mb-2">Posted By</label>
                    <select name="user_id" id="user_id"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- filepath: /home/mustafa-ashraf/Desktop/Laravel labs/Laravel-labs/Laravel-labs/lab2/resources/views/posts/update.blade.php -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-medium mb-2">Post Image</label>

                    @if ($post->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Current image:</p>
                            <div class="w-full max-w-md">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="rounded-lg border border-gray-300 shadow-sm max-h-48 object-cover">
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center space-x-2">
                        <div class="w-full">
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>{{ $post->image ? 'Replace image' : 'Upload an image' }}</span>
                                            <input id="image-upload" name="image" type="file" accept="image/*"
                                                class="sr-only" onchange="previewImage()">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>
                        <div id="image-preview-container" class="hidden w-1/3">
                            <img id="image-preview" src="#" alt="Preview"
                                class="h-32 w-full object-cover rounded-md border border-gray-300">
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
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
    <script>
        function previewImage() {
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('image-preview-container');
            const file = document.getElementById('image-upload').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                container.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                container.classList.add('hidden');
            }
        }
    </script>
</x-navbar>
