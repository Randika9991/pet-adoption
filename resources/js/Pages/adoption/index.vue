<script>
import { useForm, usePage } from "@inertiajs/vue3";
import { defineProps } from "vue";
export default {
    name: "CreatePet",
    props: {
        pets: Object,   // Single pet object
        user: Object   // User object (for email)
    },

    data() {
        return {
            form: {
                pet_id: this.pets.id || '',
                petname: this.pets.petname || '',
                user_id: this.user.id || '',
                user_name: this.user.name || '',
                email: this.user.email || '',
                application_date: new Date().toISOString().substr(0, 10)
            }
        }
    },

    methods: {
        submitForm() {
            console.log("Form data before submission:", this.form);
            this.$inertia.post(this.route('adoption.create'), this.form, {
                forceFormData: true,
            });
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto p-4" v-if="pets && user">
            <h1 class="text-3xl mb-4">Submit Adoption Application</h1>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="petname" class="block text-lg">Pet Name</label>
                    <input type="text" id="petname_display" :value="pets.petname" class="w-full px-4 py-2 border rounded" disabled>
                    <input type="hidden" id="petname" name="petname" :value="pets.petname">
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-lg">Pet Category</label>
                    <input type="text" id="category" :value="pets.category" class="w-full px-4 py-2 border rounded" disabled>
                    <input type="hidden" id="petcategory" name="petname" :value="pets.category">
                </div>

                <!-- User Name -->
                <div class="mb-4">
                    <label for="user_name" class="block text-lg">User Name</label>
                    <input type="text" id="user_name_display" :value="user.name" class="w-full px-4 py-2 border rounded" readonly>
                    <input type="hidden" id="user_name" name="user_name" :value="user.name">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-lg">Email ID</label>
                    <input type="text" id="email_display" :value="user.email" class="w-full px-4 py-2 border rounded" readonly>
                    <input type="hidden" id="email" name="email" :value="user.email">
                </div>

                <!-- Application Date -->
                <div class="mb-4">
                    <label for="application_date" class="block text-lg">Application Date</label>
                    <input type="date" id="application_date" name="application_date" class="w-full px-4 py-2 border rounded" :value="form.application_date" readonly>
                </div>

                <!-- Submit Button -->
                <div class="mb-4 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Application</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
