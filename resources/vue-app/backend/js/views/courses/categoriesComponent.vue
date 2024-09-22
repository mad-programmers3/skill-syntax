<template>
<!--    <div class="container-fluid px-4">-->
<!--        <div class="col-lg-12 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h3 class="card-title">Categories Management</h3>-->
<!--                    <div class="d-flex justify-content-between mb-3">-->
<!--                        <div></div>-->
<!--                        <button class="btn btn-primary" @click.prevent="showAddCategoryModal">+ Add Category</button>-->
<!--                    </div>-->
<!--                    <div class="table-responsive">-->
<!--                        <table class="table table-striped">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>SL</th>-->
<!--                                <th>Title</th>-->
<!--                                <th>Details</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="(category, index) in categories" :key="category.id">-->
<!--                                <td>{{ index + 1 }}</td>-->
<!--                                <td>{{ category.title }}</td>-->
<!--                                <td>{{ category.details ? category.details : 'N/A' }}</td>-->
<!--                                <td>-->
<!--                                        <span :class="category.status ? 'badge badge-success' : 'badge badge-danger'">-->
<!--                                            {{ category.status ? 'Active' : 'Inactive' }}-->
<!--                                        </span>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <button class="btn btn-outline-success btn-sm" @click="editCategory(category)">-->
<!--                                        <i class="fa fa-pencil"></i> Edit-->
<!--                                    </button>-->
<!--                                    <button class="btn btn-outline-danger btn-sm" @click="deleteCategory(category.id)">-->
<!--                                        <i class="fa fa-trash"></i> Delete-->
<!--                                    </button>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Add/Edit Category Modal -->
<!--        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">-->
<!--            <div class="modal-dialog" role="document">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="addCategoryModalLabel">{{ isEditMode ? 'Edit Category' : 'Add Category' }}</h5>-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetForm">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <form @submit.prevent="isEditMode ? updateCategory() : submitCategory()">-->
<!--                            <div class="form-group">-->
<!--                                <label for="categoryTitle">Title</label>-->
<!--                                <input type="text" class="form-control" id="categoryTitle" v-model="newCategory.title" required>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="categoryDetails">Details</label>-->
<!--                                <textarea class="form-control" id="categoryDetails" v-model="newCategory.details"></textarea>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="categoryStatus">Status</label>-->
<!--                                <select class="form-control" id="categoryStatus" v-model="newCategory.status" required>-->
<!--                                    <option value="1">Active</option>-->
<!--                                    <option value="0">Inactive</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                            <button type="submit" class="btn btn-primary">{{ isEditMode ? 'Update' : 'Submit' }}</button>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>{{ data.title }}</td>
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
        <validate-form-modal @handle-submit="handleSubmit" @close-modal="closeModal" title="Category">
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
                tableHeading: ['SL', 'Title', 'Status', 'Actions'],
            }
        },
        methods: {
            //
        },
    }
</script>

<style scoped>

</style>
