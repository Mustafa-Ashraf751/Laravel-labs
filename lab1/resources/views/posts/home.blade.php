<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITI Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

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
                    <th class="px-4 py-2">Posted By</th>
                    <th class="px-4 py-2">Created At</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $post['id'] }}</td>
                        <td class="px-4 py-2">{{$post['title']}}</td>
                        <td class="px-4 py-2">{{$post['posted_by']}}</td>
                        <td class="px-4 py-2">{{$post['created_at']}}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('posts.show', $post['id']) }}"
                                class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow-sm hover:bg-blue-700 transition duration-200">View</a>
                            <a href="{{ route('posts.update', $post['id']) }}"
                                class="inline-block px-3 py-1 bg-green-600 text-white text-sm rounded-md shadow-sm hover:bg-green-700 transition duration-200">Edit</a>
                            <a href="#"
                                class="inline-block px-3 py-1 bg-red-600 text-white text-sm rounded-md shadow-sm hover:bg-red-700 transition duration-200">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-4 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
                <a href="#" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">1</a>
                <a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">2</a>
                <a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">3</a>
                <a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next</a>
            </nav>
        </div>
    </div>
</x-navbar>

</html>