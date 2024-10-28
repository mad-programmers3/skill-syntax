<template>
    <div class="container">
        <div class="mb-3">
            <input type="text" v-model="searchQuery" @keyup="performSearch" placeholder="Search users..." class="form-control" />
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(message, index) in messages" :key="message.id">
                <td>{{ index + 1 }}</td>
                <td>{{ message.email }}</td>
                <td>{{ message.subject }}</td>
                <td>{{ message.message }}</td>
                <td>
                    <button @click="replyToMessage(message)" class="btn btn-primary btn-sm">Reply</button>
                    <button @click="deleteMessage(message.id)" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Compose Modal -->
        <div class="modal fade" id="composeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Compose Message</h5>
                        <button type="button" class="close" @click="closeModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="email" v-model="email" placeholder="Email" class="form-control" />
                        <input type="text" v-model="subject" placeholder="Subject" class="form-control" />
                        <textarea v-model="message" placeholder="Message" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitMessage" :disabled="isSending">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results Modal -->
        <div class="modal fade" id="searchResultsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Search Results</h5>
                        <button type="button" class="close" @click="closeSearchResultsModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="user in results.users" :key="user.id" class="result-item" @click="selectUser(user)">
                            {{ user.email }}
                        </div>
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
                isSending: false,
                messages: [],
            };
        },
        methods: {
            async fetchMessages() {
                try {
                    const response = await axios.get('/api/messages');
                    this.messages = response.data.messages;
                } catch (error) {
                    console.error('Fetch messages error:', error);
                    console.log(response);
                }
            },
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
            selectUser(user) {
                this.email = user.email; // Set the email directly
                this.subject = ''; // Clear previous subject
                this.message = ''; // Clear previous message
                this.closeSearchResultsModal(); // Close search results modal
                this.showModal(); // Show the compose modal
            },
            async submitMessage() {
                if (!this.email) {
                    Swal.fire('Error!', 'Email field is required.', 'error');
                    return;
                }

                this.isSending = true;

                try {
                    const response = await axios.post('/api/send-message', {
                        email: this.email,
                        subject: this.subject,
                        message: this.message
                    });

                    if (response.data.success) {
                        Swal.fire('Success!', response.data.message, 'success');
                        this.closeModal(); // Close the modal after successful send
                        this.fetchMessages(); // Fetch updated messages
                    } else {
                        Swal.fire('Error!', response.data.message, 'error');
                    }
                } catch (error) {
                    console.error('Send message error:', error);
                    Swal.fire('Error!', 'An error occurred while sending the message.', 'error');
                } finally {
                    this.isSending = false;
                }
            },
            replyToMessage(message) {
                this.email = message.email;
                this.subject = `Re: ${message.subject}`;
                this.message = '';
                this.showModal();
            },
            async deleteMessage(messageId) {
                const confirmDelete = await Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                });

                if (confirmDelete.isConfirmed) {
                    try {
                        const response = await axios.delete(`/messages/${messageId}`);
                        if (response.data.success) {
                            this.messages = this.messages.filter(msg => msg.id !== messageId);
                            Swal.fire('Deleted!', 'Your message has been deleted.', 'success');
                        } else {
                            Swal.fire('Error!', 'Failed to delete the message.', 'error');
                        }
                    } catch (error) {
                        console.error('Delete message error:', error);
                        Swal.fire('Error!', 'An error occurred while deleting the message.', 'error');
                    }
                }
            },
            showModal() {
                $('#composeModal').modal('show');
            },
            closeModal() {
                $('#composeModal').modal('hide');
            },
            showSearchResultsModal() {
                $('#searchResultsModal').modal('show');
            },
            closeSearchResultsModal() {
                $('#searchResultsModal').modal('hide');
            }
        },
        mounted() {
            this.fetchMessages();
        }
    };
</script>

<style scoped>
    .result-item {
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #ddd;
    }
    .result-item:hover {
        background-color: #f0f0f0;
    }
</style>
