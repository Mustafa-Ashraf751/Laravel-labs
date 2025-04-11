<script setup>
import {ref} from 'vue';
import axios from 'axios';

const showModal = ref(false);
const loading = ref(false);
const post = ref(null);
const error = ref(null);

const props = defineProps({
  id:{
    type:Number,
    required:true
  }
})

function fetchPostData(){
  loading.value = true;
  error.value = null;

  axios.get(`/posts/${props.id}/data`).then(response=>{
    post.value =response.data.data;
    loading.value = false;
  }).catch(err=>{
    error.value = 'Failed to load post data';
    loading.value = false;
    console.error(err);
  });
}

function openModal(){
    showModal.value = true;
    fetchPostData();
  }

  function closeModal(){
    showModal.value = false;
  }

</script>


<template>
 <div>
    <button @click="openModal" class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow-sm hover:bg-blue-700 transition duration-200">
     Post Info
    </button>

    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-black opacity-50" @click="closeModal"></div>
      <div class="bg-white p-6 rounded shadow-lg z-10 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold">Post Details</h2>
          <button @click="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        
        <div v-if="loading" class="text-center py-4">
          Loading...
        </div>
        
        <div v-else-if="error" class="text-center py-4 text-red-500">
          {{ error }}
        </div>
        
        <div v-else class="space-y-3">
          <div>
            <h3 class="font-bold">Title:</h3>
            <p>{{ post.title }}</p>
          </div>
          <div>
            <h3 class="font-bold">Description:</h3>
            <p>{{ post.description }}</p>
          </div>
          <div>
            <h3 class="font-bold">Author:</h3>
            <p>{{ post.username }}</p>
          </div>
          <div>
            <h3 class="font-bold">Email:</h3>
            <p>{{ post.useremail }}</p>
          </div>
        </div>
        <div class="mt-6 text-right">
          <button @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>



<style scoped>

</style>