<template>
    <div class="container mt-5">
        <!-- Top Controls -->
        <div class="table-controls mb-3 d-flex justify-content-between align-items-center">
            <label>
                Show
                <select class="custom-select d-inline-block w-auto">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                entries
            </label>
            <input type="text" class="form-control w-25" placeholder="Search" />
            <button class="compose-btn" @click="showModal">Compose Message</button>
        </div>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Message</th>
                <th>Sent</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>HhHhu</td>
                <td>qaZSXGC</td>
                <td>6 months ago</td>
                <td>
                    <button class="btn-view">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <!-- Additional rows can be added here -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination d-flex justify-content-between align-items-center mt-3">
            <span>Showing 1 to 1 of 1 entries</span>
            <div>
                <button class="btn btn-primary" disabled>Previous</button>
                <span class="mx-2">1</span>
                <button class="btn btn-primary" disabled>Next</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="composeModalLabel">Send Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitMessage">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="email" v-model="email" required />
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject*</label>
                                <input type="text" class="form-control" id="subject" v-model="subject" required />
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Your Message*</label>
                                <textarea class="form-control" id="message" rows="4" v-model="message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "studentMessagesComponent",
        data() {
            return {
                email: '',
                subject: '',
                message: ''
            };
        },
        methods: {
            showModal() {
                const modal = new window.bootstrap.Modal(document.getElementById('composeModal'));
                modal.show();
            },
            submitMessage() {
                // Here, you can handle the form submission logic
                console.log("Email:", this.email);
                console.log("Subject:", this.subject);
                console.log("Message:", this.message);
                // Reset form fields
                this.email = '';
                this.subject = '';
                this.message = '';
                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('composeModal'));
                modal.hide();
            }
        }
    };
</script>

<style scoped>
    /* Custom Styles */
    .compose-btn {
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .compose-btn:hover {
        background-color: #0056b3;
    }

    .btn-view {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 6px 8px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-view:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 8px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>