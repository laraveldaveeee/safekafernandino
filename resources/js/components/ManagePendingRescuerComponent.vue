<template>
  <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">

    <!-- TOP INFO -->
    <div class="flex items-center space-x-6">

      <!-- AVATAR -->
      <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-600">
        {{ initials }}
      </div>

      <!-- USER INFO -->
      <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
          {{ user.name || 'Loading...' }}
        </h2>

        <p class="text-gray-500 text-gray-900 dark:text-white">
          Role: {{ user.role?.name || '-' }}
        </p>

        <span
          v-if="user.rescuer?.is_active == 1"
          class="inline-block mt-2 px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full"
        >
          Active
        </span>

        <span
          v-else
          class="inline-block mt-2 px-3 py-1 text-sm bg-red-100 text-red-700 rounded-full"
        >
          Inactive
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
        <p>{{ user.rescuer?.contact || '-' }}</p>
      </div>

      <div>
        <label>Address</label>
        <p>{{ user.rescuer?.station_location || '-' }}</p>
      </div>

      <div>
        <label>Status</label>
        <p>{{ user.rescuer?.status || '-' }}</p>
      </div>

      <div>
        <label>Gender</label>
        <p>{{ user.rescuer?.gender || '-' }}</p>
      </div>

    </div>

    <!-- ROLE + APPROVE -->
    <div class="mt-6 border-t pt-4 text-gray-900 dark:text-white">

      <label class="text-sm text-gray-500 text-gray-900 dark:text-white">
        Select Role to Approve
      </label>

      <div class="flex space-x-3 mt-2">

        <!-- ROLE SELECT -->
        <select
          v-model="selectedRoleId"
          class="border rounded-lg px-3 py-2 w-48 dark:bg-gray-700 dark:text-white "
        >
          <option disabled value="">Select role</option>

          <option
            v-for="role in roles"
            :key="role.id"
            :value="role.id"
          >
            {{ role.name }}
          </option>

        </select>
      </div>

    </div>

  
    <div class="mt-6">
  <!-- APPROVED -->
       <button
          @click="approveRescuer"
          :disabled="!selectedRoleId"
          class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 disabled:opacity-50"
        >
           Assign & Approve
        </button>

  <!-- DECLINE -->
      <button
        @click="declineRescuer"
        class="bg-red-500 text-white px-4 py-2 rounded-lg"
      >
        Decline
      </button>

    </div>

  </div>
</template>

<script> 

export default {
  props: {
    userId: Number
  },

  data() {
    return {
      user: {
        rescuer: {},
        role: {}
      },
      roles: [],
      selectedRoleId: ''
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
    this.fetchUser()
  },

  methods: {

    // FETCH USER + ROLES
    fetchUser() {
      axios.get(`/api/rescuers-pending/${this.userId}/manage`)
        .then(res => {
          this.user = res.data.user
          this.roles = res.data.roles
          this.selectedRoleId = res.data.user.role_id || ''
        })
        .catch(() => {
          Swal.fire('Error', 'Failed to load data', 'error')
        })
    },

    // 🚀 APPROVE + ASSIGN ROLE (COMBINED)
   approveRescuer() {

  if (!this.selectedRoleId) {
    Swal.fire('Error', 'Please select a role', 'error')
    return
  }

  Swal.fire({
    title: 'Approve User?',
    text: 'This will assign role and approve user',
    icon: 'question',
    showCancelButton: true
  }).then(result => {

    if (!result.isConfirmed) return

    axios.patch(`/api/rescuers/${this.userId}/approve`, {
      role_id: this.selectedRoleId
    })
    .then(res => {

      Swal.fire({
        icon: 'success',
        title: 'User approved successfully',
        showConfirmButton: false,
        timer: 1200
      })

      // 🚀 REDIRECT (NO VUE ROUTER)
      setTimeout(() => {
        window.location.href = '/rescuers-pending'
      }, 1200)

    })
    .catch(() => {
      Swal.fire('Error', 'Failed to approve user', 'error')
    })

  })
},

    // DECLINE
    declineRescuer() {

      Swal.fire({
        title: 'Decline user?',
        icon: 'warning',
        showCancelButton: true
      }).then(result => {

        if (!result.isConfirmed) return

        axios.patch(`/api/rescuers/${this.userId}/decline`)
          .then(() => {
            Swal.fire('Declined', '', 'success')
            setTimeout(() => location.href = '/rescuers-pending', 1000)
          })

      })
    }

  }
}
</script>