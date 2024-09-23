<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>{{ data.title }}</td>
                <td>{{ data.category.title }}</td>
                <td>{{ data.price }}</td>
                <td>{{ data.sits }}</td>
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
        <validate-form-modal @handle-submit="handleSubmit" @close-modal="closeModal" title="Course">
            <div class="mb-3">
                <label class="form-label w-100">
                    Title
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Course title here"
                            v-model="formData.title"
                            v-validate="'required|min:3|max:255'"
                            name="title"
                            @input="validateField"
                    />
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Description
                    <textarea
                            type="text"
                            class="form-control"
                            placeholder="Course details here"
                            v-model="formData.description"
                            v-validate="'max:500'"
                            name="details"
                            @input="validateField"
                    ></textarea>
                </label>
            </div>
            <div class="mb-3 d-flex">
                <div class="w-50 pe-2">
                    <label class="form-label d-block">
                        Category
                        <select
                                class="form-control"
                                v-model="formData.category_id"
                                v-validate="'required'"
                                name="category_id"
                                @change="validateField"
                        >
                            <option value="">Select a category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </label>
                </div>

                <div class="w-50 ps-2">
                    <label class="form-label d-block">
                        Sub Category
                        <select
                                class="form-control"
                                v-model="formData.sub_category_id"
                                v-validate="'required'"
                                name="sub_category_id"
                                @change="validateField"
                        >
                            <option value="">Select a sub category</option>
                            <option v-for="subCategory in subCategories" :key="subCategory.id" :value="subCategory.id">
                                {{ subCategory.title }}
                            </option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Start Date
                    <input
                            type="date"
                            class="form-control"
                            placeholder="Category title here"
                            v-model="formData.start_date"
                            v-validate=""
                            name="title"
                            @input="validateField"
                    />
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    End Date
                    <input
                            type="date"
                            class="form-control"
                            placeholder="Category title here"
                            v-model="formData.end_date"
                            v-validate=""
                            name="title"
                            @input="validateField"
                    />
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Price
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Enter course price"
                            v-model="formData.price"
                            v-validate="'required|decimal'"
                            name="price"
                            @input="validateField"
                    />
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Sits
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Enter available sits"
                            v-model="formData.sits"
                            v-validate="'required|numeric'"
                            name="sits"
                            @input="validateField"
                    />
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
        name: "categoriesComponent",
        components: {ValidateFormModal, DataTable},
        mixins: [validatorMixin, validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Title', 'Category', 'Price', 'Sits', 'Status', 'Actions'],
                categories: {},
                subCategories: {}
            }
        },
        mounted() {
            this.formData.sub_category_id = 1;

            this.fetchCategories();
            this.fetchSubCategories();
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
            fetchSubCategories() {
                const _this = this;
                _this.httpReq({
                    customUrl: 'api/sub-categories',
                    callback: (response) => {
                        if (response.data)
                            _this.subCategories = response.data.result;
                    }
                })
            },
        },
    }
</script>

<style scoped>

</style>
