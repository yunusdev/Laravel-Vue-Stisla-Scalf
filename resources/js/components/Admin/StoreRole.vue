<template>
    <div class="modal fade" style="z-index:1000" id="createRole"  data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Role Name</label>

                        <input type="text" :class="{'is-invalid': errors.hasError('name')}"
                               v-model="role.name" class="form-control" placeholder="">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Attach Permissions</label>
                        <p style="color: #dc3545; font-size: 80%" v-if="errors.hasError('permissions')">Pls attach one or more permission</p>

                        <div class="selectgroup selectgroup-pills" v-if ="permissions.length > 0" >

                            <label class="selectgroup-item" v-for="permission in permissions">
                                <input type="checkbox" :class="{'is-invalid': errors.hasError('permissions')}" v-model="perm_roles[permission.id]"  class="selectgroup-input">
                                <span class="selectgroup-button">{{permission.name}}</span>
                            </label>

                        </div>

                        <p v-else><em>No Permissions... Add <a href="/admin/permission">here<i class="fas  fa-plus-circle"></i></a></em> </p>

                    </div>

                </div>

                <div class="modal-footer" style = "padding-top: 0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="editRole(role.id)" v-if="editing">Update Role</button>
                    <button type="button" @click="storeRole()" class="btn btn-primary" v-else>Create Role</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>


    import ErrorBag from '../error_bag'

    class Role{

        constructor(role){

            this.name = role.name || '';
            this.permissions = role.permissions || [];
        }

    }

    export default {
        name: "StoreRole",

        data(){

            return{

                editing: false,
                role: new Role({}),
                errors: new ErrorBag,
                permissions: [],
                perm_roles: []

            }
        },

        created(){

            // this.perm_roles = []
        },

        mounted(){


            this.$parent.$on('create_role', (permissions) => {

                this.editing = false;
                this.role = new Role({});
                this.perm_roles = [];
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                this.permissions = permissions;
                $('#createRole').modal('show')


            });

            this.$parent.$on('edit_role', (role, permissions) => {

                this.editing = true;
                this.role = new Role(role);
                this.role.id = role.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                this.permissions = permissions;

                this.perm_roles = [];

                this.role.permissions.forEach((perm) => {

                    this.perm_roles[perm.id] = true

                });
                $('#createRole').modal('show')


            });


        },

        computed: {

            name(){

                return this.editing ? 'Edit Role' : 'Create Role'

            }

        },

        methods: {

            storeRole(){

                const entries = Object.entries(this.perm_roles);
                const values = [];
                for (const [key, val] of entries) {
                    if (val){

                        values.push(key);

                    }
                }

                console.log(values);

                this.$http.post('/admin/role', {

                    name: this.role.name,
                    permissions: values

                }).then(res => {

                    this.$parent.$emit('add_role', res.data);
                    console.log(res.data);

                    $('#createRole').modal('hide')


                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                        console.log(err.response)

                    }
                })

            },

            editRole(id){

                const entries = Object.entries(this.perm_roles);
                const values = [];
                for (const [key, val] of entries) {

                    if (val){

                        values.push(key);

                    }
                }

                // console.log(values);

                this.$http.put(`/admin/role/${id}`, {

                    name: this.role.name,
                    permissions: values

                }).then(res => {

                    this.$parent.$emit('update_role', res.data);
                    console.log(res.data);
                    $('#createRole').modal('hide')

                }).catch(err =>  {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                })

            }
        }
    }
</script>

<style scoped>

</style>