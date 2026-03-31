<template>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- FORM -->
    <div class="lg:col-span-1 bg-white shadow-lg rounded-xl p-6">
      <h2 class="text-lg font-bold text-gray-800 mb-4">
        Add Evacuation Point
      </h2>

      <form @submit.prevent="storeEvacuationPoint" class="space-y-4">

        <!-- NAME -->
        <div>
          <label class="text-sm text-gray-600">Name</label>
          <input v-model="form.name" :class="['input', errors.name ? 'border-red-500' : '']" />
        </div>

        <!-- LAT -->
        <div>
          <label class="text-sm text-gray-600">Latitude</label>
          <input v-model="form.latitude" readonly :class="['input', errors.location ? 'border-red-500' : '']" />
        </div>

        <!-- LNG -->
        <div>
          <label class="text-sm text-gray-600">Longitude</label>
          <input v-model="form.longitude" readonly :class="['input', errors.location ? 'border-red-500' : '']" />
        </div>

        <!-- STATUS -->
        <div>
          <label class="text-sm text-gray-600">Status</label>
          <select v-model="form.status" :class="['input', errors.status ? 'border-red-500' : '']">
            <option value="" disabled>Select Status</option>
            <option value="Safe">Safe</option>
            <option value="Semi-Crowded">Semi-Crowded</option>
            <option value="Crowded">Crowded</option>
            <option value="Danger">Danger</option>
          </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
          Submit
        </button>

      </form>
    </div>

    <!-- MAP -->
    <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-4">
      <div id="map" class="w-full h-[500px] rounded-lg"></div>
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

    // 🔥 GLOBAL DELETE FUNCTION
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
      script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCQlbzQG6vym_ncbxLe3iGGaZShdAvs-Js";
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

        const content = `
          <div style="min-width:150px">
            <strong>${point.name}</strong><br/>
            Status: ${point.status}<br/><br/>
            <button 
              onclick="window.deleteEvacuationPoint(${point.id})"
              style="background:red;color:white;padding:5px 10px;border:none;border-radius:5px;cursor:pointer;"
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