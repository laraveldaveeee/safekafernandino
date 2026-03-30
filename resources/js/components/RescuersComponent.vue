<template>
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
            <h3 class="text-lg font-semibold text-gray-900">Rescuers list</h3>
         </div>
        </div>

      </div>
    </div>

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
              Name
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

        <!-- BODY -->
        <tbody class="bg-white divide-y divide-gray-200">

          <tr v-for="rescuer in rescuers" :key="rescuer.id">
            <td class="px-6 py-4 text-sm text-gray-700"> {{ rescuer.id }} </td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ rescuer.type }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ rescuer.name }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ rescuer.contact }}</td>
            <td class="px-6 py-4 text-sm text-gray-700"> {{ rescuer.status }}</td>
           <td class="px-6 py-4 text-sm text-gray-700">
           
           <a :href="'/rescuers/' + rescuer.id + '/view'"
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-all duration-200 group"
                >
                  <svg class="size-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      <span class="text-sm">View Profile</span>
                    </a>
              </td>
          </tr>

        </tbody>

      

      </table>

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