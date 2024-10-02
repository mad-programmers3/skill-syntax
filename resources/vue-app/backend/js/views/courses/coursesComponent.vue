<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModalAndResetUploadFileInfos">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>
                    <img :src="data.thumbnail && data.thumbnail.path? generateFileUrl(data.thumbnail.path) :  baseUrl + '/images/course-def-thumbnail.jpg'"
                         style="width: 50px; height: 50px; border-radius: 0%" alt="">
                </td>
                <td>{{ limitText(data.title) }}</td>
                <td>{{ limitText(data.category ? data.category.title : '' )}}</td>
                <td>{{formatDecimal(data.price) }}</td>
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
        <validate-form-modal @handle-submit="submit" @close-modal="closeModalAndResetUploadFileInfos" title="Course"
                             width="700px">
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
                    <quill-editor
                            v-model="formData.description"
                            class="quill-editor"
                    ></quill-editor>
                </label>
            </div>

            <div class="mb-3 d-flex">
                <div class="w-50 pr-2">
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

                <div class="w-50 pl-2">
                    <label class="form-label d-block">
                        Sub Category
                        <select
                                class="form-control"
                                v-model="formData.sub_category_id"
                                v-validate="'required'"
                                name="sub_category_id"
                                @change="validateField"
                        >
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

                <div class="w-50 pl-2">
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
            </div>
            <div class="mb-3 d-flex">
                <div class="w-50 pr-2">
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

                <div class="w-50 pl-2">
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

            <!--    Upload image        -->
            <div>
                <div
                        class="upload-area d-block m-auto"
                        @click="triggerFileInput"
                >
                    <img :src="uploadFileUrl ? uploadFileUrl : formData.thumbnail && formData.thumbnail.path ? generateFileUrl(formData.thumbnail.path) : baseUrl + '/backend/assets/images/upload.png'"
                         alt="Preview" class="preview-img"/>
                </div>
                <input
                        type="file"
                        ref="fileInput"
                        @change="handleFileChange"
                        class="file-input"
                        accept="image/*"
                />
            </div>

        </validate-form-modal>
    </div>
</template>

<script>
    import QuillEditor from "../../components/quillEditor"; // Text editor
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "categoriesComponent",
        components: {ValidateFormModal, DataTable, QuillEditor}, // Register QuillEditor component
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Images', 'Title', 'Category', 'Price', 'Sits', 'Status', 'Actions'],
                categories: {},
                subCategories: {},
                uploadFile: null,      // The uploaded file object
                uploadFileUrl: null,   // The URL for previewing the uploaded file
            }
        },
        mounted() {
            const _this = this;

            this.fetchData(_this.urlGenerate('api/categories'), (result) => {_this.categories = result});
            this.fetchData(_this.urlGenerate('api/sub-categories'), (result) => {_this.subCategories = result});
        },
        methods: {
            submit(e) {
                this.handleSubmitWithFile(e, this.handleSubmit);
            },

            closeModalAndResetUploadFileInfos() {
                this.closeModal(this.resetUploadFileInfos);
            },
            openModalAndResetUploadFileInfos() {
                this.openModal(this.resetUploadFileInfos);
            },

            /**
             * Handles form submission when a file is uploaded.
             * If a file is uploaded, it adds the file and user ID to the form data.
             * @param {Event} e - The event triggered by the form submission.
             * @param {Function} submitHandler - The function to handle form submission.
             */
            handleSubmitWithFile(e, submitHandler) {
                if (this.uploadFile) {
                    this.uploadFile.user_id = this.getAuth().id;  // Adds user ID to the file data
                    this.formData.uploadFile = this.uploadFile;    // Adds the uploaded file to the form data
                }

                if (typeof submitHandler === 'function') submitHandler(e);  // Call the submit handler if provided
            },

            /**
             * Programmatically triggers the file input element to open the file picker dialog.
             */
            triggerFileInput() {
                this.$refs.fileInput.click();  // Simulate a click on the hidden file input
            },

            /**
             * Handles the file input change event.
             * Calls the file processing method with the selected file.
             * @param {Event} event - The file input change event.
             */
            handleFileChange(event) {
                const file = event.target.files[0];  // Get the selected file
                this.handleFileUpload(file);         // Process the file
            },

            /**
             * Processes the uploaded file and sends it to the server.
             * It validates the file type (must be an image) and creates a URL for preview.
             * @param {File} file - The file object selected by the user.
             */
            handleFileUpload(file) {
                if (!file || !file.type.startsWith("image/")) {  // Check if the file is an image
                    alert("Please upload a valid image file.");  // Show an alert if the file is not valid
                    return;
                }

                // Create a URL for the image preview
                this.uploadFileUrl = URL.createObjectURL(file);

                const imgFormData = new FormData();
                imgFormData.append('file', file);  // Append the image file to the FormData

                // Send the image to the server
                this.httpReq({
                    customUrl: 'api/files/upload',
                    method: 'post',
                    callback: (res) => {
                        if (res.data.success) this.uploadFile = res.data;  // Save the response data if the upload is successful
                    },
                    data: imgFormData
                });
            },

            /**
             * Resets the uploaded file and its preview URL.
             */
            resetUploadFileInfos() {
                this.uploadFile = null;      // Reset the uploaded file object
                this.uploadFileUrl = null;   // Reset the file preview URL
            }
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

