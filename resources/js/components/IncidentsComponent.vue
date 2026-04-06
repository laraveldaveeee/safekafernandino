<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- LEFT SIDE -->
    <div class="w-1/3 border-r dark:border-gray-700 flex flex-col">

      <div class="p-4 bg-white dark:bg-gray-800 shadow">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
          Incident Dashboard
        </h2>
      </div>

      <div class="flex-1 overflow-y-auto">
        <div
          v-for="incident in incidents"
          :key="incident.id"
          @click="selectIncident(incident)"
          :class="[
            'p-4 border-b cursor-pointer transition',
            selectedIncident?.id === incident.id
              ? 'bg-blue-100 dark:bg-blue-900'
              : 'hover:bg-gray-100 dark:hover:bg-gray-800'
          ]"
        >
          <div class="flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 dark:text-white">
              {{ incident.type }}
            </h3>
            <span :class="statusClass(incident.status)">
              {{ incident.status }}
            </span>
          </div>

          <p class="text-sm text-gray-500 mt-1">
            {{ incident.locations }}
          </p>

          <button
            @click.stop="openModal(incident, 'photo')"
            class="px-2 py-1 text-xs bg-blue-50 text-blue-700 rounded"
          >
            Photo
          </button>

          <button
            @click.stop="openModal(incident, 'media')"
            class="px-2 py-1 text-xs bg-purple-50 text-purple-700 rounded"
          >
            Media
          </button>
        </div>
      </div>
    </div>

    <!-- MAP SIDE -->
    <div class="w-2/3 relative">
      <div id="map" class="w-full h-full"></div>

      <!-- INFO CARD -->
      <div v-if="selectedIncident"
        class="absolute top-10 left-5 bg-white p-4 rounded shadow w-80">

        <h3 class="font-bold">{{ selectedIncident.type }}</h3>
        <p><strong>Name:</strong> {{ selectedIncident.name || 'N/A' }}</p>
        <p><strong>Child:</strong> {{ selectedIncident.child || 'N/A' }}</p>
        <p><strong>Guardian:</strong> {{ formatGuardian(selectedIncident.guardian) }}</p>
        <p><strong>Contact:</strong> {{ selectedIncident.contact || 'N/A' }}</p>
        <p><strong>Location:</strong> {{ selectedIncident.locations }}</p>

        <button
          v-if="selectedIncident.status === 'pending'"
          @click="openAssignModal(selectedIncident)"
          class="w-full mt-3 bg-green-600 text-white py-2 rounded"
        >
          Dispatch Now
        </button>

        <button v-else disabled
          class="w-full mt-3 bg-gray-400 text-white py-2 rounded">
          Already Dispatched
        </button>

      </div>
    </div>

    <!-- MEDIA MODAL -->
    <div v-if="showModal"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">

      <div class="bg-white rounded-xl w-full max-w-3xl p-4 relative">

        <button @click="closeModal"
          class="absolute top-2 right-2 text-xl">✕</button>

        <h2 class="text-lg font-bold mb-4">
          {{ modalType === 'photo' ? 'Photo View' : 'Media View' }}
        </h2>

        <div v-if="modalType === 'photo'">
          <img v-if="selectedIncident.photo_url"
            :src="selectedIncident.photo_url"
            class="w-full rounded" />
        </div>

        <div v-if="modalType === 'media'">
          <video v-if="selectedIncident.media_url" controls class="w-full">
            <source :src="selectedIncident.media_url" />
          </video>
        </div>

      </div>
    </div>

    <!-- ASSIGN MODAL -->
    <div v-if="showAssignModal"
      class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center">

      <div class="bg-white rounded-xl p-5 w-full max-w-md">

        <h2 class="text-lg font-bold mb-3">Assign Rescuers</h2>

        <p class="text-sm text-gray-500 mb-2">
          {{ selectedIncident.type }} rescuers only
        </p>

        <!-- NEAREST -->
        <div v-if="nearestRescuer" class="text-green-600 text-sm mb-2">
          🚑 Nearest: {{ nearestRescuer.name }}
        </div>

        <!-- MULTI SELECT -->
       <div class="space-y-2 max-h-60 overflow-y-auto">

  <div
    v-for="r in filteredRescuers"
    :key="r.id"
    class="flex items-center gap-2 p-2 border rounded hover:bg-gray-50"
  >
    <input
      type="checkbox"
      :value="r.id"
      v-model="selectedRescuerId"
      class="w-4 h-4"
    />

    <div>
      <p class="font-semibold">{{ r.name }}</p>
      <p class="text-xs text-gray-500">
        {{ r.emergency?.name }}
      </p>
    </div>

  </div>

