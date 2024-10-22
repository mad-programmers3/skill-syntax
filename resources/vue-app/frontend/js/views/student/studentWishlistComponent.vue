<template>
    <div class="container mt-5">

        <courses-component-util :courses="wishList"/>

    </div>
</template>

<script>
    import CoursesComponentUtil from "../../components/coursesComponentUtil";
    export default {
        name: "studentWishlistComponent",
        components: {CoursesComponentUtil},
        data() {
            return {
                wishList: [],
            };
        },
        mounted() {
            const _this = this;
            this.fetchData(false, (result) => {
                _this.wishList = result.liked_course;
            });
        },
        methods: {
            //
        }
    };
</script>

