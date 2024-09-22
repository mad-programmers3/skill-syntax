
export  default {
    data(){
        return{
            errorFields: [], // Will store error spans for remove after
        }
    },
    methods : {
        validatorSubmit({ callBack = false }) {
            try {
                if (this.objLen(this.$validator.errors.items) === 0) {
                    if (typeof callBack === 'function') callBack();
                }
                else
                    alert('Please fix the errors before submitting.');
            } catch (e) {
                console.error(e);
            }
        },
        async validateField(e) {
            const field = e.target.name;
            if (field === 'title') {
                // Check for uniqueness by sending a request to the server
                await this.checkUniqueTitle();
            }
            this.$validator.validate(field);
        },
        async checkUniqueTitle() {
            const _this = this;
            try {
                this.httpReq({
                    urlSuffix: 'check/title',
                    method: 'post',
                    callback: (response)=>{
                        if (!response.data.isUnique) {
                            // Not unique, add a custom error
                            _this.addCustomError('title', 'The title must be unique.', 'unique');
                        }
                    }
                });
            } catch (error) {
                console.error('Error checking title uniqueness:', error);
            }
        },
        validatorHandler(errors) {
            // Remove the pre added error spans from ui
            this.clearSpanErrors();

            // Show the errors on ui
            errors.forEach(item => {
                const element = document.querySelector(`[name="${item.field}"]`);
                element.classList.add('is-invalid');

                // Create a new span element for the error message
                const errorSpan = document.createElement('span');
                errorSpan.className = 'text-danger';
                errorSpan.textContent = item.msg;

                // Append the new error message
                element.parentNode.appendChild(errorSpan);
                // Push span for remove after
                this.errorFields.push({'input': element, 'span': errorSpan});
            });
        },
        clearSpanErrors() {
            const _this = this;
            _this.errorFields.forEach(({input,span}, index) => {
                input.classList.remove('is-invalid');
                span.remove(); // Remove
                _this.errorFields.splice(index, 1); // Removes the span from the array
            });
        },
        dismissValidate() {
            this.clearSpanErrors();
        },

        addCustomError($field, $msg, $rule) {
            if (! this.isExistError($field)) {
                this.$validator.errors.add({
                    field: $field,
                    msg: $msg,
                    rule: $rule
                });
            }
        },
        clearErrorsFor($field) {
            this.$validator.errors.clear($field);
        },
        isExistError($field) {
            return this.$validator.errors.has($field);
        }
    }
}
