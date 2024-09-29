import httpMixinUtil from "../../../utils/mixins/httpMixinUtil.js";

export default {
    mixins: [httpMixinUtil],
    methods: {
        /**
         * Fetches data from the server using a given URL.
         * If a callback is provided, it will handle the response.
         * Otherwise, the fetched data is used to update the local data list.
         *
         * @param {String|Boolean} url - The URL to fetch data from. Defaults to false.
         * @param {Function|Boolean} callback - Optional callback to process the fetched data. Defaults to false.
         */
        fetchData(url = false, callback = false) {
            const _this = this;
            _this.fetchDataUtil(url, (result) => {
                // If a callback is provided, use it to handle the data
                if (typeof callback === 'function') callback(result);
                // Otherwise, update the local data list with the fetched data
                else _this.setDataList(result);
            });
        },

        /**
         * Sends an HTTP request using Axios with customizable parameters.
         * Supports multiple HTTP methods (GET, POST, PUT, DELETE) and flexible URL construction.
         * The response can be handled via an optional callback function.
         *
         * @param {Object} options - Configuration options for the request.
         * @param {String|Boolean} [options.url=false] - The direct URL for the request. Defaults to false.
         * @param {String|Boolean} [options.customUrl=false] - A custom URL segment to append to the base URL. Defaults to false.
         * @param {String|Boolean} [options.urlSuffix=false] - A suffix to append to the constructed URL. Defaults to false.
         * @param {String} [options.method='get'] - The HTTP method to use (e.g., 'get', 'post', 'put', 'delete'). Defaults to 'get'.
         * @param {Function|Boolean} [options.callback=false] - A function to handle the response. Defaults to false.
         * @param {Object} [options.data=this.getFormData()] - The data to send with the request, typically for POST or PUT methods. Defaults to the form data.
         */
        httpReq({ url = false, customUrl = false, urlSuffix = false, method = 'get', callback = false, data = this.getFormData() }) {
            this.httpReqUtil({url, customUrl, urlSuffix, method, callback, data});
        }
    }
}
