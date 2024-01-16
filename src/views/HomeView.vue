<script setup>
import NavbarLayout from "@/components/NavbarLayout.vue";
import HeroLayout from "@/components/HeroLayout.vue";
import JadwalLayout from "@/components/JadwalLayout.vue";
</script>

<template>
    <main v-if="loading">
        <NavbarLayout />
        <HeroLayout />
        <JadwalLayout/>
    </main>
    <main v-else>
        <div class="relative zIndex-0">
            <div
                aria-hidden="true"
                class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20"
            >
                <div
                    class="blur-[300px] h-[300px] bg-pink-500 rounded-full"
                ></div>
                <div
                    class="blur-[300px] h-[500px] bg-purple-500 rounded-full"
                ></div>
            </div>
        </div>
        <div class="bg-[#0d1117] h-screen justify-center flex items-center text-center text-white">
            <div class="animate-bounce w-[70px] rounded-full h-[70px]">
                <i class="fa-solid fa-bus text-[50px] text-white"></i>
                <h1 class="mt-5">loading</h1>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
        };
    },
    async created() {
        setTimeout(() => {
            this.loading = true;
        }, 3500);
    },
};
</script>
