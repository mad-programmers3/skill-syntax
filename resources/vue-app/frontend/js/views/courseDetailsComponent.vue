<template>
        <section class="course_details_area section_gap">
            <div class="container">
                <div v-if="!isEmptyData(course)" class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <!-- Display the course thumbnail or a default image if it's not available -->
                            <img class="img-fluid" :src="course ? generateFileUrl(course.thumbnail) : asset(DEF_FILES[TYPE_COURSE])" alt="Course Thumbnail" style="padding: 10px;"/>
                        </div>
                        <div class="content_wrapper">
                            <br />
                            <div class="title d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">{{ course ? course.title : '' }}</h4> <!-- Added mb-0 to remove margin from the heading -->
                                <div>
                                    <span class="meta_info mr-3">
                                        <a @click="doLike()" class="primary-text2">
                                            <i :class="`pointer ${likes.includes(auth.id) ? 'fas' : 'far' } fa-heart`"></i> {{likes.length }}
                                        </a>
                                    </span>
                                    <span class="meta_info">
                                       <a href="#review-area" class="primary-text2"> <i class="far fa-comment"></i> {{ reviews.length }} </a>
                                    </span>
                                </div>
                            </div>
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
                                                <img :src="generateFileUrl(review.user ? review.user.avatar : null, TYPE_USER)" alt="User Avatar" />
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
                                                            <i :class="`pointer ${reviewsLikes[review.id].includes(auth.id) ? 'fas' : 'far' } fa-thumbs-up`"></i> {{reviewsLikes[review.id].length}}
                                                        </a>
                                                        <a class="mr-3 primary-text2">
                                                            <i class="pointer fas fa-reply"></i>
                                                        </a>
                                                        <a v-if="review.user.id === auth.id" class="primary-text2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="pointer fas fa-ellipsis-v"></i>
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
                                <div v-if="isEmptyData(auth)" class="text-center">
                                    <h5>You need to be logged in to provide feedback</h5>
                                    <a class="primary-btn" :href="urlGenerate('login', false, { url: currentUrl + '#review-area' })">Log In</a>
                                </div>
                                <div v-else-if="!auth.purchased_courses_id.includes(course.id)" class="text-center">
                                    <h5>Purchase this course to review it</h5>
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
                                                <button @click="submitReview" class="genric-btn primary2  circle arrow">Submit<span class="ti-arrow-right"></span></button>
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

                    <!-- Course Lessons And Quizzes Section -->
                    <div v-if="true" class="col-lg-4 right-contents" >
                        <div v-if="isEmptyData(auth)" class="mt-5 row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h4 class="font-weight-bold">
                                    You need to be logged in to continue
                                </h4>
                                <a :href="urlGenerate('login', false, { url: currentUrl})" class="mt-2 genric-btn primary2 circle arrow">Login Now<span class="ti-arrow-right"></span></a>
                            </div>
                        </div>
                        <div v-else-if="!auth.purchased_courses_id.includes(course.id)" class="mt-5 row justify-content-center">
