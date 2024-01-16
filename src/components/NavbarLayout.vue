<template>
<nav style="z-index: 2;" class="fixed flex justify-evenly items-center text-white py-5 fixed w-[100%] backdrop-blur-lg bg-opacity-30" :initial="{ y:-100 }" :enter="{ y:0 }" :on-durationchange="900">
        <div class="flex gap-[40px] items-center">
            <div class="flex items-center gap-[10px]">
                <i class="fa-solid fa-bus text-[30px]"></i>
                <h1 class="font-bold text-3xl">Terminal Bus</h1>
            </div>
            <ul class="flex gap-[10px]">
                <li><router-link to="">Home</router-link></li>
                <li><router-link to="">About</router-link></li>
                <li><router-link to="">Feature</router-link></li>
                <li><router-link to="">Contact Us</router-link></li>
            </ul>
        </div>
        <div class="flex items-center">
            <ul class="flex gap-[10px]">
                <li v-if="!token"><router-link to="/login">Login</router-link></li>
                <li v-if="!token"><router-link to="/register">Register</router-link></li>
                <li v-if="token"><router-link to="/dashboard">Dashboard</router-link></li>
                <li v-if="token"><router-link to="/logout">Logout</router-link></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data(){
        return{
            token : localStorage.getItem('token')
        }
    }
}
</script>
