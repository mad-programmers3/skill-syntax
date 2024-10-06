
<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" v-if="data" style="font-size: 0.8rem" :key="data.id">
                <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
                <td>
                    <img :src="generateFileUrl(data.thumbnail)" style="width: 50px; height: 50px; border-radius: 0%" alt="">
                </td>
                <td>{{ limitText(data.title) }}</td>
                <td>{{ limitText(data.category ? data.category.title : '' )}}</td>
                <td>{{ formatDecimal(data.price) }}</td>
                <td>{{ data.sits }}</td>
                <td>
                    <span :class="data.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ data.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <button v-if="can('category_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button v-if="can('category_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

        <!-- Pagination Control -->
        <Pagination
                :currentPage="currentPage"
                :lastPage="lastPage"
                @change-page="fetchCourses"
        />

        <validate-form-modal title="Course" width="700px">
            <div class="mb-3">
                <label class="form-label w-100">
                    Title
                    <input type="text" class="form-control" v-model="formData.title" v-validate="'required|min:3|max:255'" name="title" @input="validateField"/>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Description
                    <quill-editor v-model="formData.description" class="quill-editor"></quill-editor>
                </label>
            </div>

            <div class="mb-3 d-flex">
                <div class="w-50 pr-2">
                    <label class="form-label d-block">
                        Category
                        <select class="form-control" v-model="formData.category_id" v-validate="'required'" name="category_id" @change="validateField">
                            <option value="">Select a category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </label>
                </div>

                <div class="w-50 pl-2">
                    <label class="form-label d-block">
                        Sub Category
                        <select class="form-control" v-model="formData.sub_category_id" v-validate="'required'" name="sub_category_id" @change="validateField">
                            <option value="">Select a subCategory</option>
                            <option v-for="subCategory in subCategories" :key="subCategory.id" :value="subCategory.id">
                                {{ subCategory.title }}
                            </option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="mb-3 d-flex">
                <div class="w-50 pr-2">
                    <label class="form-label w-100">
                        Start Date
                        <input type="date" class="form-control" placeholder="Category title here" v-model="formData.start_date" v-validate="" name="title" @input="validateField"/>
                    </label>
                </div>

                <div class="w-50 pl-2">
                    <label class="form-label w-100">
                        End Date
                        <input type="date" class="form-control" placeholder="Category title here" v-model="formData.end_date" v-validate="" name="title" @input="validateField"/>
                    </label>
                </div>
            </div>
            <div class="mb-3 d-flex">
                <div class="w-50 pr-2">
                    <label class="form-label w-100">
                        Price
                        <input type="text" class="form-control" placeholder="Enter course price" v-model="formData.price" v-validate="'required|decimal'" name="price" @input="validateField"/>
                    </label>
                </div>

                <div class="w-50 pl-2">
                    <label class="form-label w-100">
                        Sits
                        <input type="text" class="form-control" placeholder="Enter available sits" v-model="formData.sits" v-validate="'required|numeric'" name="sits" @input="validateField"/>
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch" v-model="formData.status" :true-value="1" :false-value="0" v-validate="'required'" name="status"/>
                    <label class="custom-control-label" for="customSwitch">
                        {{ formData.status ? 'Active' : 'Inactive' }}
                    </label>
                </div>
            </div>

            <div>
                <div class="upload-area d-block m-auto" @click="() => {$refs.fileInput.click()}">
                    <img :src="generateFileUrl(formData.thumbnail)" alt="Preview" class="preview-img"/>
                </div>
                <input type="file" ref="fileInput" @change="handleFileUpload" class="file-input" accept="image/*"/>
            </div>

        </validate-form-modal>
    </div>
</template>

<script>
    import QuillEditor from "../../components/quillEditor"; // Text editor
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import Pagination from "../../components/Pagination"; // Import your Pagination component
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "coursesComponent",
        components: { ValidateFormModal, DataTable, QuillEditor, Pagination }, // Register Pagination component
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Images', 'Title', 'Category', 'Price', 'Sits', 'Status', 'Actions'],
                categories: {},
                subCategories: {},
                currentPage: 1, // Current page for pagination
                lastPage: 1, // Last page for pagination
                itemsPerPage: 1, // Set to the same number used in backend pagination
            };
        },

        methods: {
            async fetchCourses(page = 1) {
                try {
                    const _this = this;
                    this.fetchData(this.urlGenerate(false, false, page), (result) => {
                        console.log(result.data);
                        _this.$store.commit('setDataList', result.data);
                        _this.currentPage = result.current_page;
                        _this.lastPage = result.last_page;
                    });
                } catch (error) {
                    console.error("Failed to fetch courses", error);
                }
            },
            // ... rest of your methods
        },

        mounted() {
            // Fetch the first page of courses when the component mounts
            this.fetchCourses(this.currentPage); // Ensure this fetches the initial course data

            // Fetch categories and sub-categories
            this.fetchData(this.urlGenerate('api/categories'), (result) => {
                this.categories = result;
            });
            this.fetchData(this.urlGenerate('api/sub-categories'), (result) => {
                this.subCategories = result;
            });
        },

    };
</script>

<style scoped>
    .upload-area {
        width: 300px;
        height: 200px;
        border: 2px dashed #34a9cc;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .preview-img {
        max-width: 100%;
        max-height: 100%;
    }

    .file-input {
        display: none;
    }
</style>
