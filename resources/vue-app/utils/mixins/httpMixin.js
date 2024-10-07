import Axios from "axios";

export default {
    methods: {
        /**
         * Generates a URL using the base URL, custom URL, and optional suffix.
         * If a `customUrl` is passed, it will append it to the base URL; otherwise, it will use the `dataUrl` from the current route.
         * A `suffix` can also be appended to the generated URL.
         */
        urlGenerate(customUrl = false, suffix = false, page = false) {
            let url = window.baseUrl;

            if (customUrl)
                url += '/' + customUrl;
            else
                url += '/' + this.$route.meta.dataUrl;

            if (suffix)
                url += '/' + suffix;

            if (page)
                    url += `?page=${page}`;

            return url;
        },

        /**
         * Fetches data from the server using a given URL.
         * If a callback is provided, it will handle the response.
         * Otherwise, the fetched data is used to update the local data list.
         */
        fetchData(url = false, callback = false) {
            if (!callback && this) {
                // reset data to empty
                this.$store.commit('setDataList', {});
            }

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
         */
        httpReq({ url = false, customUrl = false, urlSuffix = false, method = 'get', callback = false, data = this.$store ? this.$store.getters.formData : {}}) {
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
