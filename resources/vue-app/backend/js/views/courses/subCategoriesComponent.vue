<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>{{ data.title }}</td>
                <td>{{ data.category.title }}</td>
                <td>
                    <span :class="data.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ data.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <!--    edit btn    -->
                    <button v-if="can('category_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm"
                            type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!--    delete btn    -->
                    <button v-if="can('category_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm"
                            type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>
        <validate-form-modal @handle-submit="handleSubmit" @close-modal="closeModal" title="SubCategory">

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
                    Category
                    <select
                            class="form-select"
                            v-model="formData.category_id"
                            v-validate="'required'"
                            name="subcategory"
                    >
                        <option value="" disabled>Select a category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.title }}
                        </option>
                    </select>
                </label>
            </div>
            <label>Status</label>
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label w-100">
                        <input
                                class="form-check-input"
                                type="radio"
                                :value="1"
                                v-model="formData.status"
                                v-validate="'required'"
                                name="status"
                        />Active
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label w-100">
                        <input
                                class="form-check-input"
                                type="radio"
                                :value="0"
                                v-model="formData.status"
                                v-validate="'required'"
                                name="status"
                        />Inactive
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
        name: "subCategories",
        components: {ValidateFormModal, DataTable},
        mixins: [validatorMixin, validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL','Title', 'Category', 'Status', 'Actions'],
                categories: {}
            }
        },
        mounted() {
            this.fetchCategories();
        },
        methods: {
            fetchCategories() {
                const _this = this;
                _this.httpReq({
                    customUrl: 'api/categories',
                    callback: (response) => {
                        if (response.data)
                            _this.categories = response.data.result;
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
