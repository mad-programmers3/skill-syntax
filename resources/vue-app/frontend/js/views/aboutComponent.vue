<template>
    <div>
        <header class="header_area white-header">
            <div class="main_menu">

                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand" href="index.html">
                            <img class="logo-2" :src="baseUrl + '/frontend/img/logo2.png'" alt="" />
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
                                <li class="nav-item active">
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
                                            <router-link class="nav-link" to="/courseDetails">Course Details</router-link>
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
                                <h2>About Us</h2>
                                <div class="page_link">
                                    <a href="index.html">Home</a>
                                    <a href="about-us.html">About Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================ Start About Area =================-->
        <section class="about_area section_gap">
            <div class="container">
                <div class="row h_blog_item">
                    <div class="col-lg-6">
                        <div class="h_blog_img">
                            <img class="img-fluid" :src="baseUrl + '/frontend/img/about.png'" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="h_blog_text">
                            <div class="h_blog_text_inner left right">
                                <h4>Welcome to our Institute</h4>
                                <p>
                                    Subdue whales void god which living don't midst lesser
                                    yielding over lights whose. Cattle greater brought sixth fly
                                    den dry good tree isn't seed stars were.
                                </p>
                                <p>
                                    Subdue whales void god which living don't midst lesser yieldi
                                    over lights whose. Cattle greater brought sixth fly den dry
                                    good tree isn't seed stars were the boring.
                                </p>
                                <a class="primary-btn" href="#">
                                    Learn More <i class="ti-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ End About Area =================-->

        <!--================ Start Feature Area =================-->
        <section class="feature_area section_gap_top title-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="main_title">
                            <h2 class="mb-3 text-white">Awesome Feature</h2>
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

        <!--================ Start Testimonial Area =================-->
        <div class="testimonial_area section_gap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="main_title">
                            <h2 class="mb-3">Client say about me</h2>
                            <p>
                                Replenish man have thing gathering lights yielding shall you
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="testi_slider owl-carousel owl-loaded owl-drag">






                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1755px, 0px, 0px); transition: all 5s ease 0s; width: 7020px;"><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t2.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Davil Saden</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 555px; margin-right: 30px;"><div class="testi_item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <img :src="baseUrl + '/frontend/img/testimonials/t1.jpg'" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="testi_text">
                                        <h4>Elite Martin</h4>
                                        <p>
                                            Him, made can't called over won't there on divide there
                                            male fish beast own his day third seed sixth seas unto.
                                            Saw from
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div><div class="owl-thumbs"></div></div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "aboutComponent"
    }
</script>

<style scoped>

</style>