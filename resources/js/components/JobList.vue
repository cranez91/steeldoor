<template>
    <div>
      
      <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold py-4 text-center">Job Opportunities</h2>
                        <section class="divide-y divide-gray-200 list-none mx-4">
                            <div class="py-2">
                                <label for="search">Search</label>
                                <input type="text" v-model="search">
                            </div>
                        </section>
                        <p v-if="filteredJobs.length == 0" class="py-4 text-center">
                            Jobs not found.
                        </p>
                        <section class="divide-y divide-gray-200 list-none text-center"
                            v-for="job in filteredJobs" :key="job.id">
                            <div class="py-2">
                                <a :href="`/job-opportunities/${job.slug}`" class="text-blue-600 hover:underline">{{ job.title }}</a>
                                <p class="text-gray-500">{{ job.company_name }} - {{ job.location }} ({{ job.salary_range }})</p>
                            </div>
                        </section>
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
            search: '',
            jobs: []
        };
    },
    computed: {
      filteredJobs() {
        // filter the jobs by the search value
        return this.jobs.filter(job =>
          job.location.toLowerCase().includes(this.search.toLowerCase()) ||
          job.title.toLowerCase().includes(this.search.toLowerCase()) ||
          job.company_name.toLowerCase().includes(this.search.toLowerCase()) ||
          job.salary_range.toLowerCase().includes(this.search.toLowerCase())
        );
      }
    },
    mounted() {
        this.fetchJobOpportunities();
    },
    methods: {
        fetchJobOpportunities() {
        axios.get('/api/seeker/job-opportunities')
            .then(response => {
                this.jobs = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
  };
  </script>
  