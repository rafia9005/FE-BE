<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>
<template>
    <NavbarDashboard />
    <div
        class="bg-gray-200 font-sans h-screen w-full flex flex-row justify-center items-center"
    >
        <div class="card w-96 mx-auto bg-white shadow-xl hover:shadow">
            <img
                class="w-32 mx-auto rounded-full -mt-20 border-8 border-white"
                src="https://www.rafii.site/pp.png"
                alt=""
            />
            <div class="text-center mt-2 text-3xl font-medium" v-if="data"> {{ data.name }} </div>
            <div class="text-center mt-2 font-light text-sm"> @{{ data.username }} </div>
            <div class="text-center font-normal text-lg">role : {{ data.role }}</div>
            <div class="px-6 text-center mt-2 font-light text-sm">
                <p>
                    {{ data.bio }}
                </p>
            </div>
            <hr class="mt-8" />
            <div class="flex p-4">
                <div class="w-1/2 text-center">
                    <span class="font-bold">1.8 k</span> Followers
                </div>
                <div class="w-0 border border-gray-300"></div>
                <div class="w-1/2 text-center">
                    <span class="font-bold">2.0 k</span> Following
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
            data: null,
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }

        const response = await axios.get('http://localhost:8000/v1/profile', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            }
        })
        this.data = response.data;
    },
};
</script>
