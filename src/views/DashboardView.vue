<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <NavbarDashboard />
    <main v-if="role === 'admin'">
        <div class="">
            <div>
                <section class="container mx-auto p-6 font-mono">
                    <div
                        class="w-full mb-8 overflow-hidden rounded-sm shadow-lg"
                    >
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
                                            <a
                                                href=""
                                                class="text-red-500 font-bold"
                                                >view</a
                                            >
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
                                            {{
                                                item.description.substring(
                                                    0,
                                                    40
                                                )
                                            }}
                                        </td>
                                        <td class="items-center font-bold">
                                            <router-link
                                                :to="
                                                    '/place/' +
                                                    item.id +
                                                    '/detail'
                                                "
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
                                                :to="
                                                    '/place/' +
                                                    item.id +
                                                    '/edit'
                                                "
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
                        <router-link
                            to="/place/add"
                            class="mt-5 bg-indigo-400 text-white px-2 py-2 rounded-md hover:bg-indigo-600"
                            >Tambah Data Terminal</router-link
                        >
                    </div>
                </section>
                <section class="container mx-auto p-6 font-mono">
                    <div
                        class="w-full mb-8 overflow-hidden rounded-sm shadow-lg"
                    >
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-indigo-300 uppercase"
                                    >
                                        <th class="px-4 py-3">BUS</th>
                                        <th class="px-4 py-3">LINE</th>
                                        <th class="px-4 py-3">KELAS</th>
                                        <th class="px-4 py-3">FROM</th>
                                        <th class="px-4 py-3">TO</th>
                                        <th class="px-4 py-3">KEBERANGKATAN</th>
                                        <th class="px-4 py-3">DATANG</th>
                                        <th class="px-4 py-3">JARAK</th>
                                        <th class="px-4 py-3">SPEED</th>
                                        <th class="px-4 py-3">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white"
                                    v-for="item in schedule"
                                    :key="item.id"
                                >
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.bus }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.line }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.kelas }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.from }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.to }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.berangkat }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.datang }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.jarak }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ item.speed }}
                                        </td>
                                        <td class="items-center font-bold">
                                            <router-link
                                                class="bg-yellow-500 px-2 py-2 rounded-md"
                                                :to="
                                                    '/schedule/' +
                                                    item.id +
                                                    '/detail'
                                                "
                                                >detail</router-link
                                            >
                                            <button
                                                @click="deleteSchedule(item.id)"
                                                class="bg-red-300 rounded-md px-2 py-2 mx-5"
                                            >
                                                delete
                                            </button>
                                            <router-link
                                                class="bg-green-400 px-2 py-2 rounded-md"
                                                :to="
                                                    '/schedule/' +
                                                    item.id +
                                                    '/edit'
                                                "
                                                >edit</router-link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <router-link
                            to="/schedule/add"
                            class="mt-5 bg-indigo-400 text-white px-2 py-2 rounded-md hover:bg-indigo-600"
                            >Tambah Data Jadwal</router-link
                        >
                    </div>
                </section>
            </div>
        </div>
    </main>
    <main v-else>
        <div class="flex justify-center items-center h-[90vh]">
            <h1 class="font-bold text-4xl">kamu bukan admin sorry</h1>
        </div>
    </main>
</template>

<script>
import axios from "axios";
import { ref } from "vue";

export default {
    data() {
        return {
            place: null,
            schedule: null,
            editButton: false,
            role: null
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
        this.role = ref(localStorage.getItem("role"));
        const responsePlace = await axios.get(
            "http://localhost:8000/v1/place",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        const responseSchedule = await axios.get(
            "http://localhost:8000/v1/schedule",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        this.place = responsePlace.data.data;
        this.schedule = responseSchedule.data.data;
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
        async deleteSchedule(ScheduleId) {
            await axios.delete(
                `http://localhost:8000/v1/schedule/${ScheduleId}`,
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                }
            );
            window.location.reload();
        },
    },
};
</script>
