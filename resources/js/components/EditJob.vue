<template>
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto">
                    <h3 class="text-2xl font-bold my-4 text-center">Modify Job Opportunity</h3>

                    <form @submit.prevent="submitForm">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="company_name" class="block font-medium">Company:</label>
                                <input type="text" style="width: 100%;" id="company_name" v-model="job.company_name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="location" class="block font-medium">Location:</label>
                                <input type="text" style="width: 100%;" id="location" v-model="job.location" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="title" class="block font-medium">Job Title:</label>
                                <input type="text" style="width: 100%;" id="title" v-model="job.title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="salary_range" class="block font-medium">Salary Range:</label>
                                <input type="text" style="width: 100%;" placeholder="" id="salary_range" v-model="job.salary_range" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <p class="text-sm text-gray-500">Hint: 30k-50k</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="skills" class="block font-medium">Skills:</label>
                                <textarea style="resize: none;width: 100%;" id="skills" v-model="job.skills" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="5" required></textarea>
                                <p class="text-sm text-gray-500">Semicolon-separated list: Skill1; Skill2; Skill3; ....</p>
                            </div>

                            <div class="col-span-4 sm:col-span-2 py-2">
                                <label for="description" class="block font-medium">Description:</label>
                                <textarea style="resize: none;width: 100%;" id="description" v-model="job.description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                            </div>

                            <div class="col-span-4">
                                <div class="flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 text-black font-medium rounded-md hover:bg-indigo-600">SAVE</button>
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