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
                            <input @change="addPermission($event, crrRole.role_modules, module.id)" :checked="crrRole.role_modules.includes(module.id)" type="checkbox"/>
<!--                            <input :checked="parseInt(module.checked) === 1" type="checkbox"/>-->
                            {{ module.name }}
                        </label>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-3"  v-for="(permission, pIndex) in module.permissions" :key="pIndex">
                                <label class="text-capitalize">
                                    <input type="checkbox" @change="addPermission($event, crrRole.role_permissions,permission.id)" :checked="crrRole.role_permissions.includes(permission.id)"/>
                                    {{ permission.name }}
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <pre>{{crrRole}}</pre>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                crrRole: {
                    role_modules : [],
                    role_permissions : [],
                },
                roles: [],
                modules: [],
            };
        },
        computed: {
            // will return the largest number of permissions of any module as colsN, represent table col number
            colsN() {
                let largestIndx = 0;
                this.modules.forEach((module) => {
                    if (module.permissions && module.permissions.length && module.permissions.length > largestIndx)
                        largestIndx = module.permissions.length;
                });

                return largestIndx;
            }
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

            _this.getRolePermissions();

            // get current role with users, modules, permission

        },
        methods: {
            addPermission : function (event, objectName, id){
                if (event.target.checked){
                    objectName.push(id);
                }else{
                    var index = objectName.findIndex(a => a.id === id);
                    objectName.splice(index , 1)
                }
            },
            getRolePermissions : function (role = false){
                const _this = this;
                let role_id = role ? role : _this.getAuth().role_id;
                _this.setFormData({role_id: role_id});

                _this.fetchData(_this.urlGenerate('api/config/roles', role_id), (role) => {
                    _this.crrRole = role;
                });
            },
            getRawPermName(str) {
                let arr = str.split('_');
                return arr[arr.length - 1];
            },
            hasModule(modId) {
                if (!this.crrRole || !this.crrRole.role_modules) return false;

                this.crrRole.role_modules.forEach((role_mod) => {
                    if (role_mod.module && role_mod.module.id === modId)
                        return true;
                });

                return false;
            },
            hasParmission(permId) {
                if (!this.crrRole || !this.crrRole.role_permissions) return false;

                this.crrRole.role_permissions.forEach((role_perm) => {
                    if (role_perm.permission && role_perm.permission.id === permId)
                        return true;
                });

                return false;
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
























