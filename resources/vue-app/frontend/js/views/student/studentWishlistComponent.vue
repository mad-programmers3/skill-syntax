<!--<template>-->
<!--    <div class="container mt-5">-->

<!--        <courses-component-util :courses="wishList"/>-->

<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import CoursesComponentUtil from "../../components/coursesComponentUtil";-->
<!--    export default {-->
<!--        name: "studentWishlistComponent",-->
<!--        components: {CoursesComponentUtil},-->
<!--        data() {-->
<!--            return {-->
<!--                wishList: [],-->
<!--            };-->
<!--        },-->
<!--        mounted() {-->
<!--            const _this = this;-->
<!--            this.fetchData(false, (result) => {-->
<!--                _this.wishList = result.liked_course;-->
<!--            });-->
<!--        },-->
<!--        methods: {-->
<!--            //-->
<!--        }-->
<!--    };-->
<!--</script>-->





















































<!--<template>-->
<!--    <div class="container mt-5">-->
<!--        <courses-component-util :courses="wishList" @remove-wishlist="removeFromWishlist"/>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import CoursesComponentUtil from "../../components/coursesComponentUtil";-->

<!--    export default {-->
<!--        name: "studentWishlistComponent",-->
<!--        components: { CoursesComponentUtil },-->
<!--        data() {-->
<!--            return {-->
<!--                wishList: [],-->
<!--            };-->
<!--        },-->
<!--        mounted() {-->
<!--            const _this = this;-->
<!--            this.fetchData(false, (result) => {-->
<!--                _this.wishList = result.liked_course;-->
<!--                // Ensure each course has an `inWishlist` property-->
<!--                _this.wishList.forEach(course => {-->
<!--                    course.inWishlist = true; // Indicate that these courses are in the wishlist-->
<!--                });-->
<!--            });-->
<!--        },-->
<!--        methods: {-->
<!--            // Method to remove course from the wishlist-->
<!--            removeFromWishlist(courseId) {-->
<!--                this.wishList = this.wishList.filter(course => course.id !== courseId);-->
<!--                // Optionally, call an API to update the backend if necessary-->
<!--            }-->
<!--        }-->
<!--    };-->
<!--</script>-->




<template>
    <div class="container mt-5">
        <!-- Pass the wishlist to the course component -->
        <courses-component-util :courses="wishList" @remove-wishlist="removeFromWishlist" />
    </div>
</template>

<script>
    import CoursesComponentUtil from "../../components/coursesComponentUtil";

    export default {
        name: "studentWishlistComponent",
        components: { CoursesComponentUtil },
        data() {
            return {
                wishList: [], // Store the wishlist courses
            };
        },
        mounted() {
            // Fetch the wishlist data when the component is mounted
            this.fetchWishlist();
        },
        methods: {
            // Fetch the wishlist from the backend
            fetchWishlist() {
                // Use your API call here to fetch the data
                this.fetchData(false, (result) => {
                    this.wishList = result.liked_course;
                    // Add an `inWishlist` property to track the wishlist status
                    this.wishList.forEach(course => {
                        course.inWishlist = true;
                    });
                });
            },

            // Method to handle removing a course from the wishlist
            removeFromWishlist(courseId) {
                // Remove the course from the wishlist array in the frontend
                this.wishList = this.wishList.filter(course => course.id !== courseId);

                // Call the backend API to update the wishlist
                this.updateWishlist(courseId, false);
            },

            // Call API to update the wishlist in the backend
            updateWishlist(courseId, isLiked) {
                // Send an API request to update the wishlist (remove course)
                axios.post(`/api/wishlist`, { courseId, isLiked })
                    .then(response => {
                        // Success response handling if needed
                    })
                    .catch(error => {
                        console.error("Error updating wishlist:", error);
                    });
            }
        }
    };
</script>