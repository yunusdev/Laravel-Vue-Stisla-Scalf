<template>
    <div class="modal fade" id="createPermission"  data-backdrop="false">
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
                            <label>Permission Name</label>

                            <input type="text" :class="{'is-invalid': errors.hasError('name')}" v-model="permission.name"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>

                        </div>

                    </div>

                    <div class="modal-footer" style = "padding-top: 0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="editPermission(permission.id)" v-if="editing">Update Permission</button>
                        <button type="button" @click="storePermission()" class="btn btn-primary" v-else>Create Permission</button>
                    </div>

                 </div>
        </div>
    </div>
</template>

<script>


    import ErrorBag from '../error_bag'

    class Permission{

        constructor(permission){

            this.name = permission.name || '';
        }

    }

    export default {
        name: "StorePermission",

        data(){

            return{

                editing: false,
                permission: new Permission({}),
                errors: new ErrorBag

            }
        },

        mounted(){

            this.$parent.$on('create_permission', () => {

                this.editing = false;
                this.permission = new Permission({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createPermission').modal('show')


            });

            this.$parent.$on('edit_permission', (permission) => {

                this.editing = true;
                this.permission = new Permission(permission);
                this.permission.id = permission.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createPermission').modal('show')

            })

        },

        computed: {

            name(){

                return this.editing ? 'Edit Permission' : 'Create Permission'

            }

        },

        methods: {

            storePermission(){


                this.$http.post('/admin/permission', this.permission).then(res => {

                    this.$parent.$emit('add_permission', res.data);
                    $('#createPermission').modal('hide')


                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                        console.log(err.response)
                    }
                })

            },

            editPermission(id){


                this.$http.put(`/admin/permission/${id}`, this.permission).then(res => {

                    this.$parent.$emit('update_permission', res.data);
                    $('#createPermission').modal('hide')

                }).catch(err => {

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