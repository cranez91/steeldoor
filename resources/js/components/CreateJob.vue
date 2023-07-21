<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto">
                    <h3 class="font-bold my-4 text-center">Create Job Opportunity</h3>

                    <form @submit.prevent="submitForm">
                        <div class="grid grid-cols-4 gap-4 mx-4">
                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="company_name" class="block font-medium">Company:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input 
                                        type="text"
                                        style="width: 100%;"
                                        id="company_name" v-model="form.company_name"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="location" class="block font-medium">Location:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input 
                                        type="text"
                                        style="width: 100%;"
                                        id="location" v-model="form.location"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="title" class="block font-medium">Job Title:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input 
                                        type="text"
                                        style="width: 100%;"
                                        id="title" v-model="form.title"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="salary_range" class="block font-medium">Salary Range:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input 
                                        type="text"
                                        style="width: 100%;"
                                        placeholder="" id="salary_range" v-model="form.salary_range"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        required
                                    >
                                </div>
                                <p class="text-sm text-gray-500">Hint: 30k-50k</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="skills" class="block font-medium">Skills:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <textarea 
                                        style="resize: none;width: 100%;"
                                        id="skills"
                                        v-model="form.skills"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        rows="5"
                                        required
                                    ></textarea>
                                </div>
                                <p class="text-sm text-gray-500">Semicolon-separated list: Skill1; Skill2; Skill3; ....</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="description" class="block font-medium">Description:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <textarea 
                                        style="resize: none;width: 100%;"
                                        id="description"
                                        v-model="form.description"
                                        rows="5"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        required
                                    ></textarea>
                                </div>
                            </div>

                            <div class="col-span-4">
                                <div class="flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
      job: {},
      form: {
        company_name: '',
        location: '',
        title: '',
        description: '',
        salary_range: '',
        skills: '',
      }

    };
  },
  mounted() {
    
  },
  methods: {
    submitForm() {
      const formData = new FormData();
      formData.append('company_name', this.form.company_name);
      formData.append('title', this.form.title);
      formData.append('location', this.form.location);
      formData.append('salary_range', this.form.salary_range);
      formData.append('skills', this.form.skills);
      formData.append('description', this.form.description);

      axios.post('/api/admin/job-opportunity', formData)
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
            company_name: '',
            location: '',
            title: '',
            description: '',
            salary_range: '',
            skills: '',
        };
    }
  }
};
</script>