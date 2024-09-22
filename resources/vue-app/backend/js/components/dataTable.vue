<template>
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">{{ tableTitle }}</h4>
                            <button @click="openModal" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </div>

                        <div class="table-responsive">
                            <table class="table user-table no-wrap">
                                <thead>
                                <tr>
                                    <th class="border-top-0" v-for="heading in tableHeading">{{ heading}}</th>
                                </tr>
                                </thead>
                                <tbody>
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
        name: "dataTable",
        props: {
            tableHeading: {
                type: [Array, Object],
                default() {
                    return [];
                }
            }
        },
        computed: {
            tableTitle() {
                return this.$route.meta.pageTitle;
            }
        },
        methods: {
            openModal() {
                this.$emit('open-modal');
            }
        }
    }
</script>

<style scoped>

</style>