<template>
    <div>

        <div class="float-right mb-4">
            <button style="padding: 10px" @click="createCoupon()" class=" pull-right btn btn-primary">
                <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Coupon
            </button>
        </div>
        <br>
        <div class="box-body">

            <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Min Amount</th>
                    <th>Will Max Out</th>
                    <th>Max Usage</th>
                    <th>Will Expire</th>
                    <th>Expires In</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="coupon, key in coupons">
                    <td>{{key + 1}}</td>
                    <td>
                        <span class="text-uppercase text-primary font-weight-bold">{{coupon.code}}</span>
                    </td>
                    <td>{{coupon.status == 1 ? 'Usable' : 'Not Usable'}}</td>
                    <td>{{coupon.type}}</td>
                    <td>N{{coupon.discount}}</td>
                    <td>N{{coupon.lowest_amount || '--'}}</td>
                    <td>{{coupon.will_max_out == 1 ? 'Yes' : 'No'}}</td>
                    <td>{{coupon.max_usage || '--'}}</td>
                    <td>{{coupon.will_expire == 1 ? 'Yes' : 'No'}}</td>
                    <td>{{coupon.expires_format || '--'}}</td>
                    <td><a @click="editCoupon(coupon)"><i class="text-center fas fa-edit"></i></a></td>
                    <td><a @click="deleteCoupon(coupon.id, key)"><span class="text-center fas fa-trash" ></span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Min Amount</th>
                    <th>Will Max Out</th>
                    <th>Max Usage</th>
                    <th>Will Expire</th>
                    <th>Expires In</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </tfoot>

            </table>

        </div>

        <store-coupon></store-coupon>

    </div>

</template>

<script>
    import Swal from 'sweetalert'
    export default {
        name: "coupons",
        props: ['raw_coupons'],

        data(){

            return{

                coupons: JSON.parse(this.raw_coupons)

            }
        },

        mounted(){

            this.$on('add_coupon', (coupon) => {

                this.coupons.unshift(coupon);
                this.notifSuceess('Coupon Created Successfully!!!')

            });


            this.$on('update_coupon', (coupon) => {

                const index = this.coupons.findIndex(item => item.id === coupon.id);
                this.coupons.splice(index, 1, coupon);

                this.notifSuceess('Coupon Updated Successfully!!')
            })

        },

        computed: {


        },

        methods: {

            createCoupon(){

                this.$emit('create_coupon');

            },

            editCoupon(coupon){

                this.$emit('edit_coupon', coupon)

            },

            deleteCoupon(id, key){

                Swal('Are you sure want to delete this coupon', {
                    buttons: ['Oh no!', true]
                }).then(value => {
                    if (value) {
                        this.$http.delete(`/admin/coupons/${id}`).then(res => {

                            this.coupons.splice(key, 1);
                            this.notifSuceess('Coupon Deleted Successfully');

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
