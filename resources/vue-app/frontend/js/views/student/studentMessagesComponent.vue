<!--<template>-->
<!--    <div class="container">-->
<!--        <h2 class="my-4">Messages</h2>-->

<!--        <div class="mb-3">-->
<!--            <input-->
<!--                    type="text"-->
<!--                    v-model="searchQuery"-->
<!--                    @keyup="performSearch"-->
<!--                    placeholder="Search users..."-->
<!--                    class="form-control"-->
<!--            />-->
<!--        </div>-->

<!--        <table class="table table-striped table-hover">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>#</th>-->
<!--                <th>Email</th>-->
<!--                <th>Subject</th>-->
<!--                <th>Message</th>-->
<!--                <th>Actions</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr v-for="(message, index) in messages" :key="message.id">-->
<!--                <td>{{ index + 1 }}</td>-->
<!--                <td>{{ message.user.email }}</td>-->
<!--                <td>{{ message.subject }}</td>-->
<!--                <td>{{ message.message }}</td>-->
<!--                <td>-->
<!--                    <button @click="replyToMessage(message)" class="btn btn-info btn-sm">-->
<!--                        <i class="fas fa-reply"></i>-->
<!--                    </button>-->
<!--                    <button @click="deleteMessage(message.id)" class="btn btn-danger btn-sm">-->
<!--                        <i class="fas fa-trash"></i>-->
<!--                    </button>-->
<!--                </td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->

<!--        &lt;!&ndash; Compose Modal &ndash;&gt;-->
<!--        <div class="modal fade" id="composeModal" tabindex="-1" role="dialog">-->
<!--            <div class="modal-dialog" role="document">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title">Compose Message</h5>-->
<!--                        <button type="button" class="close" @click="closeModal">-->
<!--                            <span>&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <input-->
<!--                                type="email"-->
<!--                                v-model="email"-->
<!--                                placeholder="Email"-->
<!--                                class="form-control"-->
<!--                                required-->
<!--                        />-->
<!--                        <input-->
<!--                                type="text"-->
<!--                                v-model="subject"-->
<!--                                placeholder="Subject"-->
<!--                                class="form-control mt-2"-->
<!--                                required-->
<!--                        />-->
<!--                        <textarea-->
<!--                                v-model="message"-->
<!--                                placeholder="Message"-->
<!--                                class="form-control mt-2"-->
<!--                                rows="4"-->
<!--                                required-->
<!--                        ></textarea>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>-->
<!--                        <button type="button" class="btn btn-primary" @click="submitMessage" :disabled="isSending">Send</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Search Results Modal &ndash;&gt;-->
<!--        <div class="modal fade" id="searchResultsModal" tabindex="-1" role="dialog">-->
<!--            <div class="modal-dialog" role="document">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title">Search Results</h5>-->
<!--                        <button type="button" class="close" @click="closeSearchResultsModal">-->
<!--                            <span>&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <div-->
<!--                                v-for="user in results.users"-->
<!--                                :key="user.id"-->
<!--                                class="result-item"-->
<!--                                @click="selectUser(user)"-->
<!--                        >-->
<!--                            {{ user.email }}-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import axios from 'axios';-->
<!--    import Swal from 'sweetalert2';-->

