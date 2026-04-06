<template>
  <div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden transition-colors duration-300">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

        <!-- HEADER -->
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Location</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Contact</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="incident in incidents" :key="incident.id" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ incident.id }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ incident.type }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ incident.locations }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ incident.contact }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ incident.status }}</td>

            <td class="px-6 py-4 text-sm text-right space-x-2">

              <!-- PHOTO -->
              <button
                @click="openModal(incident, 'photo')"
                class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition"
              >
                Photo
              </button>

              <!-- MEDIA -->
              <button
                @click="openModal(incident, 'media')"
                class="px-3 py-1.5 bg-purple-50 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition"
              >
                Media
              </button>

              <!-- DISPATCH -->
              <button
                @click="dispatchIncident(incident.id)"
                class="px-3 py-1.5 bg-green-50 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-100 dark:hover:bg-green-800 transition"
              >
                Dispatch
              </button>

            </td>

          </tr>

          <!-- EMPTY STATE -->
          <tr v-if="incidents.length === 0">
            <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
              No incidents found
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <!-- MODAL -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">

      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-3xl p-4 relative transition-colors duration-300">

        <!-- CLOSE -->
        <button
          @click="closeModal"
          class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 text-xl"
        >
          ✕
        </button>

        <!-- TITLE -->
        <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">
          {{ modalType === 'photo' ? 'Photo View' : 'Media View' }}
        </h2>

        <!-- IMAGE -->
        <div v-if="modalType === 'photo'">
          <img
            v-if="selectedIncident.photo_url"
            :src="selectedIncident.photo_url"
            class="w-full rounded-lg"
          />
          <p v-else class="text-gray-500 dark:text-gray-400">No photo available</p>
        </div>

        <!-- VIDEO -->
        <div v-if="modalType === 'media'">
          <video v-if="selectedIncident.media_url" controls class="w-full rounded-lg">
            <source :src="selectedIncident.media_url" type="video/mp4" />
          </video>
          <p v-else class="text-gray-500 dark:text-gray-400">No media available</p>
        </div>

      </div>
    </div>

  </div>
</template>
<script>
export default {
  data() {
    return {
      incidents: [],

      //  MODAL STATE
      showModal: false,
      modalType: '',
      selectedIncident: {}
    }
  },

  mounted() {
    this.fetchIncidents()
  },

  methods: {

    // FETCH
    fetchIncidents() {
      axios.get('/api/incidents')
        .then(res => {
          this.incidents = res.data
        })
        .catch(err => {
          console.error(err)
        })
    },

    // OPEN MODAL
    openModal(incident, type) {
      this.selectedIncident = incident
      this.modalType = type
      this.showModal = true
    },

    // CLOSE MODAL
    closeModal() {
      this.showModal = false
      this.selectedIncident = {}
    },

    // DISPATCH
    dispatchIncident(id) {
      window.Swal.fire({
        title: 'Are you sure?',
        text: "Dispatch this incident?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, dispatch it!'
      }).then((result) => {

        if (result.isConfirmed) {
          axios.post(`/api/incidents/${id}/dispatch`)
            .then(() => {

              window.Swal.fire({
                icon: 'success',
                title: 'Dispatched!',
                timer: 1500,
                showConfirmButton: false
              })

              this.fetchIncidents()

            })
            .catch(() => {
              window.Swal.fire('Error!', 'Something went wrong.', 'error')
            })
        }

      })
    }

  }
}
</script>