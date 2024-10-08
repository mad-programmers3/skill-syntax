<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in (dataList.data ? dataList.data : dataList)" style="font-size: 0.8rem" :key="data.id">
                <td>{{ (dataList.current_page ? (dataList.current_page - 1) * perPage : 0) + index + 1 }}</td>
                <td>{{ limitText(data.title) }}</td>
                <td>
                    <span :class="data.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ data.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <!-- Edit button -->
                    <button v-if="can('category_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm" :title="`Edit ${data.title}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!-- Delete button -->
                    <button v-if="can('category_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm" :title="`Delete ${data.title}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

<!-- pagination Control-->
        <Pagination v-if="dataList.current_page" :currentPage="dataList.current_page" :lastPage="dataList.last_page" :per-page="perPage"/>


        <validate-form-modal title="Category">
            <div class="mb-3">
                <label class="form-label w-100">
                    Title
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Category title here"
                            v-model="formData.title"
                            v-validate="'required|min:3|max:255'"
                            name="title"
                            @input="validateField"
                    />
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Details
                    <textarea
                            type="text"
                            class="form-control"
                            placeholder="Category details here"
                            v-model="formData.details"
                            v-validate="'max:500'"
                            name="details"
                            @input="validateField"
                    ></textarea>
                </label>
            </div>
            <div class="mb-3">
                <div class="custom-control custom-switch">
                    <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customSwitch"
                            v-model="formData.status"
                            :true-value="1"
                            :false-value="0"
                            v-validate="'required'"
                            name="status"
                    />
                    <label class="custom-control-label" for="customSwitch">
                        {{ formData.status ? 'Active' : 'Inactive' }}
                    </label>
                </div>
            </div>
        </validate-form-modal>
    </div>
</template>


<script>
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import Pagination from "../../components/Pagination"; // Import your Pagination component
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "categoriesComponent",
        components: {ValidateFormModal, DataTable,Pagination},
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Title', 'Status', 'Actions'],
                perPage:5
            }
        },
        mounted() {
            // Fetch datalist with paginate
            this.fetchData(this.urlGenerate(false, false, {page: 1, perPage: this.perPage}));
        }
    }
</script>

<style scoped>

</style>
