<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto text-center">
                    <h3 class="font-bold my-4">List of Jobs</h3>
                    <section v-if="jobs.length == 0" class="text-center">
                        <div class="py-1 px-4 border-b mx-4">Jobs not found</div>
                    </section>
                    <table v-else class="min-w-full">
                        <thead>
                        <tr>
                            <th class="py-1 px-4 bg-gray-100 border-b">Company</th>
                            <th class="py-1 px-4 bg-gray-100 border-b">Location</th>
                            <th class="py-1 px-4 bg-gray-100 border-b">Title</th>
                            <th class="py-1 px-4 bg-gray-100 border-b">Applicants</th>
                            <th colspan="2" class="py-1 px-4 bg-gray-100 border-b text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="job in jobs" :key="job.id">
                                <td class="py-1 px-4 border-b">{{ job.company_name }}</td>
                                <td class="py-1 px-4 border-b">{{ job.location }}</td>
                                <td class="py-1 px-4 border-b">{{ job.title }}</td>
                                <td class="py-1 px-4 border-b">
                                  <a :href="`/admin/job-opportunity/${job.slug}/applicants`"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                  >
                                      View
                                  </a>
                                </td>
                                <td class="py-1 px-4 border-b">
                                  <a :href="`/admin/job-opportunity/${job.slug}/edit`"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                  >
                                      Modify
                                  </a>
                                </td>
                                <td class="py-1 px-4 border-b">
                                  <button 
                                    type="button" 
                                    @click="deleteJobOpportunity(job.slug)" 
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-600 sm:mt-0 sm:w-auto"
                                  >
                                    Remove
                                  </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container mx-auto text-center py-4">
                    <a href="/admin/job-opportunity/create"
                      class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700"
                    >
                      Create New
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      jobs: []
    };
  },
  mounted() {
    this.fetchJobOpportunities();
  },
  methods: {
    fetchJobOpportunities() {
      axios.get('/api/admin/dashboard')
        .then(response => {
          this.jobs = response.data.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteJobOpportunity(slug) {
      axios.delete(`/api/admin/job-opportunity/${slug}`)
        .then(response => {
          this.deleteJob(slug);
          Swal.fire('Success', response.data.message, 'success');
          //TODO: remove the item from the list
        })
        .catch(error => {
            Swal.fire('Error', 'Something went wrong, please try again', 'error');
        });
    },
    deleteJob(slug) {
      const index = this.jobs.findIndex(job => job.slug === slug);
      if (index !== -1) {
        this.jobs.splice(index, 1);
      }
    }
  }
};
</script>