<template>
    <div class="container mt-5">
        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4">
                <div class="card profile-card">
                    <img class="mx-auto mb-3 bg-primary p-1" :src="generateFileUrl(user.avatar, 'backend/assets/images/def-user-avatar.svg')" alt="John Doe">
                    <h4 class="mb-0">{{ user.name }}</h4>
                    <p class="text-muted">{{ user.role ? user.role.name : '' }}</p>
                    <p>{{ user.bio }}</p>
                </div>

                <div class="card px-3">
                    <ul class="list-unstyled social-links mb-0">
                        <li class="py-2 d-flex justify-content-between border-bottom">
                            <span><i class="fas fa-globe"></i> Website:</span>
                            <a href="https://bootdey.com">https://bootdey.com</a>
                        </li>
                        <li class="py-2 d-flex justify-content-between border-bottom">
                            <span><i class="fab fa-github"></i> Github:</span>
                            <a href="#">bootdey</a>
                        </li>
                        <li class="py-2 d-flex justify-content-between border-bottom">
                            <span><i class="fab fa-twitter"></i> Twitter:</span>
                            <a href="#">@bootdey</a>
                        </li>
                        <li class="py-2 d-flex justify-content-between border-bottom">
                            <span><i class="fab fa-instagram"></i> Instagram:</span>
                            <a href="#">@bootdey</a>
                        </li>
                        <li class="py-2 d-flex justify-content-between">
                            <span><i class="fab fa-facebook"></i> Facebook:</span>
                            <a href="#">bootdey</a>
                        </li>
                    </ul>
                </div>
                <div class="card px-3">
                    <div class="p-2">
                        <h4 class="text-danger">Danger Zone</h4>
                        <p class="mb-1"><strong>Delete this account? Patricio</strong></p>
                        <p class="danger-description">
                            Once you delete an account, there is no going back. Please be certain.
                        </p>
                        <button class="btn btn-outline-danger btn-fw">Delete my account</button>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="col-md-8">
                <div class="card p-3">
                    <form>
                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="fullName" class="mr-3" style="width: 150px;">Name</label>
                            <input type="text" v-model="formData.name" class="form-control" id="fullName">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="bio" class="mr-3" style="width: 150px;">Bio</label>
                            <textarea v-model="formData.bio" class="form-control" id="bio">{{formData.bio}}</textarea>
                        </div>

                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="email" class="mr-3" style="width: 150px;">Email</label>
                            <input type="email" v-model="formData.email" class="form-control" id="email">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="phone" class="mr-3" style="width: 150px;">Mobile</label>
                            <input type="tel" v-model="formData.mobile" class="form-control" id="phone">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="address" class="mr-3" style="width: 150px;">Location</label>
                            <input type="text" v-model="formData.location" class="form-control" id="address">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3">
                            <label for="password" class="mr-3" style="width: 150px;">Set Password</label>
                            <input type="password" v-model="formData.password" class="form-control" id="password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100" title="Update informations">Update</button>
                    </form>
                </div>


                <div class="row mt-4">
                    <!-- Project Status 1 -->
                    <div class="col-md-6">
                        <div class="card p-3">
                            <h6><em>assignment</em> Project Status</h6>
                            <p>Web Design</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 80%;"></div>
                            </div>
                            <p>Website Markup</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 72%;"></div>
                            </div>
                            <p>One Page</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Status 2 -->
                    <div class="col-md-6">
                        <div class="card p-3">
                            <h6><em>assignment</em> Project Status</h6>
                            <p>Mobile Template</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 55%;"></div>
                            </div>
                            <p>Backend API</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 66%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserProfileComponent",

        data() {
            return {
                user: {},
            }
        },

        mounted() {
            const _this = this;
            this.fetchData(this.urlGenerate('api/required-data', false, {'auth': true}), (result) => {
                _this.user = result.auth;
                _this.$store.commit('setFormData', result.auth);
            });
        }
    }
</script>

<style scoped>
    .card {
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .profile-card {
        text-align: center;
        padding: 30px;
    }
    .profile-card img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }
    .social-links a {
        margin-right: 15px;
        font-size: 12px;
        color: #333;
    }
    .progress {
        height: 8px;
        margin-bottom: 10px;
    }
    .progress-bar {
        background-color: #3f50f6;
    }
</style>