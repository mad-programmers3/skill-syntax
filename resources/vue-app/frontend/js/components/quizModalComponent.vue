<template>
    <!-- Modal -->
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" :style="{maxWidth: windowWidth >= 700 ? '700px' : '90%'}">
            <div class="modal-content" style="background-color: #002347; color: #ffffff;">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="quizModalLabel">{{ quiz.title }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-for="(question, indexQ) in quiz.questions" :key="question.id" class="card mb-3">
                        <div class="card-body" style="background-color: #ffffff; color: #333;">
                            <h6 class="card-title">{{ indexQ + 1 }}. {{ question.title }}</h6>
                            <div class="row mx-2">
                                <div v-for="(option, index) in questionOptions" v-if="question[option.key]" :key="index" class="form-check col-md-6">
                                    <label class="form-check-label" :for="'answer' + question.id + index">
                                        <input class="form-check-input" type="radio" :id="'answer' + question.id + index" :value="option.label.toLowerCase()" v-model="formData[question.id]">
                                        {{ option.label }}. {{ question[option.key] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submitAnswers">Submit Answers</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "quizModalComponent",
        data() {
            return {
                windowWidth: window.innerWidth,
            }
        },
        mounted() {
            const _this = this;
            $('#'+id).on('hidden.bs.modal', () => {
                _this.$store.commit('setFormData', {});
            });
        },
        props: {
            quiz: {
                type: Array | Object,
                default: {},
            },
            id: String,
        },
        methods: {
            submitAnswers() {
                // Prepare the data to be sent
                const answersToSubmit = Object.keys(this.formData).map(questionId => {
                    return {
                        question_id: questionId,
                        answer: this.formData[questionId],
                    };
                });

                const _this = this;
                this.httpReq({
                    method: 'post',
                    customUrl: 'api/quizzes/submit',
                    data: answersToSubmit,
                    callback: (response) => {
                        if (response.data) {
                            let solvedIds = response.data.result;
                            if (_this.isEmptyData(solvedIds)) return;

                            _this.showToast(`You solved ${solvedIds.length} out of ${_this.quiz && _this.quiz.questions ? _this.quiz.questions.length : 'NA'}`)

                            if (!_this.isEmptyData(_this.auth)) {
                                _this.auth.solved_questions_id.push(...solvedIds)
                            }
                        }

                        $('#'+_this.id).modal('hide');
                    }
                });
            },
        }
    }
</script>


<style scoped>

</style>