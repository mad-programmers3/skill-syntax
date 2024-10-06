<!--<template>-->
<!--    <div>-->
<!--        <data-table :table-heading="tableHeading" @open-modal="openModal">-->
<!--            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem">-->
<!--                <td>{{ index + 1 }}</td>-->
<!--                <td>{{ limitText(data.title)}}</td>-->
<!--                <td>{{ limitText(data.popularCourses ? data.popularCourses.title : '' )}}</td>-->
<!--                    <td>-->
<!--                    <span :class="data.status ? 'badge badge-success' : 'badge badge-danger'">-->
<!--                        {{ data.status ? 'Active' : 'Inactive' }}-->
<!--                    </span>-->
<!--                </td>-->
<!--                <td>-->
<!--                    &lt;!&ndash;    edit btn    &ndash;&gt;-->
<!--                    <button v-if="can('category_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm"-->
<!--                            type="button">-->
<!--                        <i class="fa fa-edit"></i>-->
<!--                    </button>-->
<!--                    &lt;!&ndash;    delete btn    &ndash;&gt;-->
<!--                    <button v-if="can('category_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm"-->
<!--                            type="button">-->
<!--                        <i class="fa fa-trash text-white"></i>-->
<!--                    </button>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </data-table>-->

<!--        <validate-form-modal title="Lessons">-->
<!--            <div class="mb-3">-->
<!--                <label class="form-label w-100">-->
<!--                    Title-->
<!--                    <input-->
<!--                            type="text"-->
<!--                            class="form-control"-->
<!--                            placeholder="Category title here"-->
<!--                            v-model="formData.title"-->
<!--                            v-validate="'required|min:3|max:255'"-->
<!--                            name="title"-->
<!--                            @input="validateField"-->
<!--                    />-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label class="form-label w-100">-->
<!--                    Description-->
<!--                    <textarea-->
<!--                            type="text"-->
<!--                            class="form-control"-->
<!--                            placeholder="Category description here"-->
<!--                            v-model="formData.description"-->
<!--                            v-validate="'max:500'"-->
<!--                            name="description"-->
<!--                            @input="validateField"-->
<!--                    ></textarea>-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label class="form-label w-100">-->
<!--                    Video URL-->
<!--                    <input-->
<!--                            type="text"-->
<!--                            class="form-control"-->
<!--                            placeholder="Enter video URL or link here"-->
<!--                            v-model="formData.video"-->
<!--                            v-validate="'required|url'"-->
<!--                            name="video"-->
<!--                            @input="validateField"-->
<!--                    />-->
<!--                </label>-->
<!--            </div>-->

<!--            <div class="mb-3">-->
<!--                <label class="form-label w-100">-->
<!--                    Courses-->
<!--                    <select-->
<!--                            class="form-select"-->
<!--                            v-model="formData.course_id"-->
<!--                            v-validate="'required'"-->
<!--                            name="subcategory"-->
<!--                    >-->
<!--                        <option value="" disabled>Select a category</option>-->
<!--                        <option v-for="course in courses" :key="course.id" :value="course.id">-->
<!--                            {{ course.title }}-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </label>-->
<!--            </div>-->

<!--            <div class="mb-3">-->
<!--                <div class="custom-control custom-switch">-->
<!--                    <input-->
<!--                            type="checkbox"-->
<!--                            class="custom-control-input"-->
<!--                            id="customSwitch"-->
<!--                            v-model="formData.status"-->
<!--                            :true-value="1"-->
<!--                            :false-value="0"-->
<!--                            v-validate="'required'"-->
<!--                            name="status"-->
<!--                    />-->
<!--                    <label class="custom-control-label" for="customSwitch">-->
<!--                        {{ formData.status ? 'Active' : 'Inactive' }}-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->

<!--        </validate-form-modal>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import DataTable from "../../components/dataTable";-->
<!--    import ValidateFormModal from "../../components/validateFormModal";-->
<!--    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";-->

<!--    export default {-->
<!--        name: "lessonsComponent",-->
<!--        components: {ValidateFormModal, DataTable},-->
<!--        mixins: [validatorListComponentMixin],-->
<!--        data() {-->
<!--            return {-->
<!--                tableHeading: ['SL', 'Title', 'Courses', 'Status', 'Actions'], // Column headings for the data table-->
<!--                courses: [], // Array to hold courses fetched from the server-->
<!--            };-->
<!--        },-->
<!--        mounted() {-->
<!--            const _this = this;-->
<!--            this.fetchData(_this.urlGenerate('api/courses'), (result) => {_this.courses = result});-->
<!--        }-->
<!--    };-->
<!--</script>-->














<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(data, index) in dataList" style="font-size: 0.8rem" :key="data.id">
                <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
                <td>{{ limitText(data.title) }}</td>
                <td>{{ limitText(data.popularCourses ? data.popularCourses.title : '') }}</td>
                <td>
                    <span :class="data.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ data.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <button v-if="can('lesson_edit')" @click="onClickUpdate(data)" class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button v-if="can('lesson_delete')" @click="deleteItem(data.id)" class="btn btn-danger btn-sm" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

        <!-- Pagination Control -->
        <Pagination
                :currentPage="currentPage"
                :lastPage="lastPage"
                @change-page="fetchLessons"
        />

        <validate-form-modal title="Lessons" width="700px">
            <div class="mb-3">
                <label class="form-label w-100">
                    Title
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Lesson title here"
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
                            placeholder="Lesson description here"
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
                            name="course_id"
                    >
                        <option value="" disabled>Select a course</option>
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
    import axios from 'axios';
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import Pagination from "../../components/Pagination"; // Import your Pagination component
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "lessonsComponent",
        components: { ValidateFormModal, DataTable, Pagination },
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Title', 'Courses', 'Status', 'Actions'], // Column headings for the data table
                courses: [], // Array to hold courses fetched from the server
                lessons: [], // Data list for lessons
                dataList:[],
                currentPage: 1, // Current page for pagination
                lastPage: 1, // Last page for pagination
                itemsPerPage: 10, // Set the number of items per page

            };
        },
        methods: {
            async fetchLessons(page = 1) {
                try {
                    const response = await axios.get(`/api/lessons?page=${page}`);
                    this.dataList = response.data.data; // Use dataList for lesson data
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                } catch (error) {
                    console.error("Failed to fetch lessons", error.response.data); // Log the error response
                }
            },

            async fetchCourses() {
                try {
                    const response = await axios.get('/api/courses');
                    this.courses = response.data; // Set courses data
                } catch (error) {
                    console.error("Failed to fetch courses", error);
                }
            },
            // ... Other methods for handling updates, deletions, etc.
        },
        mounted() {
            this.fetchLessons(this.currentPage); // Fetch the initial lessons
            this.fetchCourses(); // Fetch courses for the dropdown
        },
    };
</script>

<style scoped>
    /* Add any custom styles here */
</style>











