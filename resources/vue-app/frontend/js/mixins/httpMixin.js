import httpMixinUtil from "../../../utils/mixins/httpMixinUtil";

export default {
    mixins: [httpMixinUtil],
    data() {
        return {
            //
        };
    },
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
            this.fetchDataUtil(url, callback);
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
        httpReq({ url = false, customUrl = false, urlSuffix = false, method = 'get', callback = false, data = {} }) {
            this.httpReqUtil({url, customUrl, urlSuffix, method, callback, data})
        }
    }
}
