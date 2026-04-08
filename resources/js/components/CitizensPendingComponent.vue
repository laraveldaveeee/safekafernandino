<template>
  <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transition-colors duration-300">

    <!-- HEADER -->
    <div class="border-b border-gray-200 dark:border-gray-700 
                bg-gradient-to-r from-gray-50 to-white 
                dark:from-gray-800 dark:to-gray-900 px-6 py-4">

      <div class="flex items-center space-x-3">

        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
          <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
          Citizens Pending
        </h3>

      </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 overflow-x-auto">
      <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">

        <!-- HEADER -->
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300 w-16">
              ID
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300 w-32">
              Role/Type
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">
              Name
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300 w-40">
              Contact
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300 w-32">
              Status
            </th>
            <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500 dark:text-gray-300 w-40">
              Actions
            </th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="user in guardians" :key="user.id"
              class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 w-16">{{ user.id }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 w-32"> {{ user.role ? user.role.name : '' }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 truncate">{{ user.name  }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 w-40">{{ user.guardian.mobile }}</td>

            <td class="px-6 py-4 w-32">
              <span class="px-2 py-1 rounded text-xs font-medium
                           bg-yellow-100 text-yellow-800
                           dark:bg-yellow-900 dark:text-yellow-300">
                {{ user.status }}
              </span>
            </td>

            <!-- ACTION -->
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-100 w-40 text-right">
              <a :href="'/citizens-pending/' + user.id + '/manage'"
                 class="inline-flex items-center gap-1 px-3 py-1.5 
                        bg-blue-50 text-blue-700 
                        dark:bg-blue-900 dark:text-blue-300
                        rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 
                        transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <span>Manage</span>
              </a>
            </td>

          </tr>

          <!-- EMPTY STATE -->
          <tr v-if="guardians.length === 0">
            <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
              No pending rescuers
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
      guardians: []
    };
  },

  mounted() {
    this.fetchGuardians();
  },

  methods: {
    fetchGuardians() {
      axios.get('/api/citizens-pending')
        .then(response => {
          this.guardians = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
}
</script>