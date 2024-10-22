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
                                        <a @click="doLike()" class="primary-text2"> <!-- Call doLike without parameters -->
                                            <i :class="`pointer ${auth && likes.includes(auth.id) ? 'fas' : 'far'} fa-thumbs-up`"></i>
                                            {{ likes.length }}
                                        </a>
                                    </span>
                                    <span class="meta_info">
                                       <a href="#review-area" class="primary-text2"> <i class="far fa-comment"></i> {{ reviews.length }} </a>
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
                                            <img :src="generateFileUrl(auth ? auth.avatar : null, TYPE_USER)" alt="User Avatar" />
                                        </div>
                                        <div class="user-details flex-grow-1">
                                            <h6 class="mb-1">{{ review.user ? review.user.name : ''}}</h6>
                                            <!-- Display the comment or the textarea for editing -->
                                            <div v-if="isUpdating(review)">
                                                <textarea v-model="review.comment" class="form-control" rows="4" placeholder="Update your review..."></textarea>
                                            </div>
                                            <div v-else>
                                                <p class="comment mb-2">{{ review.comment }}</p>
                                            </div>

                                            <div class="review-footer mt-2 d-flex justify-content-between">
                                                <div>
                                                    <a @click="doLike(TYPE_LIKE_REVIEW, review.id)" class="mr-3 primary-text2">
                                                        <i :class="`pointer ${auth && reviewsLikes[review.id].includes(auth.id) ? 'fas' : 'far' } fa-thumbs-up`"></i> {{reviewsLikes[review.id].length}}
                                                    </a>
                                                    <a class="mr-3 primary-text2">
                                                        <i class="pointer fas fa-reply"></i>
                                                    </a>
                                                    <a v-if="auth && review.user.id === auth.id" class="primary-text2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="pointer fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a @click="handleDropDown('edit', review)" class="dropdown-item pointer">Edit</a>
                                                        <a @click="handleDropDown('delete', review)" class="dropdown-item pointer">Delete</a>
                                                        <a @click="handleDropDown('hide', review)" class="dropdown-item pointer">Hide</a>
                                                    </div>
                                                </div>
                                                <div v-if="isUpdating(review)">
                                                    <button @click="cancelUpdate" class="genric-btn danger circle">Cancel</button>
                                                    <button @click="submitReview" class="genric-btn info circle arrow">Update<span class="ti-arrow-right"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="review-area">
                                <!-- If the user is logged in and has not already reviewed the course -->
                                <div>
                                    <div class="feedback mb-4">
                                        <div class="d-flex justify-content-between">
                                            <h4>Give your opinion</h4>
                                        </div>
                                        <div>
                                            <textarea v-model="form.comment" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                            <div class="text-right mt-3">
                                                <button @click="submitReview()" class="genric-btn primary-bg2 text-white circle arrow">Submit<span class="ti-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 right-contents" v-if="lesson && lesson.course">
                        <h4 class="title mt-5">Lessons</h4>
                        <div class="playlist">
                            <div v-for="less in lesson.course.lessons" :key="less.id"
                                 :class="['card mb-3', { 'highlight-card': lesson.id === less.id }]">
                                <router-link :to="{ name: 'lesson', params: { id: less.id } }" class="row no-gutters">
                                    <div class="col-md-4 justify-content-center">
                                        <img
                                                class="img-fluid"
                                                :src="baseUrl + '/frontend/img/courses/c2.jpg'"
                                                alt="Course Image"
                                                style="border: 1px solid #ddd; padding: 5px; margin: 10px; border-radius: 8px;"
                                        >
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ less.title }}</h6>
                                            <p class="card-text">Duration: 10 mins</p>
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
                lesson: [],
                reviews: [],
                likes: [],
                reviewsLikes: {},
                form: {
                    comment: '',
                },
                TYPE_LIKE_LESSON: 11,
                TYPE_LIKE_REVIEW: 12,

            };
        },
        watch: {
            // Watch for changes in lesson_id
            lesson_id(newId, oldId) {
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
                return this.$route.params.id;
            }
        },
        methods: {
            fetchLesson(id) {
                const _this = this;
                this.fetchData(this.urlGenerate(false, id), (result) => {
                    _this.lesson = result['lesson'];
                    _this.reviews = result['reviews'];
                    _this.likes = result['likes'];
                    _this.reviewsLikes = result['reviews-likes'];
                    _this.form.user_id = _this.auth ? _this.auth.id : null;
                    _this.form.lesson_id = _this.lesson ? _this.lesson.id : null;

                    _this.checkUserReview();
                });
            },
            handleDropDown(action, review) {
                this.$nextTick(() => {
                    $('#dropdownMenuButton').dropdown('toggle');
                });
                if (action === 'edit') this.form = review;
                if (action === 'delete') this.deleteReview(review.id);

            },
            submitReview() {
                if (!this.form.comment.trim()) {
                    alert('Please enter your comment before submitting.');
                    return;
                }

                const _this = this;
                this.httpReq({
                    customUrl: this.form.id ? 'api/reviews' : 'api/review/lesson-reviews',
                    method: this.form.id ? 'put' : 'post',
                    urlSuffix: this.form.id ?? false,
                    data: _this.form,
                    callback(response) {
                        if (response.data) {
                            const newReview = response.data.result;

                            if (!_this.form.id) {
                                newReview.user = _this.auth;
                                _this.reviewsLikes[newReview.id] = [];
                                _this.reviews.push(newReview);
                                _this.hasReviewed = true;
                            }
                            _this.form = {
                                comment: '',
                            };
                            _this.fetchLesson(_this.lesson_id);
                        } else {
                            alert('Failed to submit the review. Please try again.');
                        }
                    },
                });
            },

            deleteReview(id) {
                this.httpReq({
                    customUrl: 'api/reviews',
                    urlSuffix: id,
                    method: 'delete',
                    callback: (response) => {
                        if (response.data) {
                            this.reviews = this.reviews.filter(review => review.id !== id);
                            this.hasReviewed = false;
                        }
                    }
                });
            },

            cancelUpdate() {
                this.form = {
                    rating: 0,
                    comment: '',
                };
            },

            isUpdating(review) {
                return this.form && this.form.id === review.id;
            },

            doLike(type = this.TYPE_LIKE_LESSON, id = this.lesson.id) {
                const auth = this.auth;
                if (!auth) return;

                let customUrl = 'api/lessons/do-like';
                let likesArr = this.likes;
                let data = {lesson_id: id,};

                if (type === this.TYPE_LIKE_REVIEW) {
                    customUrl = 'api/reviews/do-like';
                    likesArr = this.reviewsLikes[id];
                    data = {review_id: id}
                }

                const _this = this;
                this.httpReq({
                    customUrl,
                    method: 'post',
                    data,
                    callback(response) {
                        if (response.data.result === 1)
                            likesArr.push(auth.id);
                        else if(response.data.result === 0)
                            _this.removeArrItem(likesArr, auth.id);
                        else
                            _this.showToast('Failed to like the course. Please try again.', 'error')
                    }
                });
            }
        },
    }
</script>

<style scoped>
    .review-item .user-thumb img {
        width: 50px;
        border-radius: 50%;
    }

    .playlist {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px;
        background-color: #002347;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .playlist .card {
        border: 0;
        border-bottom: 1px solid #e0e0e0;
        background-color: #fff;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        color: #333;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .playlist .card:hover {
        background-color: #f1f1f1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .playlist .highlight-card {
        background-color: #f5f5f5;
        border-left: 3px solid #e91e63;
    }

    .card-body h6 {
        color: #002347;
        font-size: 0.8rem;
    }

    .card-body p {
        color: #777;
        font-size: 0.8rem;
    }

    img.img-fluid {
        border-radius: 8px;
        border: 1px solid #e91e63;
        padding: 3px;
    }

</style>
