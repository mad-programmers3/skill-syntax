<template>
    <div class="container my-5">
        <h2 class="text-center mb-4">Explore Categories</h2>
        <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            Discouraged and irrelevant life attitudes. You're you. Sneak peek into what has in store.
        </p>
        <hr class="custom-hr" />
        <div class="row">
            <!-- Category Images -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" v-for="category in categories" :key="category.alt">
                <div class="card h-100 shadow border-0 custom-card">
                    <div class="card-img-container text-center p-3">
                        <img class="card-img-top img-fluid" :src="category.src" :alt="category.alt" />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate">{{ category.alt }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExploreCategoriesSection",
        data() {
            return {
                categories: [
                    { src: '/frontend/img/explore-categories/art design.gif', alt: 'Art Design' },
                    { src: '/frontend/img/explore-categories/consolating.gif', alt: 'Consolating' },
                    { src: '/frontend/img/explore-categories/content writing.gif', alt: 'Content Writing' },
                    { src: '/frontend/img/explore-categories/development.gif', alt: 'Development' },
                    { src: '/frontend/img/explore-categories/digital-M.gif', alt: 'Digital Marketing' },
                    { src: '/frontend/img/explore-categories/finance.gif', alt: 'Finance' },
                    { src: '/frontend/img/explore-categories/marketing.gif', alt: 'Marketing' },
                    { src: '/frontend/img/explore-categories/music&audio.gif', alt: 'Music & Audio' },
                    { src: '/frontend/img/explore-categories/networking.gif', alt: 'Networking' },
                    { src: '/frontend/img/explore-categories/phptography.gif', alt: 'Photography' },
                    { src: '/frontend/img/explore-categories/science.gif', alt: 'Science' },
                    { src: '/frontend/img/explore-categories/video graphy.gif', alt: 'Videography' }
                ]
            };
        }
    };
</script>

<style scoped>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 8px; /* Slightly rounded corners */
        border: 1px solid #e0e0e0; /* Subtle border */
        background-color: #ffffff; /* White background */
    }

    .card-img-top {
        max-height: 80px; /* Smaller image height */
        width: auto; /* Automatic width */
        border-radius: 8px 8px 0 0; /* Rounded top corners */
    }

    .card-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px; /* Adjusted height */
        overflow: hidden; /* Hide overflow */
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); /* Softer shadow */
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

    .custom-hr {
        border: 1px solid green;
        width: 80%;
        margin: 0 auto;
        margin-bottom: 30px;
    }

    .card-title {
        font-weight: 500; /* Medium font weight for titles */
        color: #333; /* Darker color for contrast */
    }

    .text-truncate {
        white-space: nowrap; /* Prevent text wrap */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Ellipsis for long text */
    }

    @media (max-width: 768px) {
        .card-img-top {
            max-height: 60px; /* Smaller image for mobile */
        }
    }
</style>
