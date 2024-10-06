
<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
            <a class="sidebar-brand brand-logo" href="index.html">
                <img :src="baseUrl + '/backend/assets/images/logo.svg'" alt="logo" />
            </a>
            <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="index.html">
                <img src="assets/images/logo-mini.svg" alt="logo" />
            </a>
        </div>

        <ul class="nav">
            <!-- Profile Section -->
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img :src="baseUrl + '/backend/assets/images/faces/face1.jpg'" alt="profile" />
                        <span class="login-status online"></span>
                    </div>
                    <div class="nav-profile-text d-flex flex-column pr-3">
                        <span class="font-weight-medium mb-2">Henry Klein</span>
                        <span class="font-weight-normal">$8,753.00</span>
                    </div>
                    <span class="badge badge-danger text-white ml-3 rounded">3</span>
                </a>
            </li>

            <!-- Dashboard -->
            <li class="nav-item">
                <router-link class="nav-link" to="/admin/dashboard">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </router-link>
            </li>

            <!-- Courses -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Course</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/course/courses">Courses</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/course/lessons">Lessons</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/course/categories">Categories</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/course/subcategories">SubCategories</router-link>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reviews -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#review-basic" aria-expanded="false" aria-controls="review-basic">
                    <i class="fa fa-star menu-icon"></i>
                    <span class="menu-title">Reviews</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="review-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/review/reviews">Reviews</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/review/course-review">Course Reviews</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/review/lesson-review">Lesson Reviews</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/review/testimonials">Testimonials</router-link>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- RolePermission Section -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#role-basic" aria-expanded="false" aria-controls="role-basic">
                    <i class="fa fa-cogs menu-icon"></i>
                    <span class="menu-title">Configs</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="role-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/config/roles">Roles</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/config/modules">Modules</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/config/manage-role">Role Configs</router-link>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'Sidebar'
    };
</script>

<style scoped>

</style>
