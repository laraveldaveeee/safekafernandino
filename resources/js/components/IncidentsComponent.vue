<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- LEFT SIDE -->
    <div class="w-1/3 border-r dark:border-gray-700 flex flex-col">

      <!-- HEADER -->
      <div class="p-4 bg-white dark:bg-gray-800 shadow">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
           Incident Dashboard
        </h2>
      </div>

      <!-- LIST -->
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

            <span
              :class="statusClass(incident.status)"
              class="text-xs px-2 py-1 rounded-full font-semibold"
            >
              {{ incident.status }}
            </span>


          </div>


          <p class="text-sm text-gray-500 mt-1">
             {{ incident.locations }}
          </p>

             <!-- PHOTO -->
              <button
                @click.stop="openModal(incident, 'photo')"
                class="px-2 py-1 text-xs bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded hover:bg-blue-100 dark:hover:bg-blue-800 transition"
              >
                Photo
              </button>

              <!-- MEDIA -->
              <button
                @click.stop="openModal(incident, 'media')"
                class="px-2 py-1 text-xs bg-purple-50 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded hover:bg-purple-100 dark:hover:bg-purple-800 transition"
              >
                Media
              </button>



        </div>

        <div v-if="incidents.length === 0" class="p-6 text-center text-gray-400">
          No incidents found
        </div>

      </div>
    </div>

      <!-- ✅ MODAL HERE (IMPORTANT!) -->
  <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-3xl p-4 relative">

      <!-- CLOSE -->
      <button
        @click="closeModal"
        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
      >
        ✕
      </button>

      <!-- TITLE -->
      <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">
        {{ modalType === 'photo' ? 'Photo View' : 'Media View' }}
      </h2>

      <!-- PHOTO -->
      <div v-if="modalType === 'photo'">
        <img
          v-if="selectedIncident.photo_url"
          :src="selectedIncident.photo_url"
          class="w-full rounded-lg"
        />
        <p v-else>No photo available</p>
      </div>

      <!-- VIDEO -->
      <div v-if="modalType === 'media'">
        <video v-if="selectedIncident.media_url" controls class="w-full rounded-lg">
          <source :src="selectedIncident.media_url" type="video/mp4" />
        </video>
        <p v-else>No media available</p>
      </div>

    </div>

  </div>


    <!-- RIGHT SIDE MAP -->
    <div class="w-2/3 relative">

      <!-- MAP -->
      <div id="map" class="w-full h-full"></div>

      <!-- TOP-LEFT INFO CARD -->
      <!-- INFO CARD -->
<div
  v-if="selectedIncident"
  class="absolute top-12 left-5 bg-white/90 backdrop-blur dark:bg-gray-800/90 shadow-2xl rounded-xl p-4 w-80 space-y-3 border dark:border-gray-700"
>

  <!-- HEADER -->
  <div class="flex justify-between items-center">
    <h3 class="font-bold text-gray-800 dark:text-white">
       {{ selectedIncident.type }}
    </h3>

    <span
      :class="statusClass(selectedIncident.status)"
      class="text-xs font-semibold"
    >
      {{ selectedIncident.status }}
    </span>
  </div>

  <!-- DETAILS -->
  <div class="text-sm text-gray-600 dark:text-gray-300 space-y-1">

    <p><strong> Name:</strong> {{ selectedIncident.name || 'N/A' }}</p>

    <p><strong> Child:</strong> {{ selectedIncident.child || 'N/A' }}</p>

    <p><strong> Guardian:</strong>   {{ formatGuardian(selectedIncident.guardian) }}
