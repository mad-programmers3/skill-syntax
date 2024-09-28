import Axios from "axios";

export default {
    data() {
        return {
            // variable: val  // Define any necessary data properties here
        };
    },
    methods: {
        /**
         * Fetches data from the server and updates the store.
         * Uses `httpReq` to make the request and sets the result in the data list.
         */
        fetchData() {
            const _this = this;
            this.httpReq({
                callback: (response) => {
                    if (response.data)
                        _this.setDataList(response.data.result);  // Updates the data list with the fetched result
                }
            });
        },

        /**
         * Makes an HTTP request using Axios with customizable parameters.
         * Supports GET, POST, PUT, and DELETE methods.
         * Handles the response through a callback function.
         * @param {Object} options - Options for the request.
         * @param {String} [options.customUrl=false] - Optional custom URL to append to the base URL.
         * @param {String} [options.urlSuffix=false] - Optional URL suffix to append to the URL.
         * @param {String} [options.method='get'] - The HTTP method (e.g., 'get', 'post', 'put', 'delete').
         * @param {Function} [options.callback=false] - A function to handle the response.
         * @param {Object} [options.data=this.getFormData()] - The data to send with the request.
         */
        httpReq({ customUrl = false, urlSuffix = false, method = 'get', callback = false, data = this.getFormData() }) {
            const _this = this;

            Axios({
                method: method,  // HTTP method (GET, POST, etc.)
                url: _this.urlGenerate(customUrl, urlSuffix),  // Generate the full URL
                data: data       // The data to be sent with the request (for POST/PUT)
            })
                .then(function (response) {
                    if (typeof callback === 'function') {
                        callback(response);  // Execute the callback with the response
                    }
                })
                .catch(function (error) {
                    // Handle the error here, for example by showing a toast notification
                    // toastr.error(error.message, 'Error!', {positionClass: 'toast-top-center'});
                });
        }
    }
}
