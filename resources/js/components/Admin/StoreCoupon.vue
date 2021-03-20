<template>
    <div class="modal fade" id="createCoupon"  data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="storeCoupon" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-md-6">
                        <label>Name:</label>
                        <input type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('name')}" placeholder="Name" v-model="coupon.name">
                        <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Code:</label>
                        <input required style="text-transform: uppercase;" type="text" :class="{'form-control': true, 'is-invalid': errors.hasError('code')}" placeholder="Code" v-model="coupon.code">
                        <div class="invalid-feedback" v-if="errors.hasError('code')">{{ errors.first('code') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Select Type:</label>
                        <select required v-model="coupon.type" class="form-control">
                            <option  value="">--Select Type--</option>
                            <option  :value="'Percentage'">Percentage</option>
                            <option  :value="'Price'">Price</option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.hasError('type')">{{ errors.first('type') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Discount:</label>
                        <input min="1" type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('discount')}" placeholder="Discount" v-model="coupon.discount">
                        <div class="invalid-feedback" v-if="errors.hasError('discount')">{{ errors.first('discount') }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="custom-switch mt-2">
                            <input v-model="coupon.status" type="checkbox" name="status" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Status</span>
                        </label>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="custom-switch mt-2">
                            <input v-model="coupon.will_max_out" type="checkbox" name="will_expire" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Will Max Out</span>
                        </label>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="custom-switch mt-2">
                            <input v-model="coupon.will_expire" type="checkbox" name="will_expire" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Will Expire</span>
                        </label>
                    </div>
                    <div v-show="coupon.will_max_out" class="form-group col-md-6">
                        <label>Max Usage:</label>
                        <input min="1" type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('max_usage')}" placeholder="Max Usage" v-model="coupon.max_usage">
                        <div class="invalid-feedback" v-if="errors.hasError('max_usage')">{{ errors.first('max_usage') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Lowest Amount:</label>
                        <input min="1" type="number" :class="{'form-control': true, 'is-invalid': errors.hasError('lowest_amount')}" placeholder="Lowest Amount" v-model="coupon.lowest_amount">
                        <div class="invalid-feedback" v-if="errors.hasError('lowest_amount')">{{ errors.first('lowest_amount') }}</div>
                    </div>

                    <div v-show="coupon.will_expire" class="form-group  col-md-12">
                        <label>Expires In</label>
                        <datetime type="datetime" class="input theme-blue" placeholder="Expres In"
                                  input-class="form-control select"  v-model="coupon.expires_in"></datetime>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Description:</label>
                        <textarea :class="{'form-control': true, 'is-invalid': errors.hasError('description')}" placeholder="Description" v-model="coupon.description"></textarea>
                        <div class="invalid-feedback" v-if="errors.hasError('description')">{{ errors.first('description') }}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" v-if="editing">
                        <span>Update Coupon</span>
                        <i class="fas fa-spinner fa-pulse" v-if="disabled"></i>
                    </button>
                    <button type="submit" class="btn btn-primary" v-else>
                        <span>Create Coupon</span>
                        <i class="fas fa-spinner fa-pulse" v-if="disabled"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>


class Coupon{

    constructor(coupon){

        this.name = coupon.name || '';
        this.code = coupon.code || '';
        this.description = coupon.description || '';
        this.type = coupon.type || 'Percentage';
        this.discount = coupon.discount || '';
        this.lowest_amount = coupon.lowest_amount || 3000;
        this.max_usage = coupon.max_usage || '';
        this.will_max_out = coupon.will_max_out || true;
        this.status = coupon.status || true;
        this.will_expire = coupon.will_expire || true;
        this.expires_in = coupon.expires_in || '';
        this.product_id = coupon.product_id || '';

    }

}

import ErrorBag from '../error_bag'
import Axios from 'axios'
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

export default {

    // components: {Datetime},

    mounted(){

        this.$parent.$on('create_coupon', () => {

            this.editing = false;
            this.coupon = new Coupon({});
            if (this.errors.hasErrors()) {
                this.errors.clearAll();
            }

            $('#createCoupon').modal()


        });

        this.$parent.$on('edit_coupon', (coupon) => {

            this.editing = true;
            this.coupon = new Coupon(coupon);
            this.coupon.id = coupon.id;
            if (this.errors.hasErrors()) {
                this.errors.clearAll();
            }
            $('#createCoupon').modal()

        });

    },

    data(){

        return {

            coupon: new Coupon({}),
            editing: false,
            disabled: false,
            errors: new ErrorBag,
        }
    },

    computed: {

        name(){

            if (this.editing){

                return 'Edit Coupon'
            }

            return 'Create Coupon'

        }

    },

    watch: {

        'coupon.will_expire': function (val){

            if (!val) this.coupon.expires_in = ''

        }

    },

    methods: {


        customFormatter(date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        },
        storeCoupon(){

            if (this.coupon.type === 'Percentage' && this.coupon.discount > 80){
                this.notifError( 'Percentage discount cant be greater than 80')
                return;
            }
            if (this.coupon.type === 'Price'){
                if (this.coupon.discount > (this.coupon.lowest_amount / 2)){
                    this.notifError( 'Pls provide a lesser discount or increase the lowest amount')
                    return;
                }
            }
            if (this.coupon.will_expire && !this.coupon.expires_in){
                this.notifError( 'Pls select an expire date')
                return;
            }
            if (this.coupon.will_max_out && !this.coupon.max_usage){
                this.notifError( 'Pls provide the maximum usage')
                return;
            }
            if (!this.editing){

                this.createCoupon()

            }else{

                this.updateCoupon(this.coupon.id)

            }


        },

        createCoupon(){

            this.disabled = true
            this.$http.post('/admin/coupons', this.coupon).then(res => {

                this.disabled = false;
                this.$parent.$emit('add_coupon', res.data);
                $('#createCoupon').modal('hide')

            }).catch(err => {
                this.disabled = false;
                if (err.response && err.response.status === 422) {
                    const errors = err.response.data.errors;
                    this.errors.setErrors(errors);
                }
                this.notifError( err.message || 'An error occurred')
            })

        },

        updateCoupon(id){

            this.disabled = true
            this.$http.put(`/admin/coupons/${id}`, this.coupon).then(res => {

                this.disabled = false;
                this.$parent.$emit('update_coupon', res.data);
                console.log(res.data);
                $('#createCoupon').modal('hide');

            }).catch(err => {
                this.disabled = false;

                if (err.response && err.response.status === 422) {
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

textarea{
    height: 100px !important;
}

</style>
