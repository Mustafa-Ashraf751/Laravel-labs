<script setup>
import { Link } from '@inertiajs/vue3';
import ViewAjax from '../Components/ViewAjax.vue';
import Pagination from '../Components/Pagination.vue';

defineProps({
  posts: Object
});

</script>


<template>
  <div id="blade-app" class="container mx-auto px-4 py-8 max-w-7xl">
    <h1 class="text-2xl font-bold mb-4">ITI Blog</h1>
    <div class="flex justify-between items-center mb-4">
      <a href="{{ route('posts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create
        Post</a>
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
        <tr v-for="post in posts.data" :key="post.id" class="border-t">
          <td class="px-4 py-2">{{ post.id }}</td>
          <td class="px-4 py-2">{{ post.title }}</td>
          <td class="px-4 py-2">{{ post.slug }}</td>
          <td class="px-4 py-2">{{ post.user?.name || 'Not Found' }}</td>
          <td class="px-4 py-2">{{ post.created_at }}</td>
          <td class="px-4 py-2">
            <view-ajax :id="post.id"></view-ajax>
            <Link :href="route('posts.show', post.id)"
              class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow-sm hover:bg-blue-700 transition duration-200">
            View
            </Link>
            <Link :href="route('posts.edit', post.id)"
              class="inline-block px-3 py-1 bg-green-600 text-white text-sm rounded-md shadow-sm hover:bg-green-700 transition duration-200">
            Edit</Link>
            <Link :href="route('posts.delete', post.id)"
              class="inline-block px-3 py-1 bg-red-600 text-white text-sm rounded-md shadow-sm hover:bg-red-700 transition duration-200">
            Delete</Link>
          </td>
        </tr>

      </tbody>
    </table>
    <div class="mt-4 flex justify-center">
      <pagination :links="posts.links"></pagination>
    </div>
  </div>

</template>



<style></style>