<template>
  <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 transition-colors duration-300">

    <!-- TOP SECTION -->
    <div class="flex items-center space-x-6">

      <!-- AVATAR -->
      <div class="w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-3xl font-bold text-blue-600 dark:text-blue-400">
        {{ initials }}
      </div>

      <!-- BASIC INFO -->
      <div>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
          {{ rescuer.name || 'Loading...' }}
        </h2>

        <p class="text-gray-500 dark:text-gray-400">
          Type : {{ rescuer.type || '-' }}
        </p>

        <span
          v-if="rescuer.is_active == 1"
          class="inline-block mt-2 px-3 py-1 text-sm bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 rounded-full"
        >
          Active
        </span>

        <span
          v-else
          class="inline-block mt-2 px-3 py-1 text-sm bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 rounded-full"
        >
          Inactive
        </span>
      </div>

    </div>

    <!-- DIVIDER -->
    <div class="border-t border-gray-200 dark:border-gray-700 my-6"></div>

    <!-- DETAILS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Email</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">{{ rescuer.email || '-' }}</p>
      </div>

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Contact Number</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">
          {{ rescuer.contact || 'N/A' }}
        </p>
      </div>

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Address</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">
          {{ rescuer.station_location || '-' }}
        </p>
      </div>

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Status</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">
          {{ rescuer.status || '-' }}
        </p>
      </div>

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Gender</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">
          {{ rescuer.gender || '-' }}
        </p>
      </div>

      <div>
        <label class="text-sm text-gray-500 dark:text-gray-400">Station Location</label>
        <p class="text-gray-800 dark:text-gray-100 font-medium">
          {{ rescuer.station_location || '-' }}
        </p>
      </div>

    </div>

   
  </div>
</template>

<script>
export default {
  props: {
    rescuerId: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      rescuer: {
        name: '',
        type: '',
        email: '',
        contact: '',
        station_location: '',
        status: '',
        gender: '',
        is_active: 0
      }
    }
  },

  computed: {
    initials() {
      if (!this.rescuer.name) return ''
      return this.rescuer.name
        .split(' ')
        .map(n => n[0])
        .join('')
        .toUpperCase()
    }
  },

  mounted() {
    console.log('Rescuer ID:', this.rescuerId)
  },

}
</script>