<!--    export default {-->
<!--        data() {-->
<!--            return {-->
<!--                searchQuery: '',-->
<!--                results: {-->
<!--                    users: [],-->
<!--                },-->
<!--                messages: [],-->
<!--                email: '',-->
<!--                subject: '',-->
<!--                message: '',-->
<!--                isSending: false,-->
<!--            };-->
<!--        },-->
<!--        methods: {-->
<!--            async fetchMessages() {-->
<!--                try {-->
<!--                    const response = await axios.get('/api/messages');-->
<!--                    this.messages = response.data.messages;-->
<!--                } catch (error) {-->
<!--                    console.error('Fetch messages error:', error);-->
<!--                }-->
<!--            },-->
<!--            async performSearch() {-->
<!--                if (this.searchQuery) {-->
<!--                    try {-->
<!--                        const response = await axios.get('/search', {-->
<!--                            params: { query: this.searchQuery }-->
<!--                        });-->
<!--                        this.results.users = response.data.users;-->
<!--                        this.showSearchResultsModal();-->

<!--                        if (!this.results.users.length) {-->
<!--                            Swal.fire({-->
<!--                                icon: 'warning',-->
<!--                                title: 'No users found',-->
<!--                            });-->
<!--                        }-->
<!--                    } catch (error) {-->
<!--                        console.error('Search error:', error);-->
<!--                    }-->
<!--                } else {-->
<!--                    this.results.users = [];-->
<!--                }-->
<!--            },-->
<!--            selectUser(user) {-->
<!--                this.email = user.email; // Set the email directly-->
<!--                this.subject = ''; // Clear previous subject-->
<!--                this.message = ''; // Clear previous message-->
<!--                this.closeSearchResultsModal(); // Close search results modal-->
<!--                this.showModal(); // Show the compose modal-->
<!--            },-->
<!--            submitMessage() {-->
<!--                this.isSending = true;-->
<!--                axios.post('http://127.0.0.1:8000/api/send-message', {-->
<!--                    email: this.email,-->
<!--                    subject: this.subject,-->
<!--                    message: this.message-->
<!--                })-->
<!--                    .then((response) => {-->
<!--                        console.log("Message sent successfully", response.data);-->
<!--                        Swal.fire({-->
<!--                            icon: 'success',-->
<!--                            title: 'Message sent successfully'-->
<!--                        });-->
<!--                        this.isSending = false;-->
<!--                        this.closeModal(); // Close modal after sending-->
<!--                    })-->
<!--                    .catch((error) => {-->
<!--                        console.error("Server error:", error.response?.data || error.message);-->
<!--                        Swal.fire({-->
<!--                            icon: 'error',-->
<!--                            title: 'Server error',-->
<!--                            text: error.response?.data.error || 'Please try again later.'-->
<!--                        });-->
<!--                        this.isSending = false;-->
<!--                    });-->
<!--            },-->
<!--            replyToMessage(message) {-->
<!--                this.email = message.user.email;-->
<!--                this.subject = `Re: ${message.subject}`;-->
<!--                this.message = '';-->
<!--                this.showModal();-->
<!--            },-->
<!--            async deleteMessage(messageId) {-->
<!--                const confirmDelete = await Swal.fire({-->
<!--                    title: 'Are you sure?',-->
<!--                    text: "You won't be able to revert this!",-->
<!--                    icon: 'warning',-->
<!--                    showCancelButton: true,-->
<!--                    confirmButtonColor: '#d33',-->
<!--                    cancelButtonColor: '#3085d6',-->
<!--                    confirmButtonText: 'Yes, delete it!'-->
<!--                });-->

<!--                if (confirmDelete.isConfirmed) {-->
<!--                    try {-->
<!--                        const response = await axios.delete(`/messages/${messageId}`);-->
<!--                        if (response.data.success) {-->
<!--                            this.messages = this.messages.filter(msg => msg.id !== messageId);-->
<!--                            Swal.fire('Deleted!', 'Your message has been deleted.', 'success');-->
<!--                        } else {-->
<!--                            Swal.fire('Error!', 'Failed to delete the message.', 'error');-->
<!--                        }-->
<!--                    } catch (error) {-->
<!--                        console.error('Delete message error:', error);-->
<!--                        Swal.fire('Error!', 'An error occurred while deleting the message.', 'error');-->
<!--                    }-->
<!--                }-->
<!--            },-->
<!--            showModal() {-->
<!--                $('#composeModal').modal('show');-->
<!--            },-->
<!--            closeModal() {-->
<!--                $('#composeModal').modal('hide');-->
<!--            },-->
<!--            showSearchResultsModal() {-->
<!--                $('#searchResultsModal').modal('show');-->
<!--            },-->
<!--            closeSearchResultsModal() {-->
<!--                $('#searchResultsModal').modal('hide');-->
<!--            }-->
<!--        },-->
<!--        mounted() {-->
<!--            this.fetchMessages();-->
<!--        }-->
<!--    };-->
<!--</script>-->

<!--<style scoped>-->
<!--    .result-item {-->
<!--        padding: 10px;-->
<!--        cursor: pointer;-->
<!--        border-bottom: 1px solid #ddd;-->
<!--    }-->
<!--    .result-item:hover {-->
<!--        background-color: #f0f0f0;-->
<!--    }-->

<!--    /* Additional styles for the modal and buttons */-->
<!--    .modal-header {-->
<!--        background-color: #007bff;-->
<!--        color: white;-->
<!--    }-->
<!--    .modal-footer {-->
<!--        display: flex;-->
<!--        justify-content: space-between;-->
<!--    }-->
<!--    .table th, .table td {-->
<!--        vertical-align: middle;-->
<!--    }-->
<!--</style>-->

























