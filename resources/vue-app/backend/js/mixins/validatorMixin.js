export default {
    data() {
        return {
            errorFields: [], // Will store error elements for removal after validation
        };
    },
    methods: {
        /**
         * Handles form submission validation.
         * If there are no validation errors, it triggers the callback function.
         * @param {Object} options - Options for handling submission.
         * @param {Function} [options.callBack=false] - The function to call upon successful validation.
         */
        validatorSubmit({ callBack = false }) {
            try {
                let items = this.$validator.errors.items;
                if (Object.keys(items).length === 0) {
                    if (typeof callBack === 'function') callBack();  // Execute the callback if no validation errors
                } else {
                    alert('Please fix the errors before submitting.');
                }
            } catch (e) {
                console.error(e);  // Log any errors encountered during validation
            }
        },

        /**
         * Validates a specific field when the user interacts with it.
         * Performs additional checks for uniqueness (e.g., title).
         * @param {Event} e - The event object triggered by field interaction.
         */
        async validateField(e) {
            const field = e.target.name;
            if (field === 'title') {
                // Check for uniqueness by sending a request to the server
                await this.checkUniqueTitle();
            }
            this.$validator.validate(field);  // Validate the field using the validator
        },

        /**
         * Checks if the 'title' field is unique by making a server request.
         * Adds a custom validation error if the title is not unique.
         */
        async checkUniqueTitle() {
            const _this = this;
            try {
                this.httpReq({
                    urlSuffix: 'check/title',
                    method: 'post',
                    callback: (response) => {
                        if (!response.data.isUnique) {
                            // Title is not unique, add a custom error
                            _this.addCustomError('title', 'The title must be unique.', 'unique');
                        }
                    }
                });
            } catch (error) {
                console.error('Error checking title uniqueness:', error);
            }
        },

        /**
         * Handles displaying validation errors in the UI.
         * Adds 'is-invalid' class to input fields and appends error messages.
         * @param {Array} errors - Array of error objects containing field and message details.
         */
        validatorHandler(errors) {
            // Remove any previously added error spans from the UI
            this.clearSpanErrors();

            // Show the errors on the UI
            errors.forEach(item => {
                const element = document.querySelector(`[name="${item.field}"]`);
                element.classList.add('is-invalid');  // Highlight the field as invalid

                // Create a new span element for the error message
                const errorSpan = document.createElement('span');
                errorSpan.className = 'text-danger';
                errorSpan.textContent = item.msg;

                // Append the new error message to the parent node of the input field
                element.parentNode.appendChild(errorSpan);

                // Store the input element and its corresponding error span for later removal
                this.errorFields.push({ 'input': element, 'span': errorSpan });
            });
        },

        /**
         * Clears all error messages and invalid styles from the UI.
         * Removes 'is-invalid' class from input fields and removes error spans.
         */
        clearSpanErrors() {
            const _this = this;
            _this.errorFields.forEach(({ input, span }, index) => {
                input.classList.remove('is-invalid');  // Remove the invalid class
                span.remove();  // Remove the error message span from the DOM
                _this.errorFields.splice(index, 1);  // Remove the span from the stored array
            });
        },

        /**
         * Dismisses all current validation errors and resets the form.
         */
        dismissValidate() {
            this.clearSpanErrors();  // Clear all validation error messages
        },

        /**
         * Adds a custom error message to a specific field if it doesn't already have one.
         * @param {String} $field - The name of the field to which the error applies.
         * @param {String} $msg - The error message to display.
         * @param {String} $rule - The validation rule that was broken.
         */
        addCustomError($field, $msg, $rule) {
            if (!this.isExistError($field)) {
                this.$validator.errors.add({
                    field: $field,
                    msg: $msg,
                    rule: $rule
                });
            }
        },

        /**
         * Clears validation errors for a specific field.
         * @param {String} $field - The name of the field for which to clear errors.
         */
        clearErrorsFor($field) {
            this.$validator.errors.clear($field);  // Clear errors for the specified field
        },

        /**
         * Checks if a specific field already has a validation error.
         * @param {String} $field - The name of the field to check.
         * @returns {Boolean} - Returns true if the field has an error, false otherwise.
         */
        isExistError($field) {
            return this.$validator.errors.has($field);  // Check if the field has any validation errors
        }
    }
}
