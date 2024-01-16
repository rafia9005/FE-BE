<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <main v-if="!message">
        <NavbarDashboard />
        <div class="flex justify-center items-center h-[90vh]">
            <div class="bg-gray-50 px-5 py-5 rounded-md shadow-lg">
                <h1 class="text-2xl font-bold mb-5" v-if="data">
                    Edit Jadwal bus {{ data.bus }}
                </h1>
                <h1 v-if="data">ID JADWAL : {{ data.id }}</h1>
                <form @submit.prevent="editSchedule" class="mt-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                for="bus"
                                class="block text-sm font-medium mb-2"
                                >Bus</label
                            >
                            <select
                                id="bus"
                                v-model="bus"
                                required
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            >
                                <option>PO HARYANTO</option>
                                <option>PO GUNUNG HARTA</option>
                                <option>PO SINAR JAYA</option>
                                <option>PO SEMPATI SINAR</option>
                                <option>PO HARAPAN JAYA</option>
                                <option>PO ROSALIA INDAH</option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="line"
                                class="block text-sm font-medium mb-2"
                                >Line</label
                            >
                            <select
                                id="line"
                                v-model="line"
                                required
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            >
                                <option>TOL</option>
                                <option>JALAN UMUM</option>
                                <option>JALAN RAYA</option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="kelas"
                                class="block text-sm font-medium mb-2"
                                >Kelas</label
                            >
                            <select
                                required
                                v-model="kelas"
                                id="kelas"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            >
                                <option>EKONOMI</option>
                                <option>BISNIS</option>
                                <option>VIP</option>
                                <option>ESKLUSIF</option>
                                <option>SUITES</option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="from"
                                class="block text-sm font-medium mb-2"
                                >FROM</label
                            >
                            <select
                                id="from"
                                required
                                v-model="from"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            >
                                <option v-for="item in dataBus" :key="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="to"
                                class="block text-sm font-medium mb-2"
                                >TO</label
                            >
                            <select
                                required
                                v-model="to"
                                id="to"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            >
                                <option v-for="item in dataBus" :key="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="berangkat"
                                class="block text-sm font-medium mb-2"
                                >BERANGKAT</label
                            >
                            <input
                                required
                                v-model="berangkat"
                                type="time"
                                id="berangkat"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            />
                        </div>
                        <div>
                            <label
                                for="datang"
                                class="block text-sm font-medium mb-2"
                                >DATANG</label
                            >
                            <input
                                v-model="datang"
                                required
                                type="time"
                                id="datang"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                            />
                        </div>
                        <div>
                            <label
                                for="jarak"
                                class="block text-sm font-medium mb-2"
                                >JARAK</label
                            >
                            <input
                                required
                                v-model="jarak"
                                type="number"
                                id="jarak"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                                placeholder="Tulis angka saja tanpa km"
                            />
                        </div>
                        <div>
                            <label
                                for="speed"
                                class="block text-sm font-medium mb-2"
                                >SPEED</label
                            >
                            <input
                                v-model="speed"
                                required
                                type="number"
                                id="speed"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                                placeholder="tulis angka saja tanpa km"
                            />
                        </div>
                        <div class="flex justify-center items-center">
                            <h1 class="text-green-400" v-if="successMessage">
                                {{ successMessage }}
                            </h1>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5"
                    >
                        Kirim
                    </button>
                </form>
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
            schedule: null,
            data: null,
            successMessage: null,
            message: null,
            parameters: this.$route.path,
            dataBus: null,
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
            const dataBus = await axios.get(`http://localhost:8000/v1/place`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                }
            })
            this.dataBus = dataBus.data.data;
        } catch (error) {

        }
    },
    methods: {
        async editSchedule() {
            const bodyData = new FormData();
            bodyData.append("bus", this.bus);
            bodyData.append("line", this.line);
            bodyData.append("kelas", this.kelas);
            bodyData.append("from", this.from);
            bodyData.append("to", this.to);
            bodyData.append("berangkat", this.berangkat);
            bodyData.append("datang", this.datang);
            bodyData.append("jarak", this.jarak);
            bodyData.append("speed", this.speed);

            try {
                await axios.put(
                    `http://localhost:8000/v1/schedule/${this.idItem}`,
                    bodyData,
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
