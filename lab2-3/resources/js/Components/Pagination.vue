<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array
})

</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <div v-for="(link, key) in links" :key="key" class="mr-1 mb-1">
        <Link v-if="link.url === null" class="px-4 py-2 text-gray-400 text-sm border rounded"
          :class="{ 'text-gray-500': link.url === null }" v-html="link.label" />
        <Link v-else :href="link.url" class="px-4 py-2 border rounded text-sm"
          :class="{ 'bg-blue-500 text-white': link.active }" v-html="link.label" />
      </div>
    </div>
  </div>
</template>

<style></style>