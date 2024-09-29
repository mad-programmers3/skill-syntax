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
            return this.getDataList();
        },

        /**
         * Retrieve form data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        formData() {
            return this.getFormData();
        },

        /**
         * Retrieve configuration data from the Vuex store.
         * This is a computed property to automatically react to changes in the store.
         */
        Config() {
            return this.getConfig();
        }
    },
    methods: {
        /**
         * Generates a URL using the base URL, custom URL, and optional suffix.
         * If a `customUrl` is passed, it will append it to the base URL; otherwise, it will use the `dataUrl` from the current route.
         * A `suffix` can also be appended to the generated URL.
         * @param {String} [customUrl=false] - Optional custom URL to append to the base URL.
         * @param {String} [suffix=false] - Optional suffix to append to the generated URL.
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
         * @param {Number} value - The number to format.
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

        /**
         * Checks if the user has permission to perform a specific task.
         * @param {String} task - The task to check permission for.
         * @returns {Boolean} `true` if the user has permission; otherwise `false`.
         */
        can(task) {
            // Permission check logic (currently returns true for all tasks)
            return true;
        },

        // Vuex Store-related methods

        /**
         * Retrieves the list of data from the Vuex store.
         * @returns {Array} The data list from the store.
         */
        getDataList() {
            return this.$store.getters.dataList;
        },

        /**
         * Updates the data list in the Vuex store.
         * @param {Array} data - The new data list to set in the store.
         */
        setDataList(data) {
            this.$store.commit('setDataList', data);
        },

        /**
         * Retrieves form data from the Vuex store.
         * @returns {Object} The form data from the store.
         */
        getFormData() {
            return this.$store.getters.formData;
        },

        /**
         * Updates the form data in the Vuex store.
         * @param {Object} data - The new form data to set in the store.
         */
        setFormData(data) {
            this.$store.commit('setFormData', data);
        },

        /**
         * Resets the form data in the Vuex store to its default state.
         */
        resetFormData() {
            this.setFormData({ status: 1 });
        },

        /**
         * Updates the configuration in the Vuex store.
         * @param {Object} data - The new configuration data to set in the store.
         */
        setConfig(data) {
            this.$store.commit('setConfig', data);
        },

        /**
         * Retrieves the configuration data from the Vuex store.
         * @returns {Object} The configuration data from the store.
         */
        getConfig() {
            return this.$store.getters.Config;
        }
    }
}
