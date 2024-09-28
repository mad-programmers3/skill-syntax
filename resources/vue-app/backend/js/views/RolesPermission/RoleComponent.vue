
<template>
    <div class="role-container">
        <h1 class="title">Roles</h1>
        <form @submit.prevent="createRole" class="role-form">
            <input v-model="newRole" placeholder="Role Name" required class="role-input" />
            <button type="submit" class="add-role-button">Add Role</button>
        </form>
        <ul class="role-list">
            <li v-for="role in roles" :key="role.id" class="role-item">
                <span class="role-name">{{ role.name }}</span>
                <button @click="deleteRole(role.id)" class="delete-role-button">Delete</button>
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
                newRole: ''
            };
        },
        created() {
            this.fetchRoles();
        },
        methods: {
            // Fetch all roles
            async fetchRoles() {
                try {
                    const response = await axios.get('/api/roles');
                    this.roles = response.data;
                } catch (error) {
                    console.error("Error fetching roles:", error.response.data);
                }
            },
            // Create a new role
            async createRole() {
                try {
                    const response = await axios.post('/api/roles', {
                        name: this.newRole,
                    });
                    console.log('Role created:', response.data);
                    this.fetchRoles();  // Refresh roles after adding a new one
                    this.newRole = '';  // Clear the input after submission
                } catch (error) {
                    console.error('Error creating role:', error.response.data);
                }
            },
            // Delete a role
            async deleteRole(id) {
                try {
                    await axios.delete(`/api/roles/${id}`);
                    this.fetchRoles();  // Refresh role list
                } catch (error) {
                    console.error("Error deleting role:", error.response.data);
                }
            }
        }
    }
</script>

<style scoped>
    .role-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif;
    }

    .role-form {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .role-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .add-role-button {
        margin-left: 10px;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        background-color: #28a745;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-role-button:hover {
        background-color: #218838;
    }

    .role-list {
        list-style-type: none;
        padding: 0;
    }

    .role-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin: 5px 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: box-shadow 0.3s;
    }

    .role-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .role-name {
        font-size: 18px;
        color: #333;
    }

    .delete-role-button {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        background-color: #dc3545;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-role-button:hover {
        background-color: #c82333;
    }
</style>




