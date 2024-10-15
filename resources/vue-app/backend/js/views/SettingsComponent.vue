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

                    <input v-if="setting.type === 'number'" type="number" class="form-control" :value="parseInt(setting.value)">

                    <textarea v-if="setting.type === 'textarea'" class="form-control" rows="3">{{ setting.value }}</textarea>

                    <template v-if="setting.type === 'select'">
                        <select  class="form-control" v-model="setting.value">
                            <template v-for="(item , index) in settingSelects[setting.key]">
                                <option :value="item.id">{{ item.name }}</option>
                            </template>
                        </select>
                    </template>

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
                settingSelects : {},
            }
        },
        mounted() {
            const _this = this;
            this.fetchData(false, (settings) => {
                if (settings) {
                    _this.settingsByGroup = settings;
                }
            });
            var URl = this.urlGenerate('api/required-data-new', false);
            this.httpReq({
                url : URl,
                method : 'post',
                data : {
                    roles : {objName : 'default_user_role'},
                },
                callback : function (response) {
                    $.each(response.data.result, function (index, value){
                        _this.$set(_this.settingSelects, index, value);
                    });
                    _this.$set(_this.settingSelects, 'default_document_type', [
                        {name : 'Course Material', id : 'Course Material'},
                        {name : 'Assignment', id : 'Assignment'}
                    ]);
                    _this.$set(_this.settingSelects, 'default_course_status', [
                        {name : 'Inactive', id : '0'},
                        {name : 'Active', id : '1'},
                        {name : 'Pending', id : '2'}
                    ]);
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
