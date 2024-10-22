<template>
    <div class="container-scroller">
        <side-nav-bar></side-nav-bar>
        <top-nav-bar></top-nav-bar>
        <div class="main-panel">
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

        mounted() {
            const _this = this;
            this.fetchData(this.urlGenerate('api/required-data', false, {auth: true}), (result) => {
                _this.$store.commit('setAuth', result.auth);

            })
        }
    }
</script>

<style scoped>

</style>
