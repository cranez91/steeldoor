<template>
    
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="font-bold py-4 text-center">Job Opportunities</h3>
                <div class="sm:col-span-4 mx-4">
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input
                                type="text"
                                v-model="search"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            >
                        </div>
                    </div>
                </div>
                <ul role="list" class="divide-y divide-gray-100 mx-4">
                    <li v-if="filteredJobs.length == 0" class="flex justify-between gap-x-6 py-5">
                        No matching jobs found
                    </li>
                    <li 
                        class="flex justify-between gap-x-6 py-5"
                        v-for="job in filteredJobs" :key="job.id"
                    >
                        <div class="flex gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <a :href="`/job-opportunities/${job.slug}`" class="text-blue-600 hover:underline">{{ job.title }}</a>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ job.company_name }}</p>
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">{{ job.location }}</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">({{ job.salary_range }})</p>
                        </div>
                    </li>
                </ul>
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
  