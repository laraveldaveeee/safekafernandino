<template>
  <div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">

        <!-- HEADER -->
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="incident in incidents" :key="incident.id">

            <td class="px-6 py-4 text-sm">{{ incident.id }}</td>
            <td class="px-6 py-4 text-sm">{{ incident.type }}</td>
            <td class="px-6 py-4 text-sm">{{ incident.locations }}</td>
            <td class="px-6 py-4 text-sm">{{ incident.contact }}</td>
            <td class="px-6 py-4 text-sm">{{ incident.status }}</td>

            <td class="px-6 py-4 text-sm space-x-2">

              <!-- PHOTO -->
              <button
                @click="openModal(incident, 'photo')"
                class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100"
              >
                Photo
              </button>

              <!-- MEDIA -->
              <button
                @click="openModal(incident, 'media')"
                class="px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100"
              >
                Media
              </button>

              <!-- DISPATCH -->
              <button
                @click="dispatchIncident(incident.id)"
                class="px-3 py-1.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100"
              >
                Dispatch
              </button>

            </td>

          </tr>
        </tbody>

      </table>
    </div>

    <!--  MODAL -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">

      <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-4 relative">

        <!-- CLOSE -->
        <button
          @click="closeModal"
          class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
        >
          ✕
        </button>

        <!-- TITLE -->
        <h2 class="text-lg font-bold mb-4">
          {{ modalType === 'photo' ? 'Photo View' : 'Media View' }}
        </h2>

        <!-- IMAGE -->
        <div v-if="modalType === 'photo'">
          <img
            v-if="selectedIncident.photo_url"
            :src="selectedIncident.photo_url"
            class="w-full rounded-lg"
          />
          <p v-else class="text-gray-500">No photo available</p>
        </div>

        <!-- VIDEO -->
        <div v-if="modalType === 'media'">
          <video v-if="selectedIncident.media_url" controls class="w-full rounded-lg">
            <source :src="selectedIncident.media_url" type="video/mp4" />
          </video>
          <p v-else class="text-gray-500">No media available</p>
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