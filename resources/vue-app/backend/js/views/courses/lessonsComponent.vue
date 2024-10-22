
<template>
    <div>
        <data-table :table-heading="tableHeading" :show-add-btn="can('lesson_add')">
            <tr v-for="(lesson, index) in dataList.data" style="font-size: 0.8rem" :key="lesson.id">
                <td>{{ (dataList.current_page - 1) * perPage  + index + 1 }}</td>
                <td>
                    <img :src="generateFileUrl(lesson.thumbnail, TYPE_LESSON)" style="width: 50px; height: 35px; border-radius: 0%" alt="">
                </td>
                <td>{{ limitText(lesson.title) }}</td>
                <td>{{ limitText(lesson.course ? lesson.course.title : '') }}</td>
                <td>
                    {{ lesson.quizzes ? lesson.quizzes.length : '' }}

                    <i class="ml-1 fas fa-plus" data-toggle="modal" :data-target="`#quizzesModal${lesson.id}`" style="cursor: pointer"></i>
                    <show-details-modal :id="`quizzesModal${lesson.id}`" :title="`${lesson.title} => Quizzes`">
                        <div v-for="(quiz, index) in lesson.quizzes" :key="index" class="p-2 d-flex align-items-center justify-content-between" :style="{ backgroundColor: index % 2 === 0 ? '#e9e9e9' : '#f5f5f5' }">
                            <li style="list-style-type: decimal">{{ quiz.title }}</li>
                            <button @click="manipulateQuiz(quiz.id, lesson)" class="btn btn-danger px-1">Remove</button>
                        </div>
                        <label class="form-label d-block mt-5">
                            Add Quiz
                            <select @change="(event)=>{manipulateQuiz(event.target.value, lesson)}" class="form-control">
                                <option value="">Select a new quiz</option>
                                <option v-for="quiz in quizzes" v-if="!lesson.quizzes.map(q => q.id).includes(quiz.id)" :key="quiz.id" :value="quiz.id">
                                    {{ quiz.title }}
                                </option>
                            </select>
                        </label>
                    </show-details-modal>
                </td>
                <td>
                    <span :class="lesson.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ lesson.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <!--    edit btn    -->
                    <button v-if="can('lesson_edit')" @click="onClickUpdate(lesson)" class="btn btn-primary btn-sm" :title="`Edit ${lesson.title}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!--    delete btn    -->
                    <button v-if="can('lesson_delete')" @click="deleteItem(lesson.id, dataList.current_page, perPage)" class="btn btn-danger btn-sm" :title="`Delete ${lesson.title}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                </td>
            </tr>
        </data-table>

        <!-- Pagination Control -->
        <Pagination v-if="dataList.last_page > 1" :currentPage="dataList.current_page" :lastPage="dataList.last_page" :per-page="perPage"/>

        <validate-form-modal title="Lessons" width="700px" :current-page="dataList.current_page" :per-page="perPage">
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
                    <select class="form-control" v-model="formData.course_id" v-validate="'required'" name="course_id">
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

            <div class="mb-3">
                <div class="upload-area d-block m-auto" @click="() => {$refs.fileInput.click()}">
                    <img :src="generateFileUrl(formData.thumbnail, TYPE_LESSON)" alt="Preview" class="preview-img"/>
                </div>
                <input type="file" ref="fileInput" @change="handleFileUpload" class="file-input" accept="image/*"/>
            </div>
        </validate-form-modal>
    </div>
</template>

<script>
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import Pagination from "../../components/Pagination"; // Import your Pagination component
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";
    import ShowDetailsModal from "../../components/showDetailsModal";

    export default {
        name: "lessonsComponent",
        components: {ShowDetailsModal, ValidateFormModal, DataTable, Pagination },
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Thumbnail', 'Title', 'Courses', 'Status', 'Actions'], // Column headings for the data table
                courses: [], // Array to hold courses fetched from the server
                lessons: [], // Data list for lessons
                quizzes: [],
                perPage: 5,
            };
        },

        mounted() {
            const _this = this;

            // Fetch datalist with paginate
            this.fetchData(this.urlGenerate(false, false, {page: 1, perPage: _this.perPage}));

            // Fetch courses for the dropdown

            // Fetch courses and quizzes
            this.fetchData(this.urlGenerate('api/required-data', false, {courses: true, quizzes: true}), (result) => {
                _this.courses = result.courses;
                _this.quizzes = result.quizzes;
            });
        },

        methods: {
            manipulateQuiz(quiz_id, lesson) {
                const _this = this;
                this.httpReq({
                    urlSuffix: 'add-quiz',
                    method: 'post',
                    data: {'quiz_id': quiz_id, lesson_id: lesson.id},
                    callback: (response) => {
                        let {result} = response.data;
                        if (result) {
                            if (result.flag === 1) // Item added
                                lesson.quizzes.push(result.quiz);
                            else if (result.flag === 0) // Item removed
                                _this.removeObjArrItem(lesson.quizzes, result.quiz);
                        }
                    }
                });
            },


        }

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
        width: 100%;
        height: 100%;
    }

    .file-input {
        display: none;
    }
</style>
