<template>

</template>

<script>
import axios from 'axios'
export default {
    async created(){
        localStorage.removeItem('token')
        localStorage.removeItem('role')
        this.$router.push('/login')
    }
}
</script>
