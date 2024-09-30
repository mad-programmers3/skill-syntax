<template>
    <div class="">
        <!-- Form to Add Roles Only -->
        <form @submit.prevent="addRole" class="role-permission-form row d-flex align-items-center px-4 py-3">
            <div class="col-4">
                <select v-model="selectedRole" required class="role-select">
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
        <div class="overflow-auto">
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
                            <input
                                    type="checkbox"
                                    :checked="hasPermission(selectedRole, module.id, 'add')"
                                    @change="togglePermission(selectedRole, module.id, 'add', $event)"
                            />
                            {{ module.name }}
                        </label>
                    </td>


                    <td  v-for="permission in module.permission" :key="permission.id">
                        <label class="text-capitalize">
                            <input
                                    type="checkbox"
                                    :checked="hasPermission(selectedRole, module.id, 'delete')"
                                    @change="togglePermission(selectedRole, module.id, 'delete', $event)"
                            />
                            {{ getRawPermName(permission.name) }}
                        </label>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
<!--        <pre>{{modules}}</pre>-->
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                roles: [],
                modules: [],
                selectedRole: null,
            };
        },
        created() {
            this.fetchRolesAndPermissions();
            this.fetchModules(); // Fetch modules on component creation
        },
        mounted() {
            const _this = this;
            this.fetchData(this.urlGenerate('api/modules'), (result) => {
                _this.modules = result;
            });
        },
        methods: {
            getRawPermName(str) {
                let arr = str.split('_');
                return arr[arr.length-1];
            },

            async fetchRolesAndPermissions() {
                try {
                    const response = await axios.get("/api/role-permissions");
                    console.log("Roles and Permissions Response:", response); // Log full response
                    this.roles = response.data.roles || []; // Ensure this is defined
                } catch (error) {
                    console.error("Error fetching roles and permissions:", error);
                    // Optionally log error response data for debugging
                    if (error.response) {
                        console.error("Error response data:", error.response.data);
                    }
                }
            },

            async addRole() {
                try {
                    const selectedRoleData = this.roles.find(role => role.id === this.selectedRole);

                    // Check if the selected role exists
                    if (!selectedRoleData) {
                        alert("Selected role does not exist.");
                        return;
                    }

                    // Check if the selected role already exists
                    const roleExists = this.roles.some(role => role.name === selectedRoleData.name);
                    if (roleExists) {
                        alert("The selected role name already exists. Please choose a different name.");
                        return;
                    }

                    await axios.post("/api/roles", {
                        role_id: this.selectedRole,
                        name: selectedRoleData.name,  // Include the name in the request
                    });

                    // Clear the selection and reload data
                    this.selectedRole = null;
                    this.fetchRolesAndPermissions();

                } catch (error) {
                    console.error("Error adding role:", error.response ? error.response.data : error);
                    if (error.response && error.response.status === 422) {
                        alert(error.response.data.message); // Show a simple alert
                    }
                }
            },

            hasPermission(roleId, moduleId, action) {
                const role = this.roles.find(r => r.id === roleId);
                if (!role || !role.permissions) return false; // Check if permissions exist
                return role.permissions.some((perm) => perm.module_id === moduleId && perm.action === action);
            }
            ,

            hasPermission(roleId, moduleId, action) {
                const role = this.roles.find(r => r.id === roleId);
                if (!role) return false;
                return role.permissions.some((perm) => perm.module_id === moduleId && perm.action === action);
            },

            async togglePermission(moduleId, action, event) {
                try {
                    const roleId = this.selectedRole;
                    if (!roleId) {
                        console.error("Role ID is missing!");
                        return;
                    }

                    if (event.target.checked) {
                        await axios.post("/api/role-permissions", {
                            role_id: roleId,
                            module_id: moduleId,
                            action: action,
                        });
                    } else {
                        await axios.delete(`/api/role-permissions/${roleId}/${moduleId}/${action}`);
                    }
                    this.fetchRolesAndPermissions();
                } catch (error) {
                    console.error("Error updating permission:", error.response.data);
                }
            }


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
























