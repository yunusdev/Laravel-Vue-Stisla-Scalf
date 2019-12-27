<template>
    <div>

        <div class="card-header row" >
            <div class="col-lg-6 mb-1">

            </div>
            <div class="col-lg-6">
                <button style="padding: 10px" @click="createRole()" class="col-sm-6 col-xs-12 pull-right btn btn-primary">
                    <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Role
                </button>
            </div>

        </div>
        <br>
        <div class="box-body">

            <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Role Name</th>
                    <th>Permission For</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="role, key in roles">
                    <td>{{key+1}}</td>
                    <td>{{role.name}}</td>
                    <td ><span v-for="permission in role.permissions">{{permission.name}} | </span></td>
                    <td><a @click="editRole(role)"><i class="text-center fas fa-edit"></i></a></td>
                    <td><a @click="deleteRole(role.id, key)"><span class="text-center fas fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Role Name</th>
                    <th>Permission For</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <store-role></store-role>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    export default {
        name: "Roles",

        props: ['raw_roles', 'raw_permissions'],

        data(){

            return{

                roles: JSON.parse(this.raw_roles),
                permissions: JSON.parse(this.raw_permissions)

            }
        },

        mounted(){

            this.$on('add_role', (role) => {

                this.roles.push(role);
                Swal('Role Created Successfully!!!')

            });


            this.$on('update_role', (role) => {

                const index = this.roles.findIndex(item => item.id === role.id);
                this.roles.splice(index, 1, role);

                this.$swal('Role Updated Successfully!!')
            })

        },

        computed: {


        },

        methods: {

            createRole(){

                this.$emit('create_role', this.permissions);

            },

            editRole(role){

                this.$emit('edit_role', role, this.permissions)

            },

            deleteRole(id, key){

                this.$http.delete(`/admin/role/${id}`).then(res => {

                    this.roles.splice(key, 1);
                    this.$swal('Role Deleted Successfully');
                    // this.$emit('update_perm_roles')

                }).catch(err => {

                    console.log(err)
                })

            }
        }
    }
</script>

<style scoped>

</style>