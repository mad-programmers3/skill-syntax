<template>
    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryModalLabel">{{ title }}</h1>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
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
        props: {
            title: String,
        },

        watch: {
            '$validator.errors.items': {
                handler(newErrors) {
                    this.validatorHandler(newErrors);
                },
                deep: true // Ensure deep watching for nested changes
            }
        },

        methods: {
            handleSubmit() {
                const _this = this;
                _this.validatorSubmit({callBack: ()=> {_this.$emit('handle-submit');}})
            },
            closeModal() {
                this.dismissValidate();
                this.$emit('close-modal');
            },
        }
    };
</script>