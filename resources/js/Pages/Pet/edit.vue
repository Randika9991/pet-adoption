<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class=" h-full overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #FFE8E5;">
                <div class="py-4">
                    <!-- Display pet details -->
                    <template v-if="pet" class="">
                        <form @submit.prevent="submitForm" :action="route('pets.edit', form.id)" method="POST" enctype="multipart/form-data">
                            <label for="petname" class="px-4 gap-4 text-gray-700">edit pet</label>
                            <div class="grid md:grid-cols-2 gap-4 w-full h-full">
                                <div class=" shadow-md rounded-lg p-4 ">
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


                                </div>

                                <!-- Right Column: Pet Bio and Image -->
                                <div class=" shadow-md rounded-lg p-6">
                                    <!-- Image -->
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="grid md:grid-cols-1 gap-4">
                                            <label for="image" class="block text-gray-700">Image:</label>
                                            <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-md"
                                                   @change="handleImageUpload" />
                                        </div>

                                        <!-- Display new image preview if available -->
                                        <div v-if="form.imageUrl">
                                            <img :src="form.imageUrl" :alt="form.petname" class="w-full h-auto object-cover" style="height: 120px; width: 200px" />
                                        </div>

                                        <!-- Fallback: Display the previously saved image -->
                                        <div v-else>
                                            <img :src="`/storage/${pet.image}`" :alt="pet.petname" class="w-full h-auto object-cover" style="height: 120px; width: 200px" />
                                        </div>
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
                                </div>
                            </div>
                        </form>
                    </template>
                    <template v-else>
                        <p>No pet available.</p>
                    </template>
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
            const file = event.target.files[0]; // Get the selected file
            this.form.image = file; // Save the file

            if (file) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.form.imageUrl = e.target.result; // Set the image URL to preview
                };

                reader.readAsDataURL(file); // Read the file as a data URL for preview
            }
        },
        submitForm() {
            if (this.form.id) {
                let formData = new FormData();

                for (let key in this.form) {
                    formData.append(key, this.form[key]);
                }

                this.$inertia.post(this.route('pets.edit', this.form.id), formData)
                    .then(() => {
                        alert("Form submitted");
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
