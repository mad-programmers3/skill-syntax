<template>
    <div>

        <banner_area />


       <popular_courses />



        <gap_registration_area />



       <feature_area_section />


    </div>


</template>


<script>
    import Popular_courses from "../components/sections/popular_courses";
    import Feature_area_section from "../components/sections/feature_area_section";
    import Gap_registration_area from "../components/sections/gap_registration_area";
    import Banner_area from "../components/sections/banner_area";

    export default {
        name: "coursesComponent",
        components: {Banner_area, Gap_registration_area, Feature_area_section, Popular_courses},

    }
</script>

<style scoped>

</style>