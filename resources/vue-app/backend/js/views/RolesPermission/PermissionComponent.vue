<template>
    <div class="permissions-container">
        <h1>Permissions</h1>
        <form @submit.prevent="createPermission" class="permission-form">
            <div class="form-group">
                <select v-model="selectedModule" required class="module-select">
                    <option disabled value="">Select Module</option>
                    <option v-for="module in modules" :key="module.id" :value="module.id">
                        {{ module.name }}
                    </option>
                </select>
                <input
                        v-model="newPermission"
                        placeholder="Enter Permission Name"
                        required
                        class="permission-input"
                />
                <button type="submit" class="submit-button">Add Permission</button>
            </div>
        </form>
        <ul class="permissions-list">
            <li v-for="permission in permissions" :key="permission.id" class="permission-item">
                {{ permission.name }}
                <button @click="deletePermission(permission.id)" class="delete-button">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                permissions: [],
                newPermission: '',
                selectedModule: null,
                modules: [] // Array to hold modules
            };
        },
        created() {
            this.fetchPermissions();
            this.fetchModules(); // Fetch modules on component creation
        },
        methods: {
            async fetchModules() {
                try {
                    const response = await axios.get('/api/modules'); // Adjust this based on your API endpoint for modules
                    this.modules = response.data;
                } catch (error) {
                    console.error("Error fetching modules:", error);
                }
            },
            async fetchPermissions() {
                try {
                    const response = await axios.get('/api/permissions');
                    this.permissions = response.data;
                } catch (error) {
                    console.error("Error fetching permissions:", error);
                }
            },
            async createPermission() {
                try {
                    await axios.post('/api/permissions', {
                        name: this.newPermission,
                        module_id: this.selectedModule // Include module_id
                    });
                    this.newPermission = '';
                    this.selectedModule = null; // Reset selected module
                    this.fetchPermissions();
                } catch (error) {
                    console.error("Error creating permission:", error);
                }
            },
            async deletePermission(id) {
                try {
                    await axios.delete(`/api/permissions/${id}`);
                    this.fetchPermissions();
                } catch (error) {
                    console.error("Error deleting permission:", error);
                }
            }
        }
    };
</script>

<style scoped>
    .permissions-container {
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

    .permission-form {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .module-select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
        flex: 1; /* Allows the select to take more space */
    }

    .permission-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
        flex: 2; /* Input takes more space */
    }

    .submit-button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }

    .permissions-list {
        list-style-type: none;
        padding: 0;
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
