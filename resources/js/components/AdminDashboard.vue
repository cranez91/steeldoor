<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto text-center">
                    <h3 class="text-2xl font-bold my-4">List of Jobs</h3>
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
                                    class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md hover:bg-blue-600">
                                    View
                                </a>
                                </td>
                                <td class="py-1 px-4 border-b">
                                <a :href="`/admin/job-opportunity/${job.slug}/edit`"
                                    class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md hover:bg-blue-600">
                                    Modify
                                </a>
                                </td>
                                <td class="py-1 px-4 border-b">
                                    <button type="button" @click="deleteJobOpportunity(job.slug)" class="px-2 py-1 bg-red-500 text-black font-medium rounded-md hover:bg-red-600">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container mx-auto text-center py-4">
                    <a class="text-2xl font-bold my-4" href="/admin/job-opportunity/create">Create New</a>
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