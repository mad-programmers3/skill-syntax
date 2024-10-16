
<template>
    <div class="container mt-5">
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-md-4">
                <div class="profile-card">
                    <img :src="asset('backend/assets/images/def-user-avatar.svg')" class="bg-primary p-1" alt="Profile Picture">
                    <h5>Our Student</h5>
                    <p class="text-muted">Student</p>
                    <ul class="list-group list-group-flush shadow-sm rounded-lg">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark ">Email:</span>
                            <span class="text-dark">student@gmail.com</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Date of Birth:</span>
                            <span class="text-dark">10/12/2008</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="font-weight-bold text-dark">Courses Enrolled:</span>
                            <span class="text-dark ">Web Development</span>
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
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter your first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your Email" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bio">Bio</label>
                                <input type="text" class="form-control" id="bio" placeholder="Enter your bio">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select id="gender" class="form-control">
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
                                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter phone number"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="birthDate">Date of Birth</label>
                                <input type="date" class="form-control" id="birthDate" placeholder="Enter your birth date"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" id="address" placeholder="Enter your address"/>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="justify-content-center genric-btn primary-bg2 text-white full-width-btn">Submit</button>
                        </div>
                    </form>
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

</style>













