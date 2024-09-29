<template>
    <div class="modules-container">
        <h1>Modules</h1>
        <form @submit.prevent="createModule" class="module-form">
            <input
                    v-model="newModule"
                    placeholder="Module Name"
                    required
                    class="module-input"
            />
            <button type="submit" class="add-button">Add Module</button>
        </form>
        <ul class="modules-list">
            <li v-for="module in modules" :key="module.id" class="module-item">
                {{ module.name }}
                <button @click="deleteModule(module.id)" class="delete-button">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                modules: [],
                newModule: ''
            };
        },
        created() {
            this.fetchModules();
        },
        methods: {
            async fetchModules() {
                try {
                    const response = await axios.get('/api/modules');
                    this.modules = response.data;
                } catch (error) {
                    console.error("Error fetching modules:", error);
                }
            },
            async createModule() {
                try {
                    await axios.post('/api/modules', { name: this.newModule });
                    this.newModule = '';
                    this.fetchModules();
                } catch (error) {
                    console.error("Error creating module:", error);
                }
            },
            async deleteModule(id) {
                try {
                    await axios.delete(`/api/modules/${id}`);
                    this.fetchModules();
                } catch (error) {
                    console.error("Error deleting module:", error);
                }
            }
        }
    };
</script>

<style scoped>
    .modules-container {
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

    .module-form {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .module-input {
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

    .modules-list {
        list-style-type: none;
        padding: 0;
    }

    .module-item {
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
