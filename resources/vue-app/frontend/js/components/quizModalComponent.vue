<template>
    <!-- Modal -->
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" :style="{maxWidth: windowWidth >= 700 ? '700px' : '90%', /*90% for small screens*/}">
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
                            <h6 class="card-title">{{ indexQ+1 }}. {{ question.title }}</h6>
                            <div class="row mx-2">
                                <div v-for="(option, index) in questionOptions" v-if="question[option.key]" :key="index" class="form-check col-md-6">
                                    <label class="form-check-label" :for="'answerA' + question.id">
                                        <input class="form-check-input" type="radio" :id="'answerA' + question.id" :name="'question' + question.id">
                                        {{ option.label }}. {{ question[option.key] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit Answers</button>
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
        props: {
            quiz: {
                type: Array | Object,
                default: {},
            },
            id : String
        },
    }
</script>

<style scoped>

</style>