<template>
    <div class="modal fade" id="createCategory"  data-backdrop="false">
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
                            <label>Name:</label>
                            <input type="text" :class="{'is-invalid': errors.hasError('name')}" v-model="category.name"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" v-model="category.description"></textarea>
                            <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                        </div>

                    </div>

                    <div class="modal-footer" style = "padding-top: 0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="editCategory(category.id)" v-if="editing">Update Category</button>
                        <button type="button" @click="storeCategory()" class="btn btn-primary" v-else>Create Category</button>
                    </div>

                 </div>
        </div>
    </div>
</template>

<script>


    import ErrorBag from '../error_bag'

    class Category{

        constructor(category){

            this.name = category.name || '';
            this.description = category.description || '';
        }

    }

    export default {
        name: "StoreCategory",

        data(){

            return{

                editing: false,
                category: new Category({}),
                errors: new ErrorBag

            }
        },

        mounted(){

            this.$parent.$on('create_category', () => {

                this.editing = false;
                this.category = new Category({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCategory').modal('show')


            });

            this.$parent.$on('edit_category', (category) => {

                this.editing = true;
                this.category = new Category(category);
                this.category.id = category.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCategory').modal('show')

            })

        },

        computed: {

            name(){

                return this.editing ? 'Edit Category' : 'Create Category'

            }

        },

        methods: {

            storeCategory(){


                this.$http.post('/admin/categories', this.category).then(res => {

                    this.$parent.$emit('add_category', res.data);
                    $('#createCategory').modal('hide')


                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                    this.notifError( err.message || 'An error occurred')
                })

            },

            editCategory(id){


                this.$http.put(`/admin/categories/${id}`, this.category).then(res => {

                    this.$parent.$emit('update_category', res.data);
                    $('#createCategory').modal('hide')

                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                    this.notifError( err.message || 'An error occurred')

                })

            }
        }
    }
</script>

<style scoped>

    textarea {
        height: 100px !important;
    }

</style>
