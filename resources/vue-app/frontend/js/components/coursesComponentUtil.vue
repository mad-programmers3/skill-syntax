<template>
    <div class="row">
        <div v-for="course in courses" :key="course.id" class="col-md-4 mb-3">
            <div class="single_course card">
                <div class="course_head">
                    <!-- Display the dynamic thumbnail image -->
                    <img class="img-fluid" :src="course.thumbnail && course.thumbnail.path ? generateFileUrl(course.thumbnail.path) :  baseUrl + '/images/course-def-thumbnail.jpg'" alt="">
                </div>
                <div class="course_content card-body">
                    <span class="price">{{ course.price }}</span>
                    <span class="tag mb-4 d-inline-block">{{ course.category.title }}</span>
                    <h4 class="mb-3">
                        <router-link to="/courses">{{ course.title }}</router-link>
                    </h4>
                    <!-- Truncated description -->
                    <p class="course-description" v-html="truncateDescription(course.description)"></p>
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
                                class="btn btn-outline-warning btn-lg btn-block flex items-center justify-center"
                                :to="{ name: 'courseDetails', params: { id: course.id } }"
                        >
                            SEE DETAILS
                            <img
                                    class="transition-all duration-200 w-6 h-6 min-w-[24px] ml-2"
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

</style>