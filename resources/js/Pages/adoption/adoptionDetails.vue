<template>
    <Head title="Pet Dashboard" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="dark:bg-black overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-12">
                        <!-- Grid container for adoption applications -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
                            <template v-if="adoption.data.length > 0">
                                <div v-for="adoption in adoption.data" :key="adoption.id">
                                    <a :href="`/adoption/${adoption.id}`" class="block bg-white shadow-md rounded-lg overflow-hidden">
                                        <div class="p-6 bg-white shadow-lg rounded-lg">
                                            <h3 class="text-lg font-semibold mb-4">Application Information</h3>

                                            <!-- Pet Name -->
                                            <div class="mb-4">
                                                <strong>Pet Name:</strong> {{ adoption.user_name }}
                                            </div>

                                            <!-- Applicant Name -->
                                            <div class="mb-4">
                                                <strong>Applicant Name:</strong> {{ adoption.email }}
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-4">
                                                <strong>Email:</strong> {{ adoption.application_date }}
                                            </div>

                                            <!-- Application Date -->
                                            <div class="mb-4">
                                                <strong>Application Date:</strong> {{ adoption.status }}
                                            </div>

                                            <!-- Status -->
                                            <div class="mb-4">
                                                <strong>Status:</strong>
                                                <span :class="{
                                                        'text-green-500': adoption.status === 'approved',
                                                        'text-red-500': adoption.status === 'rejected',
                                                        'text-yellow-500': adoption.status === 'pending'
                                                    }">
                                                        {{ adoption.status.charAt(0).toUpperCase() + adoption.status.slice(1) }}
                                                    </span>
                                            </div>
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
                            <template v-for="link in adoption.links" :key="link.url">
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
    adoption: Object, // Ensure pets is of type Object
});
</script>
