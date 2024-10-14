<template>
    <div>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <!-- Display the course thumbnail or a default image if it's not available -->
                            <img class="img-fluid" :src="course ? generateFileUrl(course.thumbnail) : baseUrl + '/images/course-def-thumbnail.jpg'" alt="Course Thumbnail" style="padding: 10px;"/>
                        </div>
                        <div class="content_wrapper">
                            <br />
                            <h3 >{{ course ? course.title : '' }}</h3>
                            <div class="content">
                                <div v-html="course ? course.description : ''" class="course-description mb-4"></div>
                                <!-- Course Details -->
                                <div class="course-details">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <h5>Price:</h5>
                                            <span class="text-muted">${{ course ? course.price : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <h5>Seats Available:</h5>
                                            <span class="text-muted">{{ course ? course.sits : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <h5>Start Date:</h5>
                                            <span class="text-muted">{{ course ? course.start_date : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <h5>End Date:</h5>
                                            <span class="text-muted">{{ course ? course.end_date : '' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Course Review Section -->
                            <h4 class="title">Reviews ({{ reviews.length }})</h4>
                            <div class="mb-30">
                                <div class="reviews-list">
                                    <h6 class="mb-3">Recent Reviews</h6>
                                    <div v-for="review in reviews" :key="review.id" class="review-item mb-3">
                                        <div class="user-info d-flex align-items-start justify-content-between">
                                            <div class="user-thumb mr-3">
                                                <img :src="generateFileUrl(getAuth() ? getAuth.avatar : null, DEF_AVATAR_B)" alt="User Avatar" />
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
                                                        <a class="mr-3 primary-text2">
                                                            <i class="pointer fa fa-thumbs-up"></i> {{ likes.length }}
                                                        </a>
                                                        <a class="mr-3 primary-text2">
                                                            <i class="pointer fa fa-reply"></i>
                                                        </a>
                                                        <a v-if="review.user.id === getAuth().id" class="primary-text2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="pointer fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a @click="handleDropDown('edit', review)" class="dropdown-item pointer">Edit</a>
                                                            <a @click="handleDropDown('delete', review)" class="dropdown-item pointer">Delete</a>
                                                            <a @click="handleDropDown('hide', review)" class="dropdown-item pointer">Hide</a>
                                                        </div>
                                                    </div>
                                                    <div v-if="isUpdating(review)" >
                                                        <button @click="cancelUpdate" class="genric-btn danger circle">Cancel</button>
                                                        <button @click="submitReview" class="genric-btn info circle arrow">Update<span class="ti-arrow-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="isUpdating(review)" class="star-rating d-flex mb-2">
                                                <i v-for="rate in 5" :class="'primary-text ' + getStarClass(rate)"
                                                   @mouseover="setHoverRating(rate)"
                                                   @mouseleave="setHoverRating(0)"
                                                   @click="setRating(rate)"
                                                   style="cursor: pointer; font-size: 25px">
                                                </i>
                                            </div>
                                            <div v-else class="star-rating primary-text d-flex mb-2">
                                                <i v-for="rate in 5" :class="['fa', rate <= review.rating ? 'fa-star' : 'fa-star-o']"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Area (New review) -->
                            <div id="review-area">
                                <div v-if="!getAuth()" class="text-center">
                                    <h5>You need to be logged in to provide feedback</h5>
                                    <a class="primary-btn" :href="urlGenerate('login', false, { url: currentUrl + '#review-area' })">Log In</a>
                                </div>
                                <!-- If the user is logged in and has not already reviewed the course -->
                                <div v-else-if="!hasReviewed">
                                    <div class="feedback mb-4">
                                        <div class="d-flex justify-content-between">
                                            <h4>Leave Your Review</h4>
                                            <!-- Star Rating for new review -->
                                            <div class="star-rating d-flex mb-2">
                                                <i v-for="rate in 5" :class="'primary-text ' + getStarClass(rate)"
                                                   @mouseover="setHoverRating(rate)"
                                                   @mouseleave="setHoverRating(0)"
                                                   @click="setRating(rate)"
                                                   style="cursor: pointer; font-size: 25px">
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <textarea v-model="form.comment" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                            <div class="text-right mt-3">
                                                <button @click="submitReview" class="genric-btn primary-bg2 text-white circle arrow">Submit<span class="ti-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- If the user has already reviewed the course -->
                                <div v-else class="text-center">
                                    <h5>You have already provided feedback for this course.</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Lessons Section -->
                    <div class="col-lg-4 right-contents" v-if="course && course.lessons">
                        <h4 class="title mt-5">Lessons</h4>
                        <div class="playlist">
                            <div v-for="lesson in course.lessons" :key="lesson.id" class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c1.jpg'" alt="" style="margin: 10px; padding: 5px;" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <router-link :to="{ name: 'lesson', params: { id: lesson.id } }" :class="{ 'font-weight-bold': lesson.id === lesson_id }">
                                                <h5 class="card-title">{{ lesson.title }}</h5>
                                            </router-link>
                                            <div class="mt-lg-0 mt-3">
                                                <span class="meta_info mr-4">
                                                    <a href="#" class="primary-text2"> <i class="fa fa-thumbs-up"></i> {{ likes.length }} </a>
                                                </span>
                                                <span class="meta_info padded-info">
                                                    <a href="#" class="primary-text2"> <i class="fa fa-comment"></i> {{ reviews.length }} </a>
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
        name: "courseDetails",
        props: ['courseId'],
        data() {
            return {
                course: null,
                reviews: [],
                likes: [],
                form: {
                    rating: 0,
                    comment: '',
                },
                hoverRating: 0,
                hasReviewed: false,
            };
        },
        mounted() {
            this.fetchCourseData();
        },
        methods: {
            // Fetch course and related data
            fetchCourseData() {
                const _this = this;
                this.fetchData(this.urlGenerate(false, this.course_id), (result) => {
                    _this.course = result['course'];
                    _this.reviews = result['reviews'];
                    _this.likes = result['likes'];
                    _this.form.user_id = _this.getAuth() ? _this.getAuth().id : null; // Set user_id from auth
                    _this.form.course_id = _this.course ? _this.course.id : null;

                    _this.checkUserReview();
                });
            },

            handleDropDown(action, review) {
                // Close the dropdown
                this.$nextTick(() => {
                    $('#dropdownMenuButton').dropdown('toggle'); // Close the dropdown manually
                });

                // Perform your action logic here based on the action type
                if (action === 'edit') this.form = review;
                if (action === 'delete') this.deleteReview(review.id);

            },

            // Check if the user has already reviewed the course
            checkUserReview() {
                const user = this.getAuth();
                if (user) {
                    const userId = user.id;
                    this.hasReviewed = this.reviews.some((review) => review.user.id === userId);
                }
            },


            // Handle submitting a new review
            submitReview() {
                if (!this.form.comment.trim()) {
                    alert('Please enter your comment before submitting.');
                    return;
                }

                const _this = this;
                this.httpReq({
                    customUrl: this.form.id ? 'api/reviews' : 'api/review/course-reviews',
                    method: this.form.id ? 'put' : 'post',
                    urlSuffix: this.form.id ?? false,
                    data: _this.form,
                    callback(response) {
                        if (response.data) {
                            // Update the review list
                            const newReview = response.data.result;

                            if (!_this.form.id ) {
                                newReview.user = _this.getAuth();
                                _this.reviews.push(newReview);
                                // Mark that the user has reviewed the course
                                _this.hasReviewed = true;
                            }

                            // Reset the form
                            _this.form = {
                                rating: 0,
                                comment: '',
                            };
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

            // Set rating for new review
            setRating(rate) {
                this.form.rating = rate;
            },

            // Set hover rating
            setHoverRating(rate) {
                this.hoverRating = rate;
            },

            // Get star class for new review rating
            getStarClass(rate) {
                return this.hoverRating >= rate || this.form.rating >= rate ? 'fa fa-star': 'fa fa-star-o';
            },

            isUpdating(review) {
                return this.form && this.form.id === review.id;
            }
        },
        computed: {
            course_id() {
                return this.$route.params.id;
            },
            lesson_id() {
                return this.$route.params.id;
            },
        },
    };
</script>

<style scoped>
    /* Styles for Course Details */

    .course-details li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .review-item .user-thumb img {
        width: 50px;
        border-radius: 50%;
    }
</style>