<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-4 relative">

      <!-- CLOSE -->
      <button
        @click="$emit('close')"
        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
      >
        ✕
      </button>

      <!-- TITLE -->
      <h2 class="text-lg font-bold mb-4">
        {{ type === 'photo' ? 'Photo View' : 'Media View' }}
      </h2>

      <!-- IMAGE -->
      <div v-if="type === 'photo'">
        <img
          v-if="data.photo_url"
          :src="data.photo_url"
          class="w-full rounded-lg"
        />
        <p v-else class="text-gray-500">No photo available</p>
      </div>

      <!-- VIDEO -->
      <div v-if="type === 'media'">
        <video
          v-if="data.media_url"
          controls
          class="w-full rounded-lg"
        >
          <source :src="data.media_url" type="video/mp4" />
        </video>
        <p v-else class="text-gray-500">No media available</p>
      </div>

    </div>

  </div>
</template>

<script>
export default {
  props: {
    show: Boolean,
    type: String, // 'photo' or 'media'
    data: Object
  }
}
</script>