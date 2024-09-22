import validatorMixin from "./validatorMixin";

export  default {
    mixins: [validatorMixin],
    data() {
        return {
            //
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        handleSubmit() {
            const _this = this;
            let urlSuffix = this.formData.id ?? false;
            let method = this.formData.id ? 'put' : 'post';

            this.httpReq({
                urlSuffix: urlSuffix,
                method: method,
                callback: (response) => {
                    if (response.data) {
                        alert(response.data.message);
                        _this.fetchData();
                        // toastr.success(response.data.message, 'Category Updated!');
                    }
                }
            });

            this.closeModal();
        },
        onClickUpdate(item) {
            let cat = Object.assign({}, item);
            this.setFormData(cat);
            this.openModal();
        },
        deleteItem(id) {
            let _this = this;
            if (confirm('Are you sure to delete this category?'))
                _this.httpReq({
                    urlSuffix: id,
                    method : 'delete',
                    callback : (response) => {
                        if (response.data) {
                            // toastr.success(response.data.message, 'Category Deleted!', {positionClass: 'toast-top-center'});
                            _this.fetchData();
                        }
                    }
                });
        },

        closeModal() {
            $('#categoryModal').modal('hide');
            this.resetFormData();
        },
        openModal() {
            $('#categoryModal').modal('show');
        }
    }
}