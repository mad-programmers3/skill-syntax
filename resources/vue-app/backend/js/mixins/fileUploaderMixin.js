export default {
    data() {
        return {
            uploadFile: null,
            uploadfileUrl: null,
        }
    },
    methods: {
        handleSubmitWithImg(e, submitHandler) {
            if (this.uploadFile) {
                this.uploadFile.user_id = this.getAuth().id;
                this.formData.thumbnail = this.uploadFile;
            }

            if (typeof submitHandler === 'function') submitHandler(e);
        },


        // Trigger the file input on click
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        // Handle file input change
        handleFileChange(event) {
            const file = event.target.files[0];
            this.handleFileUpload(file);
        },
        // Handle file processing
        handleFileUpload(file) {
            if (!file || !file.type.startsWith("image/")) {
                alert("Please upload a valid image file.");
                return;
            }

            // Create a URL for the image preview
            this.imageUrl = URL.createObjectURL(file);

            const imgFormData = new FormData();
            imgFormData.append('image', file);

            this.httpReq({
                customUrl: 'api/files/upload',
                method: 'post',
                callback: (res)=>{
                    if (res.data.success) this.uploadFile = res.data;
                },
                data: imgFormData
            })

        },
    }
}