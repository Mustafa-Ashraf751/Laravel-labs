<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<x-navbar>
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">Post Details</h1>

        <div class="bg-blue-50 rounded-md p-6 mb-8 border border-blue-100">
            <h2 class="text-2xl font-semibold mb-3 text-gray-800">Post Title: {{ $post['title'] }}</h2>
            <p class="mb-4 text-gray-600">
                <strong>Description:</strong> {{ $post['description'] }}
            </p>
            <div class="text-gray-700 space-y-2">
                <p><strong>Created At:</strong> {{ $post['created_at'] }}</p>
                <p><strong>Posted By:</strong> {{ $post['posted_by'] }}</p>
                <p><strong>Email:</strong> {{ $post['email'] }}</p>
            </div>
        </div>

        <div class="text-right">
            <a href="{{ route('posts.home') }}"
                class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200 font-medium">
                Back to Posts
            </a>
        </div>
    </div>
</x-navbar>


</html>