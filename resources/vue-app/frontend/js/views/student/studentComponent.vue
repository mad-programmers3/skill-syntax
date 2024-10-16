<!-- Parent.vue -->
<template>
    <div>
        <header>
            <div class="container">
                <!-- Horizontal Navigation with Font Awesome Icons -->
                <div class="nav-container">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <span @click="goHome()" class="nav-link pointer"><i class="fas fa-home"></i>Home</span>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-myCourses'}" class="nav-link"><i class="fas fa-book"></i> My Courses</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-wishlist'}" class="nav-link"><i class="fas fa-heart"></i> Wishlist</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-messages'}" class="nav-link"><i class="fas fa-envelope"></i> My messages</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-purchaseHistory'}" class="nav-link"><i class="fas fa-history"></i> Purchase History</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-profile'}" class="nav-link"><i class="fas fa-user"></i> Profile</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'student-settings'}" class="nav-link"><i class="fas fa-cog"></i> Settings</router-link> <!-- New Settings Item -->
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- This is where child routes will be rendered -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'studentDashboardComponent',

        data() {
            return {
                beforeHeader: this.UI_HEADER_REGULAR,
                beforeFooter: this.UI_FOOTER_REGULAR,
            };
        },
        mounted() {
            this.beforeHeader = this.$store.getters.showHeader;
            this.beforeFooter = this.$store.getters.showFooter;
            this.$store.commit('setShowHeader', this.UI_HEADER_HIDE);
            this.$store.commit('setShowFooter', this.UI_FOOTER_MINI);
        },
        methods: {
            goHome() {
                this.$router.push('/');
            }
        },
        beforeDestroy() {
            this.$store.commit('setShowHeader', this.beforeHeader);
            this.$store.commit('setShowFooter', this.beforeFooter);
        }
    }
</script>
<style scoped>
    .nav-container {
        background-color: #fff;
        border-radius: 0.5rem;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
        margin-top: 20px;
    }

    .nav-item {
        margin-right: 20px;
    }

    .nav-link {
        font-weight: bold;
        color: #333;
        text-transform: capitalize;
    }

    .nav-link:hover {
        color: #fdc632; /* Green hover effect */
    }

    .active {
        background-color: #fdc632;
        color: white !important;
        border-radius: 0.25rem;
        padding: 5px 15px;
    }

    /* Adding space between icon and text */
    .nav-link i {
        margin-right: 8px;
    }
</style>
