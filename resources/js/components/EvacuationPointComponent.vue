<template>
  <div class="p-6 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <!-- TOP PANELS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

      <!-- LEGEND -->
      <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
          Legend & Status
        </h2>

        <div class="space-y-2 text-sm">
          <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-green-500"></span>
            <span>Safe</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
            <span>Semi-Crowded</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-orange-500"></span>
            <span>Crowded</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-red-500"></span>
            <span>Danger</span>
          </div>
        </div>
      </div>

      <!-- NOTES -->
      <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-xl p-4 shadow-sm">
        <h2 class="text-sm font-semibold text-blue-700 dark:text-blue-300 mb-2">
          ⚠️ Important Notes
        </h2>

        <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-2">
          <li>• Double-click the map to fill coordinates.</li>
          <li>• Verify safety status before saving.</li>
          <li>• Keep data updated.</li>
        </ul>
      </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">

      <!-- FORM -->
      <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 h-full flex flex-col">

        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
          Add Evacuation Point
        </h2>

        <form @submit.prevent="storeEvacuationPoint" class="space-y-4 flex flex-col h-full">

          <!-- NAME -->
          <div>
            <label class="text-sm text-gray-600 dark:text-gray-300">Name</label>
            <input v-model="form.name"
              :class="['w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100', errors.name ? 'border-red-500' : '']"
              placeholder="Enter name"
            />
          </div>

          <!-- LAT -->
          <div>
            <label class="text-sm text-gray-600 dark:text-gray-300">Latitude</label>
            <input v-model="form.latitude" readonly
              class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            />
          </div>

          <!-- LNG -->
          <div>
            <label class="text-sm text-gray-600 dark:text-gray-300">Longitude</label>
            <input v-model="form.longitude" readonly
              class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            />
          </div>

          <!-- STATUS -->
          <div>
            <label class="text-sm text-gray-600 dark:text-gray-300">Status</label>
            <select v-model="form.status"
              :class="['w-full mt-1 px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100', errors.status ? 'border-red-500' : '']">
              <option value="" disabled>Select Status</option>
              <option value="Safe">Safe</option>
              <option value="Semi-Crowded">Semi-Crowded</option>
              <option value="Crowded">Crowded</option>
              <option value="Danger">Danger</option>
            </select>
          </div>

          <!-- BUTTON -->
          <button type="submit"
            class="mt-auto w-full bg-blue-600 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 py-2 rounded-lg transition">
            Submit
          </button>

        </form>
      </div>

      <!-- MAP -->
      <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-4 h-full flex flex-col">
        <div id="map" class="w-full flex-1 min-h-[450px] rounded-lg"></div>
      </div>

    </div>

  </div>
</template>


