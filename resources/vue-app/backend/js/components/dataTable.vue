<template>
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Table title is dynamically set based on the page title from route meta -->
                            <h4 class="card-title mb-0">{{ tableTitle }}</h4>

                            <!-- Button to trigger the modal, emits the 'open-modal' event -->
                            <button @click="openModal" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <!-- Table that displays headings passed as props -->
                        <div class="table-responsive">
                            <table class="table user-table no-wrap">
                                <thead>
                                <tr>
                                    <!-- Loop through tableHeading array/object and display headings -->
                                    <th class="border-top-0" v-for="heading in tableHeading">{{ heading }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Slot for dynamic table rows (data passed by the parent) -->
                                <slot/>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dataTable", // Name of the component

        // Props allow passing table headings from the parent component
        props: {
            tableHeading: {
                type: [Array, Object], // Can be either an array or object
                default() {
                    return [];
                }
            }
        },

        // Computed property for the table title based on route meta data
        computed: {
            tableTitle() {
                return this.$route.meta.pageTitle; // Dynamically sets title from the route meta field
            }
        },

        methods: {
            /**
             * Emits an 'open-modal' event to the parent component when the button is clicked.
             */
            openModal() {
                this.$emit('open-modal'); // Triggers the parent component's modal opening method
            }
        }
    }
</script>

<style scoped>
    /* Scoped styles specific to this component can go here */
</style>
