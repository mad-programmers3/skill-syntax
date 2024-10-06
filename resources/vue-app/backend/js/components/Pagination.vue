<!--<template>-->
<!--    <div class="pagination d-flex justify-content-center my-4">-->
<!--        <button-->
<!--                @click="emitPage(currentPage - 1)"-->
<!--                :disabled="currentPage === 1"-->
<!--                class="btn btn-outline-primary mx-2"-->
<!--        >-->
<!--            Previous-->
<!--        </button>-->
<!--        <span class="mx-2">Page {{ currentPage }} of {{ lastPage }}</span>-->
<!--        <button-->
<!--                @click="emitPage(currentPage + 1)"-->
<!--                :disabled="currentPage === lastPage"-->
<!--                class="btn btn-outline-primary mx-2"-->
<!--        >-->
<!--            Next-->
<!--        </button>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    export default {-->
<!--        props: {-->
<!--            currentPage: {-->
<!--                type: Number,-->
<!--                required: true,-->
<!--            },-->
<!--            lastPage: {-->
<!--                type: Number,-->
<!--                required: true,-->
<!--            },-->
<!--        },-->
<!--        methods: {-->
<!--            emitPage(page) {-->
<!--                this.$emit('change-page', page);-->
<!--            },-->
<!--        },-->
<!--    };-->
<!--</script>-->

<!--<style scoped>-->
<!--    .pagination {-->
<!--        margin-top: 20px;-->
<!--    }-->

<!--    .pagination button {-->
<!--        background-color: #423a8e;-->
<!--        color: white;-->
<!--    }-->

<!--    .pagination button:disabled {-->
<!--        background-color: #ccc;-->
<!--        color: #666;-->
<!--    }-->

<!--    .pagination span {-->
<!--        align-self: center;-->
<!--        color: #423a8e;-->
<!--    }-->
<!--</style>-->




































<template>
    <div class="pagination d-flex justify-content-center my-4">
        <button
                @click="emitPage(currentPage - 1)"
                :disabled="currentPage === 1"
                class="btn btn-outline-primary mx-2"
        >
            Previous
        </button>

        <!-- Page number buttons -->
        <button
                v-for="page in pages"
                :key="page"
                @click="emitPage(page)"
                :disabled="currentPage === page"
                :class="['btn', 'mx-1', { 'btn-active': currentPage === page, 'btn-inactive': currentPage !== page }]"
        >
            {{ page }}
        </button>

        <button
                @click="emitPage(currentPage + 1)"
                :disabled="currentPage === lastPage"
                class="btn btn-outline-primary mx-2"
        >
            Next
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            currentPage: {
                type: Number,
                required: true,
            },
            lastPage: {
                type: Number,
                required: true,
            },
        },
        computed: {
            pages() {
                // Create an array of page numbers to display
                const pageArray = [];
                for (let i = 1; i <= this.lastPage; i++) {
                    pageArray.push(i);
                }
                return pageArray;
            },
        },
        methods: {
            emitPage(page) {
                this.$emit('change-page', page);
            },
        },
    };
</script>

<style scoped>
    .pagination {
        margin-top: 20px;
    }

    .pagination button {
        background-color: #423a8e; /* Default button color */
        color: white;
    }

    .pagination button:disabled {
        background-color: #ccc; /* Disabled button color */
        color: #666;
    }

    .pagination button.btn-active {
        background-color: #423a8e; /* Active button color */
        color: white; /* Text color for active button */
        border: none; /* Optional: remove border */
    }

    .pagination button.btn-inactive {
        background-color: #666; /* Inactive button color */
        color: white; /* Text color for inactive buttons */
    }

    .pagination span {
        align-self: center;
        color: #423a8e;
    }
</style>

