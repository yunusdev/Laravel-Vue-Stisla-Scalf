<template>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account :user="user" :raw_url="raw_url"></nav-account>
            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>

                <div class="text-center order-details">
                    <h6><span class="cont">#{{order.tracking_number}}</span></h6>
                    <h6><span class="cont">{{order.name}} | {{order.email}} | {{order.phone}}</span></h6>
                    <h6><span class="cont">{{order.address}} | {{order.lga}} | {{order.state}}</span></h6>
                </div>
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
                                        <img :src="item.product.front_image" class="cart-item-image" :alt="item.product_name">
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
                                <div class="text-small"> <span>{{item.quantity}}</span> <span> X </span> N{{item.product_price | formatMoney}}</div>
                            </td>
                            <td>
                                <div class="text-small">N{{item.amount | formatMoney}}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="shopping-cart-footer  ">
                        <section class="widget widget-order-summary col-md-5 float-right">
                            <table class="table">
                                <tr>
                                    <td>Subtotal:</td>
                                    <td class="text-medium">N{{order.sub_total_amount | formatMoney}}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee:</td>
                                    <td class="text-small">N{{order.delivery_fee | formatMoney}}</td>
                                </tr>
                                <tr v-if="order.coupon_id">
                                    <td>Discount:</td>
                                    <td class="text-small text-danger">- N{{order.coupon_discount | formatMoney}}</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="text-lg text-medium">N{{order.total_amount | formatMoney}}</td>
                                </tr>
                            </table>
                        </section>
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

    props: ['raw_order', 'raw_url', 'raw_user'],

    data(){

        return {

            order: JSON.parse(this.raw_order),
            user: JSON.parse(this.raw_user),

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
