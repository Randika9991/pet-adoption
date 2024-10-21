<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl mb-6">Edit Pet</h2>

                    <div class="max-h-[75vh] overflow-y-auto">
                        <form @submit.prevent="submitForm" :action="route('pets.edit', form.id)" method="POST" enctype="multipart/form-data">
                            <!-- Pet Name -->
                            <div class="mb-4">
                                <label for="petname" class="block text-gray-700">Pet Name:</label>
                                <input type="text" id="petname" name="petname" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.petname" />
                            </div>

                            <!-- Pet Category -->
                            <div class="mb-4">
                                <label for="petcategory" class="block text-gray-700">Pet Category:</label>
                                <input type="text" id="petcategory" name="petcategory" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.category" />
                            </div>

                            <!-- Breed -->
                            <div class="mb-4">
                                <label for="breed" class="block text-gray-700">Breed:</label>
                                <input type="text" id="breed" name="breed" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.breed" />
                            </div>

                            <!-- Age -->
                            <div class="mb-4">
                                <label for="age" class="block text-gray-700">Age:</label>
                                <input type="number" id="age" name="age" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.age" />
                            </div>

                            <!-- Gender -->
                            <div class="mb-4">
                                <label for="gender" class="block text-gray-700">Gender:</label>
                                <select v-model="form.gender" id="gender" name="gender" class="w-full px-4 py-2 border rounded-md">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <!-- Story -->
                            <div class="mb-4">
                                <label for="story" class="block text-gray-700">Story:</label>
                                <textarea id="story" name="story" class="w-full px-4 py-2 border rounded-md"
                                          v-model="form.story"></textarea>
                            </div>

                            <!-- Is Adopted -->
                            <div class="mb-4">
                                <label for="is_adopted" class="block text-gray-700">Is Adopted:</label>
                                <select id="is_adopted" name="is_adopted" class="w-full px-4 py-2 border rounded-md"
                                        v-model="form.is_adopted">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <label for="image" class="block text-gray-700">Image:</label>
                                <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-md" @change="handleImageUpload" />
                                <span class="text-gray-500">{{ form.image ? form.image.name : 'No file chosen' }}</span>
                            </div>

                            <!-- User Information -->
                            <div class="mb-4">
                                <label class="block text-gray-700">Name:</label>
                                <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ form.name }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Email:</label>
                                <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ form.email }}</p>
                            </div>

                            <!-- Address -->
                            <div class="mb-4">
                                <label for="address" class="block text-gray-700">Address:</label>
                                <input type="text" id="address" name="address" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.address" />
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="phone" class="block text-gray-700">Phone:</label>
                                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded-md"
                                       v-model="form.phone" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="dark:bg-black text-white px-4 py-2 rounded">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm, usePage } from "@inertiajs/vue3";
import { defineProps } from "vue";

export default {
    name: "EditPet",
    props: {
        pet: Object,   // Single pet object
        user: Object   // User object (for email)
    },
    data() {
        return {
            form: {
                id: this.pet.id || '',
                petname: this.pet.petname || '',
                category: this.pet.category || '',
                breed: this.pet.breed || '',
                age: this.pet.age || null,
                gender: this.pet.gender || 'male',
                story: this.pet.story || '',
                is_adopted: this.pet.is_adopted ? '1' : '0',
                address: this.pet.address || '',
                phone: this.pet.phone || '',
                name: this.user.name || '',
                email: this.user.email || '',
                image: null,
            }
        };
    },
    methods: {
        handleImageUpload(event) {
            this.form.image = event.target.files[0]; // Get the file
        },
        submitForm() {
            if (this.form.id) {
                let formData = new FormData();

                for (let key in this.form) {
                    formData.append(key, this.form[key]);
                }

                this.$inertia.post(this.route('pets.edit', this.form.id), formData)
                    .then(() => {
                        console.log("Form submitted");
                    })
                    .catch(error => {
                        console.log("Error submitting form", error);
                    });
            } else {
                console.log("Pet ID is missing");
            }
        }
    }
}
</script>

<style scoped>

</style>
