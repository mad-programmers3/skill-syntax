export default {

    data() {
        return {
            baseUrl: window.baseUrl,    // Base URL for the application
            authUser: window.authUser,  // Authenticated user information from the window object
            auth: {},                   // Parsed authentication data
        };
    },
    methods: {
        /**
         * Generates a URL to access a file in the storage folder.
         * @param {String} path - The path of the file in the storage.
         * @returns {String} The full URL to the file.
         */
        generateFileUrl(path) {
            return this.baseUrl + '/storage/' + path;
        },

        /**
         * Returns the number of keys in an object.
         * If the passed argument is not an object, it returns `null`.
         * @param {Object} obj - The object to count keys from.
         * @returns {Number|null} The number of keys in the object or `null` if not an object.
         */
        objLen(obj) {
            if (typeof obj === 'object')
                return Object.keys(obj).length;
            return null;
        },


        // find a obj by id from a array
        findById(arrOfObjs, id) {
            return arrOfObjs.find(obj => obj.id === id);
        },

        /**
         * Trims the provided text to a specified maximum length.
         * Appends "..." to indicate the text was shortened.
         * @param {String} text - The text to be truncated.
         * @param {Number} [maxLength=70] - The maximum allowed length before truncation.
         * @returns {String} The truncated text.
         */
        limitText(text, maxLength = 70) {
            if (text && text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        },

        /**
         * Formats a decimal number.
         * If the number is a whole number, it returns the integer.
         * If it's a decimal, it returns the number with two decimal places.
         * @param {String|Number} value - The number to format.
         * @returns {String|Number} The formatted number.
         */
        formatDecimal(value) {
            if (value % 1 === 0) return parseInt(value);
            return parseFloat(value).toFixed(2);
        },

        // Authentication-related methods


        /**
         * Fetches and parses the authenticated user information from the window object.
         * Updates the `auth` data property with the parsed information.
         */
        fetchAuth() {
            let decodedJson = window.authUser.replace(/&quot;/g, '"');
            this.auth = JSON.parse(decodedJson);
        },

        /**
         * Returns the parsed authenticated user information from the window object.
         * @returns {Object} The authenticated user information.
         */
        getAuth() {
            let decodedJson = window.authUser.replace(/&quot;/g, '"');
            return JSON.parse(decodedJson);
        },
    }
}
