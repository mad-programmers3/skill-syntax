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
                <td>{{ message.sender ? message.sender.email : (message.receiver ? message.receiver.email : 'NA') }}</td>
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
                <form @submit.prevent="submitMessage" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Compose Message</h5>
                        <button type="button" class="close" @click="closeModal('#composeModal')">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" v-model="formData.subject" placeholder="Subject" class="form-control mt-2" required />
                        <textarea v-model="formData.message" placeholder="Message" class="form-control mt-2" rows="4" required ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal('#composeModal')">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
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
                        <div v-for="user in results.users" :key="user.id" class="result-item" @click="selectUser(user)" >
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
                receivedMessages: [],
                sentMessages: [],
                displayedMessages: [], // Control which messages to display
                receiver: '',
                subject: '',
                message: '',
            };
        },
        mounted() {
            const _this = this;
            this.fetchData(false, (result) => {
                _this.receivedMessages = result.received_messages;
                _this.sentMessages = result.sent_messages;
                _this.displayedMessages = _this.receivedMessages;
            })
        },
        methods: {
            showInbox() {
                this.displayedMessages = this.receivedMessages; // Set displayed messages to inbox
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
                this.receiver = user; // Set the email directly
                this.closeSearchResultsModal(); // Close search results modal
                this.openModal('#composeModal'); // Show the compose modal
            },
            submitMessage() {
                if (this.isEmptyData(this.auth) || this.isEmptyData(this.receiver)) {
                    this.showToast('Un authorized access', 'error');
                    return;
                }

                this.formData.receiver_id = this.receiver.id;
                this.formData.sender_id = this.auth.id;

                const _this = this;
                this.httpReq({
                    method: 'post',
                    urlSuffix: 'send',
                    callback: (response) => {
                        if (!response.data) return;
                        _this.showToast(response.data.message);
                        _this.closeModal('#composeModal');
                        _this.showSent();
                    }
                });
            },
            replyToMessage(message) {
                this.email = message.user.email;
                this.subject = `Re: ${message.subject}`; // Corrected syntax for template literal
                this.message = '';
                this.openModal('#composeModal');
            },
            deleteMessage(messageId) {
                const _this = this;
                this.showSweetAlert({
                    callback: (confirm) => {
                        if (!confirm) return;

                        _this.httpReq({
                            method: 'delete',
                            urlSuffix: messageId,
                            callback: (response) => {
                                _this.showToast(response.message);
                            }
                        })
                    }
                });
            },
            showSearchResultsModal() {
                $('#searchResultsModal').modal('show');
            },
            closeSearchResultsModal() {
                $('#searchResultsModal').modal('hide');
            }
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



