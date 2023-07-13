<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto">
                    <h3 class="text-2xl font-bold my-4">List of Applicants</h3>

                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="py-1 px-4 bg-gray-100 border-b">Email</th>
                                <th class="py-1 px-4 bg-gray-100 border-b">Name</th>
                                <th class="py-1 px-4 bg-gray-100 border-b">Resume</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="applicants.length == 0" class="text-center">
                                <td colspan="3" class="py-1 px-4 border-b">Applicants not found</td>
                            </tr>
                            <tr v-for="applicant in applicants" :key="applicant.id">
                                <td class="py-1 px-4 border-b">{{ applicant.email }}</td>
                                <td class="py-1 px-4 border-b">{{ applicant.name }}</td>
                                <td class="py-1 px-4 border-b">
                                    <a :href="'/storage/resumes/' + applicant.resume" download>Download</a>   
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
  export default {
    props: {
        slug: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            applicants: []
        };
    },
    mounted() {
        this.fetchApplicants();
    },
    methods: {
        fetchApplicants() {
            let slug = this.$props.slug;
            axios.get(`/api/admin/job-opportunity/${slug}/applicants`)
                .then(response => {
                    this.applicants = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
  };
  </script>
  