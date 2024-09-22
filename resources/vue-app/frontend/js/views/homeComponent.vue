<template>
    <div>
        <home_banner_section />

        <feature_area_section />

        <popular_courses/>

        <gap_registration_area />

        <trainer_area_section />

        <event_area_section />

        <testimonial_area_section />
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

    export default {
        name: "homeComponent",
        components: {
            Testimonial_area_section,
            Event_area_section,
            Trainer_area_section,
            Gap_registration_area,
            Popular_courses,
            Feature_area_section,
            Home_banner_section},

    }
</script>

<style scoped>

</style>








