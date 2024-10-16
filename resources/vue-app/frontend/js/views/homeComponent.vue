<template>
    <div>
        <home_banner_section/>

        <feature_area_section/>

        <popular_courses :popular-courses="popularCourses"/>

        <gap_registration_area/>

        <trainer_area_section/>

        <event_area_section/>

        <testimonial_area_section/>

        <payment_img_section/>
    </div>

</template>

<script>

    import Home_banner_section from "../components/sections/home_banner_section";
    import Feature_area_section from "../components/sections/feature_area_section";
    import Popular_courses from "../components/sections/popular_courses";
    import Gap_registration_area from "../components/sections/gap_registration_area";
    import Trainer_area_section from "../components/sections/trainer_area_section";
    import Event_area_section from "../components/sections/events_area_section";
    import Testimonial_area_section from "../components/sections/testimonial_area_section";
    import Payment_img_section from "../components/sections/payment_img_section";

    export default {
        name: "homeComponent",
        components: {
            Payment_img_section,
            Testimonial_area_section,
            Event_area_section,
            Trainer_area_section,
            Gap_registration_area,
            Popular_courses,
            Feature_area_section,
            Home_banner_section
        },
        data() {
            return {
                popularCourses: []
            };
        },
        mounted() {
            this.fetchData(this.urlGenerate(), (result) => {
                this.popularCourses = result['popular-courses'];
            });
        }

    }
</script>

<style scoped>

</style>








