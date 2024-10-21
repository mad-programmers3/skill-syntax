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
                <router-link :to="{ name: 'courses', params: { cat_id: category.id } }" class="card h-100 shadow border-0 custom-card">
                    <div class="card-img-container text-center p-3">
                        <img class="card-img-top img-fluid" :src="generateFileUrl(category.thumbnail, TYPE_CATEGORY)" :alt="category.title" />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate">{{ category.title }}</h5>
                        <p class="course-count">{{ category.courses ? category.courses.length : 0 }} courses available</p>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "explore_categories_section",

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
