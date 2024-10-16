<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="max-w-6xl mx-auto p-4 overflow-hidden">
            <p class="text-5xl text-center mb-6" style="font-size: 40px;">Pet Adoption</p>
            <p class="text-center text-gray-600 mb-6">Thousands of adoptable pets are looking for people. People Like You</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                <div class="bg-white shadow-md rounded-lg overflow overflow-y-hidden">
                    <img src="https://photo-cdn2.icons8.com/srbWoIKOgNVvm0aDE-sNS5f1MFcLRe2g5SpEp8CR4No/rs:fit:576:864/czM6Ly9pY29uczgu/bW9vc2UtcHJvZC5h/c3NldHMvYXNzZXRz/L3NhdGEvb3JpZ2lu/YWwvNzEwLzJkN2Ji/YTRmLTgyNGUtNDY1/NC1iMDQ0LWFlNDFh/NWQ1YzRiZC5qcGc.webp" alt="Pet" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-bold text-xl">Shay and Luna (BONDED PAIR)</h2>
                        <p class="text-gray-600">Cat - Female - Young - Small</p>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://photo-cdn2.icons8.com/Rz--ULtByXCPUEQAw1q-bfmNDLHCdar2lc68nRt6fZE/rs:fit:576:864/czM6Ly9pY29uczgu/bW9vc2UtcHJvZC5h/c3NldHMvYXNzZXRz/L3NhdGEvb3JpZ2lu/YWwvNjgxLzBjZGY1/M2U5LWNkYjUtNDM0/NS04NWQyLTY2OWQz/ZmViYzdhMS5qcGc.webp" alt="Pet" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-bold text-xl">Moose and Annie</h2>
                        <p class="text-gray-600">Cat - Female - Young - Small</p>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://photo-cdn2.icons8.com/BhQb28SGfn1-F-vnJ0qTsicJJKbURcqI_jf0AH6l5xc/rs:fit:576:864/czM6Ly9pY29uczgu/bW9vc2UtcHJvZC5h/c3NldHMvYXNzZXRz/L3NhdGEvb3JpZ2lu/YWwvMzUxLzBiZGRm/MmVlLTg4YTEtNDI5/MC1hZDJhLTY1YTA4/OWYxMjJmNy5qcGc.webp" alt="Pet" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-bold text-xl">Kittens (Bonded Brothers)</h2>
                        <p class="text-gray-600">Cat - Male - Young - Small</p>
                    </div>
                </div>
                <!-- Add more pet cards as needed -->
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-600">Animals have no voice. We do!</p>
                <p class="text-gray-600">Donate now to help animals. Today!</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
