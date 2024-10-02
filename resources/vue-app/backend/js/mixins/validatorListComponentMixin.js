import validatorMixin from "./InputValidatorMixin";

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
        // prepare the form for updating an existing item.
        onClickUpdate(item) {
            let copy = Object.assign({}, item); // to avoid reference
            this.$store.commit('setFormData', copy);
            this.openModal();
        },

        // handle the deletion of an item
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
    }
}
