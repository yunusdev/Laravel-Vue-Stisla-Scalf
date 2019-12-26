<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-1">
                <!--<h3 class="card-title">Permissions</h3>-->

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createPermission()" class="col-sm-6 col-xs-12 pull-right btn btn-primary">
                    <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Permission
                </button>
            </div>

        </div>
        <br>
        <div class="box-body">

            <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Permission Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="permission, key in permissions">
                    <td>{{key + 1}}</td>
                    <td>{{permission.name}}</td>
                    <td><a @click="editPermission(permission)"><i class="text-center fas fa-edit"></i></a></td>
                    <td><a @click="deletePermission(permission.id, key)"><span class="text-center fas fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Permission Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <store-permission></store-permission>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    export default {
        name: "Permissions",

        props: ['raw_permissions'],

        data(){

            return{

                permissions: JSON.parse(this.raw_permissions)

            }
        },

        mounted(){

            this.$on('add_permission', (permission) => {

                this.permissions.push(permission);
                Swal('Permission Created Successfully!!!')

            });


            this.$on('update_permission', (permission) => {

                const index = this.permissions.findIndex(item => item.id === permission.id);
                this.permissions.splice(index, 1, permission);

                this.$swal('Permission Updated Successfully!!')
            })

        },

        computed: {


        },

        methods: {

            createPermission(){

                this.$emit('create_permission');

            },

            editPermission(permission){

                this.$emit('edit_permission', permission)

            },

            deletePermission(id, key){

                this.$http.delete(`/admin/permission/${id}`).then(res => {

                    this.permissions.splice(key, 1);
                    this.$swal('Permission Deleted Successfully');

                }).catch(err => {

                    console.log(err)
                })

            }
        }
    }
</script>

<style scoped>

</style>