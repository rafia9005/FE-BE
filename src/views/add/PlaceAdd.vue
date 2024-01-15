<script setup>
import NavbarDashboard from "../../components/NavbarDashboard.vue";
</script>

<template>
    <NavbarDashboard />
    <div class="flex justify-center items-center h-screen">
        <form class="w-1/2" @submit.prevent="uploadData">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Tambah Data Terminal
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Data Terminal Indonesia
                </p>

                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-4">
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Nama Terminal</label
                        >
                        <div class="mt-2">
                            <input
                                type="text"
                                v-model="name"
                                required
                                autofocus
                                class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label
                            for="first-name"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Latitude</label
                        >
                        <div class="mt-2">
                            <input
                                type="number"
                                v-model="latitude"
                                required
                                class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label
                            for="last-name"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Longitude</label
                        >
                        <div class="mt-2">
                            <input
                                type="number"
                                v-model="longitude"
                                required
                                class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label
                            for="cover-photo"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Foto Terminal</label
                        >
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                        >
                            <label for="image_path">
                                <span
                                    class="text-indigo-600 bg-gray-100 px-5 py-5 rounded-md"
                                    >Upload Image</span
                                >
                                <input
                                    id="image_path"
                                    class="sr-only"
                                    type="file"
                                    @change="handleFileInputChange"
                                    required
                                />
                            </label>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label
                            for="about"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Description</label
                        >
                        <div class="mt-2">
                            <textarea
                                v-model="description"
                                rows="3"
                                required
                                class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            ></textarea>
                        </div>
                        <h1 class="mt-3 text-sm leading-6 text-gray-600">
                            <h1 v-if="successMessage" class="text-green-500">
                                {{ successMessage }}
                            </h1>
                        </h1>
                    </div>
                </div>
                <button
                    type="submit"
                    class="bg-indigo-400 px-5 py-3 text-white rounded-md font-bold"
                >
                    Tambah Terminal
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { ref } from "vue";

export default {
    data() {
        return {
            response: null,
            successMessage: null,
            image_path: null,
        };
    },
    created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
    },
    methods: {
        handleFileInputChange(event) {
            this.image_path = event.target.files[0];
        },

        async uploadData() {
            const formData = new FormData();
            formData.append("name", this.name);
            formData.append("latitude", this.latitude);
            formData.append("longitude", this.longitude);
            formData.append("image_path", this.image_path);
            formData.append("description", this.description);

            try {
                await axios.post("http://localhost:8000/v1/place", formData, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                });
                this.successMessage = "Place updated successfully!";
                setTimeout(() => {
                    this.$router.push("/dashboard");
                }, 2000);
            } catch (error) {
                console.log(error.response.data.message);
            }
        },
    },
};
</script>
