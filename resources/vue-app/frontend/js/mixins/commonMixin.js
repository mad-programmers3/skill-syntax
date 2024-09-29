import commonMixinUtil from "../../../utils/mixins/commonMixinUtil";

export  default {
    mixins: [commonMixinUtil],
    methods : {
        // Truncate description to a maximum of 2 lines
        truncateDescription(description) {
            const maxLength = 150; // Set max length for two lines
            return description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
        },
    }
}