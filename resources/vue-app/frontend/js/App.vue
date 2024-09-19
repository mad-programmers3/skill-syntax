<template>
    <div class="super_container">
        <header-menu></header-menu>
        <div class="home">
           <main>
               <router-view></router-view>
           </main>
            <my-footer></my-footer>
        </div>
    </div>
</template>
<script>
    import HeaderMenu from "./components/headerMenu";
    import MyFooter from "./components/myFooter";
    import HomeComponent from "./views/homeComponent";
    export default {
        components: {HomeComponent, MyFooter, HeaderMenu}
    }
</script>
<style scoped>

</style>