<template>
    <div>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left" v-if="lesson">
                        <div class="main_image">
                            <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/course-details.jpg'" alt="">
                        </div>
                        <div class="content_wrapper">
                            <div class="title d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">{{ lesson.title }}</h4> <!-- Added mb-0 to remove margin from the heading -->
                                <div>
                                    <span class="meta_info mr-3">
                                        <i class="ti-thumb-up"> {{ likes.length }}</i>
                                    </span>
                                    <span class="meta_info">
                                        <i class="ti-comment"> {{ reviews.length }}</i>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h4>Course title</h4>
                            </div>
                            <div class="content">
                                {{ lesson.description }}
                                <br>
                                <br>
                            </div>

                            <h4 class="title">Comments</h4>
                            <div class="reviews-list">
                                <h6 class="mb-3">Recent Comments</h6>
                                <div v-for="review in reviews" :key="review.id" class="review-item mb-3">
                                    <div class="user-info d-flex align-items-start justify-content-between">
                                        <div class="user-thumb mr-3">
                                            <img :src="baseUrl + '/frontend/img/courses/author2.png'" alt="User Image">
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">{{ review.user.name  }}</h6> <!-- Replace with actual user info if available -->
                                            <p class="comment mb-2">{{ review.comment }}</p>
                                            <div class="review-footer mt-2">
                                                <a href="#" class="mr-3">
                                                    <i class="ti-thumb-up"></i> 25 <!-- This can be dynamic if likes data is available -->
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

                    <div class="col-lg-4 right-contents" v-if="lesson && lesson.course">
                        <h4 class="title mt-5">Lessons</h4>
                        <div class="playlist">
                            <div v-for="less in lesson.course.lessons" :key="less.id" :class="['card mb-3', { 'highlight-card': lesson.id === less.id }]">
                                <router-link :to="{ name: 'lesson', params: { id: less.id } }" class="row no-gutters">

                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c2.jpg'"
                                                alt="Course Image"
                                                style="margin: 10px; padding: 5px;">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ less.title }}</h5>
                                        </div>
                                    </div>
                                </router-link>
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
                lesson: null,
                reviews: null,
                likes: null,
            };
        },
        watch: {
            // Watch for changes in lesson_id
            lesson_id(newId, oldId) {
                // Refetch data when the lesson_id changes
                if (newId !== oldId) {
                    this.fetchLesson(newId);
                }
            }
        },
        mounted() {
            this.fetchLesson(this.lesson_id);
        },
        computed: {
            lesson_id() {
                return this.$route.params.id; // Get the current lesson ID from the route
            }
        },
        methods: {
            fetchLesson(id) {
                const _this = this;
                this.fetchData(this.urlGenerate(false, id), (result) => {
                    _this.lesson = result['lesson'];
                    _this.reviews = result['reviews'];
                    _this.likes = result['likes'];
                });
            },
            doLike() {
                console.log(888);
            }
        }
    }
</script>

<style scoped>
    .meta_info i {
        color: #ff5e14;
    }

    .meta_info a {
        color: #ff5e14;
    }

    .review-footer i {
        color: #ff5e14;
    }

    .review-footer a {
        color: #ff5e14;
    }
    .card {

        border-radius: 8px;
    }

    .highlight-card {
        border: 2px solid #ff5e14; /* Blue border for highlighted card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }


</style>

