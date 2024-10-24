<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    adoption: Object,
    pets: Object,
});

const form = useForm({
    pet_id: props.adoption.pet_id || '',
    petname: props.pets.petname || '',
    user_id: props.adoption.user_id || '',
    user_name: props.adoption.user_name || '',
    email: props.adoption.email || '',
    status:props.adoption.status || 'pending',
    application_date: new Date().toISOString().substr(0, 10)
});

const submitForm = () => {
    console.log("Form data before submission:", form);
    form.patch(route('adoption.edit', props.adoption.id), {
        onSuccess: () => {
            console.log("Form submitted successfully");
        },
        onError: (errors) => {
            console.log("Error submitting form", errors);
        },
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto p-4" v-if="adoption && pets">
            <h1 class="text-3xl mb-4">Submit Adoption Application</h1>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="petname" class="block text-lg">Pet Name</label>
                    <input type="text" id="petname_display" :value="pets.petname" class="w-full px-4 py-2 border rounded" disabled>
                    <input type="hidden" id="petname" name="petname" :value="pets.petname">
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-lg">Pet Name</label>
                    <input type="text" id="category" :value="pets.category" class="w-full px-4 py-2 border rounded" disabled>
                    <input type="hidden" id="petcategory" name="petname" :value="pets.category">
                </div>

                <!-- User Name -->
                <div class="mb-4">
                    <label for="user_name" class="block text-lg">User Name</label>
                    <input type="text" id="user_name_display" :value="adoption.user_name" class="w-full px-4 py-2 border rounded" readonly>
                    <input type="hidden" id="user_name" name="user_name" :value="adoption.user_name">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-lg">Email ID</label>
                    <input type="text" id="email_display" :value="adoption.email" class="w-full px-4 py-2 border rounded" readonly>
                    <input type="hidden" id="email" name="email" :value="adoption.email">
                </div>

                <!-- Application Date -->
                <div class="mb-4">
                    <label for="application_date" class="block text-lg">Application Date</label>
                    <input type="date" id="application_date" name="application_date" class="w-full px-4 py-2 border rounded" :value="form.application_date" readonly>
                </div>



                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-lg">Status</label>
                    <select id="status" v-model="form.status" name="status" class="w-full px-4 py-2 border rounded">
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mb-4 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Application</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
