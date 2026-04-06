<template>
  <!-- GRID WRAPPER -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- EDIT ADMIN FORM -->
    <div class="lg:col-span-12 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
      <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Edit Admin</h2>

      <form @submit.prevent="updateUser" class="space-y-4">

        <!-- NAME -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Name</label>
          <input 
            v-model="form.name"
            type="text"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
            placeholder="Enter name"
          />
        </div>

        <!-- ADDRESS -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Address</label>
          <input 
            v-model="form.address"
            type="text"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
            placeholder="Enter address"
          />
        </div>

        <!-- MOBILE -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Contact No.</label>
          <input 
            v-model="form.mobile"
            type="text"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
            placeholder="Enter mobile"
          />
        </div>

        <!-- BIRTHDATE -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Birthdate</label>
          <input 
            v-model="form.birthdate"
            type="date"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
          />
        </div>

        <!-- EMAIL -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Email</label>
          <input 
            v-model="form.email"
            type="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
            placeholder="Enter email"
          />
        </div>

        <!-- PASSWORD -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Password</label>
          <input 
            v-model="form.password"
            type="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400"
            placeholder="Enter password"
          />
        </div>

        <!-- SUBMIT BUTTON -->
        <button
          type="submit"
          class="w-full bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white py-2 rounded-lg transition-colors"
        >
          Update
        </button>

      </form>
    </div>

  </div>
</template>

<script> 

export default {
  props: {
    userId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      form: {
        name: '',
        mobile: '',
        address: '',
        birthdate: '',
        email: '',
        password: ''
      }
    }
  },
  watch: {
    userId: {
      immediate: true,
      handler(newId) {
        this.fetchUser(newId);
      }
    }
  },
  methods: {
    fetchUser(id) {
      // Reset form bago mag-load ng bagong user
      this.form = {
        name: '',
        mobile: '',
        address: '',
        birthdate: '',
        email: '',
        password: ''
      };

      axios.get(`/api/users/${id}/edit`)
        .then(response => {
          this.form = {
            name: response.data.name,
            mobile: response.data.mobile,
            address: response.data.address,
            birthdate: response.data.birthdate,
            email: response.data.email,
            password: '' // password hindi nilalagay
          };
        })
        .catch(error => {
          console.error('Error fetching user:', error);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Failed to load user data!'
          });
        });
    },
    updateUser() {
      // Optional confirmation before submitting
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to update this user.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.patch(`/api/users/${this.userId}`, this.form)
            .then(response => {
              Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: response.data.message,
                showConfirmButton: false,
                timer: 2000
              }).then(() => {
                // Redirect to /users route (make sure route exists)
				window.location.href = '/users';
              });
            })
            .catch(error => {
              console.error('Error updating user:', error);
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to update user!'
              });
            });
        }
      });
    }
  }
}
</script>