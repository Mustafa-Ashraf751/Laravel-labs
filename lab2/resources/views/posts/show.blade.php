<x-navbar>
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">Post Details</h1>

        <div class="bg-blue-50 rounded-md p-6 mb-8 border border-blue-100">
            <h2 class="text-2xl font-semibold mb-3 text-gray-800">Post Title: {{ $post->title }}</h2>
            @if ($post->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-auto rounded-lg shadow-md object-cover max-h-96">
                </div>
            @endif
            <p class="mb-4 text-gray-600">
                <strong>Description:</strong> {{ $post->description }}
            </p>
            <div class="text-gray-700 space-y-2">
                <p><strong>Created At:</strong> {{ $post->formatted_date }}</p>
                <p><strong>Posted By:</strong> {{ $post->user->name }}</p>
                <p><strong>Email:</strong> {{ $post->user->email }}</p>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-8 mb-8">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Comments
                ({{ $post->allComments()->count() }})</h3>

            @if ($post->allComments()->count() > 0)
                <div class="space-y-4">
                    @foreach ($post->allComments()->with('user')->orderBy('created_at', 'desc')->get() as $comment)
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 {{ $comment->trashed() ? 'opacity-60' : '' }}"
                            id="comment-{{ $comment->id }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <p class="font-medium text-gray-800">{{ $comment->user->name }}</p>
                                        <div class="flex space-x-2">
                                            @if ($comment->trashed())
                                                <!-- Options for trashed comments -->
                                                <form action="{{ route('comments.restore', $comment->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('comments.force-delete', $comment->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Permanently delete this comment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Options for active comments -->
                                                <button onclick="showEditForm({{ $comment->id }})"
                                                    class="text-blue-500 hover:text-blue-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('comments.destroy', $comment->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                        @if ($comment->trashed())
                                            <span class="text-red-500 ml-2">(Deleted)</span>
                                        @endif
                                    </p>
                                    <div id="comment-content-{{ $comment->id }}" class="mt-2 text-gray-700">
                                        {{ $comment->content }}
                                    </div>

                                    @if (!$comment->trashed())
                                        <!-- Edit Comment Form (Hidden by default) -->
                                        <div id="edit-form-{{ $comment->id }}" class="mt-2 hidden">
                                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" rows="3"
                                                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $comment->content }}</textarea>
                                                <div class="mt-2 flex justify-end space-x-2">
                                                    <button type="button" onclick="hideEditForm({{ $comment->id }})"
                                                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md shadow hover:bg-gray-300 transition duration-200 text-sm">Cancel</button>
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200 text-sm">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">No comments yet.</p>
            @endif
        </div>

        <!-- Add Comment Form -->
        <div class="mt-6 bg-gray-50 p-4 rounded-md border border-gray-200">
            <h4 class="font-medium text-gray-800 mb-3">Add a Comment</h4>
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="3"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write your comment here..." required></textarea>
                <div class="mt-2 text-right">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200 text-sm font-medium">Submit
                        Comment</button>
                </div>
            </form>
        </div>

        <div class="text-right mt-6">
            <a href="{{ route('posts.index') }}"
                class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200 font-medium">
                Back to Posts
            </a>
        </div>
    </div>

    <script>
        function showEditForm(commentId) {
            document.getElementById('comment-content-' + commentId).classList.add('hidden');
            document.getElementById('edit-form-' + commentId).classList.remove('hidden');
        }

        function hideEditForm(commentId) {
            document.getElementById('edit-form-' + commentId).classList.add('hidden');
            document.getElementById('comment-content-' + commentId).classList.remove('hidden');
        }
    </script>
</x-navbar>
