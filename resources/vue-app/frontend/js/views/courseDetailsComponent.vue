<template>
    <div>

        <banner_area />


        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/course-details.jpg'" alt="">
                        </div>
                        <div class="content_wrapper">
                            <h4 class="title">Objectives</h4>
                            <div class="content">
                                When you enter into any new area of science, you almost always find yourself with a
                                baffling new language of
                                technical terms to learn before you can converse with the experts. This is certainly
                                true in astronomy both in
                                terms of terms that refer to the cosmos and terms that describe the tools of the trade,
                                the most prevalent
                                being the telescope.
                                <br>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea
                                commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum. Lorem ipsum dolor sit
                                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim
                                ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat. Duis aute
                                irure dolor in reprehenderit in voluptate velit esse cillum.
                            </div>

                            <h4 class="title">Reviews</h4>
                            <div class="reviews-list">
                                <h6 class="mb-3">Recent Reviews</h6>
                                <div class="review-item mb-3">
                                    <div class="user-info d-flex align-items-start justify-content-between">
                                        <div class="user-thumb mr-3">
                                            <img :src="baseUrl + '/frontend/img/courses/author2.png'" alt="">
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">Emilly Blunt</h6>
                                            <p class="comment mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula justo eget erat volutpat.</p>
                                            <div class="review-footer mt-2">
                                                <a href="#" class="mr-3">
                                                    <i class="ti-thumb-up"></i> 25
                                                </a>
                                                <a href="#">
                                                    <i class="ti-reply"></i> Reply
                                                </a>
                                            </div>
                                        </div>
                                        <div class="star-rating d-flex align-items-center">
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="review-item mb-3">
                                    <div class="user-info d-flex align-items-start justify-content-between">
                                        <div class="user-thumb mr-3">
                                            <img :src="baseUrl + '/frontend/img/courses/author1.png'" alt="">
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">Elsie Cunningham</h6>
                                            <p class="comment mb-2">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                            <div class="review-footer mt-2">
                                                <a href="#" class="mr-3">
                                                    <i class="ti-thumb-up"></i> 25
                                                </a>
                                                <a href="#">
                                                    <i class="ti-reply"></i> Reply
                                                </a>
                                            </div>
                                        </div>
                                        <div class="star-rating d-flex align-items-center">
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="review-item mb-3">
                                    <div class="user-info d-flex align-items-start justify-content-between">
                                        <div class="user-thumb mr-3">
                                            <img :src="baseUrl + '/frontend/img/courses/author3.png'" alt="">
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">Maria Luna</h6>
                                            <p class="comment mb-2">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>
                                            <div class="review-footer mt-2">
                                                <a href="#" class="mr-3">
                                                    <i class="ti-thumb-up"></i> 25
                                                </a>
                                                <a href="#">
                                                    <i class="ti-reply"></i>Reply
                                                </a>
                                            </div>
                                        </div>
                                        <div class="star-rating d-flex align-items-center">
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star checked"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback mb-4">
                                <h6>Your Feedback</h6>
                                <textarea class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                <div class="text-right mt-3">
                                    <button class="btn btn-primary text-uppercase">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 right-contents">
                        <h4 class="title mt-5">Lessons</h4>
                        <div class="playlist">
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c1.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                      </span>
                                                <span class="meta_info">
                                            <a href="#"> <i class="ti-comment"></i>35 </a>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c2.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                      </span>
                                                <span class="meta_info">
                                            <a href="#"> <i class="ti-comment"></i>35 </a>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c3.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                              <span class="meta_info mr-4">
                                                <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                              </span>
                                                        <span class="meta_info">
                                                    <a href="#"> <i class="ti-comment"></i>35 </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c2.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                      </span>
                                                <span class="meta_info">
                                            <a href="#"> <i class="ti-comment"></i>35 </a>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c1.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                      </span>
                                                <span class="meta_info">
                                            <a href="#"> <i class="ti-comment"></i>35 </a>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c3.jpg'" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#"><h5 class="card-title">Chapter 2: Advanced Topics</h5></a>
                                            <div class="mt-lg-0 mt-3">
                                      <span class="meta_info mr-4">
                                        <a href="#"> <i class="ti-thumb-up"></i>25 </a>
                                      </span>
                                                <span class="meta_info">
                                            <a href="#"> <i class="ti-comment"></i>35 </a>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!--================ End Course Details Area =================-->
    </div>

</template>

<script>
    import Banner_area from "../components/sections/banner_area";
    export default {
        name: "courseDetailsComponent.vue",
        components: {Banner_area}
    }
</script>

<style scoped>

</style>