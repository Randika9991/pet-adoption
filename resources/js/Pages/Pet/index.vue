<template>
    <Head title="Pet Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <a class="text-black px-4 py-2 rounded">
                    Pet
                </a>
                <a :href="`/pets/create`">
                    <button type="button"
                            class="dark:bg-black text-black px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Add new pet
                    </button>
                </a>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="dark:bg-black overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-12">
                        <!-- Wrap all cards in the grid container -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
                            <template v-if="pets.data.length > 0">
                                <div v-for="pet in pets.data" :key="pet.id">
                                    <a :href="`/pets/${pet.id}`" class="block bg-white shadow-md rounded-lg overflow-hidden">
                                        <img
                                            style="height: 250px;"
                                            :src="`/storage/${pet.image}`"
                                            :alt="pet.petname"
                                            class="w-full h-5 object-cover"
                                        />
                                        <div class="p-4">
                                            <h2 class="font-bold text-xl">{{ pet.petname }}</h2>
                                            <p class="text-gray-600">{{ pet.category }} - {{ pet.gender }} - {{ pet.age }} years old</p>
                                        </div>
                                    </a>
                                </div>
                            </template>
                            <template v-else>
                                <p>No pets available.</p>
                            </template>
                        </div>

                        <!-- Pagination links -->
                        <div class="mt-4 gap-4 px-4 flex justify-center">
                            <template v-for="link in pets.links" :key="link.url">
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    class="mx-1 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    :class="{ 'font-bold': link.active }"
                                >
                                    <span v-html="link.label"></span>
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    pets: Object, // Ensure pets is of type Object
});
</script>