<!--                            <div class="col-md-8 text-center">-->
<!--                                <h4 class="font-weight-bold">-->
<!--                                    Purchase the course now for only <span class="text-success">{{ course.price }} Taka</span>-->
<!--                                </h4>-->
<!--                                <button @click="purchaseCourse" class="mt-2 genric-btn primary2 circle arrow">Purchase Now<span class="ti-arrow-right"></span></button>-->
<!--                            </div>-->
                            <div class="card p-4 shadow-sm mb-4">
                                <form @submit.prevent="purchaseCourse">
                                    <div class="form-group mt-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" id="method-0" value="bkash" v-model="selectedMethod" required/>
                                            <label class="form-check-label d-flex align-items-center" for="method-0">
                                                <img width="50px" :src="asset('frontend/img/payment-img/Logo__Bkash.svg')" alt="Bkash" class="payment-logo mr-2" />
                                                Bkash
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" id="method-1" value="nagad" v-model="selectedMethod" required/>
                                            <label class="form-check-label d-flex align-items-center" for="method-1">
                                                <img width="50px" :src="asset('frontend/img/payment-img/nagad.png')" alt="Nagad" class="payment-logo mr-2" />
                                                Nagad
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">Complete Payment 2000tk</button>
                                </form>
                            </div>
                        </div>
                        <template v-else>
                            <!-- Lessons Section -->
                            <h4 v-if="isEmptyData(course.lessons)" class="mt-5 text-center">No lessons available for this course</h4>
                            <template v-else>
                                <h4 class="title mt-5">Lessons</h4>
                                <div class="playlist">
                                    <div v-for="lesson in course.lessons" :key="lesson.id" class="card mb-3" :style="`background: ${ runningInfo.current_lesson_id >= lesson.id ? 'white' : '#d4d4d4'};`">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img class="img-fluid" :src="baseUrl + '/frontend/img/courses/c1.jpg'" alt="" style="margin: 10px; padding: 5px;" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div @click="goToLesson(lesson.id, runningInfo.current_lesson_id)" :class="{'pointer': true, 'font-weight-bold': lesson.id === lesson_id }">
                                                        <h6 class="card-title">{{ lesson.title }}</h6>
                                                    </div>
                                                    <div class="mt-lg-0 mt-3">
                                                        <span class="meta_info mr-4">
                                                           <a @click="doLike(TYPE_LIKE_LESSON, lesson.id)" class="primary-text2">
                                                               <i :class="`${lessonsLikes[lesson.id].includes(auth.id) ? 'fas' : 'far'} fa-thumbs-up`"></i> {{ lessonsLikes[lesson.id].length }}
                                                           </a>
                                                       </span>
                                                        <span class="meta_info padded-info">
                                                            <a href="#" class="primary-text2">
                                                                <i class="far fa-comment"></i> {{ reviews.length }}
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>


                            <!-- Quizzes Section -->
                            <h4 v-if="isEmptyData(course.quizzes)" class="mt-5 text-center">No quizzes available for this course</h4>
                            <h4 v-else-if="!canShowQuiz(course.lessons, runningInfo.current_lesson_id)" class="mt-5 text-center">The {{ course.quizzes.length }} quizzes will appear soon</h4>
                            <template v-else>
                                <h4 class="title mt-5">Quizzes</h4>
                                <div v-for="(quiz, index) in course.quizzes" :key="quiz.id" class="playlist">
                                    <button data-toggle="modal" :data-target="`#quizModal${quiz.id}`" class="btn btn-custom btn-lg mt-3 d-flex justify-content-center align-items-center" style="background-color: #002347; color: #ffffff;">
                                        {{ quiz.title }}
                                    </button>

                                    <!-- Quiz Card -->
                                    <div class="card mt-3" style="background-color: #002347; color: #ffffff;">
                                        <div class="card-body text-center" style="background-color: #ffffff; color: #333;">
                                            <div class="mb-2">
                                                <p class="card-text">{{ getSolvedQsN(quiz.questions) }} solved out of {{ quiz.questions ? quiz.questions.length : 0 }} questions</p>
                                                <div class="progress">
                                                    <div :class="`progress-bar ${isSolvedAllQs(quiz.questions) ? 'primary-bg2' : 'primary-bg3'}`" role="progressbar"
                                                         :style="{ width: `${!isEmptyData(quiz.questions) ? getSolvedQsN(quiz.questions)/quiz.questions.length*100 : 100}%` }"
                                                         :aria-valuenow="getSolvedQsN(quiz.questions)" aria-valuemin="0"
                                                         :aria-valuemax="quiz.questions ? quiz.questions.length : 0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="runningInfo.current_quiz_id < quiz.id" class="genric-btn primary-bg circle text-white" style="cursor: default">Upcoming</div>
                                            <div v-else-if="isSolvedAllQs(quiz.questions)" class="genric-btn primary-bg2 circle text-white" style="cursor: default">Solved</div>
                                            <button v-else class="genric-btn primary3 circle" data-toggle="modal" :data-target="`#quizModal${quiz.id}`">Take Now</button>
                                        </div>
                                    </div>

                                    <!-- Modal Component -->
                                    <quiz-modal-component :id="`quizModal${quiz.id}`" :quiz="quiz" :running-info="runningInfo" :next-quiz-id="course.quizzes[index+1] ? course.quizzes[index+1].id : null"/>
                                </div>
                            </template>


                            <!-- Get Certification -->
                            <div v-if="canShowCerificate" class="mt-5 py-3 px-4 primary-bg2 rounded">
                                <div class="text-center bg-white p-3 rounded">
                                    <h6 class="font-weight-bold">
                                        Congratulations on completing the course! You can now download your certificate.
                                    </h6>
                                    <button @click="purchaseCourse" class="mt-2 genric-btn primary2 circle arrow">Download<span class="fas fa-download"></span></button>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </section>
