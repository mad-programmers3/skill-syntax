<template>
    <div class="container mt-5">
        <h2 class="mb-4">SkillSyntax - Be A Skilled Soul</h2>

        <!-- General Settings Section -->
        <div v-for="(settings, groupName) in settingsByGroup" class="form-section">
            <div class="section-title">{{ groupName }} Settings</div>
            <div class="p-3 mx-0 border row">
                <div v-for="setting in settings" class="form-group col-md-6">
                    <label>{{ setting.name }}</label>

                    <input v-if="setting.type === 'text'" type="text" class="form-control" :value="setting.value">

                    <input v-else-if="setting.type === 'number'" type="number" class="form-control" :value="parseInt(setting.value)">

                    <textarea v-else-if="setting.type === 'textarea'" class="form-control" rows="3">{{ setting.value }}</textarea>

                    <select v-else-if="setting.type === 'select'" class="form-control">
                        <template v-if="setting.key === 'default_course_status'">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                            <option value="2" selected>Pending</option>
                        </template>
                        <template v-else-if="setting.key === 'default_document_type'">
                            <option>Course Material</option>
                            <option>Assignment</option>
                        </template>
                        <template v-else-if="setting.key === 'default_user_role'">
                            <option>Student</option>
                            <option>Instructor</option>
                        </template>
                    </select>

                    <div v-else-if="setting.type === 'file'" class="file-upload-wrapper">
                        <img :src="asset('backend/assets/images/logo-backend.png')" alt="Logo">
                        <br>
                        <input type="file" class="btn btn-upload btn-primary mt-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SettingsComponent",

        data () {
            return {
                settingsByGroup: [],
            }
        },
        mounted() {
            const _this = this;
            this.fetchData(false, (settings) => {
                // Separate settings by group
                if (settings) {
                    _this.settingsByGroup = settings.reduce((groups, setting) => {
                        if (!groups[setting.group]) {
                            groups[setting.group] = [];
                        }
                        groups[setting.group].push(setting);
                        return groups;
                    }, {});
                }
            });
        }
    }
</script>

<style scoped>
    .section-title {
        background-color: #f7f7f7;
        padding: 10px;
        font-weight: bold;
        border: 1px solid #dee2e6;
        text-transform: capitalize;
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
        padding: 8px 12px;
        font-size: 16px;
        max-width: 100%;
    }
</style>