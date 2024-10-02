import Axios from "axios";

export default {
    methods: {
        /**
         * Generates a URL using the base URL, custom URL, and optional suffix.
         * If a `customUrl` is passed, it will append it to the base URL; otherwise, it will use the `dataUrl` from the current route.
         * A `suffix` can also be appended to the generated URL.
         * @param {String|Boolean} [customUrl=false] - Optional custom URL to append to the base URL.
         * @param {String|Boolean} [suffix=false] - Optional suffix to append to the generated URL.
         * @returns {String} The full generated URL.
         */
        urlGenerate(customUrl = false, suffix = false) {
            let url = window.baseUrl;

            if (customUrl)
                url += '/' + customUrl;
            else
                url += '/' + this.$route.meta.dataUrl;

            if (suffix)
                url += '/' + suffix;

            return url;
        },

        /**
         * Fetches data from the server using a given URL.
         * If a callback is provided, it will handle the response.
         * Otherwise, the fetched data is used to update the local data list.
         *
         * @param {String|Boolean} url - The URL to fetch data from. Defaults to false.
         * @param {Function|Boolean} callback - Optional callback to process the fetched data. Defaults to false.
         */
        fetchData(url = false, callback = false) {
            // Make the HTTP request using httpReq with the provided URL and callback
            const _this = this;
            this.httpReq({
                url,
                callback: (response) => {
                    if (response.data) {
                        // If a callback is provided, use it to handle the data
                        if (typeof callback === 'function') callback(response.data.result);
                        // Otherwise, update the local data list with the fetched data
                        else _this.$store.commit('setDataList', response.data.result);
                    }
                }
            });
        },

        /**
         * Sends an HTTP request using Axios with customizable parameters.
         * Supports various HTTP methods (GET, POST, PUT, DELETE) and allows for dynamic URL generation.
         * The response is handled through an optional callback function.
         *
         * @param {Object} options - An object containing the request parameters.
         * @param {String|Boolean} [options.url=false] - Direct URL for the request. Defaults to false.
         * @param {String|Boolean} [options.customUrl=false] - A custom URL to append to the base URL. Defaults to false.
         * @param {String|Boolean} [options.urlSuffix=false] - A suffix to append to the generated URL. Defaults to false.
         * @param {String} [options.method='get'] - The HTTP method to use (e.g., 'get', 'post', 'put', 'delete'). Defaults to 'get'.
         * @param {Function|Boolean} [options.callback=false] - A function to handle the response. Defaults to false.
         * @param {Object} [options.data=this.getFormData()] - Data to send with the request (usually for POST or PUT). Defaults to the form data.
         */
        httpReq({ url = false, customUrl = false, urlSuffix = false, method = 'get', callback = false, data = this.$store.getters.formData }) {
            const _this = this;

            Axios({
                method: method,  // HTTP method (GET, POST, etc.)
                url: url ? url : _this.urlGenerate(customUrl, urlSuffix),  // Generate the full URL
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
