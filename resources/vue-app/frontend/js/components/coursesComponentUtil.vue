<template>
    <div class="row">
        <div v-for="course in courses" :key="course.id" class="col-md-4 mb-3">
            <div class="single_course card">
                <div class="course_head">
                    <!-- Display the dynamic thumbnail image -->
                    <img class="img-fluid" :src="course.thumbnail && course.thumbnail.path ? generateFileUrl(course.thumbnail) :  baseUrl + '/images/course-def-thumbnail.jpg'" alt="">
                </div>
                <div class="course_content card-body">
                    <span class="price">{{ course.price }}</span>
                    <span class="tag mb-4 d-inline-block">{{ course.category.title }}</span>
                    <h4 class="mb-3">
                        <router-link to="/courses">{{ limitText(course.title, 25)}}</router-link>
                    </h4>
                    <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                        <div class="authr_meta">
                            <img :src="baseUrl + '/frontend/img/courses/author3.png'" alt="">
                            <span class="d-inline-block ml-2">Cameron</span>
                        </div>
                        <div class="mt-lg-0 mt-3">
                            <span class="meta_info mr-4">
                                <a href="#"> <i class="ti-user mr-2"></i>25 </a>
                            </span>
                            <span class="meta_info">
                                <a href="#"> <i class="ti-heart mr-2"></i>35 </a>
                            </span>
                        </div>
                    </div>
                    <!-- See Details Button -->
                    <div class="mt-4">
                        <router-link
                                class="btn see-details-button btn-lg btn-block flex items-center justify-center"
                                :to="{ name: 'courseDetails', params: { id: course.id } }"
                        >
                            SEE DETAILS
                            <img
                                    class="transition-all duration-200 w-6 h-6 min-w-[24px] ml-2 arrow-icon"
                                    src="https://cdn.ostad.app/public/icons/arrow-right-line.svg"
                                    alt="Arrow Right"
                            >
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "coursesComponentUtil",
        props: {
            courses: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>


    .single_course {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%;
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
        color: #ff5e14;
    }

    .course-description {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 20px;
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

    .see-details-button {
        background-color: white;
        color: #ff5e14;
        font-size: 1.2rem;
        padding: 10px;
        border-radius: 4px;
        border: 2px solid #ff5e14;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .see-details-button:hover {
        background-color: #ff5e14;
        color: white;
    }

    .see-details-button img {
        width: 24px;
        height: 24px;
        transition: all 0.3s ease;
    }

    /* Ensure arrow icon color matches the button text color */
    .see-details-button .arrow-icon {
        filter: invert(27%) sepia(81%) saturate(2603%) hue-rotate(3deg) brightness(95%) contrast(97%); /* Matches the #ff5e14 color */
    }

    .see-details-button:hover .arrow-icon {
        filter: invert(100%) sepia(0%) saturate(7487%) hue-rotate(205deg) brightness(106%) contrast(107%); /* Matches white color */
    }

    .see-details-button:hover img {
        transform: translateX(5px);
    }
</style>
