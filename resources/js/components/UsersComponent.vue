 <template>
      <!-- GRID WRAPPER (IMPORTANT FIX) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
       <div class="lg:col-span-1 bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-lg font-bold text-gray-800 mb-4">
          Add Admin
        </h2>
        <form @submit.prevent="storeUser" class="space-y-4">
          <!-- NAME -->
          <div>
            <label class="text-sm text-gray-600">Name</label>
            <input v-model="form.name"
              type="text"
              class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
              placeholder="Enter name"
            />
          </div>
          <!-- EMAIL -->
          <div>
            <label class="text-sm text-gray-600">Email</label>
            <input v-model="form.email"
              type="email"
              class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
              placeholder="Enter email"
            />
          </div>

          <!-- PASSWORD -->
          <div>
            <label class="text-sm text-gray-600">Password</label>
            <input v-model="form.password"
              type="password"
              class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
              placeholder="Enter password"
            />
          </div>

          <!-- BUTTON -->
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
          >
            Submit
          </button>

        </form>

      </div>

 <div class="lg:col-span-2 bg-white shadow-lg rounded-xl overflow-hidden">

    <!-- PANEL TITLE / HEADER -->
    <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <!-- Panel Title Icon -->
          <div class="p-2 bg-blue-100 rounded-lg">
            <svg class="size-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Administrator Management</h3>
            <p class="text-sm text-gray-500 mt-0.5">Manage and view all registered admins in the system</p>
          </div>
        </div>

      </div>
    </div>
    
     

    <!-- PANEL BODY -->
  <div class="lg:col-span-2 bg-white shadow-lg rounded-xl overflow-hidden">

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- TABLE HEADER -->
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
                ID
              </div>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Name
              </div>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Email
              </div>
            </th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
              <div class="flex items-center justify-end gap-2">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Actions
              </div>
            </th>
          </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-8 w-8">
                  <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center">
                    <span class="text-xs font-medium text-white">{{ user.id }}</span>
                  </div>
                </div>
              
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
              
                <div class="ml-3">
                  <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center gap-2">
                <svg class="size-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-sm text-gray-900">{{ user.email }}</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex justify-end gap-2">
                <a 
                  :href="'/users/' + user.id" 
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-all duration-200 group"
                >
                  <svg class="size-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  <span class="text-sm">View</span>
                </a>
                
                <!-- Optional: Edit Button -->
                <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-all duration-200 group">
                  <svg class="size-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  <span class="text-sm">Edit</span>
                </button>
                
                <!-- Optional: Delete Button -->
                <button
                  @click="deleteUser(user.id)"
                  class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                >
                  Delete
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Empty State (Optional) -->
          <tr v-if="users.length === 0">
            <td colspan="4" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center justify-center">
                <svg class="size-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <p class="text-gray-500 text-sm">No users found</p>
                <button class="mt-3 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-medium">
                  <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Add your first user
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    
    <!-- PANEL FOOTER (Optional) -->
    <div class="border-t border-gray-200 bg-gray-50 px-6 py-3">
      <div class="flex items-center justify-between">
        <div class="text-sm text-gray-700">
          <span class="font-medium">{{ users.length }}</span> total users found
        </div>
        <div class="flex gap-2">
          <button class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Previous
          </button>
          <button class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            Next
            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
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