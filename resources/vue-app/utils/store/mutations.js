export const mutations = {
    setAuth(state, data) {
        state.auth = data;
    },
    setDataList(state, data) {
        state.dataList = data;
    },
    setFormData(state, data) {
        state.formData = data;
    },
    setConfig(state, data) {
        state.Config = data;
    },
    setShowHeader(state, data) {
        state.showHeader = data;
    },
    setShowFooter(state, data) {
        state.showFooter = data;
    }
};