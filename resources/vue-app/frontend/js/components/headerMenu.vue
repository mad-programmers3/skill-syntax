<template>
    <header class="header d-flex flex-row">
        <div class="header_content d-flex flex-row align-items-center">
            <!-- Logo -->
            <div class="logo_container">
                <div class="logo">
                    <img :src="baseUrl + '/frontend/images/logo.png'" alt="" />
<!--                    <img src="baseUrl + '/frontend/images/logo.png'" alt="">-->
                    <span>course</span>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="main_nav_container">
                <div class="main_nav">
                    <ul class="main_nav_list">
                        <li class="main_nav_item"><router-link to="/">home</router-link></li>
                        <li class="main_nav_item"><a href="#">about us</a></li>
                        <li class="main_nav_item"><a href="courses.html">courses</a></li>
                        <li class="main_nav_item"><a href="elements.html">elements</a></li>
                        <li class="main_nav_item"><a href="news.html">news</a></li>
                        <li class="main_nav_item"><a href="contact.html">contact</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_side d-flex flex-row justify-content-center align-items-center">

            <img :src="baseUrl + '/frontend/images/phone-call.svg'" alt="" />
<!--            <img src="{{baseurl+('frontend/images/phone-call.svg')}}" alt="">-->
            <span>+43 4566 7788 2457</span>
        </div>

        <!-- Hamburger -->
        <div class="hamburger_container">
            <i class="fas fa-bars trans_200"></i>
        </div>

    </header>

</template>
<script>
   export default {
       name:'headerMenu'
   }

</script>
<style scoped>

</style>