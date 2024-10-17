<template>
    <div>
        <template>
            <div class="popular_courses section_gap_top">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="main_title">
                                <h2 class="mb-3">Our Courses</h2>
                                <p>Replenish man have thing gathering lights yielding shall you</p>
                            </div>
                        </div>
                    </div>
                    <courses-component-util :courses="courses" />
                </div>
            </div>
        </template>



        <gap_registration_area />



       <feature_area_section />


    </div>


</template>


<script>
    import Popular_courses from "../components/sections/popular_courses";
    import Feature_area_section from "../components/sections/feature_area_section";
    import Gap_registration_area from "../components/sections/gap_registration_area";
    import Banner_area from "../components/sections/banner_area";
    import CoursesComponentUtil from "../components/coursesComponentUtil";

    export default {
        name: "coursesComponent",
        components: {CoursesComponentUtil, Banner_area, Gap_registration_area, Feature_area_section, Popular_courses},
        data() {
            return {
                courses: []
            };
        },
        mounted() {
            const _this = this;
            this.fetchData(this.urlGenerate(), (result) => {
                _this.courses = result['courses'];
            });
        }
    }
</script>

<style scoped>

</style>