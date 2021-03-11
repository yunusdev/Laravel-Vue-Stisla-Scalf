<template>
    <div>

        <div class="float-right mb-4">
            <button style="padding: 10px" @click="createCategory()" class=" pull-right btn btn-primary">
                <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Category
            </button>
        </div>
        <br>
        <div class="box-body">

            <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>View Products</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category, key in categories">
                    <td>{{key + 1}}</td>
                    <td>{{category.name}}</td>
                    <td><a :href="`/admin/categories/${category.slug}/products`"><i class="text-center fas fa-2x fa-list"></i></a></td>
                    <td><a @click="editCategory(category)"><i class="text-center fas fa-edit"></i></a></td>
                    <td><a @click="deleteCategory(category.id, key)"><span class="text-center fas fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>View Products</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <store-category></store-category>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    export default {
        name: "Categories",
        props: ['raw_categories'],

        data(){

            return{

                categories: JSON.parse(this.raw_categories)

            }
        },

        mounted(){

            this.$on('add_category', (category) => {

                this.categories.unshift(category);
                this.notifSuceess('Category Created Successfully!!!')

            });


            this.$on('update_category', (category) => {

                const index = this.categories.findIndex(item => item.id === category.id);
                this.categories.splice(index, 1, category);

                this.notifSuceess('Category Updated Successfully!!')
            })

        },

        computed: {


        },

        methods: {

            createCategory(){

                this.$emit('create_category');

            },

            editCategory(category){

                this.$emit('edit_category', category)

            },

            deleteCategory(id, key){

                Swal('Are you sure want to delete this category', {
                    buttons: ['Oh no!', true]
                }).then(value => {
                    if (value) {
                        this.$http.delete(`/admin/categories/${id}`).then(res => {

                            this.categories.splice(key, 1);
                            this.notifSuceess('Category Deleted Successfully');

                        }).catch(err => {

                            this.notifError( err.message || 'An error occurred')
                        })

                    }
                })

            }
        }
    }
</script>

<style scoped>

</style>
