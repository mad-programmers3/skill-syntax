<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(module, index) in (dataList.module ? dataList.module : dataList)" style="font-size: 0.8rem" :key="module.id">
                <td>{{ (dataList.current_page ? (dataList.current_page - 1) * itemPerPage : 0) + index + 1 }}</td>
                <td>{{ limitText(data.review ? data.review.comment : '' )}}</td>
                <td>{{ limitText(module.name) }}</td>
                <td>{{ module.roles ? module.roles.length : 'NA' }}</td>
                <td>{{ module.permissions ? module.permissions.length : 'NA' }}</td>
                <td>
                    <span :class="module.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ module.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                <td>
                    <!-- Edit button -->
                    <button v-if="can('role_edit')" @click="onClickUpdate(module)" class="btn btn-primary btn-sm" :title="`Edit ${module.name}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!-- Delete button -->
                    <button v-if="can('role_delete')" @click="deleteItem(module.id)" class="btn btn-danger btn-sm" :title="`Delete ${module.name}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                    <!-- Mange button -->
                    <router-link :to="{ name: 'manageRoles' }" v-if="can('role_manage')" @click="deleteItem(module.id)" class="btn btn-warning btn-sm" :title="`Manage ${module.name}`" type="button">
                        <i class="fa fa-cogs text-white"></i>
                    </router-link>
                </td>
            </tr>
        </data-table>

        <Pagination v-if="dataList.current_page" :currentPage="dataList.current_page" :lastPage="dataList.last_page"/>


        <validate-form-modal  title="Module">
            <div class="mb-3">
                <label class="form-label w-100">
                    Name
                    <input type="text" class="form-control" v-model="formData.name" v-validate="'required|min:3|max:255'" name="name" @input="validateField"/>
                </label>
            </div>
            <div class="mb-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch" v-model="formData.status" :true-value="1" :false-value="0" v-validate="'required'" name="status"/>
                    <label class="custom-control-label" for="customSwitch">
                        {{ formData.status ? 'Active' : 'Inactive' }}
                    </label>
                </div>
            </div>
        </validate-form-modal>
    </div>
</template>

<script>
    import DataTable from "../../components/dataTable";
    import ValidateFormModal from "../../components/validateFormModal";
    import Pagination from "../../components/Pagination"
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";

    export default {
        name: "RolesComponent",
        components: {ValidateFormModal, DataTable,Pagination},
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Role', 'Roles', 'Permissions', 'Status', 'Action'],
                itemPerPage:4,
            }
        }
    }
</script>
