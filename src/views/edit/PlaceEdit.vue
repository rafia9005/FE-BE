<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <main v-if="!message">
        <NavbarDashboard />
        <form @submit.prevent="editPlace">
            <div class="flex justify-center items-center h-screen">
                <div class="w-1/2">
                    <div class="shadow-lg p-5 pb-12">
                        <h2
                            class="text-base font-semibold leading-7 text-gray-900"
                            v-if="data"
                        >
                            Edit data terminal {{ data.name }}
                        </h2>
                        <p
                            class="mt-1 text-sm leading-6 text-gray-600"
                            v-if="data"
                        >
                            Halaman edit data Terminal
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
                                        v-model="place.name"
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
                                        v-model="place.latitude"
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
                                        v-model="place.longitude"
                                        class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    />
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
                                        v-model="place.description"
                                        class="px-5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    ></textarea>
                                </div>
                                <button
                                    type="submit"
                                    v-if="data"
                                    class="bg-indigo-500 text-white px-2 py-2 mt-5 rounded-md font-bold"
                                >
                                    Update {{ data.name }}
                                </button>
                                <h1
                                    class="mt-3 text-sm leading-6 text-gray-600"
                                >
                                    <h1
                                        v-if="successMessage"
                                        class="text-green-500"
                                    >
                                        {{ successMessage }}
                                    </h1>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <div v-else>
        <div class="relative">
            <div
                aria-hidden="true"
                class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20"
            >
                <div
                    class="blur-[106px] h-[800px] bg-gradient-red-700 from-black to-purple-500"
                ></div>
                <div
                    class="blur-[106px] h-[500px] bg-gradient-to-r from-green-500 to-pink-500"
                ></div>
            </div>
        </div>
        <div class="flex justify-center items-center h-[90vh]">
            <div class="text-center">
                <p class="text-indigo-400 text-xl">404</p>
                <h1 class="text-3xl font-bold">Not Found</h1>
                <p class="mt-5">
                    Sorry, but the {{ parameters }} page was not found.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            idItem: null,
            place: null,
            data: null,
            successMessage: null,
            message: null,
            parameters: this.$route.path,
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
        const url = this.$route.path;
        const segments = url.split("/");
        const id = segments[2];
        this.idItem = parseInt(id);

        this.getItem();
    },
    methods: {
        async getItem() {
            try {
                const response = await axios.get(
                    `http://localhost:8000/v1/place/${this.idItem}`,
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "token"
                            )}`,
                        },
                    }
                );
                this.data = response.data.data;
                this.place = this.data;
            } catch (error) {
                this.message = "404 Not Found";
            }
        },
        async editPlace() {
            const bodyFrom = new FormData();
            bodyFrom.append("name", this.place.name);
            bodyFrom.append("latitude", this.place.latitude);
            bodyFrom.append("longitude", this.place.longitude);
            bodyFrom.append("description", this.place.description);

            try {
                await axios.put(
                    `http://localhost:8000/v1/place/${this.idItem}`,
                    bodyFrom,
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "token"
                            )}`,
                            "Content-Type": "application/json",
                        },
                    }
                );
                this.successMessage = "Place updated successfully!";
                setTimeout(() => {
                    this.$router.push("/dashboard");
                }, 2000);
            } catch (error) {}
        },
    },
};
</script>
