<template>
  <form @submit.prevent="submitForm" class="space-y-4">
    
    <!-- Name -->
    <div>
      <label class="block text-sm font-medium">Name</label>
      <input v-model="form.name" type="text"
        class="w-full mt-1 p-3 border rounded-xl" required>
    </div>

    <!-- Email -->
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input v-model="form.email" type="email"
        class="w-full mt-1 p-3 border rounded-xl" required>
    </div>

    <!-- Password -->
    <div>
      <label class="block text-sm font-medium">Password</label>
      <input v-model="form.password" type="password"
        class="w-full mt-1 p-3 border rounded-xl" required>
    </div>

    <!-- Gender -->
    <div>
      <label class="block text-sm font-medium">Gender</label>
      <select v-model="form.gender" class="w-full mt-1 p-3 border rounded-xl">
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>

    <!-- Mobile -->
    <div>
      <label class="block text-sm font-medium">Mobile</label>
      <input v-model="form.mobile" type="text"
        class="w-full mt-1 p-3 border rounded-xl">
    </div>

    <!-- Birthdate -->
    <div>
      <label class="block text-sm font-medium">Birthdate</label>
      <input v-model="form.birthdate" type="date"
        class="w-full mt-1 p-3 border rounded-xl">
    </div>

    <!-- Address -->
    <div>
      <label class="block text-sm font-medium">Address</label>
      <textarea v-model="form.address"
        class="w-full mt-1 p-3 border rounded-xl"></textarea>
    </div>

    <!-- File Uploads -->
    <div>
      <label class="block text-sm font-medium">Upload Valid ID</label>
      <input type="file" @change="handleFile($event, 'is_id_verified')">
    </div>

    <div>
      <label class="block text-sm font-medium">Gesture Data</label>
      <input type="file" @change="handleFile($event, 'gesture_data')">
    </div>

    <div>
      <label class="block text-sm font-medium">Medical Info</label>
      <input type="file" @change="handleFile($event, 'medical_info')">
    </div>

    <!-- Submit -->
    <button type="submit"
      class="w-full bg-blue-600 text-white py-3 rounded-xl">
      {{ loading ? 'Submitting...' : 'Register' }}
    </button>

    <!-- Success -->
    <p v-if="success" class="text-green-600">✅ Registered successfully</p>

    <!-- Errors -->
    <div v-if="errors" class="text-red-500">
      <div v-for="(err, key) in errors" :key="key">
        {{ err[0] }}
      </div>
    </div>

  </form>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      success: false,
      errors: null,

      form: {
        name: '',
        email: '',
        password: '',
        gender: '',
        mobile: '',
        birthdate: '',
        address: '',

        is_id_verified: null,
        gesture_data: null,
        medical_info: null,
      }
    }
  },

  methods: {
    handleFile(e, field) {
      this.form[field] = e.target.files[0];
    },

    async submitForm() {
      this.loading = true;
      this.errors = null;
      this.success = false;

      let formData = new FormData();

      // append normal fields
      for (let key in this.form) {
        if (this.form[key] !== null) {
          formData.append(key, this.form[key]);
        }
      }

     try {
      let res = await axios.post('/api/citizen/signup', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      });

        this.success = true;
        console.log(res.data);

      } catch (err) {
        if (err.response && err.response.status === 422) {
          this.errors = err.response.data.errors;
        } else {
          console.error(err);
        }
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>