<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">
                <td>{{ index + 1 }}</td>
                <td>{{ limitText(data.title)}}</td>
                <td>{{ limitText(data.course ? data.course.title : '' )}}</td>
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

        <validate-form-modal @handle-submit="handleSubmit" @close-modal="closeModal" title="Lessons">
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
                    Description
                    <textarea
                            type="text"
                            class="form-control"
                            placeholder="Category description here"
                            v-model="formData.description"
                            v-validate="'max:500'"
                            name="description"
                            @input="validateField"
                    ></textarea>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Video URL
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Enter video URL or link here"
                            v-model="formData.video"
                            v-validate="'required|url'"
                            name="video"
                            @input="validateField"
                    />
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label w-100">
                    Courses
                    <select
                            class="form-select"
                            v-model="formData.course_id"
                            v-validate="'required'"
                            name="subcategory"
                    >
                        <option value="" disabled>Select a category</option>
                        <option v-for="course in courses" :key="course.id" :value="course.id">
                            {{ course.title }}
                        </option>
                    </select>
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
    import validatorMixin from "../../mixins/validatorMixin";
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "lessonsComponent",
        components: {ValidateFormModal, DataTable},
        mixins: [validatorMixin, validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Title', 'Courses', 'Status', 'Actions'], // Column headings for the data table
                courses: [], // Array to hold courses fetched from the server
            };
        },
        mounted() {
            this.fetchCategories(); // Fetch categories when the component is mounted
        },
        methods: {
            /**
             * Fetch categories from the API and update the courses array.
             */
            fetchCategories() {
                const _this = this;
                _this.httpReq({
                    customUrl: 'api/courses',
                    callback: (response) => {
                        if (response.data)
                            _this.courses = response.data.result; // Set to courses, not categories
                    }
                });
            },
        },
    };
</script>