</div>

        <button
          @click="confirmDispatch"
          class="w-full bg-green-600 text-white py-2 rounded"
        >
          Confirm Dispatch
        </button>

        <button
          @click="showAssignModal = false"
          class="w-full mt-2 text-gray-500"
        >
          Cancel
        </button>

      </div>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      incidents: [],
      selectedIncident: null,
      rescuers: [],
      showModal: false,
      modalType: null,

      showAssignModal: false,
      selectedRescuerId: [],  
      dispatchingIncidentId: null,
      nearestRescuer: null,

      map: null,
      markers: []
    }
  },

  mounted() {
    this.fetchIncidents()
    this.fetchRescuers()
    this.loadMap()
  },

  computed: {
    filteredRescuers() {
      if (!this.selectedIncident) return []

      const type = this.selectedIncident.type?.toLowerCase()

      return this.rescuers.filter(r =>
        r.emergency?.name?.toLowerCase() === type
      )
    }
  },

  watch: {
    selectedIncident() {
      this.selectedRescuerId = []
      this.nearestRescuer = null
    }
  },

  methods: {

    fetchIncidents() {
      axios.get('/api/incidents')
        .then(res => this.incidents = res.data)
    },

    fetchRescuers() {
      axios.get('/api/rescuers')
        .then(res => this.rescuers = res.data)
    },

    formatGuardian(g) {
      if (!g) return 'N/A'
      try {
        return typeof g === 'object'
          ? g.name
          : JSON.parse(g).name
      } catch {
        return g
      }
    },

    openModal(incident, type) {
      this.selectedIncident = incident
      this.modalType = type
      this.showModal = true
    },

    closeModal() {
      this.showModal = false
    },

    selectIncident(incident) {
      this.selectedIncident = incident
    },

    openAssignModal(incident) {
      this.selectedIncident = incident
      this.dispatchingIncidentId = incident.id
      this.selectedRescuerId = []
      this.showAssignModal = true
      this.findNearestRescuer()
    },

    findNearestRescuer() {
      const valid = this.filteredRescuers.filter(r =>
        r.latitude && r.longitude
      )

      if (!valid.length) return

      this.nearestRescuer = valid[0]
      this.selectedRescuerId = [valid[0].id]
    },

    confirmDispatch() {
      if (!this.selectedRescuerId.length) return alert("Select rescuer")

      axios.post(`/api/incidents/${this.dispatchingIncidentId}/dispatch`, {
        rescuer_ids: this.selectedRescuerId
      })
      .then(() => {

        const inc = this.incidents.find(i =>
          i.id === this.dispatchingIncidentId
        )

        if (inc) inc.status = 'dispatched'

        this.showAssignModal = false
      })
    },

    loadMap() {
      if (window.google) return this.initMap()

      const script = document.createElement("script")
      script.src = "https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"
      script.onload = this.initMap
      document.head.appendChild(script)
    },

    initMap() {
      this.map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 15, lng: 121 },
        zoom: 10
      })
    },

    statusClass(status) {
      if (status === 'pending') return 'text-yellow-600'
      if (status === 'dispatched') return 'text-blue-600'
      return 'text-green-600'
    }
  }
}
</script>