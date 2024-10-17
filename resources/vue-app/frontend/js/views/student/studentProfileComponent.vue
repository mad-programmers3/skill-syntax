<template>
    <div class="container mt-5">
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="mb-3">
                        <div class="upload-area d-block m-auto">
                            <div>
                                <i @click="() => {$refs.fileInput.click()}" class="fas fa-edit text-white p-1 edit-icon" title="Upload"></i>
                                <i class="fas fa-trash text-white p-1 delete-icon" title="Delete"></i>
                            </div>
                            <img :src="generateFileUrl(avatarFormData.avatar ? avatarFormData.avatar : user.avatar, 'backend/assets/images/def-user-avatar.svg')" alt="Preview" class="preview-img mx-auto bg-primary p-1"/>
                        </div>
                        <input type="file" ref="fileInput" @change="handleFileUpload($event, 'avatar', avatarFormData)" class="file-input" accept="image/*"/>
                        <div  v-if="avatarFormData.avatar && avatarFormData.avatar.success" class="mt-1">
                            <button @click="uploadAvatar" class="btn btn-primary" title="Confirm Upload"><i class="fas fa-upload"></i></button>
                            <button class="btn btn-danger" title="Cancel Upload">X</button>
                        </div>
                    </div>
                    <h5>{{user.name}}</h5>
                    <p class="text-muted">{{user.bio}}</p>
                    <ul class="list-group list-group-flush shadow-sm rounded-lg">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Email:</span>
                            <span class="text-dark">{{user.email}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Date of Birth:</span>
                            <span class="text-dark">{{user.date_of_birth}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Courses Enrolled:</span>
                            <span class="text-dark">Web Development</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Completed Assignments:</span>
                            <span class="badge badge-success px-3 py-2">10</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Reviews Given:</span>
                            <span class="badge badge-warning px-3 py-2">3</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Form Section -->
            <div class="col-md-8">
                <div class="form-container">
                    <form @submit.prevent="updateForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">Name</label>
                                <input type="text" v-model="formData.name" class="form-control" id="firstName" placeholder="Enter your first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" v-model="formData.email" class="form-control" id="email" placeholder="Enter your Email" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bio">Bio</label>
                                <input type="text" v-model="formData.bio" class="form-control" id="bio" placeholder="Enter your bio">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select id="gender" v-model="formData.gender" class="form-control">
                                    <option selected disabled>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" v-model="formData.mobile" class="form-control" id="phoneNumber" placeholder="Enter phone number"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="birthDate">Date of Birth</label>
                                <input type="date" v-model="formData.date_of_birth" class="form-control" id="birthDate" placeholder="Enter your birth date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" v-model="formData.location" id="address" placeholder="Enter your address"/>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="justify-content-center genric-btn primary-bg2 text-white full-width-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "studentProfileComponent",
        data() {
            return {
                user: {},
                avatarFormData: {},
            }
        },

        mounted() {
            const _this = this;
            this.fetchData(this.urlGenerate('api/required-data', false, {'auth': true}), (result) => {
                _this.user = result.auth;
                _this.$store.commit('setFormData', result.auth);
            });
        },
        methods: {

            uploadAvatar() {
                const _this = this;
                this.httpReq({
                    url: '/api/users/' + this.user.id,
                    method: 'put',
                    data: this.avatarFormData,
                    callback: (response) => {
                        if (response.data)
                            _this.showToast(response.data.message, response.data.status === _this.CODE_SUCCESS ? 'success' : 'error')
                    }
                });
            },

            updateForm() {
                const _this = this;
                this.httpReq({
                    url: '/api/users/' + this.user.id,
                    method: 'put',
                    data: this.formData,
                    callback: (response) => {
                        if (response.data)
                            _this.showToast(response.data.message, response.data.status === _this.CODE_SUCCESS ? 'success' : 'error')
                    }
                });
            },
            // deleteAvatar() {
            //     const _this = this;
            //     this.httpReq({
            //         url: '/api/users/' + this.user.id,
            //         method: 'delete',
            //         data: this.avatarFormData,
            //         callback: (response) => {
            //             if (response.data)
            //                 _this.showToast(response.data.message, response.data.status === _this.CODE_SUCCESS ? 'success' : 'error')
            //         }
            //     });
            // },

        }
    }
</script>


<style scoped>
    .profile-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }
    .profile-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }
    .form-container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .full-width-btn {
        width: 100%;
    }
    .text-dark{
        font-size: 12px;
    }
    .font-weight-bold{
        font-size: 13px;
    }

    .upload-area {
        position: relative;
    }
    .upload-area div {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .upload-area div i {
        background-color: rgba(0, 0, 0, 0.47);
        cursor: pointer;
    }
    .preview-img {
        max-width: 100%;
        max-height: 100%;
    }
    .file-input {
        display: none;
    }
</style>
