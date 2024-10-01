<template>
    <div>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/course-details.jpg'" alt="">
                        </div>
                        <div class="content_wrapper">
                            <h4 class="title">{{lesson.title}}</h4>
                            <div class="content">
                                {{lesson.description}}
                                <br>
                                <br>

                            </div>

                            <h4 class="title">Commends</h4>
                            <div class="reviews-list">
                                <h6 class="mb-3">Recent Commends</h6>
                                <div v-for="review in lesson.reviews" :key="review.id" class="review-item mb-3">
                                    <div class="user-info d-flex align-items-start justify-content-between">
                                        <div class="user-thumb mr-3">
                                            <img :src="baseUrl + '/frontend/img/courses/author2.png'" alt="">
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">{{ review.review.user.name }}</h6>
                                            <p class="comment mb-2">{{ review.review.comment }}</p>
                                            <div class="review-footer mt-2">
                                                <a href="#" class="mr-3">
                                                    <i class="ti-thumb-up"></i> 25
                                                </a>
                                                <a href="#">
                                                    <i class="ti-reply"></i> Reply
                                                </a>
                                            </div>
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

    export default {
        name: "lessonDetails",
            props: ['lessonId'],
            data() {
                return {
                    lesson: [],
                };
            },
            mounted() {
                this.fetchData(this.urlGenerate(false, this.lesson_id), (result) => {
                    this.lesson = result['lesson']
                });
            },

            computed: {
                lesson_id() {
                    return this.$route.params.id;
                }
            },

    }
</script>

<style scoped>

</style>