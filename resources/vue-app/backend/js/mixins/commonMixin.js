import commonMixinUtil from "../../../utils/mixins/commonMixinUtil";

export default {
    mixins: [commonMixinUtil],
    data() {
        return {
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
        },

        storageImage : function (image){
            if (image === undefined || !image === null){
                return `${baseUrl}/images/course-def-thumbnail.jpg`;
            }
            if (typeof image === "object"){
                return `${this.generateFileUrl(image.path)}`;
            }else{
                return `${this.generateFileUrl(image)}`;
            }
        },
        openModal(modelId = 'formModal', defaultObject = {}, callBack = false) {
            const _this = this;
            $(`#${modelId}`).modal('show'); // Show the modal

            $.each(defaultObject, function (index, value){
                _this.$set(_this.formData, index, value);
            });

            if (typeof callBack === 'function') callBack(); // Execute callback if provided
        }
    }
}
