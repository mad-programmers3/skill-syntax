<template>
    <div class="container-fluid px-4">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Categories Management</h3>
                    <div class="d-flex justify-content-between mb-3">
                        <div></div>
                        <button class="btn btn-primary" @click.prevent="showAddCategoryModal">+ Add Category</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category, index) in categories" :key="category.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ category.title }}</td>
                                <td>{{ category.details ? category.details : 'N/A' }}</td>
                                <td>
                                        <span :class="category.status ? 'badge badge-success' : 'badge badge-danger'">
                                            {{ category.status ? 'Active' : 'Inactive' }}
                                        </span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm" @click="editCategory(category)">
                                        <i class="fa fa-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" @click="deleteCategory(category.id)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">{{ isEditMode ? 'Edit Category' : 'Add Category' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="isEditMode ? updateCategory() : submitCategory()">
                            <div class="form-group">
                                <label for="categoryTitle">Title</label>
                                <input type="text" class="form-control" id="categoryTitle" v-model="newCategory.title" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryDetails">Details</label>
                                <textarea class="form-control" id="categoryDetails" v-model="newCategory.details"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoryStatus">Status</label>
                                <select class="form-control" id="categoryStatus" v-model="newCategory.status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ isEditMode ? 'Update' : 'Submit' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "categoryComponent",
        data() {
            return {
                categories: [],
                baseUrl: window.baseUrl,
                newCategory: {
                    title: '',
                    details: '',
                    status: 1
                },
                isEditMode: false,
            };
        },
        methods: {
            fetchCategories() {
                axios.get(`${this.baseUrl}/api/categories`)
                    .then(response => {
                        if (response.data && response.data.result) {
                            this.categories = response.data.result;
                            console.log("Categories Loaded:", this.categories);
                        } else {
                            console.error("Unexpected API response structure:", response.data);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching categories:", error);
                    });
            },
            showAddCategoryModal() {
                this.resetForm();
                this.isEditMode = false;
                $('#addCategoryModal').modal('show');
            },
            submitCategory() {
                axios.post(`${this.baseUrl}/api/categories`, this.newCategory)
                    .then(response => {
                        this.fetchCategories();
                        $('#addCategoryModal').modal('hide');
                        this.showToast("Category added successfully!", "success");
                    })
                    .catch(error => {
                        console.error("Error adding category:", error);
                    });
            },
            editCategory(category) {
                this.newCategory = { ...category };
                this.isEditMode = true;
                $('#addCategoryModal').modal('show');
            },
            updateCategory() {
                axios.put(`${this.baseUrl}/api/categories/${this.newCategory.id}`, this.newCategory)
                    .then(response => {
                        this.fetchCategories();
                        $('#addCategoryModal').modal('hide');
                        this.showToast("Category updated successfully!", "success");
                    })
                    .catch(error => {
                        console.error("Error updating category:", error);
                    });
            },
            deleteCategory(id) {
                axios.delete(`${this.baseUrl}/api/categories/${id}`)
                    .then(response => {
                        this.fetchCategories();
                        this.showToast("Category deleted successfully!", "success");
                    })
                    .catch(error => {
                        console.error("Error deleting category:", error);
                    });
            },
            resetForm() {
                this.newCategory = { title: '', details: '', status: 1 };
                this.isEditMode = false;
            },
            showToast(message, type) {
                const toast = useToast();
                toast[type](message);
            }
        },
        mounted() {
            this.fetchCategories();
        }
    };
</script>

<style scoped>

</style>
