<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>

<template>
    <NavbarDashboard />
    <div class="flex justify-center items-center h-[90vh]">
        <div class="bg-gray-50 px-5 py-5 rounded-md shadow-lg">
            <h1 class="text-2xl font-bold mb-5">Buat Jadwal Bus</h1>
            <form @submit.prevent="createJadwal">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="bus" class="block text-sm font-medium mb-2"
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
                        <label for="line" class="block text-sm font-medium mb-2"
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
                        <label for="from" class="block text-sm font-medium mb-2"
                            >FROM</label
                        >
                        <select
                            id="from"
                            required
                            v-model="from"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                        >
                            <option v-for="item in data" :key="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="to" class="block text-sm font-medium mb-2"
                            >TO</label
                        >
                        <select
                            required
                            v-model="to"
                            id="to"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border"
                        >
                            <option v-for="item in data" :key="item.id">
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
                        <h1 class="text-green-400" v-if="messageSucces">{{ messageSucces }}</h1>
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
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            data: null,
            kelas: null,
            jarak: null,
            messageSucces: null,
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
        const data = await axios.get("http://localhost:8000/v1/place", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });

        this.data = data.data.data;
    },
    methods: {
        async createJadwal() {
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
                await axios.post(
                    "http://localhost:8000/v1/schedule",
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
                this.messageSucces = "Succes create jadwal";
                this.$router.push('/dashboard')
            } catch (error) {
                console.log(error.response.data);
            }
        },
    },
};
</script>
