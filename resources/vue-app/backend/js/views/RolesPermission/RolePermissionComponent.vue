<template>
    <div class="role-permission-container">
        <h1>Manage Role-Permission Associations</h1>
        <form @submit.prevent="addPermissionToRole" class="role-permission-form">
            <select v-model="selectedRole" required class="role-select">
                <option disabled value="">Select a Role</option>
                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
            </select>
            <select v-model="selectedPermission" required class="permission-select">
                <option disabled value="">Select a Permission</option>
                <option v-for="permission in permissions" :key="permission.id" :value="permission.id">{{ permission.name }}</option>
            </select>
            <button type="submit" class="add-button">Add Permission</button>
        </form>
        <ul class="role-permission-list">
            <li v-for="role in roles" :key="role.id" class="role-item">
                <h2>{{ role.name }} Permissions:</h2>
                <ul>
                    <li v-for="permission in role.permissions" :key="permission.id" class="permission-item">
                        {{ permission.name }}
                        <button @click="removePermissionFromRole(role.id, permission.id)" class="remove-button">Remove</button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                roles: [],
                permissions: [],
                selectedRole: null,
                selectedPermission: null,
            };
        },
        created() {
            this.fetchRolesAndPermissions();
        },
        methods: {
            async fetchRolesAndPermissions() {
                try {
                    const response = await axios.get('/api/role-permissions');
                    this.roles = response.data.roles;
                    this.permissions = response.data.permissions;
                } catch (error) {
                    console.error("Error fetching roles and permissions:", error);
                }
            },
            async addPermissionToRole() {
                try {
                    await axios.post('/api/role-permissions', {
                        role_id: this.selectedRole,
                        permission_id: this.selectedPermission
                    });
                    this.selectedRole = null;
                    this.selectedPermission = null;
                    this.fetchRolesAndPermissions();
                } catch (error) {
                    console.error("Error adding permission to role:", error.response.data);
                }
            },
            async removePermissionFromRole(roleId, permissionId) {
                console.log("Removing permission:", permissionId, "from role:", roleId); // Debugging line
                try {
                    await axios.delete(`/api/role-permissions/${roleId}/${permissionId}`);
                    this.fetchRolesAndPermissions();
                } catch (error) {
                    console.error("Error removing permission from role:", error.response.data);
                }
            }



        }
    };
</script>

<style scoped>
    .role-permission-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif;
    }

    .role-permission-form {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .role-select, .permission-select {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    .add-button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .add-button:hover {
        background-color: #0056b3;
    }

    .role-permission-list {
        list-style-type: none;
        padding: 0;
    }

    .role-item {
        margin-bottom: 20px;
    }

    .permission-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 4px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }

    .remove-button {
        padding: 5px 10px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .remove-button:hover {
        background-color: #c82333;
    }
</style>
