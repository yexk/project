<template>
    <div>
        <router-link to="/"><el-button>home</el-button></router-link>
        <router-link to="/test"><el-button>test</el-button></router-link>
        <hr>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
