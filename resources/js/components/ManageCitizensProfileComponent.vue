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

          <p class="text-gray-500 dark:text-white">
            Role: {{ user.role?.name || '-' }}
          </p>

          <span
            class="inline-block mt-2 px-3 py-1 text-sm rounded-full"
            :class="statusClass(user.guardian?.status)"
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

        <!-- FILES -->
        <div>
          <label>Medical Info</label>
          <FileLink :file="user.guardian?.medical_info" />
        </div>

        <div>
          <label>Gesture Data</label>
          <FileLink :file="user.guardian?.gesture_data" />
        </div>

        <div>
          <label>ID Verified</label>
          <FileLink :file="user.guardian?.is_id_verified" />
        </div>

      </div>

      <!-- ACTIONS -->
      <div class="mt-6 flex gap-3">

        <button
          @click="approveCitizen"
          :disabled="user.guardian?.status === 'approved'"
          class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 disabled:opacity-50"
        >
          Approve
        </button>

        <button
          @click="declineCitizen"
          :disabled="user.guardian?.status === 'declined'"
          class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 disabled:opacity-50"
        >
          Decline
        </button>

      </div>

    </div>
  </div>
</template>

<script>

const FileLink = {
  props: ['file'],

  computed: {
    fileUrl() {
      return this.file ? `/storage/${this.file}` : null
    }
  },

  template: `
    <div v-if="file">

      <a
        :href="fileUrl"
        target="_blank"
        class="text-blue-600 underline mr-3"
      >
        View
      </a>

      <a
        :href="fileUrl"
        download
        class="text-green-600 underline"
      >
        Download
      </a>

    </div>

    <span v-else class="text-gray-400">No file</span>
  `
}

export default {

  components: {
    FileLink
  },

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

    // STATUS COLOR
    statusClass(status) {
      return {
        approved: 'bg-green-100 text-green-700',
        declined: 'bg-red-100 text-red-700',
        pending: 'bg-yellow-100 text-yellow-700'
      }[status] || 'bg-gray-100 text-gray-700'
    },

    // GET USER
    fetchUser() {
      this.loading = true
      this.error = false

      axios.get(`/api/citizens-pending/${this.userId}/manage`)
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

    // APPROVE
    approveCitizen() {
      Swal.fire({
        title: "Approve this user?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#16a34a",
        confirmButtonText: "Yes, Approve"
      }).then((result) => {

        if (result.isConfirmed) {
          axios.post(`/api/citizens/${this.userId}/approve`)
            .then(() => {
              Swal.fire("Approved!", "", "success")
              setTimeout(() => {
                window.location.href = '/citizens-pending'
              }, 1200)
            })
            .catch(() => {
              Swal.fire("Error", "Failed to approve user", "error")
            })
        }

      })
    },

    // DECLINE
    declineCitizen() {
      Swal.fire({
        title: "Decline this user?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        confirmButtonText: "Yes, Decline"
      }).then((result) => {

        if (result.isConfirmed) {
          axios.post(`/api/citizens/${this.userId}/decline`)
            .then(() => {
              Swal.fire("Declined!", "", "success")
              setTimeout(() => {
                window.location.href = '/citizens-pending'
              }, 1200)
            })
            .catch(() => {
              Swal.fire("Error", "Failed to decline user", "error")
            })
        }

      })
    }

  }
}
</script>