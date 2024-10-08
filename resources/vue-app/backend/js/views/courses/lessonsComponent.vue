
<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(lesson, index) in (dataList.data ? dataList.data : dataList)" style="font-size: 0.8rem" :key="lesson.id">
                <td>{{ (dataList.current_page ? (dataList.current_page - 1) * perPage : 0) + index + 1 }}</td>
                <td>{{ limitText(lesson.title) }}</td>
                <td>{{ limitText(lesson.course ? lesson.course.title : '') }}</td>
                <td>
                    <span :class="lesson.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ lesson.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <!--    edit btn    -->
                    <button v-if="can('category_edit')" @click="onClickUpdate(lesson)" class="btn btn-primary btn-sm" :title="`Edit ${lesson.title}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!--    delete btn    -->
                    <button v-if="can('category_delete')" @click="deleteItem(lesson.id)" class="btn btn-danger btn-sm" :title="`Delete ${lesson.title}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

        <!-- Pagination Control -->
        <Pagination v-if="dataList.current_page" :currentPage="dataList.current_page" :lastPage="dataList.last_page" :per-page="perPage"/>

        <validate-form-modal title="Lessons" width="700px">
            <div class="mb-3">
                <label class="form-label w-100">
                    Title
                    <input type="text" class="form-control" placeholder="Lesson title here" v-model="formData.title" v-validate="'required|min:3|max:255'" name="title" @input="validateField"/>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Description
                    <textarea type="text" class="form-control" placeholder="Lesson description here" v-model="formData.description" v-validate="'max:500'" name="description" @input="validateField"></textarea>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Video URL
                    <input type="text" class="form-control" placeholder="Enter video URL or link here" v-model="formData.video" v-validate="'required|url'" name="video" @input="validateField"/>
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label w-100">
                    Courses
                    <select class="form-select" v-model="formData.course_id" v-validate="'required'" name="course_id">
                        <option value="" disabled>Select a course</option>
                        <option v-for="course in courses" :key="course.id" :value="course.id">
                            {{ course.title }}
                        </option>
                    </select>
                </label>
            </div>

            <div class="mb-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch" v-model="formData.status" :true-value="1" :false-value="0" v-validate="'required'" name="status"/>
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
        name: "lessonsComponent",
        components: { ValidateFormModal, DataTable, Pagination },
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Title', 'Courses', 'Status', 'Actions'], // Column headings for the data table
                courses: [], // Array to hold courses fetched from the server
                lessons: [], // Data list for lessons
                perPage: 5,
            };
        },

        mounted() {
            // Fetch datalist with paginate
            this.fetchData(this.urlGenerate(false, false, {page: 1, perPage: this.perPage}));

            // Fetch courses for the dropdown
            const _this = this;
            this.fetchData(this.urlGenerate('api/courses'), (result) => {
                _this.courses = result;
            });
        },


    };
</script>

<style scoped>
    /* Add any custom styles here */
</style>
