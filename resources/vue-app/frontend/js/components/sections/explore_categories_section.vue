<template>
    <div class="container my-5">
        <h2 class="text-center mb-4">Explore Categories</h2>
        <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            Discouraged and irrelevant life attitudes. You're you. Sneak peek into what has in store.
        </p>
        <hr class="custom-hr" />
        <div class="row">
            <!-- Category Images -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" v-for="(category, index) in categories" :key="index">
                <div class="card h-100 shadow border-0 custom-card">
                    <div class="card-img-container text-center p-3">
                        <img class="card-img-top img-fluid" :src="asset('frontend/img/explore-categories/art design.gif')" :alt="category.title" />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate">{{ category.title }}</h5>
                        <p class="course-count">{{ category.courses ? category.courses.length : 0 }} courses available</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "explore_categories_section",

        data() {
            return {
                // categories: [
                //     { src: '/frontend/img/explore-categories/art design.gif', name: 'Art Design', courseCount: 10 },
                //     { src: '/frontend/img/explore-categories/consolating.gif', name: 'Consolating', courseCount: 5 },
                //     { src: '/frontend/img/explore-categories/content writing.gif', name: 'Content Writing', courseCount: 8 },
                //     { src: '/frontend/img/explore-categories/development.gif', name: 'Development', courseCount: 15 },
                //     { src: '/frontend/img/explore-categories/digital-M.gif', name: 'Digital Marketing', courseCount: 7 },
                //     { src: '/frontend/img/explore-categories/finance.gif', name: 'Finance', courseCount: 12 },
                //     { src: '/frontend/img/explore-categories/marketing.gif', name: 'Marketing', courseCount: 6 },
                //     { src: '/frontend/img/explore-categories/music&audio.gif', name: 'Music & Audio', courseCount: 4 },
                //     { src: '/frontend/img/explore-categories/networking.gif', name: 'Networking', courseCount: 9 },
                //     { src: '/frontend/img/explore-categories/phptography.gif', name: 'Photography', courseCount: 11 },
                //     { src: '/frontend/img/explore-categories/science.gif', name: 'Science', courseCount: 3 },
                //     { src: '/frontend/img/explore-categories/video graphy.gif', name: 'Videography', courseCount: 2 }
                // ]
            };
        },

        props: {
            categories: {
                type: [Object, Array],
                default: () => []
            }
        },
    };
</script>

<style scoped>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        background-color: #ffffff;
    }

    .card-img-top {
        max-height: 80px;
        width: auto;
        border-radius: 8px 8px 0 0;
    }

    .card-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    h2 {
        font-weight: bold;
        color: #002347;
    }

    .subtitle {
        text-align: center;
        color: #555;
        margin-bottom: 20px;
        font-style: italic;
    }

    .card-title {
        font-weight: 500;
        color: #333;
    }

    .course-count {
        font-weight: 400;
        color: #666;
        margin-top: 10px;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .card-img-top {
            max-height: 60px;
        }
    }
</style>
