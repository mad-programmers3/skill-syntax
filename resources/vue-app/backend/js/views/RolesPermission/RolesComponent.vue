<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(role, index) in (dataList.data ? dataList.data : dataList)" style="font-size: 0.8rem" :key="role.id">
                <td>{{ (dataList.current_page ? (dataList.current_page - 1) * perPage : 0) + index + 1 }}</td>
                <td>{{ limitText(role.name) }}</td>
                <td>
                    {{ role.users ? role.users.length : 'NA' }}

                    <i class="ml-1 fa fa-eye" data-toggle="modal" :data-target="`#roleUsersModal${role.id}`" style="cursor: pointer"></i>
                    <show-details-modal :id="`roleUsersModal${role.id}`" :title="`${role.name} => Users`">
                        <div class="row">
                            <li class="col-md-6 my-1" v-for="user in role.users">
                                {{ user.name }}
                            </li>
                        </div>
                    </show-details-modal>
                </td>
                <td>
                    {{ role.modules ? role.modules.length : 'NA' }}

                    <i class="ml-1 fa fa-eye" data-toggle="modal" :data-target="`#roleModulesModal${role.id}`" style="cursor: pointer"></i>
                    <show-details-modal :id="`roleModulesModal${role.id}`" :title="`${role.name} => Modules`">
                        <div class="row">
                            <li class="col-md-6 my-1" v-for="module in role.modules">
                                {{ module.name }}
                            </li>
                        </div>
                    </show-details-modal>
                </td>
                <td>
                    {{ role.permissions ? role.permissions.length : 'NA' }}

                    <i class="ml-1 fa fa-eye" data-toggle="modal" :data-target="`#rolePermissionsModal${role.id}`" style="cursor: pointer"></i>
                    <show-details-modal :id="`rolePermissionsModal${role.id}`" :title="`${role.name} => Permissions`">
                        <div class="row">
                            <li class="col-md-6 my-1" v-for="permission in role.permissions">
                                {{ permission.name }}
                            </li>
                        </div>
                    </show-details-modal>
                </td>
                <td>
                    <span :class="role.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ role.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                <td>
                    <!-- Edit button -->
                    <button v-if="can('role_edit')" @click="onClickUpdate(role)" class="btn btn-primary btn-sm" :title="`Edit ${role.name}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!-- Delete button -->
                    <button v-if="can('role_delete')" @click="deleteItem(role.id)" class="btn btn-danger btn-sm" :title="`Delete ${role.name}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                    <!-- Mange button -->
                    <router-link :to="{ name: 'manageRoles', params: { role_id: role.id } }" v-if="can('role_manage')" @click="deleteItem(role.id)" class="btn btn-warning btn-sm" :title="`Manage ${role.name}`" type="button">
                        <i class="fa fa-cogs text-white"></i>
                    </router-link>
                </td>
            </tr>
        </data-table>


        <Pagination v-if="dataList.current_page" :currentPage="dataList.current_page" :lastPage="dataList.last_page" :per-page="perPage"/>


        <validate-form-modal  title="Role">
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
    import ShowDetailsModal from "../../components/showDetailsModal";

    export default {
        name: "RolesComponent",
        components: {ShowDetailsModal, ValidateFormModal, DataTable,Pagination},
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Role','Users', 'Modules', 'Permissions', 'Status', 'Action'],
                perPage:5,
            }
        },

        mounted() {
            // Fetch datalist with paginate
            this.fetchData(this.urlGenerate(false, false, {page: 1, perPage: this.perPage}));
        }
    }
</script>