</p>

    <p><strong> Contact:</strong> {{ selectedIncident.contact || 'N/A' }}</p>

    <p><strong>Location:</strong> {{ selectedIncident.locations }}</p>

  </div>

  <!-- DISPATCH -->
  <button
    v-if="selectedIncident.status === 'pending'"
    @click="dispatchIncident(selectedIncident.id)"
    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition"
  >
     Dispatch Now
  </button>

  <button
    v-else
    disabled
    class="w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed"
  >
    Already Dispatched
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

      // ✅ MODAL STATES (MISSING MO ITO)
      showModal: false,
      modalType: '',

      map: null,
      directionsService: null,
      directionsRenderer: null,
      userLocation: null,
      markers: []
    }
  },

  mounted() {
    this.fetchIncidents()
    this.loadGoogleMaps()
  },

  methods: {

    // FETCH INCIDENTS
    fetchIncidents() {
      axios.get('/api/incidents')
        .then(res => {
          this.incidents = res.data
        })
        .catch(err => console.error(err))
    },

    formatGuardian(g) {
      if (!g) return 'N/A'
      if (typeof g === 'object') return g.name || 'N/A'

      try {
        return JSON.parse(g).name || 'N/A'
      } catch {
        return g
      }
    },



    // LOAD MAP
    loadGoogleMaps() {
      if (window.google) return this.initMap()

      const script = document.createElement("script")
      script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyCGVyoXkw7WNkHwmU9WytzLRNV45OLkknA`
      script.async = true
      script.defer = true
      script.onload = this.initMap

      document.head.appendChild(script)
    },

    initMap() {
      this.map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 15.0, lng: 121.0 },
        zoom: 10
      })

      this.directionsService = new google.maps.DirectionsService()
      this.directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
      })

      this.directionsRenderer.setMap(this.map)

      navigator.geolocation.getCurrentPosition(pos => {
        this.userLocation = {
          lat: pos.coords.latitude,
          lng: pos.coords.longitude
        }

        new google.maps.Marker({
          position: this.userLocation,
          map: this.map,
          label: "You",
          icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        })

        this.map.setCenter(this.userLocation)
      })
    },

    // SELECT INCIDENT
    selectIncident(incident) {
      this.selectedIncident = incident

      const destination = {
        lat: parseFloat(incident.latitude),
        lng: parseFloat(incident.longitude)
      }

      this.clearMarkers()
      this.directionsRenderer.setDirections({ routes: [] })

      const marker = new google.maps.Marker({
        position: destination,
        map: this.map,
        title: incident.type,
        icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
      })

      this.markers.push(marker)

      this.map.panTo(destination)
      this.map.setZoom(16)

      if (this.userLocation) {
        this.drawRoute(this.userLocation, destination)
      }
    },

    drawRoute(origin, destination) {
      this.directionsService.route({
        origin,
        destination,
        travelMode: google.maps.TravelMode.DRIVING
      }, (result, status) => {
        if (status === "OK") {
          this.directionsRenderer.setDirections(result)
        }
      })
    },

    // 🚨 MODAL OPEN
    openModal(incident, type) {
      this.selectedIncident = incident
      this.modalType = type
      this.showModal = true
    },

    // 🚨 MODAL CLOSE
    closeModal() {
      this.showModal = false
    },

    // DISPATCH
    dispatchIncident(id) {
      window.Swal.fire({
        title: 'Dispatch this incident?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        confirmButtonText: 'Yes, Dispatch'
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

              this.selectedIncident.status = 'dispatched'

              const index = this.incidents.findIndex(i => i.id === id)
              if (index !== -1) {
                this.incidents[index].status = 'dispatched'
              }

            })
            .catch(() => {
              window.Swal.fire('Error', 'Failed to dispatch', 'error')
            })
        }
      })
    },

    clearMarkers() {
      this.markers.forEach(m => m.setMap(null))
      this.markers = []
    },

    statusClass(status) {
      if (status === 'pending') return 'text-yellow-600 font-semibold'
      if (status === 'dispatched') return 'text-blue-600 font-semibold'
      if (status === 'resolved') return 'text-green-600 font-semibold'
      return 'text-gray-600'
    }

  }
}
</script>