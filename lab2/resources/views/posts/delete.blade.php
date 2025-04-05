<x-navbar>
  <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold mb-6 text-red-700">Delete Confirmation</h1>

    <div class="bg-blue-50 rounded-md p-6 mb-8 border border-red-100">
      <h2 class="text-2xl font-semibold mb-3 text-gray-800">Post Title: {{ $post->title }}</h2>
      <p class="mb-4 text-gray-600">
        <strong>Description:</strong> {{ $post->description }}
      </p>
      <div class="text-gray-700 space-y-2">
        <p><strong>Created At:</strong> {{ $post->formatted_date }}</p>
        <p><strong>Posted By:</strong> {{ $post->user->name }}</p>
        <p><strong>Email:</strong> {{ $post->user->email }}</p>
      </div>
    </div>

    <div class="flex justify-between">
      <a href="{{ route('posts.index') }}"
        class="inline-block px-5 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 transition duration-200 font-medium">
        Cancel
      </a>

      <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="inline-block px-5 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition duration-200 font-medium">
          Confirm Delete
        </button>
      </form>
    </div>
  </div>
</x-navbar>