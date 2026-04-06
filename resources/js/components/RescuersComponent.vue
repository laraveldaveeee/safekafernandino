<template>
  <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transition-colors duration-300">

    <!-- HEADER -->
    <div class="border-b border-gray-200 dark:border-gray-700 
                bg-gradient-to-r from-gray-50 to-white 
                dark:from-gray-800 dark:to-gray-900 px-6 py-4">

      <div class="flex items-center space-x-3">

        <!-- ICON -->
        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
          <svg class="size-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>

        <!-- TITLE -->
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
          Rescuers List
        </h3>

      </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 transition-colors duration-300">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto">

        <!-- HEADER -->
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Contact</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="rescuer in rescuers" :key="rescuer.id"
              class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ rescuer.id }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ rescuer.type }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ rescuer.name }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ rescuer.contact }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100">{{ rescuer.status }}</td>

            <td class="px-6 py-4 text-sm text-right">
              <a :href="'/rescuers/' + rescuer.id + '/view'"
                 class="inline-flex items-center gap-1 px-3 py-1.5 
                        bg-blue-50 text-blue-700 
                        dark:bg-blue-900 dark:text-blue-300
                        rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 
                        transition group">

                <svg class="size-4 group-hover:scale-110 transition-transform"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <span class="text-sm">View Profile</span>
              </a>
            </td>

          </tr>

          <!-- EMPTY STATE -->
          <tr v-if="rescuers.length === 0">
            <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
              No rescuers found
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
        this.fetchIncidents();
    },

    methods: {
        fetchIncidents() {
            axios.get('/api/rescuers')
                .then(response => {
                    this.rescuers = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>