<script>
export default {
  data() {
    return {
      map: null,
      markers: [],
      evacuationPoints: [],
      tempMarker: null,

      errors: {
        name: false,
        location: false,
        status: false
      },

      form: {
        name: '',
        latitude: '',
        longitude: '',
        status: ''
      }
    };
  },

  mounted() {
    this.loadGoogleMaps();

    //  GLOBAL DELETE FUNCTION
    window.deleteEvacuationPoint = (id) => {
      this.deleteEvacuationPoint(id);
    };
  },

  methods: {

    loadGoogleMaps() {
      if (window.google && window.google.maps) {
        this.fetchEvacuationPoints();
        return;
      }

      const script = document.createElement("script");
      script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCGVyoXkw7WNkHwmU9WytzLRNV45OLkknA";
      script.async = true;

      script.onload = () => {
        this.fetchEvacuationPoints();
      };

      document.head.appendChild(script);
    },

    initMap() {
      const geocoder = new google.maps.Geocoder();

      this.map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 15.144, lng: 120.588 },
        zoom: 13
      });

      this.map.addListener("dblclick", (e) => {
        const latlng = {
          lat: e.latLng.lat(),
          lng: e.latLng.lng()
        };

        this.form.latitude = latlng.lat;
        this.form.longitude = latlng.lng;

        geocoder.geocode({ location: latlng }, (results, status) => {
          this.form.name = (status === "OK" && results[0])
            ? results[0].formatted_address
            : "Unknown Location";
        });

        this.placeTempMarker(latlng);
      });

      this.renderMarkers();
    },

    placeTempMarker(latlng) {
      if (this.tempMarker) this.tempMarker.setMap(null);

      this.tempMarker = new google.maps.Marker({
        position: latlng,
        map: this.map,
        draggable: true
      });

      this.tempMarker.addListener("dragend", (e) => {
        this.form.latitude = e.latLng.lat();
        this.form.longitude = e.latLng.lng();
      });
    },

    getIcon(status) {
      const colors = {
        Safe: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
        "Semi-Crowded": "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
        Crowded: "http://maps.google.com/mapfiles/ms/icons/orange-dot.png",
        Danger: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
      };
      return colors[status] || colors.Safe;
    },

    renderMarkers() {
      this.markers.forEach(m => m.setMap(null));
      this.markers = [];

      this.evacuationPoints.forEach(point => {

        const marker = new google.maps.Marker({
          position: {
            lat: parseFloat(point.latitude),
            lng: parseFloat(point.longitude)
          },
          map: this.map,
          title: point.name,
          icon: this.getIcon(point.status)
        });
        const isDark = document.documentElement.classList.contains('dark');
        const content = `
          <div style="
            min-width:160px;
            padding:10px;
            border-radius:10px;
            font-size:13px;
            background:${isDark ? '#1f2937' : '#ffffff'};
            color:${isDark ? '#f9fafb' : '#111827'};
          ">
            <div style="font-weight:bold; margin-bottom:4px;">
              ${point.name}
            </div>

            <div style="margin-bottom:8px;">
              Status: <span style="font-weight:500;">${point.status}</span>
            </div>

            <button 
              onclick="window.deleteEvacuationPoint(${point.id})"
              style="
                background:#ef4444;
                color:white;
                padding:6px 10px;
                border:none;
                border-radius:6px;
                cursor:pointer;
              "
            >
              Delete
            </button>
          </div>
        `;

        const infoWindow = new google.maps.InfoWindow({
          content: content
        });

        marker.addListener("click", () => {
          infoWindow.open(this.map, marker);
        });

        this.markers.push(marker);
      });
    },

    fetchEvacuationPoints() {
      axios.get("/api/evacuation-points").then(res => {
        this.evacuationPoints = res.data;

        this.$nextTick(() => {
          if (!this.map) this.initMap();
          else this.renderMarkers();
        });
      });
    },

    storeEvacuationPoint() {

      this.errors = { name: false, location: false, status: false };

      let hasError = false;

      if (!this.form.name) this.errors.name = hasError = true;
      if (!this.form.latitude || !this.form.longitude) this.errors.location = hasError = true;
      if (!this.form.status) this.errors.status = hasError = true;

      if (hasError) {
        window.Swal.fire("Error", "Complete all fields", "error");
        return;
      }

      window.Swal.fire({
        title: "Save this point?",
        icon: "question",
        showCancelButton: true
      }).then((result) => {

        if (result.isConfirmed) {
          axios.post("/api/evacuation-points", this.form)
            .then(() => {

              window.Swal.fire("Saved!", "", "success");

              this.form = { name: '', latitude: '', longitude: '', status: '' };

              if (this.tempMarker) this.tempMarker.setMap(null);

              this.fetchEvacuationPoints();
            });
        }
      });
    },

    // 🔥 DELETE METHOD
    deleteEvacuationPoint(id) {
      window.Swal.fire({
        title: "Delete this point?",
        icon: "warning",
        showCancelButton: true
      }).then((result) => {

        if (result.isConfirmed) {
          axios.delete(`/api/evacuation-points/${id}`)
            .then(() => {

              window.Swal.fire("Deleted!", "", "success");

              this.fetchEvacuationPoints();
            });
        }
      });
    }

  }
};
</script>

<style>
.input {
  width: 100%;
  margin-top: 6px;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.input:focus {
  outline: none;
  border-color: #3b82f6;
}
</style>