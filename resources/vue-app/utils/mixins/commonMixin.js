export default {

    data() {
        return {
            baseUrl: window.baseUrl,    // Base URL for the application
            authUser: window.authUser,  // Authenticated user information from the window object
            currentUrl: window.location.href,
            auth: {},                   // Parsed authentication data
            UI_HEADER_HIDE: 0,
            UI_HEADER_REGULAR: 1,
            UI_FOOTER_REGULAR: 1,
            UI_FOOTER_MINI: 2,
            CODE_SUCCESS: 2000,
            CODE_WARNING: 2020,
            CODE_DANGER: 3000,
            PERM_VIEW: 'view',
            PERM_ADD: 'add',
            PERM_EDIT: 'edit',
            PERM_DELETE: 'delete',
            PERM_MANAGE: 'manage',
            DEF_AVATAR_B: 'backend/assets/images/def-user-avatar.svg',
            DEF_COURSE_THUMB: 'images/course-def-thumbnail.jpg',
        };
    },
    computed: {
        /**
         * Retrieve the list of data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        dataList() {
            return this.$store.getters.dataList
        },

        /**
         * Retrieve form data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        formData() {
            return this.$store.getters.formData;
        },

        showHeader() {
            return this.$store.getters.showHeader;
        },

        showFooter() {
            return this.$store.getters.showFooter;
        },

        /**
         * Retrieve configuration data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        Config() {
            return this.$store.getters.Config;
        }
    },
    methods: {
        dd(data) {
            console.log(data);
        },
        asset(path) {
            return baseUrl + '/' + path;
        },
        generateFileUrl(file, def = this.DEF_COURSE_THUMB) {
            if (file && file.path)
                def = 'storage/' + file.path;

            return this.baseUrl + '/' + def;
        },

        limitText(text, maxLength = 70) {
            if (text && text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        },

        removeArrItem(array, item) {
            let index = array.indexOf(item);
            array.splice(index , 1)
        },


        formatDecimal(value) {
            if (value % 1 === 0) return parseInt(value);
            return parseFloat(value).toFixed(2);
        },


        getAuth() {
            let decodedJson = window.authUser.replace(/&quot;/g, '"');
            return JSON.parse(decodedJson);
        },

        // Authentication-related methods

        can(task) {
            return this.Config && this.Config.permissions && this.Config.permissions.includes(task);
        },


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


        showSweetAlert({
                           title = 'Are you sure?',
                           text = "You won't be able to revert this!",
                           icon = 'warning',
                           showCancelButton = true,
                           confirmButtonText = 'Yes',
                           cancelButtonText = 'No',
                           confirmButtonColor= '#ff1695',
                           cancelButtonColor = '#00cccd',
                           callback = false
        }) {
            this.$swal({title, text, icon, showCancelButton, confirmButtonText, cancelButtonText, confirmButtonColor, cancelButtonColor}).then((result) => {

                if (typeof callback === 'function') callback(result.isConfirmed);
            });
        },

        // close the modal and reset the form data.
        closeModal(modalId = '#backendModal', callBack = false, defVal = {status: 1}) {
            $(modalId).modal('hide'); // Hide the modal

            if (typeof callBack === 'function') callBack(); // Execute callback if provided
            this.$store.commit('setFormData', defVal); // Reset the form data
        },

        // open the modal for adding or updating list.
        openModal(modalId = '#backendModal', callBack = false) {
            $(modalId).modal('show'); // Show the modal

            if (typeof callBack === 'function') callBack(); // Execute callback if provided
        },


        // upload the file on storage and set it's infos on form data
        handleFileUpload(event, key = 'thumbnail', dataHolder = this.formData) {
            const file = event.target.files[0];  // Get the selected file
            if (!file || !file.type.startsWith("image/")) {  // Check if the file is an image
                alert("Please upload a valid image file.");  // Show an alert if the file is not valid
                return;
            }

            const imgFormData = new FormData();
            imgFormData.append('file', file);  // Append the image file to the FormData

            // Send the image to the server
            const _this = this;
            this.httpReq({
                customUrl: 'api/files/upload',
                method: 'post',
                callback: (res) => {
                    if (res.data.success) {
                        _this.$set(res.data, 'user_id', _this.getAuth().id);
                        _this.$set(dataHolder, key, res.data);
                    }
                },
                data: imgFormData
            });
        },
    }
}
