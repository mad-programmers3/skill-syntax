<template>
    <div>
        <data-table :table-heading="tableHeading" @open-modal="openModal">
            <tr v-for="(permission, index) in (dataList.data ? dataList.data : dataList)" :key="permission.id" style="font-size: 0.8rem">
                <td>{{ (dataList.current_page ? (dataList.current_page - 1) * perPage : 0) + index + 1 }}</td>
                <td>{{ limitText(permission.name) }}</td>
                <td>{{ permission.module ? permission.module.name : 'NA' }}</td>
                <td>
                    {{ permission.roles ? permission.roles.length : 'NA' }}

                    <i class="ml-1 fa fa-eye" data-toggle="modal" :data-target="`#permissionRolesModal${permission.id}`" style="cursor: pointer"></i>
                    <show-details-modal :id="`permissionRolesModal${permission.id}`" :title="`${permission.name} => Roles`">
                        <div class="row">
                            <li class="col-md-6 my-1" v-for="role in permission.roles">
                                {{ role.name }}
                            </li>
                        </div>
                    </show-details-modal>
                </td>
                <td>
                    <span :class="permission.status ? 'badge badge-success' : 'badge badge-danger'">
                        {{ permission.status ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                <td>
                    <!-- Edit button -->
                    <button v-if="can('module_edit')" @click="onClickUpdate(permission)" class="btn btn-primary btn-sm" :title="`Edit ${permission.name}`" type="button">
                        <i class="fa fa-edit"></i>
                    </button>
                    <!-- Delete button -->
                    <button v-if="can('module_delete')" @click="deleteItem(permission.id, dataList.current_page, perPage)" class="btn btn-danger btn-sm" :title="`Delete ${permission.name}`" type="button">
                        <i class="fa fa-trash text-white"></i>
                    </button>
                    <!-- Mange button -->
                    <router-link :to="{ name: 'manageRoles' }" v-if="can('role_manage')" @click="deleteItem(permission.id)" class="btn btn-warning btn-sm" :title="`Manage ${permission.name}`" type="button">
                        <i class="fa fa-cogs text-white"></i>
                    </router-link>
                </td>
            </tr>
        </data-table>

        <pagination v-if="dataList.current_page" :current-page="dataList.current_page" :last-page="dataList.last_page" :per-page="perPage"/>

        <validate-form-modal  title="Module" :current-page="dataList.current_page" :per-page="perPage">
            <div class="mb-3">
                <label class="form-label w-100">
                    Name
                    <input type="text" class="form-control" v-model="formData.name" v-validate="'required|min:3|max:255'" name="name" @input="validateField"/>
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label w-100">
                    Module
                    <select class="form-select form-control" v-model="formData.module_id" v-validate="'required'" name="module">
                        <option value="" disabled>Select a module</option>
                        <option v-for="module in modules" :key="module.id" :value="module.id">
                            {{ module.name }}
                        </option>
                    </select>
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
    import validatorListComponentMixin from "../../mixins/validatorListComponentMixin";
    import ShowDetailsModal from "../../components/showDetailsModal";
    import Pagination from "../../components/Pagination";

    export default {
        name: "PermissionsComponents",
        components: {Pagination, ShowDetailsModal, ValidateFormModal, DataTable},
        mixins: [validatorListComponentMixin],
        data() {
            return {
                tableHeading: ['SL', 'Name', 'Module', 'Roles', 'Status', 'Action'],
                modules: [],
                perPage: 5,
            }
        },
        mounted() {
            // Fetch datalist with paginate
            this.fetchData(this.urlGenerate(false, false, {page: 1, perPage: this.perPage}));

            const _this = this;
            // Fetch courses
            this.fetchData(this.urlGenerate('api/required-data', false, {'modules': true}), (result) => {
                _this.modules = result.modules;
            })

        },
    }
</script>