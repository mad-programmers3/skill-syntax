<template>
    <div>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <!-- Display the course thumbnail or a default image if it's not available -->
                            <img class="img-fluid"
                                 :src="course && course.thumbnail && course.thumbnail.path ? generateFileUrl(course.thumbnail.path) : baseUrl + '/images/course-def-thumbnail.jpg'"
                                 alt="Course Thumbnail">
                        </div>
                        <div class="content_wrapper">
                            <br/>
                            <h4 class="yellow-text">{{ course.title }}</h4>
                            <div class="content">
                                <div v-html="course.description" class="course-description mb-4"></div>

                                <!-- Course Details -->
                                <div class="course-details ">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Price:</strong>
                                            <span class="text-muted">${{ course.price }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Seats Available:</strong>
                                            <span class="text-muted">{{ course.sits }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Start Date:</strong>
                                            <span class="text-muted">{{ course.start_date }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">End Date:</strong>
                                            <span class="text-muted">{{ course.end_date }}</span>
                                        </li>
                                    </ul>
                                </div>

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
                                            <p class="comment mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Ut vehicula justo eget erat volutpat.</p>
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
                                            <p class="comment mb-2">Sed do eiusmod tempor incididunt ut labore et dolore
                                                magna aliqua.</p>
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
                                            <p class="comment mb-2">Quis autem vel eum iure reprehenderit qui in ea
                                                voluptate velit esse quam nihil molestiae consequatur.</p>
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
                                <textarea class="form-control" rows="4"
                                          placeholder="Share your experience..."></textarea>
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
    import axios from 'axios';

    export default {
        name: "courseDetails",
        components: {Banner_area},
        data() {
            return {
                course: null,
                baseUrl: window.location.origin
            };
        },
        mounted() {
            this.fetchData(this.urlGenerate(false, this.course_id), (result) => {
                this.course = result['course']
            });
        },

        computed: {
            course_id() {
                return this.$route.params.id;
            }
        },
        methods: {
            //
        }
    }
</script>

<style scoped>
    .yellow-text {
        color: #f39c12; /* Refined yellow color */
        font-weight: bold;
    }

    .course-details li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e0e0e0; /* Separator lines */
    }


</style>