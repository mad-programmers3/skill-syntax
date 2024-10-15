
<template>
    <div>
        <div class="user-profile-area" style="padding-top: 80px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <main>
                            <div class="content">

                                <div class="profile-form-wrapper">
                                    <h4 class="text-center" style="font-weight: 700; font-size: 24px; line-height: 34px; color: #242424; font-family: 'Open Sans', sans-serif;">Profile</h4>
                                    <hr>
                                    <form id="userform" action="https://product.geniusocean.com/academy-king/student/profile" method="POST">
                                        <div class="gocover" style="background: url(https://product.geniusocean.com/academy-king/assets/images/1600621324loader-19.gif) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                        </div>
                                        <input type="hidden" name="_token" value="YcoFhvfxYZob0y4HjdUfVX3yoRRg4Sh1FIwgCv5p">
                                        <div class="alert alert-success" style="display: none;" role="alert">
                                            <button type="button" class="close hide-close" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <p class="m-0"></p>
                                        </div>

                                        <div class="alert alert-danger" style="display: none;" role="alert">
                                            <button type="button" class="close hide-close" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul class="text-left mb-0">
                                            </ul>
                                        </div>

                                        <div class="image text-center">
                                            <img id="showimage" class="profile-img" src="https://product.geniusocean.com/academy-king/assets/front/images/author.jpg" alt="Profile Image">
                                        </div>

                                        <div class="form-group">
                                            <label>First Name * :</label>
                                            <input type="text" class="form-control" required name="first_name" value="thien" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name * :</label>
                                            <input type="text" class="form-control" required name="last_name" value="ho" placeholder="Last Name">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Email * :</label>
                                            <input type="text" class="form-control" required name="email" value="student@gmail.com">
                                        </div>

                                        <div class="form-group">
                                            <label>Profile Photo :</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="photo" id="image">
                                                <label class="custom-file-label" for="image">Choose Photo</label>
                                            </div>
                                        </div>

                                        <button class="btn btn-success" type="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"studentProfileComponent"
    }
</script>

<style scoped>
    body {
        background-color: #f5f5f5;
    }
    .user-profile-area {
        padding-top: 80px;
    }

    .profile-form-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 20px;
        height: 100%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
</style>













