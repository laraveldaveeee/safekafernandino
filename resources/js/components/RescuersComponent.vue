<template>
  <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">

    <!-- HEADER -->
    <div class="border-b px-6 py-4 bg-gray-50 dark:bg-gray-900">
      <div class="flex items-center space-x-3">

        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
          <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
          Approved Rescuers
        </h3>

      </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

        <!-- HEADER -->
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Contact</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Action</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-white">

          <tr v-for="user in rescuers" :key="user.id"
              class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="px-6 py-4 text-sm">{{ user.id }}</td>

            <td class="px-6 py-4 text-sm">
              {{ user.rescuer?.type || '-' }}
            </td>

            <td class="px-6 py-4 text-sm">
              {{ user.name }}
            </td>

            <td class="px-6 py-4 text-sm">
              {{ user.rescuer?.contact || '-' }}
            </td>

            <td class="px-6 py-4 text-sm">
              <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                {{ user.rescuer?.status || '-' }}
              </span>
            </td>

            <td class="px-6 py-4 text-right">

              <a :href="`/rescuers/${user.id}/view`"
                 class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100">

                <span>View Profile</span>
              </a>

            </td>

          </tr>

          <!-- EMPTY -->
          <tr v-if="rescuers.length === 0">
            <td colspan="6" class="text-center py-6 text-gray-500">
              No approved rescuers found
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</template>

<script>

export default {
  data() {
    return {
      rescuers: []
    }
  },

  mounted() {
    this.fetchRescuers()
  },

  methods: {

    fetchRescuers() {
      axios.get('/api/rescuers')
        .then(res => {

          // FILTER ONLY APPROVED
          this.rescuers = res.data.filter(user =>
            user.rescuer?.status === 'approved'
          )

        })
        .catch(err => {
          console.log(err)
        })
    }

  }
}
</script>