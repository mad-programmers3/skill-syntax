<template>
    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" :style="{maxWidth: windowWidth >= 700 ? this.width : '90%', /*90% for small screens*/}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryModalLabel">{{ title }}</h1>
                    <a type="button" class="font-weight-bold" @click="closeModal" aria-label="Close">X</a>
                </div>

                <form role="form" @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <slot/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import validatorMixin from "../mixins/validatorMixin";

    export default {
        name: "validateFormModal",
        mixins: [validatorMixin],
        data() {
            return {
                windowWidth: window.innerWidth,
            };
        },
        props: {
            title: String,
            width: {
                type: String,
                default: '500px',
            }
        },

        watch: {
            // Watches for changes in validation errors and triggers custom handler
            '$validator.errors.items': {
                handler(newErrors) {
                    this.validatorHandler(newErrors);
                },
                deep: true // Ensure deep watching for nested changes
            }
        },

        mounted() {
            // Fetches authenticated user info on mount
            this.formData.user_id = this.getAuth().id;
        },

        methods: {
            /**
             * Handles the form submission, triggers validation before emitting an event.
             */
            handleSubmit() {
                const _this = this;
                _this.validatorSubmit({callBack: ()=> {_this.$emit('handle-submit');}})
            },

            /**
             * Handles the modal close event, clears validation errors, and emits 'close-modal' event.
             */
            closeModal() {
                this.dismissValidate();
                this.$emit('close-modal');
            },
        }
    };
</script>