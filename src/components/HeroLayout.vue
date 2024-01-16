<template>
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
    <div class="hero flex justify-center items-center h-screen text-white text-center zIndex-1">
        <div class="w-1/2">
            <div v-motion :initial="{ y:200 }" :enter="{ y: 0 }" :on-durationchange="900">
                <h1 class="font-semibold text-5xl">Easily Access Bus Route Information on Your Mobile</h1>
                <p class="mt-5">Easy to use The simple and intuitive interface makes it easy to find the information you need.</p>
                <div class="mt-5 flex gap-[20px] justify-center items-center">
                    <router-link to="" class="bg-blue-200 backdrop-blur-lg bg-opacity-30 text-white px-3 py-2 rounded-sm">Get Started</router-link>
                    <router-link to="" class="bg-blue-200 backdrop-blur-lg bg-opacity-30 text-white px-3 py-2 rounded-sm">Download</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

</script>

<style lang="css" scoped>
.hero {
    background: #0d1117;
}
</style>
