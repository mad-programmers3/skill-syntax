<template>
    <div class="user-dashboard-content-area">
        <div class="container" id="ajaxContent">

            <div class="row all-videos wishlists">

                <div class="col-xl-3 col-lg-4 col-md-6" v-for="course in wishlist" :key="course.id">
                    <div class="single-course">
                        <div class="img">
                            <img :src="course.image" alt="course">
                            <a href="javascript:;" class="remove wishlist-remove" @click="removeFromWishlist(course.id)">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="content">
                            <p class="author">
                                <a :href="course.instructorUrl">{{ course.instructor }}</a>
                            </p>
                            <a :href="course.courseUrl">
                                <h4 class="title">{{ course.title }}</h4>
                            </a>

                            <div class="rating-area">
                                <span class="number">{{ course.rating }}</span>
                                <div class="stars">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" :style="{ width: course.rating * 20 + '%' }"></div>
                                    </div>
                                </div>
                                <div class="total-star">({{ course.totalReviews }})</div>
                            </div>

                            <p class="price">
                                ${{ course.price }} <del v-if="course.oldPrice">${{ course.oldPrice }}</del>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="page-center mt-5">
                <!-- Pagination or additional controls can go here -->
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "studentWishlistComponent",
        data() {
            return {
                wishlist: [
                    {
                        id: 46,
                        image: "https://product.geniusocean.com/academy-king/assets/images/courses/1624957955create-any-kind-of-graphic-design-with-idea.jpg",
                        instructor: "John Doe",
                        instructorUrl: "https://product.geniusocean.com/academy-king/instructor/John-Doe",
                        courseUrl: "https://product.geniusocean.com/academy-king/course/Career-Building-in-Cyber-Security-and-Ethical-Hacking",
                        title: "Career Building in Cyber Security and Ethical Hack...",
                        rating: 5.0,
                        totalReviews: 1,
                        price: 15,
                        oldPrice: 30
                    },
                    {
                        id: 45,
                        image: "https://product.geniusocean.com/academy-king/assets/images/courses/1624958276computer-hardware-2625895-322917d648864dc4974d9befc74b6c6a.png",
                        instructor: "John Doe",
                        instructorUrl: "https://product.geniusocean.com/academy-king/instructor/John-Doe",
                        courseUrl: "https://product.geniusocean.com/academy-king/course/The-System-Hacking-Course",
                        title: "The System Hacking Course",
                        rating: 0.0,
                        totalReviews: 0,
                        price: 15,
                        oldPrice: 30
                    },
                    {
                        id: 47,
                        image: "https://product.geniusocean.com/academy-king/assets/images/courses/1624958537web-design-development-blog-2.jpg",
                        instructor: "Shane Watson",
                        instructorUrl: "https://product.geniusocean.com/academy-king/instructor/Shane-Watson",
                        courseUrl: "https://product.geniusocean.com/academy-king/course/Web-Development-with-PHP",
                        title: "Web Development with PHP",
                        rating: 0.0,
                        totalReviews: 0,
                        price: 13,
                        oldPrice: 25
                    },
                ]
            };
        },
        methods: {
            removeFromWishlist(courseId) {
                this.wishlist = this.wishlist.filter(course => course.id !== courseId);
            }
        }
    };
</script>
<style scoped>
    .user-dashboard-content-area {
        padding: 20px;
    }

    .row.all-videos {
        display: flex;
        flex-wrap: wrap;
    }

    .single-course {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .img {
        position: relative;
    }

    .img img {
        width: 100%;
        height: auto;
    }

    .wishlist-remove {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 5px;
    }

    .content {
        padding: 15px;
    }

    .author {
        font-weight: bold;
    }

    .title {
        font-size: 1.2em;
        margin: 10px 0;
    }

    .rating-area {
        display: flex;
        align-items: center;
    }

    .number {
        margin-right: 5px;
    }

    .stars {
        position: relative;
        display: inline-block;
    }

    .ratings {
        position: absolute;
        white-space: nowrap;
        overflow: hidden;
        height: 16px; /* Adjust based on your star icon size */
        width: 100%;
    }

    /*.empty-stars, .full-stars {*/
    /*    background: url('path/to/your/star-icons.svg') no-repeat;*/
    /*}*/

    .price {
        margin-top: 10px;
        font-weight: bold;
    }

    .del {
        text-decoration: line-through;
        color: #777;
    }
</style>

