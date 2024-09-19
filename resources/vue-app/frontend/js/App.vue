<template>
    <div class="super_container">

        <header-menu />

        <router-view></router-view>

        <my-footer />

    </div>
</template>
<script>
    import HeaderMenu from "./components/headerMenu";
    import HomeComponent from "./views/homeComponent";
    import MyFooter from "./components/myFooter";
    export default {
        components: {MyFooter, HomeComponent, HeaderMenu}

    }
</script>
<style scoped>

</style>