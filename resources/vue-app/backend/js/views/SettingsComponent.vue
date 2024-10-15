<template>
    <div class="container mt-5">
        <h2 class="mb-4">SkillSyntax - Online Course Management</h2>

        <!-- General Settings Section -->
        <div class="form-section">
            <div class="section-title">General Settings</div>
            <div class="p-3 border">
                <div class="form-group">
                    <label for="appName">Application Name</label>
                    <input type="text" class="form-control" id="appName" placeholder="SkillSyntax - Online Course Management" required>
                </div>
                <div class="form-group">
                    <label for="courseStatus">Default Course Status</label>
                    <select class="form-control" id="courseStatus" required>
                        <option>Draft</option>
                        <option>Published</option>
                        <option>Archived</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="docType">Default Document Type</label>
                    <select class="form-control" id="docType" required>
                        <option>Course Material</option>
                        <option>Assignment</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="appLogo">Application Logo</label>
                    <div class="file-upload-wrapper">
                        <img src="path/to/logo.png" alt="Logo">
                        <br>
                        <input type="file" class="btn btn-upload mt-2">
                    </div>
                </div>
                <div class="form-group">
                    <label for="welcomeMessage">Welcome Message</label>
                    <textarea class="form-control" id="welcomeMessage" rows="2" placeholder="Welcome to SkillSyntax! Manage your courses and track progress easily." required></textarea>
                </div>
                <div class="form-group">
                    <label for="defaultRole">Default User Role</label>
                    <select class="form-control" id="defaultRole" required>
                        <option>Student</option>
                        <option>Instructor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="courseDuration">Default Course Duration (Weeks)</label>
                    <input type="number" class="form-control" id="courseDuration" value="12" required>
                </div>
                <div class="form-group">
                    <label for="incrementPercent">Course Progress Increment (%)</label>
                    <input type="number" class="form-control" id="incrementPercent" value="10" required>
                </div>
            </div>
        </div>

        <!-- Payment Settings Section -->
        <div class="form-section">
            <div class="section-title">Payment Settings</div>
            <div class="p-3 border">
                <div class="form-group">
                    <label for="paymentSlab">Total Payment Slabs</label>
                    <input type="number" class="form-control" id="paymentSlab" value="3" required>
                </div>
                <div class="form-group">
                    <label for="paymentMode">Default Payment Mode</label>
                    <select class="form-control" id="paymentMode" required>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>One-Time</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- User Settings Section -->
        <div class="form-section">
            <div class="section-title">User Settings</div>
            <div class="p-3 border">
                <div class="form-group">
                    <label for="defaultLayer">Default User Group</label>
                    <select class="form-control" id="defaultLayer" required>
                        <option>Student</option>
                        <option>Instructor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="maxCourses">Max Courses Per User</label>
                    <input type="number" class="form-control" id="maxCourses" value="5" required>
                </div>
                <div class="form-group">
                    <label for="accountValidity">Account Validity (Months)</label>
                    <input type="number" class="form-control" id="accountValidity" value="12" required>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SettingsComponent"
    }
</script>

<style scoped>
    .section-title {
        background-color: #f7f7f7;
        padding: 10px;
        font-weight: bold;
        border: 1px solid #dee2e6;
    }
    .file-upload-wrapper {
        border: 1px dashed #ddd;
        padding: 20px;
        text-align: center;
    }
    .file-upload-wrapper img {
        max-width: 100px;
    }
    .form-section {
        margin-bottom: 30px;
    }
    .btn-upload {
        background-color: #28a745;
        color: white;
        padding: 8px 12px;
        font-size: 16px;
    }
</style>