<template>
    <div class="container">
        <h2 class="my-4">Messages</h2>

        <div class="d-flex mb-3">
            <button class="btn btn-primary me-2" @click="showInbox">
                <i class="fas fa-inbox"></i> Inbox
            </button>
            <button class="btn btn-secondary" @click="showSent">
                <i class="fas fa-paper-plane"></i> Sent
            </button>
        </div>

        <div class="mb-3">
            <input
                    type="text"
                    v-model="searchQuery"
                    @keyup="performSearch"
                    placeholder="Search users..."
                    class="form-control"
            />
        </div>

        <table class="table table-striped table-hover">
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
            <tr v-for="(message, index) in displayedMessages" :key="message.id">
                <td>{{ index + 1 }}</td>
                <td>{{ message.user?.email || message.recipient_email }}</td>
                <td>{{ message.subject }}</td>
                <td>{{ message.message }}</td>
                <td>
                    <button @click="replyToMessage(message)" class="btn btn-info btn-sm">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button @click="deleteMessage(message.id)" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Modal for composing messages -->
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
                        <input
                                type="email"
                                v-model="email"
                                placeholder="Email"
                                class="form-control"
                                required
                        />
                        <input
                                type="text"
                                v-model="subject"
                                placeholder="Subject"
                                class="form-control mt-2"
                                required
                        />
                        <textarea
                                v-model="message"
                                placeholder="Message"
                                class="form-control mt-2"
                                rows="4"
                                required
                        ></textarea>
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
                        <div
                                v-for="user in results.users"
                                :key="user.id"
                                class="result-item"
                                @click="selectUser(user)"
                        >
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
                messages: [],
                sentMessages: [],
                displayedMessages: [], // Control which messages to display
                email: '',
                subject: '',
                message: '',
                isSending: false,
            };
        },
        methods: {
            async fetchMessages() {
                try {
                    const response = await axios.get('/api/messages');
                    this.messages = response.data.messages; // Inbox messages
                    this.sentMessages = response.data.sentMessages; // Sent messages
                    this.displayedMessages = this.messages; // Show inbox by default
                } catch (error) {
                    console.error('Fetch messages error:', error);
                }
            },
            showInbox() {
                this.displayedMessages = this.messages; // Set displayed messages to inbox
            },
            showSent() {
                this.displayedMessages = this.sentMessages; // Set displayed messages to sent
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
            submitMessage() {
                this.isSending = true;
                axios.post('/api/send-message', {
                    email: this.email,
                    subject: this.subject,
                    message: this.message
                })
                    .then((response) => {
                        console.log("Message sent successfully", response.data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Message sent successfully'
                        });
                        this.isSending = false;
                        this.closeModal(); // Close modal after sending
                        this.showSent(); // Optionally show sent messages after sending
                    })
                    .catch((error) => {
                        console.error("Server error:", error.response?.data || error.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Server error',
                            text: error.response?.data.error || 'Please try again later.'
                        });
                        this.isSending = false;
                    });
            },
            replyToMessage(message) {
                this.email = message.user.email;
                this.subject = `Re: ${message.subject}`; // Corrected syntax for template literal
                this.message = '';
                this.showModal();
            },
            async deleteMessage(messageId) {
                const confirm = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'This message will be deleted permanently!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                });

                if (confirm.isConfirmed) {
                    try {
                        await axios.delete(`/api/messages/${messageId}`); // Ensure your API supports DELETE
                        Swal.fire('Deleted!', 'Your message has been deleted.', 'success');
                        this.fetchMessages(); // Refresh the message list
                    } catch (error) {
                        console.error('Delete message error:', error);
                        Swal.fire('Error!', 'Unable to delete message. Please try again.', 'error');
                    }
                }
            },
            showModal() {
                $('#composeModal').modal('show'); // Show the modal using jQuery
            },
            closeModal() {
                $('#composeModal').modal('hide'); // Hide the modal
            },
            showSearchResultsModal() {
                $('#searchResultsModal').modal('show');
            },
            closeSearchResultsModal() {
                $('#searchResultsModal').modal('hide');
            }
        },
        created() {
            this.fetchMessages(); // Fetch messages when the component is created
        },
    };
</script>

<style scoped>
    .result-item {
        padding: 8px;
        cursor: pointer;
    }
    .result-item:hover {
        background-color: #f1f1f1;
    }
</style>



