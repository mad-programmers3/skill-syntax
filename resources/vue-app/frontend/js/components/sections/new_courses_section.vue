<template>
    <div class="container my-5">
        <h2 class="text-center mb-4">New Courses</h2>
        <p class="text-center">Explore our latest courses designed to enhance your skills and knowledge!</p> <!-- Added paragraph -->
        <hr class="green-line"> <!-- Added horizontal line -->
        <div class="row">
            <!-- Course Images -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" v-for="course in courses" :key="course.alt">
                <div class="card h-100 shadow border-0">
                    <div class="card-img-container text-center p-3">
                        <img class="card-img-top img-fluid" :src="course.src" :alt="course.alt" />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ course.title }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <router-link to="/all-courses" class="view-all-button">View All New Courses</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewCoursesSection",
        data() {
            return {
                courses: [
                    { src: '/frontend/img/courses/course1.jpg', alt: 'Course 1', title: 'Introduction to Programming' },
                    { src: '/frontend/img/courses/course2.jpg', alt: 'Course 2', title: 'Web Development Basics' },
                    { src: '/frontend/img/courses/course3.jpg', alt: 'Course 3', title: 'Data Science for Beginners' },
                    { src: '/frontend/img/courses/course4.jpg', alt: 'Course 4', title: 'Digital Marketing Essentials' },
                    { src: '/frontend/img/courses/course5.jpg', alt: 'Course 5', title: 'Graphic Design Fundamentals' },
                    { src: '/frontend/img/courses/course6.jpg', alt: 'Course 6', title: 'Mobile App Development' },
                    // Add more courses as needed
                ]
            };
        }
    };
</script>

<style scoped>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-img-top {
        max-height: 150px;
        width: auto;
        border-radius: 10px;
    }

    .card-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        color: #333;
    }

    h2 {
        font-weight: bold;
        color: #002347;
    }

    .view-all-button {
        display: inline-block;
        padding: 12px 48px;
        background: #002347;
        color: #fdc632;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .view-all-button:hover {
        background: #001e31;
    }

</style>
