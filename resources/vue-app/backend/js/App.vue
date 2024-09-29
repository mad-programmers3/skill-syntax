<template>
    <div class="container-scroller">
        <side-nav-bar></side-nav-bar>
        <top-nav-bar></top-nav-bar>
        <div class="main-panel">
            <router-link to="/admin/roles">Roles</router-link>
            <router-link to="/admin/permissions">Permissions</router-link>
            <router-link to="/admin/modules">Modules</router-link>
            <router-link to="/admin/RoleModules">RoleModules</router-link>
            <router-link to="/admin/RolePermissions">RolePermissions</router-link>
            <router-view></router-view>
            <Footer></Footer>
        </div>
    </div>
</template>

<script>
    import SideNavBar from "./components/sideNavBar";
    import TopNavBar from "./components/topNavBar";
    import Footer from "./components/Footer";

    export default {
        name: 'App',
        components: {
            Footer,
            TopNavBar,
            SideNavBar
        },
        mounted() {}
    }
</script>

<style scoped>

</style>
