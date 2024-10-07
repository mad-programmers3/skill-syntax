<template>
    <div>
        <!--================ Start Header Menu Area =================-->
        <header class="header_area yellow-header">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container" style="background-color: white">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <router-link class="navbar-brand logo_h" to="/">
                            <img :src="baseUrl + '/frontend/img/logo.png'" alt=""/>
                        </router-link>
                        <button
                                class="navbar-toggler"
                                type="button"
                                data-toggle="collapse"
                                data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="icon-bar"></span> <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/">Home</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/about">About</router-link>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a
                                            href="#"
                                            class="nav-link dropdown-toggle"
                                            data-toggle="dropdown"
                                            role="button"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                    >Pages</a
                                    >
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <router-link class="nav-link" to="/courses">Courses</router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link class="nav-link" to="/elements">Elements</router-link>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a
                                            href="#"
                                            class="nav-link dropdown-toggle"
                                            data-toggle="dropdown"
                                            role="button"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                    >Blog</a
                                    >
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <router-link class="nav-link" to="/blog">Blog</router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link class="nav-link" to="/blogDetails">Blog Details</router-link>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/contact">Contact</router-link>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link search" id="search">
                                        <i class="ti-search"></i>
                                    </a>
                                </li>
                            </ul>
                            <div>
                                <li class="nav-item nav-profile dropdown border-0">
                                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                                        <img class="nav-profile-img " alt="" :src="baseUrl + '/backend/assets/images/faces/face1.jpg'" />
                                        <span class="profile-name">{{ userName }}</span>
                                    </a>
                                    <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                                        <a v-if="getAuth()" class="dropdown-item" href="#" @click.prevent="confirmLogout">
                                            <i class="mdi mdi-logout mr-2 text-primary"></i> Logout
                                        </a>
                                        <a v-else class="dropdown-item" href="/login">
                                            <i class="mdi mdi-login mr-2 text-primary"></i> LogIn
                                        </a>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!--================ End Header Menu Area =================-->
    </div>


</template>
<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';
    export default {
        name: 'HeaderMenu',
        computed: {
            userName() {
                const user = this.getAuth();
                return user ? user.name : 'Guest';
            }
        },
        methods: {
            confirmLogout() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to log out?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#28a745',
                    confirmButtonText: 'Yes, log out!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.logout();
                    }
                });
            },
            async logout() {
                try {
                    await axios.post('/logout');
                    this.$store.commit('logout');
                    window.location.href = '/login';
                } catch (error) {
                    console.error('Logout failed:', error);
                }
            }
        }

    }

</script>
<style scoped>

    .nav-profile-img {
        width: 40px; /* Set the desired width */
        height: 40px; /* Set the desired height */
        border-radius: 50%; /* Make it circular */
        border: 2px solid #fff; /* Add a white border */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        object-fit: cover; /* Ensure the image covers the element without distortion */
    }

    .profile-name {
        font-weight: bold;
        color: #333;
        margin-left: 5px;
    }

</style>