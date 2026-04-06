<template>
  <!-- GRID WRAPPER -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ADD EMERGENCY TYPE FORM -->
    <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 transition-colors duration-300">

      <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
        Add Emergency Type
      </h2>

      <form @submit.prevent="storeEmergency" class="space-y-4">

        <!-- NAME -->
        <div>
          <label class="text-sm text-gray-600 dark:text-gray-400">Name</label>
          <input v-model="form.name"
            type="text"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100"
            placeholder="Enter name"
          />
        </div>

        <!-- BUTTON -->
        <button
          type="submit"
          class="w-full bg-blue-600 dark:bg-blue-700 text-white py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition"
        >
          Submit
        </button>

      </form>
    </div>

    <!-- EMERGENCY TYPES TABLE -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transition-colors duration-300">

      <!-- PANEL HEADER -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 px-6 py-4">
        <div class="flex items-center space-x-3">
          <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
            <svg class="size-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Emergency Type</h3>
        </div>
      </div>

      <!-- TABLE -->
      <div class="bg-white dark:bg-gray-800 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

          <!-- HEADER -->
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase w-16">
                ID
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                Name
              </th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase w-40">
                Actions
              </th>
            </tr>
          </thead>

          <!-- BODY -->
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

            <tr v-for="emergency in emergencies" :key="emergency.id" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

              <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ emergency.id }}</td>
              <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ emergency.name }}</td>

              <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 text-right">
                <button
                  @click="deleteEmergency(emergency.id)"
                  class="bg-red-500 dark:bg-red-600 text-white px-3 py-1 rounded hover:bg-red-600 dark:hover:bg-red-700 transition"
                >
                  Delete
                </button>
              </td>

            </tr>

            <!-- EMPTY STATE -->
            <tr v-if="emergencies.length === 0">
              <td colspan="3" class="text-center py-6 text-gray-500 dark:text-gray-400">
                No emergency types found
              </td>
            </tr>

          </tbody>

        </table>
      </div>

    </div>
  </div>
</template>

<script>
export default {

   data() {
        return {
            emergencies: [],
             form: {
        name: '',
      }
    }
  },

    mounted() {
        this.fetchEmergencies();
    },
    methods: {
        fetchEmergencies() {
            axios.get('/api/emergency-types')
                .then(response => {
                    this.emergencies = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        // STORE Emergency
        storeEmergency() {
          axios.post('/api/emergency-types', this.form)
            .then(res => {

              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Emergency type created successfully',
                timer: 1500,
                showConfirmButton: false
              })

              // reset form
              this.form.name = '' 

              // reload table
              this.fetchEmergencies()

            })
            .catch(err => {

              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to create emergency type'
              })

              console.log(err)

            })
        },


        // DELETE Emergency
        deleteEmergency(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: "This emergency type will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {

            if (result.isConfirmed) {
              axios.delete('/api/emergency-types/' + id)
                .then(() => {
                  Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Emergency Type has been deleted.',
                    timer: 1500,
                    showConfirmButton: false
                  })

                  this.fetchEmergencies()

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