<template>
    <div>
        <header class="header_area white-header">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand" href="index.html">
                            <img class="logo-2" :src="baseUrl + '/frontend/img/logo2.png'" alt=""/>
                        </a>
                        <button
                                class="navbar-toggler"
                                type="button"
                                data-toggle="collapse"
                                data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                        >
                            <span class="icon-bar"></span> <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div
                                class="collapse navbar-collapse offset"
                                id="navbarSupportedContent"
                        >
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/">Home</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/about">About</router-link>
                                </li>
                                <li class="nav-item submenu dropdown active">
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
                                            <router-link class="nav-link" to="/courseDetails">Course Details
                                            </router-link>
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
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!--================ End Header Menu Area =================-->

        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="banner_content text-center">
                                <h2>Courses</h2>
                                <div class="page_link">
                                    <a href="index.html">Home</a>
                                    <a href="courses.html">Courses</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================ Start Popular Courses Area =================-->
        <div class="popular_courses mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="main_title">
                            <h2 class="mb-3">Our Popular Courses</h2>
                            <p>
                                Replenish man have thing gathering lights yielding shall you
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div v-for="course in courses" :key="course.id" class="col-md-4 mb-3" >
                        <div class="single_course">
                            <div class="course_head">
                                <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c3.jpg'" alt="">
                            </div>
                            <div class="course_content">
                                <span class="price">{{ course.price }}</span>
                                <span class="tag mb-4 d-inline-block">{{ course.title }}</span>
                                <h4 class="mb-3">
                                    <a href="course-details.html">{{ course.title }}</a>
                                </h4>
                                <p>{{ course.description }}</p>
                                <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                                    <div class="authr_meta">
                                        <img :src="baseUrl + '/frontend/img/courses/author3.png'"
                                             alt="">
                                        <span class="d-inline-block ml-2">Cameron</span>
                                    </div>
                                    <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-user mr-2"></i>25 </a>
                                      </span>
                                        <span class="meta_info">
                                            <a href="#"> <i class="ti-heart mr-2"></i>35 </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================ End Popular Courses Area =================-->

        <!--================ Start Registration Area =================-->
        <div class="section_gap registration_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="row clock_sec clockdiv" id="clockdiv">
                            <div class="col-lg-12">
                                <h1 class="mb-3">Register Now</h1>
                                <p>
                                    There is a moment in the life of any aspiring astronomer that
                                    it is time to buy that first telescope. It’s exciting to think
                                    about setting up your own viewing station.
                                </p>
                            </div>
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">150</h1>
                                <span class="smalltext">Days</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Hours</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes">47</h1>
                                <span class="smalltext">Mins</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Secs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <div class="register_form">
                            <h3>Courses for Free</h3>
                            <p>It is high time for learning</p>
                            <form
                                    class="form_area"
                                    id="myForm"
                                    action="mail.html"
                                    method="post"
                            >
                                <div class="row">
                                    <div class="col-lg-12 form_group">
                                        <input
                                                name="name"
                                                placeholder="Your Name"
                                                required=""
                                                type="text"
                                        />
                                        <input
                                                name="name"
                                                placeholder="Your Phone Number"
                                                required=""
                                                type="tel"
                                        />
                                        <input
                                                name="email"
                                                placeholder="Your Email Address"
                                                pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                                required=""
                                                type="email"
                                        />
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================ End Registration Area =================-->

        <!--================ Start Feature Area =================-->
        <section class="feature_area section_gap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="main_title">
                            <h2 class="mb-3">Awesome Feature</h2>
                            <p>
                                Replenish man have thing gathering lights yielding shall you
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_feature">
                            <div class="icon"><span class="flaticon-student"></span></div>
                            <div class="desc">
                                <h4 class="mt-3 mb-2">Scholarship Facility</h4>
                                <p>
                                    One make creepeth, man bearing theira firmament won't great
                                    heaven
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="single_feature">
                            <div class="icon"><span class="flaticon-book"></span></div>
                            <div class="desc">
                                <h4 class="mt-3 mb-2">Sell Online Course</h4>
                                <p>
                                    One make creepeth, man bearing theira firmament won't great
                                    heaven
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="single_feature">
                            <div class="icon"><span class="flaticon-earth"></span></div>
                            <div class="desc">
                                <h4 class="mt-3 mb-2">Global Certification</h4>
                                <p>
                                    One make creepeth, man bearing theira firmament won't great
                                    heaven
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ End Feature Area =================-->
    </div>


</template>


<script>
    import axios from 'axios';

    export default {
        name: "coursesComponent",

        data() {
            return {
                courses: [], // Store courses here
            };
        },
        mounted() {
            this.fetchCourses();
        },
        methods: {
            async fetchCourses() {
                try {
                    const response = await axios.get('/api/courses');
                    this.courses = response.data.result;
                } catch (error) {
                    console.error('Failed to fetch courses:', error);
                }
            },
        },
    }
</script>

<style scoped>

</style>