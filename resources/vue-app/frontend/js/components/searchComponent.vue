
<template>
    <div class="search-component">
        <li class="nav-item">
            <a href="#" class="nav-link search" @click.prevent="openSearchModal">
                <i class="ti-search"></i>
            </a>
        </li>

        <!-- Search Modal -->
        <div v-if="isModalVisible" class="modal-overlay" @click.self="closeSearchModal">
            <div class="modal-content">
                <span class="close ml-auto" @click="closeSearchModal" style="float: right;">&times;</span>
                <h2 class="modal-title">Search</h2>
                <div class="search-input-container">
                    <input
                            v-model="searchQuery"
                            @keyup.enter="performSearch"
                            placeholder="Search for users, courses, lessons, categories..."
                            class="search-input"
                    />
                    <button class="search-button" @click="performSearch">Search</button>
                </div>

                <!-- Scrollable Results Section -->
                <div class="results-section">
                    <!-- USERS -->
                    <div v-if="results.users.length">
                        <h3>USERS</h3>
                        <ul>
                            <li v-for="user in results.users" :key="user.id" class="result-item">
                                <router-link :to="`/users/${user.id}`" @click.native="handleResultClick">
                                    {{ user.name.toLowerCase() }} - {{ user.email.toLowerCase() }}
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- COURSES -->
                    <div v-if="results.courses.length">
                        <h3>COURSES</h3>
                        <ul>
                            <li v-for="course in results.courses" :key="course.id" class="result-item">
                                <router-link :to="`/courses/${course.id}`" @click.native="handleResultClick">
                                    {{ course.title.toLowerCase() }}
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- LESSONS -->
                    <div v-if="results.lessons.length">
                        <h3>LESSONS</h3>
                        <ul>
                            <li v-for="lesson in results.lessons" :key="lesson.id" class="result-item">
                                <router-link :to="`/lesson/${lesson.id}`" @click.native="handleResultClick">
                                    {{ lesson.title.toLowerCase() }}
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- CATEGORIES -->
                    <div v-if="results.categories.length">
                        <h3>CATEGORIES</h3>
                        <ul>
                            <li v-for="category in results.categories" :key="category.id" class="result-item">
                                <router-link :to="`/categories/${category.id}`" @click.native="handleResultClick">
                                    {{ category.title.toLowerCase() }}
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- SUBCATEGORIES -->
                    <div v-if="results.subcategories.length">
                        <h3>SUB_CATEGORIES</h3>
                        <ul>
                            <li v-for="subcategory in results.subcategories" :key="subcategory.id" class="result-item">
                                <router-link :to="`/subcategories/${subcategory.id}`" @click.native="handleResultClick">
                                    {{ subcategory.title.toLowerCase() }}
                                </router-link>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'; // Ensure SweetAlert2 is installed and imported

    export default {
        data() {
            return {
                isModalVisible: false, // Controls the visibility of the search modal
                searchQuery: '', // Holds the search input
                results: {
                    users: [], // Store search results for users
                    courses: [], // Store search results for courses
                    lessons: [], // Store search results for lessons
                    categories: [], // Store search results for categories
                    subcategories: [], // Store search results for subcategories
                }
            };
        },
        methods: {
            openSearchModal() {
                this.isModalVisible = true; // Show the modal
                document.body.style.overflow = 'hidden'; // Disable scrolling on the body
            },
            closeSearchModal() {
                this.isModalVisible = false; // Hide the modal
                this.results = { // Clear results when closing the modal
                    users: [],
                    courses: [],
                    lessons: [],
                    categories: [],
                    subcategories: [],
                };
                this.searchQuery = ''; // Clear search input
                document.body.style.overflow = ''; // Enable scrolling on the body
            },
            async performSearch() {
                if (this.searchQuery) {
                    try {
                        const response = await axios.get('/search', {
                            params: { query: this.searchQuery }
                        });
                        this.results = response.data; // Store results

                        // Check if all result arrays are empty
                        if (
                            !this.results.users.length &&
                            !this.results.courses.length &&
                            !this.results.lessons.length &&
                            !this.results.categories.length &&
                            !this.results.subcategories.length
                        ) {
                            // Show a simplified SweetAlert message if no results found
                            Swal.fire({
                                icon: 'warning',
                                title: 'No Results Found',
                                text: 'Please try again with different keywords.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#423a8e', // Button color
                            });
                        }
                    } catch (error) {
                        console.error('Search request failed:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33',
                        });
                    }
                }
            },
            handleResultClick() {
                this.closeSearchModal();
            }
        }
    };
</script>

<style scoped>
    /* Hide scrolling for the body when the modal is open */
    .search-input-container {
        display: flex;
        align-items: center; /* Center items vertically */
        margin-bottom: 20px; /* Space between input and results */
    }

    .search-input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
        margin-right: 10px; /* Space between input and button */
    }

    .search-button {
        padding: 10px 15px;
        background-color: #007bff; /* Primary button color */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .search-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000; /* Higher z-index to cover other elements */
        overflow: hidden; /* Prevent scrolling on the modal overlay */
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 800px;
        width: 100%;
        max-height: 100vh;
        overflow-y: auto; /* Scroll inside the modal if content overflows */
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .results-section {
        max-height: 60vh;
        overflow-y: auto;
        padding-right: 10px;
        margin-top: 20px;
    }

    h2.modal-title {
        margin-bottom: 20px;
        font-size: 24px;
        color: #444;
        font-weight: 600;
    }

    h3 {
        margin-top: 20px;
        font-size: 18px;
        color: #555;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        text-transform: uppercase; /* Uppercase for headings */
    }

    .result-item {
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        text-transform: lowercase; /* Lowercase for results */
    }

    .result-item:last-child {
        border-bottom: none;
    }

    .no-results {
        color: #999;
        font-style: italic;
    }
</style>
