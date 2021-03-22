<template>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account></nav-account>
            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div class="table-responsive wishlist-table margin-bottom-none">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody v-for="item in order.order_items">
                        <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" :href="'/product/' + item.product.slug">
                                        <img :src="item.product.front_image" class="cart-item-image" alt="Product">
                                    </a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a :href="'/product/' + item.product.slug">{{item.product_name}}</a></h4>
                                        <div>Size:
                                            <div class="d-inline">{{item.size}}</div>
                                        </div>
                                        <div>Color:
                                            <div class="d-inline">{{item.color}}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-lg text-medium"> <span>{{item.quantity}}</span> <span> X </span> N{{item.product_price | formatMoney}}</div>
                            </td>
                            <td>
                                <div class="text-lg text-medium">N{{item.amount | formatMoney}}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="shopping-cart-footer">

                    <div class="column text-lg">
                        Subtotal: <span class="text-medium">N{{order.sub_total_amount | formatMoney}}</span>
                        Delivery Fee: <span class="text-medium">N{{order.delivery_fee | formatMoney}}</span>
                        <div class="mt-2 mb-2" v-if="order.coupon_id">
                            <span class="">Discount:
                                <span class="text-small text-danger">
                                    {{order.coupon_discount}}% off
                                </span>
                            </span>
                        </div>

                        <span class="">
                            Total Price: <span class="text-medium">N{{order.total_amount | formatMoney}}</span>
                        </span>
                    </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</template>

<script>
import NavAccount from "./NavAccount";

import { mapActions, mapMutations, mapGetters } from 'vuex'

export default {
    name: "ViewUserOrder",

    components: {NavAccount},

    props: ['raw_order'],

    data(){

        return {

            order: JSON.parse(this.raw_order)

        }
    },

    mounted() {


    },

    computed: {


    },

    methods: {



    }
}
</script>

<style scoped>

</style>