</template>

<script>
    import QuizModalComponent from "../components/quizModalComponent";
    export default {
        name: "courseDetails",
        components: {QuizModalComponent},
        props: ['courseId'],
        data() {
            return {
                course: null,
                reviews: [],
                likes: [],
                reviewsLikes: [],
                lessonsLikes: [],
                runningInfo: {},
                form: {
                    rating: 0,
                    comment: '',
                },
                TYPE_LIKE_COURSE: 11,
                TYPE_LIKE_REVIEW: 12,
                TYPE_LIKE_LESSON: 13,
                hoverRating: 0,
                hasReviewed: false,
            };
        },
        mounted() {
            // if (!this.auth) {
            //     this.fetchData(this.urlGenerate('required-data', false, {}));
            // }


            this.fetchCourseData();
            this.checkUserReview();
        },
        methods: {
            // Fetch course and related data
            fetchCourseData() {
                const _this = this;
                this.fetchData(this.urlGenerate(false, this.course_id), (result) => {
                    _this.course = result['course'];
                    _this.reviews = result['reviews'];
                    _this.likes = result['likes'];
                    _this.reviewsLikes = result['reviews_likes'];
                    _this.lessonsLikes = result['lessons_likes'];
                    _this.runningInfo = result['running_info'];

                    _this.form.user_id = _this.auth.id;
                    _this.form.course_id = _this.course ? _this.course.id : null;

                });
            },


            purchaseCourse() {
                if (this.isEmptyData(this.auth) || this.isEmptyData(this.course)) return;
                
                const _this = this;
                this.httpReq({
                    customUrl: 'api/courses/purchase',
                    urlSuffix: this.course.id,
                    method: 'post',
                    callback: (response) => {
                        if (response.data) {
                            _this.runningInfo = response.data.result;
                            _this.showToast(response.data.message);
                            _this.auth.purchased_courses_id.push(_this.course.id);
                        }
                    }
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
                const user = this.auth;
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
                                newReview.user = _this.auth;
                                _this.reviewsLikes[newReview.id] = [];
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
                return this.hoverRating >= rate || this.form.rating >= rate ? 'fas fa-star': 'far fa-star';
            },

            isUpdating(review) {
                return this.form && this.form.id === review.id;
            },
            doLike(type = this.TYPE_LIKE_COURSE, id = this.course.id) {
                if (this.isEmptyData(this.auth)) return;

                let customUrl = 'api/courses/do-like';
                let likesArr = this.likes;
                let data = {
                    course_id: id,
                };

                if (type === this.TYPE_LIKE_REVIEW) {
                    customUrl = 'api/reviews/do-like';
                    likesArr = this.reviewsLikes[id];
                    data = {review_id: id}
                } else if (type === this.TYPE_LIKE_LESSON) {
                    customUrl = 'api/lessons/do-like';
                    likesArr = this.lessonsLikes[id];
                    data = {lesson_id: id}
                }

                // api/reviews/do-like

                const _this = this;
                this.httpReq({
                    customUrl,
                    method: 'post',
                    data,
                    callback(response) {
                        if (response.data.result === 1)
                            likesArr.push(_this.auth.id);
                        else if(response.data.result === 0)
                            _this.removeArrItem(likesArr, _this.auth.id);
                        else
                            _this.showToast('Failed to like the course. Please try again.', 'error')
                    }
                });
            },

        },
        computed: {
            course_id() {
                return this.$route.params.id;
            },
            lesson_id() {
                return this.$route.params.id;
            },

            canShowCerificate() {
                if (this.isEmptyData(this.course.quizzes) && !this.runningInfo.current_quiz_id) return false;
                const lastQuiz = this.course.quizzes[this.course.quizzes.length - 1];
                if (this.isEmptyData(lastQuiz)) return false;
                return lastQuiz.id === this.runningInfo.current_quiz_id;
            }
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
        height: 50px;
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
        background-color: #f5f1ff !important;
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

    .btn-custom {
        background-color: #002347;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        width: 100%;
    }

    .btn-custom:hover {
        background-color: #001d32;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-custom {
        background-color: #002347;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        width: 100%;
    }

    .btn-custom:hover {
        background-color: #001d32;
        color: #ffffff;
    }

</style>