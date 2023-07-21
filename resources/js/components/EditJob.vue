<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto">
                    <h3 class="font-bold my-4 text-center">Modify Job Opportunity</h3>

                    <form @submit.prevent="submitForm">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="company_name" class="block font-medium">Company:</label>
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input
                                        type="text"
                                        style="width: 100%;"
                                        id="company_name"
                                        v-model="job.company_name"
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
                                        id="location" 
                                        v-model="job.location" 
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
                                        id="title" 
                                        v-model="job.title" 
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
                                        placeholder="" 
                                        id="salary_range" 
                                        v-model="job.salary_range" 
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        required
                                    >
                                </div>
                                <p class="text-sm text-gray-500">Hint: 30k-50k</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="skills" class="block font-medium">Skills:</label>
                                <textarea
                                    style="resize: none;width: 100%;"
                                    id="skills" v-model="job.skills"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    rows="5"
                                    required
                                ></textarea>
                                <p class="text-sm text-gray-500">Semicolon-separated list: Skill1; Skill2; Skill3; ....</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="description" class="block font-medium">Description:</label>
                                <textarea
                                    style="resize: none;width: 100%;"
                                    id="description" v-model="job.description"
                                    rows="5"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    required
                                ></textarea>
                            </div>

                            <div class="col-span-4">
                                <div class="flex justify-end">
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700"
                                    >
                                        SAVE
                                    </button>
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
    props: {
        slug: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            job: {},
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
                this.job.skills = this.job.skills.join(';');
            })
            .catch(error => {
                console.error(error);
            });
        },
        submitForm() {
            let slug = this.$props.slug;
            axios.put(`/api/admin/job-opportunity/${slug}`, this.job)
            .then(response => {
                this.updateForm(response.data.data);
                Swal.fire('Success', response.data.message, 'success');
            })
            .catch(error => {
                Swal.fire('Error', 'Something went wrong, please try again', 'error');
            });
        },
        updateForm(data){
            this.form = data;
        }
    }
};
</script>