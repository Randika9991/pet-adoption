<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute top-0 left-0 w-full h-full object-cover"
            src="https://photo-cdn2.icons8.com/wvsaqHZRmkAADc4ckva8FOAumcSxvd5GH5ZiGmLyYoo/rs:fit:576:384/czM6Ly9pY29uczgu/bW9vc2UtcHJvZC5h/c3NldHMvYXNzZXRz/L3NhdGEvb3JpZ2lu/YWwvODU3LzZkMjg5/MmE3LThjY2QtNDVj/NS04NWVlLTUxMTE1/Yjc4NmRmMC5qcGc.webp"
        />
        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <div class="flex lg:col-start-2 lg:justify-center">
                        <svg
                            class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]"
                            viewBox="0 0 62 65"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                        </svg>
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div class="p-4 h-screen bg-gray-50 text-black/50  dark:text-white/50 rounded-lg">
                        <p class="text-5xl text-center mb-6 text-black" style="font-size: 40px;">Pet Adoption</p>
                        <p class="text-center text-gray-600 mb-6">Thousands of adoptable pets are looking for people. People Like You</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
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
                </main>

                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
</template>
