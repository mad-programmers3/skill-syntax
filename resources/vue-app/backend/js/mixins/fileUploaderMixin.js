export default {
    data() {
        return {
            uploadFile: null,      // The uploaded file object
            uploadFileUrl: null,   // The URL for previewing the uploaded file
        };
    },
    methods: {
        /**
         * Handles form submission when a file is uploaded.
         * If a file is uploaded, it adds the file and user ID to the form data.
         * @param {Event} e - The event triggered by the form submission.
         * @param {Function} submitHandler - The function to handle form submission.
         */
        handleSubmitWithFile(e, submitHandler) {
            if (this.uploadFile) {
                this.uploadFile.user_id = this.getAuth().id;  // Adds user ID to the file data
                this.formData.uploadFile = this.uploadFile;    // Adds the uploaded file to the form data
            }

            if (typeof submitHandler === 'function') submitHandler(e);  // Call the submit handler if provided
        },

        /**
         * Programmatically triggers the file input element to open the file picker dialog.
         */
        triggerFileInput() {
            this.$refs.fileInput.click();  // Simulate a click on the hidden file input
        },

        /**
         * Handles the file input change event.
         * Calls the file processing method with the selected file.
         * @param {Event} event - The file input change event.
         */
        handleFileChange(event) {
            const file = event.target.files[0];  // Get the selected file
            this.handleFileUpload(file);         // Process the file
        },

        /**
         * Processes the uploaded file and sends it to the server.
         * It validates the file type (must be an image) and creates a URL for preview.
         * @param {File} file - The file object selected by the user.
         */
        handleFileUpload(file) {
            if (!file || !file.type.startsWith("image/")) {  // Check if the file is an image
                alert("Please upload a valid image file.");  // Show an alert if the file is not valid
                return;
            }

            // Create a URL for the image preview
            this.uploadFileUrl = URL.createObjectURL(file);

            const imgFormData = new FormData();
            imgFormData.append('image', file);  // Append the image file to the FormData

            // Send the image to the server
            this.httpReq({
                customUrl: 'api/files/upload',
                method: 'post',
                callback: (res) => {
                    if (res.data.success) this.uploadFile = res.data;  // Save the response data if the upload is successful
                },
                data: imgFormData
            });
        },

        /**
         * Resets the uploaded file and its preview URL.
         */
        resetUploadFileInfos() {
            this.uploadFile = null;      // Reset the uploaded file object
            this.uploadFileUrl = null;   // Reset the file preview URL
        }
    }
}
