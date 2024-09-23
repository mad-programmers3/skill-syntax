
import validatorMixin from "./validatorMixin";

export default {
    mixins: [validatorMixin],
    data() {
        return {
            //
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        // Reusable toast notification function
        showToast(message, type = "success") {
            this.$toast(message, {
                type: type,
                timeout: 3000,        // 3 seconds timeout
                position: "top-right", // Toast position at top-right
            });
        },

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

        // When user clicks update
        onClickUpdate(item) {
            let cat = Object.assign({}, item);
            this.setFormData(cat)
            ;
            this.openModal();
        },

        // Handle delete action
        deleteItem(id)
        {
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

        // Close modal and reset form data
        closeModal() {
            $('#categoryModal').modal('hide');
            this.resetFormData();
        },

        // Open modal to update or add category
        openModal() {
            $('#categoryModal').modal('show');
        }
    }
}
