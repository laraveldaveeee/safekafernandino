<template>
  <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">

    <!-- LOADING -->
    <div v-if="loading" class="text-center text-gray-500 py-10">
      Loading rescuer profile...
    </div>

    <!-- ERROR -->
    <div v-else-if="error" class="text-center text-red-500 py-10">
      Failed to load rescuer profile
    </div>

    <!-- CONTENT -->
    <div v-else>

      <!-- TOP -->
      <div class="flex items-center space-x-6">

        <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-600">
          {{ initials }}
        </div>

        <div>
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ user.name }}
          </h2>
 

          <!-- STATUS -->
          <span
            class="inline-block mt-2 px-3 py-1 text-sm rounded-full"
            :class="user.guardian?.status === 'approved'
              ? 'bg-green-100 text-green-700'
              : user.guardian?.status === 'declined'
              ? 'bg-red-100 text-red-700'
              : 'bg-yellow-100 text-yellow-700'"
          >
            {{ user.guardian?.status || 'pending' }}
          </span>

        </div>

      </div>

      <div class="border-t my-6"></div>

      <!-- DETAILS -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-900 dark:text-white">

        <div>
          <label>Email</label>
          <p>{{ user.email || '-' }}</p>
        </div>

        <div>
          <label>Contact</label>
          <p>{{ user.guardian?.contact || '-' }}</p>
        </div>

        <div>
          <label>Address</label>
          <p>{{ user.guardian?.address || '-' }}</p>
        </div>

        <div>
          <label>Gender</label>
          <p>{{ user.guardian?.gender || '-' }}</p>
        </div>

        <div>
          <label>Medical Info</label>
          <p>{{ user.guardian?.medical_info || '-' }}</p>
        </div>

        <div>
          <label>Gesture Data</label>
          <p>{{ user.guardian?.gesture_data || '-' }}</p>
        </div>
        <div>
          <label>ID Verified</label>
          <p>{{ user.is_id_verified?.is_id_verified || '-' }}</p>
        </div>

      </div>


    </div>

  </div>
</template>

<script> 

export default {

  data() {
    return {
      user: {
        guardian: {},
        role: {}
      },
      loading: false,
      error: false,
      userId: null
    }
  },

  computed: {
    initials() {
      if (!this.user.name) return ''
      return this.user.name
        .split(' ')
        .map(n => n[0])
        .join('')
        .toUpperCase()
    }
  },

  mounted() {
    const path = window.location.pathname.split('/')
    this.userId = path[2]
    this.fetchUser()
  },

  methods: {

    // GET USER
    fetchUser() {
      this.loading = true
      this.error = false

      axios.get(`/api/citizens/${this.userId}/profile`)
        .then(res => {
          this.user = res.data
        })
        .catch(err => {
          console.log(err)
          this.error = true
        })
        .finally(() => {
          this.loading = false
        })
    },

  }
}
</script>