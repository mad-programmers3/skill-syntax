<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" :key="data.id" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>{{ limitText(data.review ? data.review.comment : '' )}}</td>
                <td>{{ limitText(data.review ? data.review.user : '')}}</td>
                <td>{{ data.review ? data.review.rating : ''}}</td>
                <td>
                    <span :class="data.review && data.review.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ data.review && data.review.status ? 'Showing' : 'Hidden' }}
                    </span>
                </td>
                <td>
                    <!-- Edit button -->
                    <button v-if="can('category_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!-- Delete button -->
                    <button v-if="can('category_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

        <validate-form-modal @handle-submit="handleSubmit" @close-modal="closeModal" title="Course Review">
            <div v-if="formData.review" class="mb-3">
                <div class="custom-control custom-switch">
                    <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customSwitch"
                            v-model="formData.review.status"
                            :true-value="1"
                            :false-value="0"
                    />
                    <label class="custom-control-label" for="customSwitch">
                        {{ formData.review.status ? 'Active' : 'Inactive' }}
                    </label>
                </div>
            </div>
        </validate-form-modal>
    </div>
</template>

<script>
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import validatorMixin from "../../mixins/validatorMixin";
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "testimonialComponent",
        components: {ValidateFormModal, DataTable},
        mixins: [validatorMixin, validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Review','User','Rating', 'Status', 'Actions'],
            }
        },
        methods: {

        },
    }
</script>

<style scoped>

</style>
