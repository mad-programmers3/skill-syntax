
<template>
    <div class="popular_courses mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="main_title">
                        <h2 class="mb-3">Our Popular Courses</h2>
                        <p>Replenish man have thing gathering lights yielding shall you</p>
                    </div>
                </div>
            </div>
            <courses-component-util :courses="popularCourses" />
        </div>
    </div>
</template>

<script>
    import CoursesComponentUtil from "../coursesComponentUtil";
    export default {
        name: 'PopularCourses',
        components: {CoursesComponentUtil},
        props: {
            // Define the popularCourses prop, which should be an array
            popularCourses: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>
    /* Add your styles here */

    .single_course {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%; /* Ensure equal height for all cards */
    }

    .single_course:hover {
        transform: translateY(-5px);
    }

    .course_head img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #ff5e14; /* Change color as needed */
    }

    .course-description {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 20px; /* Space below the description */
    }

    .authr_meta img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .meta_info i {
        color: #ff5e14;
    }

    .meta_info a {
        font-size: 14px;
        color: #333;
        text-decoration: none;
    }

    .main_title h2 {
        font-size: 36px;
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .main_title p {
        color: #666;
        text-align: center;
        font-size: 16px;
    }

    /* Button Styling */
    .btn-outline-warning {
        width: 100%;
        font-size: 1.2rem;
        padding: 10px;
        border-radius: 4px;
    }
</style>























