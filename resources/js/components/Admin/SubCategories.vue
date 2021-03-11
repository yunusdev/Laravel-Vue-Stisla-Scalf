<template>
    <div>

        <div class="float-right mb-4">
            <button style="padding: 10px" @click="createSubCategory()" class=" pull-right btn btn-primary">
                <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Sub Category
            </button>
        </div>
        <br>
        <div class="box-body">

            <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>View Products</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="sub_category, key in sub_categories" :key="sub_category.id">
                    <td>{{key + 1}}</td>
                    <td>{{sub_category.name}}</td>
                    <td>{{sub_category.category.name}}</td>
                    <td><a :href="`/admin/sub-categories/${sub_category.slug}/products`"><i class="text-center fas fa-2x fa-list"></i></a></td>
                    <td><a @click="editSubCategory(sub_category)"><i class="text-center fas fa-edit"></i></a></td>
                    <td><a @click="deleteSubCategory(sub_category.category.id, sub_category.id, key)"><span class="text-center fas fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>View Products</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <store-sub-category></store-sub-category>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    export default {
        name: "SubCategories",
        props: ['raw_sub_categories', 'raw_categories'],

        data(){

            return{

                sub_categories: JSON.parse(this.raw_sub_categories),
                categories: JSON.parse(this.raw_categories),

            }
        },

        mounted(){

            this.$on('add_sub_category', (sub_category) => {

                // this.sub_categories.unshift(sub_category);
                this.notifSuceess('Sub Category Created Successfully!!!')
                window.location.reload()

            });


            this.$on('update_sub_category', (sub_category) => {

                // const index = this.sub_categories.findIndex(item => item.id === sub_category.id);
                // this.sub_categories.splice(index, 1, sub_category);
                this.notifSuceess('Sub Category Updated Successfully!!')
                window.location.reload()

            })

        },

        computed: {


        },

        methods: {

            createSubCategory(){

                this.$emit('create_sub_category', this.categories);

            },

            editSubCategory(sub_category){

                this.$emit('edit_sub_category', sub_category, this.categories)

            },

            deleteSubCategory(categoryId, subCategoryId, key){

                Swal('Are you sure want to delete this sub category', {
                    buttons: ['Oh no!', true]
                }).then(value => {
                    if (value) {
                        this.$http.delete(`/admin/${categoryId}/sub-categories/${subCategoryId}`).then(res => {

                            this.sub_categories.splice(key, 1);
                            this.notifSuceess('Sub Category Deleted Successfully');

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
