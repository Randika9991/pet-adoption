<template>
    <Head title="Pet Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="h-3 flex justify-between items-center">
                <a class="text-black px-4 py-2 rounded">Pet</a>
                <template v-if="pet">
                    <a :href="`/pets/${pet.id}/edit`" class="block bg-white shadow-md rounded-lg overflow-hidden">
                        <button type="button"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Edit Pet
                        </button>
                    </a>
                </template>
                <template v-if="pet">
                    <button type="button"
                            @click="deletePet"
                            class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Delete Pet
                    </button>
                </template>
            </div>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
                <div class="dark:bg-black h-full overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-4">
                        <!-- Display pet details -->
                        <template v-if="pet" class="">
                            <div class="grid md:grid-cols-2 gap-4 w-full h-full">
                                <!-- Left Column: Pet Details -->
                                <div class="dark:bg-black shadow-md rounded-lg p-6 ">
                                    <h1 class="text-3xl text-center text-gray-800 dark:text-white mb-6">{{ pet.petname }}</h1>

                                    <!-- Pet Story -->
                                    <div class="mb-6">
                                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-300">Story</h2>
                                        <p class="text-gray-600 dark:text-gray-400 mt-2">{{ pet.story }}</p>
                                    </div>

                                    <!-- Pet Details -->
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Category:</h2>
                                            <p class="text-gray-600 dark:text-gray-400">{{ pet.category }}</p>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Breed:</h2>
                                            <p class="text-gray-600 dark:text-gray-400">{{ pet.breed }}</p>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Gender:</h2>
                                            <p class="text-gray-600 dark:text-gray-400">{{ pet.gender }}</p>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Age:</h2>
                                            <p class="text-gray-600 dark:text-gray-400">{{ pet.age }}</p>
                                        </div>
                                    </div>

                                    <!-- Adoption Status -->
                                    <div class="mb-6">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Adoption Status:</h2>
                                        <span class="inline-block px-4 py-2 mt-2 text-sm font-medium"
                                              :class="pet.is_adopted ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white'">
                                            {{ pet.is_adopted ? 'Adopted' : 'Available for Adoption' }}
                                        </span>
                                    </div>

                                    <!-- Submit Button for Adoption Application -->
                                    <a v-if="!pet.is_adopted" :href="`/adoption/applyForm/${pet.id}`">
                                        <button type="submit"
                                                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-blue-400">
                                            Submit Adoption Application
                                        </button>
                                    </a>
                                </div>

                                <!-- Right Column: Pet Bio and Image -->
                                <div class="dark:bg-black shadow-md rounded-lg p-6">
                                    <div class="mb-6">
                                        <!-- Check if the image exists before rendering -->
                                        <img
                                            v-if="pet.image"
                                            :src="`/storage/${pet.image}`"
                                            :alt="pet.petname"
                                            class="w-full h-80 object-cover rounded-lg"
                                        />
                                        <p v-else class="text-gray-500 dark:text-gray-400">
                                            No image available for this pet.
                                        </p>
                                        <p class="text-gray-500 dark:text-gray-400 mt-4">{{ pet.is_adopted ? 'Adopted' : 'Adoptable' }}</p>
                                    </div>

                                    <!-- Shelter Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Shelter Info</h2>
                                            <p class="text-gray-700 dark:text-gray-400"><span class="font-semibold">Address:</span> {{ pet.address }}</p>
                                            <p class="text-gray-700 dark:text-gray-400"><span class="font-semibold">Phone:</span>  {{ pet.phone }}</p>
                                            <p class="text-gray-700 dark:text-gray-400"><span class="font-semibold">Email:</span>  {{ user.email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <p>No pet available.</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Expect a single 'pet' object and user info
const props = defineProps({
    pet: Object,   // Single pet object
    user: Object   // User object (for email)
});

// Define the deletePet function directly
function deletePet() {
    console.log("Pet delete function triggered");

    if (confirm('Are you sure you want to delete this pet?')) {
        Inertia.delete(`/pets/${props.pet.id}`, {
            onSuccess: () => {
                console.log('Pet deleted successfully');
            },
            onError: (error) => {
                console.error('Error deleting pet:', error);
            }
        });
    }
}
</script>

