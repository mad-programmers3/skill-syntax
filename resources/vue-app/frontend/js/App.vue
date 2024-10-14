<template>
    <div>
        <header-menu v-if="showHeader === 1"></header-menu>

        <!--================ Start Home Banner Area =================-->
<!--        <home-component></home-component>-->
        <router-view></router-view>
        <!--================ End Testimonial Area =================-->


        <!--================ Start footer Area  =================-->
      <MyFooter></MyFooter>
        <!--================ End footer Area  =================-->
    </div>


</template>
<script >
 import HeaderMenu from "./components/headerMenu";
 import MyFooter from "./components/myFooter";
 import HomeComponent from "./views/homeComponent";
 export default {
     components: {HomeComponent, MyFooter, HeaderMenu}
 }
</script>
<style scoped>

</style>

