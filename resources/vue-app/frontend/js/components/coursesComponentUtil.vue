<template>
    <div class="row">
        <div v-for="course in courses" :key="course.id" class="col-md-3 mb-4"> <!-- Updated spacing -->
            <div class="single_course card h-80 w-100 "> <!-- Added shadow, removed border, rounded corners -->
                <div class="course_head">
                    <!-- Display the dynamic thumbnail image -->
                    <img class="img-fluid rounded-top" :src="course.thumbnail && course.thumbnail.path ? generateFileUrl(course.thumbnail) : baseUrl + '/images/course-def-thumbnail.jpg'" alt="" style="object-fit: cover; height: 100%; width: 100%;">
                </div>

                <div class="course_content card-body">
                    <span class="price badge badge-success p-1">${{ course.price }}</span>
                    <div style="padding-right: 15px">
                        <span class="tag mb-3 d-inline-block text-sm badge badge-secondary p-1 " style="font-size: 10px" >{{course.category.title}}</span>
                    </div>
                    <h4 class="mb-3">
                        <router-link to="/courses" class="text-dark" style="font-size: 17px">{{ limitText(course.title, 35)}}</router-link> <!-- Adjusted link color -->
                    </h4>

                    <!-- See Details Button -->
                    <div class="mt-4">
                        <router-link :to="{ name: 'courseDetails', params: { id: course.id } }" class="btn btn-primary btn-block btn-lg see-details-button d-flex justify-content-center align-items-center">
                            SEE DETAILS
                            <img class="transition-all duration-200 w-6 h-6 min-w-[24px] ml-2 arrow-icon" src="https://cdn.ostad.app/public/icons/arrow-right-line.svg" alt="Arrow Right">
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



    .course_head img {
        object-fit: cover;
        width: 100%;
    }

    .price {
        font-size: 1rem;
        font-weight: bold;
        color: #ff5e14;
      ;
    }




    .see-details-button {
        background-color: white;
        color: #ff5e14;
        font-size: 1rem;
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
        width: 20px;
        height: 20px;
        transition: all 0.3s ease;
    }
    .single_course .price {
        top: -30px;
        right: 15px;
        height: 50px;
        line-height: 50px;
        width: 50px;
        font-size: 12px;

    }
    .single_course {
        border: 1px solid #ddd; /* Default border color */
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Default shadow */
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .single_course:hover {
        transform: translateY(-5px); /* Slight lift on hover */
        border-color: #ff5e14; /* Change border color on hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
    }
    .single_course .course_content{
        padding: 10px;
    }


</style>
