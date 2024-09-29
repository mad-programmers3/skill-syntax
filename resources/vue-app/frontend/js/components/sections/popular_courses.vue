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
            <div class="row">
                <div v-for="course in courses" :key="course.id" class="col-md-4 mb-3">
                    <div class="single_course">
                        <div class="course_head">
                            <!-- Display the dynamic thumbnail image -->
                            <img class="img-fluid" :src="generateFileUrl(course.thumbnail.path)" alt="">
                        </div>
                        <div class="course_content">
                            <span class="price">{{ course.price }}</span>
                            <span class="tag mb-4 d-inline-block">{{ course.category.title }}</span>
                            <h4 class="mb-3">
                                <router-link to="/courses">{{ course.title }}</router-link>
                            </h4>
                            <p v-html="course.description"></p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'PopularCourses',
        data() {
            return {
                courses: [],  // Store courses here
                baseUrl: window.location.origin // Base URL for images
            };
        },
        methods: {
            generateFileUrl(path) {
                return this.baseUrl+'/storage/'+path;
            },
        },
        mounted() {
            axios.get('/api/courses')
                .then(response => {
                    this.courses = response.data.result;
                })
                .catch(error => {
                    console.error('Failed to fetch courses:', error);
                });
        }
    }
</script>

<style scoped>

</style>
