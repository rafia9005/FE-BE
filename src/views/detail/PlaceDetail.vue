<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <main v-if="!message">
        <NavbarDashboard />
        <div class="flex justify-center items-center">
            <div class="w-1/2 mt-5">
                <div class="shadow-lg px-5 py-5 rounded-md">
                    <div class="px-4 sm:px-0">
                        <h3
                            class="text-base font-semibold leading-7 text-gray-900"
                            v-if="detail"
                        >
                            Terminal {{ detail.name }}
                        </h3>
                        <p
                            class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"
                            v-if="detail"
                        >
                            Personal details terminal {{ detail.name }}
                        </p>
                    </div>
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div
                                class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                            >
                                <dt
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    Name
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                    v-if="detail"
                                >
                                    {{ detail.name }}
                                </dd>
                            </div>
                            <div
                                class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                            >
                                <dt
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    Latitude
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                    v-if="detail"
                                >
                                    {{ detail.latitude }}
                                </dd>
                            </div>
                            <div
                                class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                            >
                                <dt
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    Longitude
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                    v-if="detail"
                                >
                                    {{ detail.longitude }}
                                </dd>
                            </div>
                            <div
                                class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                            >
                                <dt
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    Description
                                </dt>
                                <dd
                                    v-if="detail"
                                    class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                >
                                    {{ detail.description }}
                                </dd>
                            </div>
                            <div
                                class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                            >
                                <dt
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    Image
                                </dt>
                                <dd
                                    class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    <ul
                                        role="list"
                                        class="divide-y divide-gray-100 rounded-md"
                                        v-if="detail"
                                    >
                                        <a
                                            :href="
                                                'http://localhost:8000/storage' +
                                                detail.image_path
                                            "
                                        >
                                            <img
                                                :src="
                                                    'http://localhost:8000/storage' +
                                                    detail.image_path
                                                "
                                                :alt="
                                                    'Foto Detail Terminal' +
                                                    detail.name
                                                "
                                                class="w-[200px]"
                                            />
                                        </a>
                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
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
            detail: null,
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
            this.detail = response.data.data;
        } catch (error) {
            this.message = "404 Not Found";
        }
    },
};
</script>
