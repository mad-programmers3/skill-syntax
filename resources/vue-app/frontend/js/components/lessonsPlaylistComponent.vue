<template>
    <div>
        <h4 class="title mt-2">Lessons</h4>
        <div class="playlist">
            <div v-if="!isEmptyData(lessons)" v-for="lesson in lessons" :key="lesson.id" :class="['card my-2', { 'highlight-card': id === lesson.id }]" :style="`background: ${ currentLessonId >= lesson.id ? '#fff' : '#d4d4d4'};`">
                <div @click="id !== lesson.id && goToLesson(lesson.id, currentLessonId)" class="row no-gutters pointer align-items-center">
                    <div class="col-md-4 justify-content-center">
                        <img class="img-fluid" :src="generateFileUrl(lesson.thumbnail, TYPE_LESSON)" alt="Course Image" style="border: 1px solid #ddd; padding: 5px; margin: 10px; border-radius: 8px;" >
                    </div>

                    <div class="col-md-8 py-3 pl-3">
                        <h6 class="card-title mb-0">{{ lesson.title }}</h6>
                        <p class="card-text"><i class="fas fa-clock primary-text2"></i> {{ !isEmptyData(lesson.video) ? formatSecondsToTime(lesson.video.duration) : 'NA' }}</p>
                    </div>
    <!--                <div class="mt-lg-0 mt-3">-->
    <!--                    <span class="meta_info mr-4">-->
    <!--                       <a @click="()=>{$emit('do-like')}" class="primary-text2">-->
    <!--                           <i :class="`${lessonsLikes && lessonsLikes[lesson.id].includes(auth.id) ? 'fas' : 'far'} fa-thumbs-up`"></i> {{lessonsLikes && lessonsLikes[lesson.id] ? lessonsLikes[lesson.id].length : 0 }}-->
    <!--                       </a>-->
    <!--                    </span>-->
    <!--                    <span class="meta_info padded-info">-->
    <!--                        <a href="#" class="primary-text2">-->
    <!--                            <i class="far fa-comment"></i> {{ lessonsReviews && lessonsReviews[lesson.id] ? lessonsReviews[lesson.id].length }}-->
    <!--                        </a>-->
    <!--                    </span>-->
    <!--                </div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "lessonsPlaylistComponent",

        props: {
            id: Number,
            lessons: Array,
            currentLessonId: Number,
        }
    }
</script>

<style scoped>

    .review-item .user-thumb img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .playlist {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        background-color: #002347;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .playlist .card {
        border: 0;
        border-bottom: 1px solid #e0e0e0;
        background-color: #fff;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        color: #333;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .playlist .card:hover {
        background: #deebff !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .playlist .highlight-card {
        border-left: 3px solid #e91e63;
    }

    .card-body h6 {
        color: #002347;
        font-size: 0.8rem;
    }

    .card-body p {
        color: #777;
        font-size: 0.8rem;
    }
</style>