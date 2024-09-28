import validatorMixin from "./validatorMixin";

export default {
    mixins: [validatorMixin],
    data() {
        return {
            fetches: [], // hold all fetch infos / {} for fetch default datalist
        };
    },
    mounted() {
        this.fetchData();
        // add other fetches and call fetch in main list component again :)
    },
    methods: {
        /**
         * Display a toast notification with a custom message and type.
         * @param {String} message - The message to display in the toast.
         * @param {String} [type="success"] - The type of toast (e.g., 'success', 'error').
         */
        showToast(message, type = "success") {
            this.$toast(message, {
                type: type,
                timeout: 3000,        // 3 seconds timeout
                position: "top-right", // Toast position at top-right
            });
        },

        /**
         * Handle form submission to create or update data.
         * Determines whether to send a POST or PUT request based on formData.id.
         */
        // Handle form submission
        handleSubmit() {
            let urlSuffix = this.formData.id ?? false;
            let method = this.formData.id ? 'put' : 'post';

            this.httpReq({
                urlSuffix: urlSuffix,
                method: method,
                callback: (response) => {
                    if (response.data) {
                        // Show success toast notification instead of alert
                        this.showToast(response.data.message, "success");
                        this.fetchData();
                    }
                }
            });

            this.closeModal();
        },

        /**
         * Prepare the form for updating an existing item.
         * @param {Object} item - The item to be updated.
         */
        onClickUpdate(item) {
            let cat = Object.assign({}, item);
            this.setFormData(cat);
            this.openModal();
        },

        /**
         * Handle the deletion of an item.
         * Prompts the user for confirmation before proceeding with the delete action.
         * @param {Number} id - The ID of the item to be deleted.
         */
        deleteItem(id) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.httpReq({
                        urlSuffix: id,
                        method: 'delete',
                        callback: (response) => {
                            if (response.data) {
                                // Show success toast notification for deletion
                                this.showToast(response.data.message, "success");
                                this.fetchData();
                            }
                        }
                    });
                }
            });
        },

        /**
         * Close the modal and reset the form data.
         * Optionally calls a callback function after the modal is closed.
         * @param {Function} [callBack] - Optional callback to be executed after closing the modal.
         */
        closeModal(callBack) {
            $('#categoryModal').modal('hide'); // Hide the modal

            if (typeof callBack === 'function') callBack(); // Execute callback if provided
            this.resetFormData(); // Reset the form data
        },

        /**
         * Open the modal for adding or updating categories.
         * Optionally calls a callback function after the modal is opened.
         * @param {Function} [callBack] - Optional callback to be executed after opening the modal.
         */
        openModal(callBack) {
            $('#categoryModal').modal('show'); // Show the modal

            if (typeof callBack === 'function') callBack(); // Execute callback if provided
        }
    }
}
