<template>
    <div class="relative zIndex-0">
        <div
            aria-hidden="true"
            class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20"
        >
            <div
                class="blur-[300px] h-[300px] rounded-full bg-indigo-800"
            ></div>
        </div>
    </div>
    <div class="h-[70vh] bg-[#0d1117] flex justify-center items-center">
        <div class="flex items-center justify-center min-h-[450px]">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <h1 class="text-center mb-5 text-3xl text-white">
                    Jadwal BUS Hari Ini
                </h1>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        v-if="dataJadwal && dataJadwal.length > 0"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="py-3 px-6">BUS</th>
                                <th scope="col" class="py-3 px-6">FROM</th>
                                <th scope="col" class="py-3 px-6">TO</th>
                                <th scope="col" class="py-3 px-6">DATANG</th>
                                <th scope="col" class="py-3 px-6">BERANGKAT</th>
                            </tr>
                        </thead>
                        <tbody v-for="item in dataJadwal" :key="item.id">
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <td class="py-4 px-6">{{ item.bus }}</td>
                                <td class="py-4 px-6">{{ item.from }}</td>
                                <td class="py-4 px-6">{{ item.to }}</td>
                                <td class="py-4 px-6">{{ item.datang }}</td>
                                <td class="py-4 px-6">{{ item.berangkat }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else>
                        <div class="flex justify-center items-center">
                            <h1 class="text-white text-1xl">belum ada data</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            dataJadwal: null,
        };
    },
    async created() {
        try {
            const responseJadwal = await axios.get(
                "http://localhost:8000/v1/schedule",
                {
                    headers: {
                        Accept: "application/json",
                    },
                }
            );
            const data = responseJadwal.data.data;
            this.dataJadwal = data;
            console.log(this.dataJadwal);
        } catch (error) {}
    },
};
</script>

<style lang="css" scoped></style>
