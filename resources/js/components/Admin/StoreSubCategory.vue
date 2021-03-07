<template>
    <div class="modal fade" id="createSubCategory"  data-backdrop="false">
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
                            <input type="text" :class="{'is-invalid': errors.hasError('name')}" v-model="sub_category.name"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Category</label>
                            <multiselect v-model="sub_category.category" label="name" track-by="id" tag-placeholder="Add category" placeholder="Search or add a tag"
                                         :options="categories" :taggable="true">
                            </multiselect>
                            <div class="invalid-feedback" v-if="errors.hasError('category_id')">{{ errors.first('category_id') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" v-model="sub_category.description"></textarea>
                            <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                        </div>

                    </div>

                    <div class="modal-footer" style = "padding-top: 0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" :disabled="this.sub_category.category === ''" class="btn btn-primary" @click="editCategory(sub_category.id)" v-if="editing">Update SubCategory</button>
                        <button type="button" :disabled="this.sub_category.category === ''" @click="storeCategory()" class="btn btn-primary" v-else>Create SubCategory</button>
                    </div>

                 </div>
        </div>
    </div>
</template>

<script>


    import ErrorBag from '../error_bag'
    import Multiselect from "vue-multiselect";
    import "vue-multiselect/dist/vue-multiselect.min.css";

    class SubCategory{

        constructor(sub_category){

            this.name = sub_category.name || '';
            this.category = sub_category.category || '';
            this.description = sub_category.description || '';
        }

    }

    export default {
        name: "StoreSubCategory",

        components: {Multiselect},

        data(){

            return{

                editing: false,
                categories: [],
                sub_category: new SubCategory({}),
                errors: new ErrorBag

            }
        },

        mounted(){

            this.$parent.$on('create_sub_category', (categories) => {

                this.editing = false;
                this.categories = categories;
                this.sub_category = new SubCategory({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createSubCategory').modal('show')


            });

            this.$parent.$on('edit_sub_category', (sub_category, categories) => {

                this.editing = true;
                this.categories = categories;
                this.sub_category = new SubCategory(sub_category);
                this.sub_category.id = sub_category.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createSubCategory').modal('show')

            })

        },

        computed: {

            name(){

                return this.editing ? 'Edit Sub Category' : 'Create Sub Category'

            }

        },

        methods: {

            storeCategory(){


                this.$http.post(`/admin/${this.sub_category.category.id}/sub-categories`, this.sub_category).then(res => {

                    this.$parent.$emit('add_sub_category', res.data);
                    $('#createSubCategory').modal('hide')


                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                    this.notifError( err.message || 'An error occurred')
                })

            },

            editCategory(id){


                this.$http.put(`/admin/${this.sub_category.category.id}/sub-categories/${id}`, this.sub_category).then(res => {

                    this.$parent.$emit('update_sub_category', res.data);
                    $('#createSubCategory').modal('hide')

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
