<template>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300 p-6">

    <!-- FORM PANEL -->
    <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 transition-colors duration-300">
      <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Add Admin</h2>

      <form @submit.prevent="storeUser" class="space-y-4">
        <!-- NAME -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Name</label>
          <input v-model="form.name" type="text"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            placeholder="Enter name"
          />
        </div>

        <!-- ADDRESS -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Address</label>
          <input v-model="form.address" type="text"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            placeholder="Enter address"
          />
        </div>

        <!-- MOBILE -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Contact No.</label>
          <input v-model="form.mobile" type="text"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            placeholder="Enter mobile"
          />
        </div>

        <!-- BIRTHDATE -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Birthdate</label>
          <input v-model="form.birthdate" type="date"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
          />
        </div>

        <!-- EMAIL -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Email</label>
          <input v-model="form.email" type="email"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            placeholder="Enter email"
          />
        </div>

        <!-- PASSWORD -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-300">Password</label>
          <input v-model="form.password" type="password"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            placeholder="Enter password"
          />
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 py-2 rounded-lg transition-colors duration-300">
          Submit
        </button>
      </form>
    </div>

    <!-- TABLE PANEL -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transition-colors duration-300">

      <!-- HEADER -->
      <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Administrator Management</h3>
        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">Manage all registered admins</p>
      </div>

      <!-- TABLE -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 transition-colors duration-300">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
              <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ user.id }}</td>
              <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ user.name }}</td>
              <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ user.email }}</td>
              <td class="px-6 py-4 text-right">
                <div class="flex gap-2 justify-end">
                  <a :href="'/users/' + user.id + '/edit'"
                    class="px-3 py-1.5 bg-green-50 dark:bg-green-600 text-green-700 dark:text-green-100 rounded-lg hover:bg-green-100 dark:hover:bg-green-500 transition-colors duration-300">
                    Edit
                  </a>
                  <button @click="deleteUser(user.id)"
                    class="px-3 py-1.5 bg-red-50 dark:bg-red-600 text-red-700 dark:text-red-100 rounded-lg hover:bg-red-100 dark:hover:bg-red-500 transition-colors duration-300">
                    Delete
                  </button>
                </div>
              </td>
            </tr>

            <!-- Empty state -->
            <tr v-if="users.length === 0">
              <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-300">
                No users found
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- FOOTER -->
      <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-3 flex justify-between items-center">
        <span class="text-sm text-gray-700 dark:text-gray-300">{{ users.length }} total users</span>
        <div class="flex gap-2">
          <button class="px-3 py-1.5 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">Previous</button>
          <button class="px-3 py-1.5 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">Next</button>
        </div>
      </div>

    </div>
  </div>
</template>
<script> 
export default {
  data() {
    return {
      users: [],
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
  mounted() {
    this.fetchUsers()
  },
  methods: {
    // GET USERS
    fetchUsers() {
      axios.get('/api/users')
        .then(res => {
          this.users = res.data
        })
        .catch(err => {
          console.log(err)
        })
    },

    // STORE USER
    storeUser() {
      axios.post('/api/users', this.form)
        .then(res => {

          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'User created successfully',
            timer: 1500,
            showConfirmButton: false
          })

          // reset form
          this.form.name = ''
          this.form.address = ''
          this.form.mobile = ''
          this.form.birthdate = ''
          this.form.email = ''
          this.form.password = ''

          // reload table
          this.fetchUsers()

        })
        .catch(err => {

          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to create user'
          })

          console.log(err)

        })
    },

     // DELETE USER
    deleteUser(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This user will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {

        if (result.isConfirmed) {
          axios.delete('/api/users/' + id)
            .then(() => {
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'User has been deleted.',
                timer: 1500,
                showConfirmButton: false
              })

              this.fetchUsers()

            })
            .catch(() => {
              Swal.fire('Error', 'Delete failed', 'error')
            })
        }
      })
    }
  }
}
</script>