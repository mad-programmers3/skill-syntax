
import Axios from "axios";

export  default {
    data(){
        return{
            // variable: val
        }
    },
    methods : {
        fetchData() {
            const _this = this;
            this.httpReq({
                callback: (response) => {
                    if (response.data)
                        _this.setDataList(response.data.result);
                }
            });
        },
        httpReq({customUrl = false, urlSuffix = false, method='get', callback = false}){
            const _this = this;
            Axios({
                method: method,
                url: _this.urlGenerate(customUrl, urlSuffix),
                data: _this.getFormData()
            }).then(function (response) {
                if (typeof callback === 'function'){
                    callback(response)
                }
            }).catch(function (error) {
                // toastr.error(error.message, 'Error!', {positionClass: 'toast-top-center'});
            });
        }
    }
}