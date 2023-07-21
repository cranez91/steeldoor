<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mx-4 text-center">
                    <h2 class="text-2xl font-bold mb-2 py-4">{{job.title}}</h2>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mx-4 text-center">
                    <h5 class="text-sm font-bold mb-2">
                        {{job.company_name}} @ {{job.location}} ({{job.salary_range}})
                    </h5>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mx-4">
                    <p class="text-md mb-2">
                        <strong>Job Description</strong>: {{job.description}}
                    </p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mx-4">
                    <p class="text-md mb-2">
                        <strong>Skills</strong>:
                    </p>
                    <ul>
                        <li v-for="skill in job.skills" :key="skill">{{ skill }}</li>
                    </ul>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 mx-4">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Apply to this Job</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

                        <form @submit.prevent="submitForm">
                           
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="sm:col-span-3 py-2">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3 py-2">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                    <div class="mt-2">
                                        <input id="email" v-model="form.email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3 py-2">
                                    <label for="resume" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload resume</span>
                                        <input type="file" id="resume" accept=".pdf,.doc,.docx" ref="resumeInput">
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6 py-4">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700"
                                >Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  props: {
    slug: {
        type: String,
        required: true,
    }
  },
  data() {
    return {
      job: {},
      form: {
        name: '',
        email: '',
        opportunity: '',
        resume: null
      }

    };
  },
  mounted() {
    this.fetchJob();
  },
  methods: {
    fetchJob() {
      let slug = this.$props.slug;
      axios.get(`/api/admin/job-opportunity/${slug}`)
        .then(response => {
          this.job = response.data.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    submitForm() {
      const formData = new FormData();
      formData.append('name', this.form.name);
      formData.append('email', this.form.email);
      formData.append('opportunity', this.$props.slug);
      formData.append('resume', this.$refs.resumeInput.files[0]);

      axios.post('/api/admin/job-opportunities/apply', formData)
        .then(response => {
            this.cleanForm();
            Swal.fire('Success', response.data.message, 'success');
        })
        .catch(error => {
            Swal.fire('Error', 'Something went wrong, please try again', 'error');
        });
    },
    cleanForm(){
        this.form =  {
            name: '',
            email: '',
            opportunity: '',
            resume: null
        };
    }
  }
};
</script>