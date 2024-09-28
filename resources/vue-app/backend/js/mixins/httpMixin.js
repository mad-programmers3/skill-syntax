import Axios from "axios";

export default {
    data() {
        return {
            fetches: [], // hold all fetch infos
        };
    },
    methods: {
        /**
         * Fetches data from the server using the provided URL.
         * If a data holder or callback is specified, it uses them to handle the response.
         * Otherwise, it defaults to updating a local data list.
         *
         * @param {String|Boolean} url - The URL from which to fetch data. Defaults to false.
         * @param {Object|Boolean} dataHolder - An object where the fetched data will be stored. Defaults to false.
         * @param {Function|Boolean} callback - An optional callback to handle custom actions with the fetched data. Defaults to false.
         */
        fetchData(url = false, dataHolder = false, callback = false) {
            const _this = this;
            // Make the HTTP request using httpReq with the provided URL and callback
            this.httpReq({
                url,
                callback: (response) => {
                    if (response.data) {
                        // If a custom callback is provided, execute it with the result
                        if (typeof callback == 'function') {
                            callback(response.data.result);
                            if (!dataHolder) return;  // If no data holder is specified, exit early
                        }

                        // Store the result in the provided data holder or update the local data list
                        if (dataHolder) dataHolder = response.data.result;
                        else _this.setDataList(response.data.result); // Default behavior: update the data list
                    }
                }
            });
        },


        /**
         * Iterates through an array of fetch requests and makes each request sequentially.
         * Each object in the array contains a URL and a data holder to store the fetched data.
         *
         * If `url`, `dataHolder`, and `callback` are not provided, the method fetches the paginated URL and stores the result in the store.
         */
        fetchDataAll() {
            const _this = this;

            _this.fetches.forEach(({url, dataHolder}) => {
                _this.fetchData(url, dataHolder);
            });
        },


        addFetch({url = false, dataHolder = false, callback = false}) {
            this.fetches.push({url, dataHolder, callback})
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
        httpReq({ url = false, customUrl = false, urlSuffix = false, method = 'get', callback = false, data = this.getFormData() }) {
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
