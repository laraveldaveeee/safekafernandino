<template>
  <div class="p-6 bg-white rounded shadow-md max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Emergency Form</h2>

    <form @submit.prevent="submitForm">

      <!-- NAME -->
      <div class="mb-3">
        <label>Name</label>
        <input v-model="form.name" type="text" class="input" required />
      </div>

      <!-- EMAIL -->
      <div class="mb-3">
        <label>Email</label>
        <input v-model="form.email" type="email" class="input" required />
      </div>

      <!-- PASSWORD -->
      <div class="mb-3">
        <label>Password</label>
        <input v-model="form.password" type="password" class="input" required />
      </div>

      <!-- EMERGENCY TYPE -->
      <div class="mb-3">
        <label>Emergency Type</label>
        <select v-model="form.type" class="input" required>
          <option value="">Select Emergency</option>
          <option 
            v-for="item in emergencyTypes" 
            :key="item.id" 
            :value="item.id"
          >
            {{ item.name }}
          </option>
        </select>
      </div>

      <!-- GENDER -->
      <div class="mb-3">
        <label>Gender</label>
        <select v-model="form.gender" class="input">
          <option value="">Select</option>
          <option>Male</option>
          <option>Female</option>
        </select>
      </div>

      <!-- MOBILE -->
      <div class="mb-3">
        <label>Mobile</label>
        <input v-model="form.mobile" type="text" class="input" />
      </div>

      <!-- BIRTHDATE -->
      <div class="mb-3">
        <label>Birthdate</label>
        <input v-model="form.birthdate" type="date" class="input" />
      </div>

      <!-- GET LOCATION -->
      <div class="mb-3">
        <button type="button" @click="getLocation" class="bg-green-500 text-white px-3 py-2 rounded">
          Get My Location
        </button>
      </div>

      <!-- LAT -->
      <div class="mb-3">
        <label>Latitude</label>
        <input v-model="form.latitude" type="text" class="input" readonly />
      </div>

      <!-- LNG -->
      <div class="mb-3">
        <label>Longitude</label>
        <input v-model="form.longitude" type="text" class="input" readonly />
      </div>

      <!-- LOCATION -->
      <div class="mb-3">
        <label>Station Location</label>
        <input v-model="form.station_location" type="text" class="input" />
      </div>

      <!-- CONTACT -->
      <div class="mb-3">
        <label>Contact</label>
        <input v-model="form.contact" type="text" class="input" />
      </div>

      <!-- FILE -->
      <div class="mb-3">
        <label>ID Verification</label>
        <input type="file" @change="handleFileUpload" />
      </div>

      <!-- SUBMIT -->
      <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">
        Submit
      </button>

    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        type: "",
        gender: "",
        mobile: "",
        birthdate: "",
        station_location: "",
        latitude: "",
        longitude: "",
        contact: "",
        is_id_verified: null,
      },
      emergencyTypes: []
    };
  },

  mounted() {
    this.getEmergencyTypes();
  },

  methods: {
    // FETCH TYPES SELECT
    async getEmergencyTypes() {
      try {
        let res = await axios.get("/api/emergency-types");
        this.emergencyTypes = res.data;
      } catch (error) {
        console.error(error);
      }
    },

    // LOCATION
    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            this.form.latitude = position.coords.latitude;
            this.form.longitude = position.coords.longitude;
          },
          (error) => {
            if (error.code === 1) {
              alert("Permission denied. Please allow location.");
            } else {
              alert("Location error");
            }
          }
        );
      } else {
        alert("Geolocation not supported");
      }
    },

    //  FILE
    handleFileUpload(event) {
      this.form.is_id_verified = event.target.files[0];
    },

    // SUBMIT
    async submitForm() {
      try {
        let formData = new FormData();

        for (let key in this.form) {
          formData.append(key, this.form[key]);
        }

        let res = await axios.post("/api/rescuer/signup", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        });

        alert("Success!");
        console.log(res.data);

      } catch (error) {
        console.error(error);
        alert("Error submitting form");
      }
    }
  }
};
</script>

<style>
.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
</style>