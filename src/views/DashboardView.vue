<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <NavbarDashboard />
    <div class="flex justify-center items-center">
        <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-sm shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-indigo-300 uppercase"
                            >
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Latitude</th>
                                <th class="px-4 py-3">Longitude</th>
                                <th class="px-4 py-3">Lokasi</th>
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody
                            class="bg-white"
                            v-for="item in place"
                            :key="item.id"
                        >
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ item.id }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.latitude }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.longitude }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="" class="text-red-500 font-bold">view</a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a
                                        :href="
                                            'http://localhost:8000/storage' +
                                            item.image_path
                                        "
                                    >
                                        <img
                                            :src="
                                                'http://localhost:8000/storage' +
                                                item.image_path
                                            "
                                            class="w-[50px]"
                                        />
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.description.substring(0, 40) }}
                                </td>
                                <td class="items-center font-bold">
                                    <router-link
                                        :to="'/place/' + item.id + '/detail'"
                                        class="bg-yellow-500 px-2 py-2 rounded-md"
                                        >detail</router-link
                                    >
                                    <button
                                        @click="deletePlace(item.id)"
                                        class="bg-red-300 rounded-md px-2 py-2 mx-5"
                                    >
                                        delete
                                    </button>
                                    <router-link
                                        :to="'/place/' + item.id + '/edit'"
                                        class="bg-green-400 px-2 py-2 rounded-md"
                                    >
                                        edit
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <router-link to="/place/add" class="mt-5 bg-indigo-400 text-white px-2 py-2 rounded-md hover:bg-indigo-600"
                    >Tambah Data Terminal</router-link
                >
            </div>
        </section>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            place: null,
            editButton: false,
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
        const responsePlace = await axios.get(
            "http://localhost:8000/v1/place",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        this.place = responsePlace.data.data;
    },
    methods: {
        async deletePlace(PlaceId) {
            await axios.delete(`http://localhost:8000/v1/place/${PlaceId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            window.location.reload();
        },
    },
};
</script>
