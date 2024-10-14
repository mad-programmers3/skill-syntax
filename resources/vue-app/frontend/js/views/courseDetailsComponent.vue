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
                            <h4 class="yellow-text">{{ course ? course.title : '' }}</h4>
                            <div class="content">
                                <div v-html="course ? course.description : ''" class="course-description mb-4"></div>
                                <!-- Course Details -->
                                <div class="course-details">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Price:</strong>
                                            <span class="text-muted">${{ course ? course.price : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Seats Available:</strong>
                                            <span class="text-muted">{{ course ? course.sits : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">Start Date:</strong>
                                            <span class="text-muted">{{ course ? course.start_date : '' }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <strong class="yellow-text">End Date:</strong>
                                            <span class="text-muted">{{ course ? course.end_date : '' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Course Review Section -->
                            <h4 class="title">Reviews ({{ reviews.length }})</h4>
                            <div>
                                <div class="reviews-list">
                                    <h6 class="mb-3">Recent Reviews</h6>
                                    <div v-for="review in reviews" :key="review.id" class="review-item mb-3">
                                        <div class="user-info d-flex align-items-start justify-content-between">
                                            <div class="user-thumb mr-3">
                                                <img :src="baseUrl + '/frontend/img/courses/author2.png'" alt="User Avatar" />
                                            </div>
                                            <div class="user-details flex-grow-1">
                                                <h6 class="mb-1">{{ review.user.name }}</h6>
                                                <!-- Display the comment or the textarea for editing -->
                                                <div v-if="!review.isEditing">
                                                    <p class="comment mb-2">{{ review.comment }}</p>
                                                </div>
                                                <div v-else>
                                                    <textarea v-model="review.updatedComment" class="form-control" rows="4" placeholder="Update your review..."></textarea>
                                                </div>

                                                <div class="review-footer mt-2">
                                                    <a href="#" class="mr-3">
                                                        <i class="fa fa-thumbs-up"></i> {{ likes.length }}
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                    <!-- Edit and Save Buttons -->
                                                    <a v-if="review.user.id === getAuth().id && !review.isEditing" @click="editReview(review)" style="padding: 20px">
                                                        <i class="fa fa-edit"></i>
                                                    </a>


                                                    <button v-if="review.isEditing" @click="updateReview(review)" class="btn btn-primary btn-sm ml-2">Save</button>
                                                </div>
                                            </div>
                                            <div class="star-rating d-flex mb-2">
                                                <!-- Display existing ratings for each review -->
                                                <template v-for="rate in 5">
                                                    <i :class="['fa', rate <= review.rating ? 'fa-star' : 'fa-star-o']" style="color: #ff5e14;"></i>
                                                </template>
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
                                        <h6>Your Feedback</h6>
                                        <!-- Star Rating for new review -->
                                        <div class="star-rating d-flex mb-2">
                                            <template v-for="rate in 5">
                                                <i :class="getStarClass(rate)"
                                                   @mouseover="setHoverRating(rate)"
                                                   @mouseleave="setHoverRating(0)"
                                                   @click="setRating(rate)"
                                                   style="cursor: pointer; font-size: 24px; color: #ff5e14;">
                                                </i>
                                            </template>
                                        </div>
                                        <div>
                                            <textarea v-model="form.comment" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                            <div class="text-right mt-3">
                                                <button @click="submitReview" class="btn btn-primary text-uppercase">Submit</button>
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
                                                    <a href="#"> <i class="fa fa-thumbs-up"></i> {{ likes.length }} </a>
                                                </span>
                                                <span class="meta_info padded-info">
                                                    <a href="#"> <i class="fa fa-comment"></i> {{ reviews.length }} </a>
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

            // Check if the user has already reviewed the course
            checkUserReview() {
                const user = this.getAuth();
                if (user) {
                    const userId = user.id;
                    this.hasReviewed = this.reviews.some((review) => review.user.id === userId);
                }
            },

            // Handle editing a review
            editReview(review) {
                // Ensure reactivity by explicitly setting new properties
                this.$set(review, 'isEditing', true);
                // Store the original comment in the updatedComment property
                this.$set(review, 'updatedComment', review.comment);
            },

            // Update a review
            updateReview(review) {
                // Check if the updated comment is empty
                if (!review.updatedComment.trim()) {
                    alert('Review comment cannot be empty.');
                    return;
                }

                // Perform the API call to update the review
                this.httpReq({
                    customUrl: `api/review/course-reviews/${review.id}`,
                    method: 'put',
                    data: {
                        comment: review.updatedComment,
                        rating: review.rating, // Include rating if necessary
                    },
                    callback: (response) => {
                        if (response.data && response.data.success) {
                            // Update the review content with the new comment
                            this.$set(review, 'comment', review.updatedComment);
                            // Disable the editing mode
                            this.$set(review, 'isEditing', false);
                        } else {
                            alert('review update successfully');
                        }
                    },
                });
            },


            // Handle submitting a new review
            submitReview() {
                const _this = this;

                if (!this.form.comment.trim()) {
                    alert('Please enter your comment before submitting.');
                    return;
                }

                if (this.hasReviewed) {
                    return;
                }

                this.httpReq({
                    customUrl: 'api/review/course-reviews',
                    method: 'post',
                    data: _this.form,
                    callback(response) {
                        if (response.data && response.data.success) {
                            // Update the review list
                            const newReview = response.data.result;
                            newReview.user = _this.getAuth();
                            _this.reviews.push(newReview);

                            // Mark that the user has reviewed the course
                            _this.hasReviewed = true;

                            // Reset the form
                            _this.form.rating = 0;
                            _this.form.comment = '';
                        } else {
                            alert('Failed to submit the review. Please try again.');
                        }
                    },
                });
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
                if (this.hoverRating >= rate || this.form.rating >= rate) {
                    return 'fa fa-star'; // Filled star
                } else {
                    return 'fa fa-star-o'; // Empty star
                }
            },
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
    .yellow-text {
        color: #002347;
        font-weight: bold;
    }

    .course-details li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e0e0e0;
    }

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

    .star-rating i {
        font-size: 15px;
        color:  #ff5e14; /* Gold color */
        margin-right: 5px;
    }

    .star-rating i:hover {
        color:  #ff5e14; /* Slightly darker on hover */
    }

    .star-rating {
        display: flex;
    }

    .review-item .user-thumb img {
        width: 50px;
        border-radius: 50%;
    }

    .review-item .star-rating {
        color:  #ff5e14;
    }

    .review-footer .btn {
        margin-top: 5px;
    }
</style>