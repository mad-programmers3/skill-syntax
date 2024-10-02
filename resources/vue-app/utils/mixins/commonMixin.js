export default {

    data() {
        return {
            baseUrl: window.baseUrl,    // Base URL for the application
            authUser: window.authUser,  // Authenticated user information from the window object
            auth: {},                   // Parsed authentication data
        };
    },
    computed: {
        /**
         * Retrieve the list of data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        dataList() {
            return this.$store.getters.dataList
        },

        /**
         * Retrieve form data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        formData() {
            return this.$store.getters.formData;
        },

        /**
         * Retrieve configuration data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        Config() {
            return this.$store.getters.Config;
        }
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

        /**
         * Returns the parsed authenticated user information from the window object.
         * @returns {Object} The authenticated user information.
         */
        getAuth() {
            let decodedJson = window.authUser.replace(/&quot;/g, '"');
            return JSON.parse(decodedJson);
        },

        // Authentication-related methods
        /**
         * Checks if the user has permission to perform a specific task.
         * @param {String} task - The task to check permission for.
         * @returns {Boolean} `true` if the user has permission; otherwise `false`.
         */
        can(task) {
            // Permission check logic (currently returns true for all tasks)
            return true;
        },
    }
}
