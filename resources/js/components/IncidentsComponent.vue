<template>
 
   <div class="bg-white shadow rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- HEADER -->
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              ID
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              Type
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              Locations
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              Contact
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              Status
            </th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
              Actions
            </th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="bg-white divide-y divide-gray-200">

          <tr v-for="incident in incidents" :key="incident.id">
            <td class="px-6 py-4 text-sm text-gray-700"> {{ incident.id }} </td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ incident.type }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ incident.locations }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ incident.contact }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ incident.status }}</td>
           <td class="px-6 py-4 text-sm text-gray-700">
           
           <a :href="'/incidents/' + incident.id"
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-all duration-200 group"
                >
                  <svg class="size-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      <span class="text-sm">View</span>
                    </a>
              </td>
          </tr>

        </tbody>

      </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            incidents: []
        }
    },

    mounted() {
        this.fetchIncidents();
    },

    methods: {
        fetchIncidents() {
            axios.get('/api/incidents')
                .then(response => {
                    this.incidents = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>