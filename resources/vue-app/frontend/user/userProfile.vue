
<template>
    <div class="user-profile">
        <h2>User Profile</h2>
        <div class="profile-container">
            <!-- Left Card: User Profile -->
            <div class="card profile-card">
                <h4>User Profile</h4>
                <div class="user-image-container">
                    <img class="user-image" :src="userImage" alt="User Profile Image" />
                    <div class="upload-button">
                        <input type="file" id="imageUpload" @change="uploadImage" hidden />
                        <label for="imageUpload" class="btn btn-upload">Upload Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" v-model="user.name" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" v-model="user.email" />
                </div>
                <button class="btn btn-primary" @click="updateProfile">Update Profile</button>
            </div>

            <!-- Right Card: Change Password -->
            <div class="card password-card">
                <h4>Change Password</h4>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" v-model="newPassword" />
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password:</label>
                    <input type="password" id="confirmPassword" v-model="confirmPassword" />
                </div>
                <button class="btn btn-success" @click="changePassword">Set Password</button>
            </div>
        </div>

        <!-- User history: Display user's courses and roles -->
        <div v-if="user.courses && user.courses.length" class="user-history">
            <h4>User's Courses</h4>
            <ul>
                <li v-for="course in user.courses" :key="course.id">{{ course.name }}</li>
            </ul>
        </div>

        <div v-if="user.role && user.role.name" class="user-role">
            <h4>User Role: {{ user.role.name }}</h4>
        </div>
    </div>
</template>


<script>
    import axios from 'axios'
    export default {
        name: "userProfile",
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    courses: [],
                    role: {}
                },
                newPassword: "",
                confirmPassword: "",
                userImage: "https://via.placeholder.com/150",
            };
        },
        methods: {
            fetchUserProfile() {
                axios.get('/api/users/profile')
                    .then(response => {
                        this.user = response.data;
                    })
                    .catch(error => {
                        console.error("Error fetching user profile:", error);
                    });
            },
            updateProfile() {
                axios.post('/api/users/profile', {
                    fullName: this.user.name,
                    email: this.user.email,
                })
                    .then(response => {
                        alert("Profile updated successfully");
                    })
                    .catch(error => {
                        console.error("Error updating profile:", error);
                    });
            },
            changePassword() {
                if (this.newPassword !== this.confirmPassword) {
                    alert("Passwords do not match!");
                    return;
                }

                axios.post('/api/user/password', {
                    newPassword: this.newPassword,
                    confirmPassword: this.confirmPassword,
                })
                    .then(response => {
                        alert("Password updated successfully");
                        this.newPassword = "";
                        this.confirmPassword = "";
                    })
                    .catch(error => {
                        console.error("Error updating password:", error);
                    });
            },
            uploadImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.userImage = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
        },
        mounted() {
            this.fetchUserProfile();
        }
    };
</script>


<style scoped>
    .user-profile {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-container {
        display: flex;
        justify-content: space-between;
    }

    .card {
        width: 48%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .profile-card {
        margin-right: 20px; /* Space between cards */
    }

    h4 {
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .user-image-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #007bff;
    }

    .upload-button {
        margin-top: 10px;
        text-align: center;
    }

    .btn-upload {
        align-items: center;
        background-color: #28a745;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    .btn-upload svg {
        margin-right: 8px;
    }

    .btn-upload:hover {
        background-color: #218838;
    }

    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>




















