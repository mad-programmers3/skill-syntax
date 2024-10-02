<template>
    <div class="role-module-container">
        <h1>Manage Role-Module Associations</h1>
        <form @submit.prevent="createRoleModule" class="role-module-form">
            <select v-model="selectedRole" required class="role-select">
                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
            </select>
            <select v-model="selectedModule" required class="module-select">
                <option v-for="module in modules" :key="module.id" :value="module.id">{{ module.name }}</option>
            </select>
            <button type="submit" class="add-button">Add Association</button>
        </form>
        <ul class="role-module-list">
            <li v-for="association in roleModules" :key="association.id" class="association-item">
                Role: {{ association.role.name }} - Module: {{ association.module.name }}
                <button @click="deleteRoleModule(association.id)" class="delete-button">Remove</button>
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
                modules: [],
                roleModules: [],
                selRoleId: null,
                selectedModule: null,
            };
        },
        created() {
            this.fetchRoles();
            this.fetchModules();
            this.fetchRoleModules();
        },
        methods: {
            async fetchRoles() {
                try {
                    const response = await axios.get('/api/roles'); // Adjust endpoint if necessary
                    this.roles = response.data;
                } catch (error) {
                    console.error("Error fetching roles:", error);
                }
            },
            async fetchModules() {
                try {
                    const response = await axios.get('/api/modules'); // Adjust endpoint if necessary
                    this.modules = response.data;
                } catch (error) {
                    console.error("Error fetching modules:", error);
                }
            },
            async fetchRoleModules() {
                try {
                    const response = await axios.get('/api/role-modules'); // Adjust endpoint if necessary
                    this.roleModules = response.data;
                } catch (error) {
                    console.error("Error fetching role-module associations:", error);
                }
            },
            async createRoleModule() {
                try {
                    await axios.post('/api/role-modules', {
                        role_id: this.selRoleId,
                        module_id: this.selectedModule
                    });
                    this.selectedRole = null;
                    this.selectedModule = null;
                    this.fetchRoleModules();
                } catch (error) {
                    console.error("Error creating role-module association:", error);
                }
            },
            async deleteRoleModule(id) {
                try {
                    await axios.delete(`/api/role-modules/${id}`);
                    this.fetchRoleModules();
                } catch (error) {
                    console.error("Error deleting role-module association:", error);
                }
            }
        }
    };
</script>

<style scoped>
    .role-module-container {
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

    .role-module-form {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .role-select, .module-select {
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

    .role-module-list {
        list-style-type: none;
        padding: 0;
    }

    .association-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 4px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }

    .delete-button {
        padding: 5px 10px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-button:hover {
        background-color: #c82333;
    }
</style>
