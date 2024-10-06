<template>
    <div class="">
        <!-- Form to Add Roles Only -->
        <form @submit.prevent="addRole" class="role-permission-form row d-flex align-items-center px-4 py-3">
            <div class="col-4">
                <select @change="getRolePermissions(formData.role_id)" v-model="formData.role_id" name="role_id" required class="role-select">
                    <option disabled value="" selected>Select a Role</option>
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
            </div>
            <h1 class="col-4">Role-Permission</h1>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="add-button">Add Role</button>
            </div>
        </form>


        <!-- Table to Display Permissions -->
        <div class="overflow-auto my-3">
            <table class="role-permission-table">
                <thead>
                <tr>
                    <th>Modules</th>
                    <th colspan="4">Permissions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="module in modules" :key="module.id">
                    <td>
                        <label class="font-weight-bold">
                            <input @change="addPermission($event, crrRole.modules, module.id, ADD_MODULE)" :checked="crrRole.modules && crrRole.modules.includes(module.id)" type="checkbox"/>
                            {{ module.name }}
                        </label>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-3"  v-for="(permission, pIndex) in module.permissions" :key="pIndex">
                                <label class="text-capitalize">
                                    <input type="checkbox" @change="addPermission($event, crrRole.permissions, permission.id, ADD_PERMISSION)" :checked="crrRole.permissions && crrRole.permissions.includes(permission.id)"/>
                                    {{ getRawPermName(permission.name) }}
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
<!--        <pre>{{crrRole}}</pre>-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ADD_MODULE: 1,
                ADD_PERMISSION: 2,
                crrRole: {},
                roles: [],
                modules: [],
            };
        },
        mounted() {
            const _this = this;

            // get all modules with permissions
            _this.fetchData(_this.urlGenerate('api/config/modules'), (result) => {
                _this.modules = result;
            });

            // get all roles with users
            _this.fetchData(_this.urlGenerate('api/config/roles', false), (result) => {
                _this.roles = result;
            });

            // get current role with users, modules, permission
            let auth = _this.getAuth();
            if (auth && auth.role_id) {
                this.getRolePermissions(auth.role_id);
            }

        },
        methods: {
            addPermission : function (event, objectName, perm_id, type){
                let data = {'role_id' : this.crrRole.id};

                if (type === this.ADD_MODULE) data.module_id = perm_id;
                else if (type === this.ADD_PERMISSION) data.permission_id = perm_id;

                if (event.target.checked) {
                    // add permission
                    this.httpReq({
                        customUrl: 'api/config/roles/add-permission', method: 'post', data, callback: (response) => {
                            if(response.data.result) objectName.push(perm_id);
                        }
                    });
                } else {
                    const _this = this;
                    // remove permission
                    this.httpReq({
                        customUrl: 'api/config/roles/remove-permission', method: 'post', data, callback: (response) => {
                            if (response.data.result) {
                                console.log(response.data.result);
                                let {modules, permissions} = response.data.result;
                                modules.forEach((id) => {
                                    _this.removeArrItem(_this.crrRole.modules, id)
                                });
                                permissions.forEach((id) => {
                                    _this.removeArrItem(_this.crrRole.permissions, id)
                                });
                            }
                        }
                    });
                }
            },
            getRolePermissions(role_id) {
                const _this = this;

                this.$store.commit('setFormData', {role_id});

                this.fetchData(_this.urlGenerate('api/config/roles', role_id), (role) => {
                    _this.crrRole = role;
                });
            },
            getRawPermName(str) {
                let arr = str.split('_');
                return arr[arr.length - 1];
            },
        },
    };
</script>

<style scoped>

    h1 {
        text-align: center;
        color: #423a8e;
        font-weight: bold;
        font-size: 1.7em;
    }

    .role-permission-form {
        display: flex;
        justify-content: space-between;
    }

    .role-select {
        min-width: 75%;
        display: block;
        padding: 12px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s, box-shadow 0.3s;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .role-select:focus {
        border-color: rgb(66, 58, 142);
        outline: none;
        box-shadow: 0 0 5px rgba(66, 58, 142, 0.5);
    }


    .role-select option {
        background-color: #ffffff;
        color: #333;
        padding: 10px;
        font-size: 16px;

    }


    .add-button {
        padding: 12px 20px;
        background-color: #423a8e;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .add-button:hover {
        background-color: #423a8e;
        transform: translateY(-2px);
    }

    .role-permission-table {
        min-width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 12px;
    }

    .role-permission-table th,
    .role-permission-table td {
        border: 1px solid #dddddd;
        padding: 6px;
    }

    .role-permission-table th {
        background-color: #423a8e;
        color: white;
        font-weight: bold;
    }

    .role-permission-table td {
        /*display: flex;*/
        background-color: #f9f9f9;
        color: #555555;
    }

    .role-permission-table tr:hover {
        background-color: #f1f1f1;
    }

    label {
        display: flex;
        cursor: pointer;
        font-weight: normal;
    }

    input[type="checkbox"] {
        margin-right: 5px;
        transform: scale(0.9);
        cursor: pointer;
        accent-color: #423a8e;
    }


    input[type="checkbox"]:checked {
        background-color: #423a8e;
        border-color: #423a8e;
    }


    label {
        cursor: pointer;
        font-weight: normal;
        margin-bottom: 0;
    }
</style>
























