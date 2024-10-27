<template>
    <div class="container mt-5">
        <!-- Top Controls -->
        <div class="table-controls mb-3 d-flex justify-content-between align-items-center">
            <input type="text" class="form-control w-25" placeholder="Search" v-model="searchQuery" />
            <button class="btn btn-primary" @click="performSearch">Search</button>
            <button class="compose-btn" @click="showModal">Compose Message</button>
        </div>


        <!-- Data Table -->
        <table class="table table-bordered mt-3">
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

        <!-- Search Results Modal -->
        <div class="modal fade" id="searchResultsModal" tabindex="-1" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchResultsModalLabel">Search Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="results.users.length">
                            <h3>USERS</h3>
                            <div v-for="user in results.users" :key="user.id" class="result-item">
                                <!-- Prevent default behavior on click -->
                                <a href="#" @click.prevent="handleResultClick(user.email)">
                                    {{ user.name.toLowerCase() }} - {{ user.email.toLowerCase() }}
                                </a>
                            </div>
                        </div>
                        <div v-else>
                            <h3>No users found</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compose Message Modal -->
        <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="composeModalLabel">Send Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitMessage">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="email" v-model="email" required readonly />
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject*</label>
                                <input type="text" class="form-control" id="subject" v-model="subject" required />
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message*</label>
                                <textarea class="form-control" id="message" v-model="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" :disabled="isSending">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                searchQuery: '',
                results: {
                    users: [],
                },
                email: '',
                subject: '',
                message: '',
                isSending: false
            };
        },
        methods: {
            async performSearch() {
                if (this.searchQuery) {
                    try {
                        const response = await axios.get('/search', {
                            params: { query: this.searchQuery }
                        });
                        this.results.users = response.data.users;

                        this.showSearchResultsModal();

                        if (!this.results.users.length) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No users found',
                            });
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                    }
                } else {
                    this.results.users = [];
                }
            },
            handleResultClick(email) {
                this.email = email; // Set the email field to the selected user's email
                this.showModal(); // Open the compose modal
                this.results.users = []; // Clear results when clicking on a result
            },
            async submitMessage() {
                this.isSending = true;
                try {
                    const response = await axios.post('/send-message', {
                        email: this.email,
                        subject: this.subject,
                        message: this.message
                    });
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message sent successfully!',
                        });
                        this.closeModal();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to send message. Please try again.',
                        });
                    }
                } catch (error) {
                    console.error('Message send error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred. Please try again.',
                    });
                } finally {
                    this.isSending = false; // Re-enable the send button
                }
            },
            showModal() {
                const modal = new bootstrap.Modal(document.getElementById('composeModal'));
                modal.show();
            },
            closeModal() {
                const modalCompose = bootstrap.Modal.getInstance(document.getElementById('composeModal'));
                const modalSearch = bootstrap.Modal.getInstance(document.getElementById('searchResultsModal'));

                if (modalCompose) {
                    modalCompose.hide();
                }
                if (modalSearch) {
                    modalSearch.hide();
                }

                this.email = '';
                this.subject = '';
                this.message = '';
            },
            showSearchResultsModal() {
                const modal = new bootstrap.Modal(document.getElementById('searchResultsModal'));
                modal.show();
            }
        }
    };
</script>

<style scoped>
    .container {
        margin: 0 auto;
    }

    .table-controls {
        margin-bottom: 20px;
    }

    .compose-btn {
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .table {
        margin-bottom: 20px;
    }

    .modal-content {
        padding: 20px;
    }

    .result-item {
        margin: 5px 0;
    }

    h3 {
        margin: 10px 0;
    }

    .modal-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-title {
        font-weight: bold;
    }
</style>
