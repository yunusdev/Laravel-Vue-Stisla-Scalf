<template>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <form v-if="isCart"  @submit.prevent="initiateCheckout" >
                    <h4>Shipping Information</h4>
                    <hr class="padding-bottom-1x">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-fn">Name</label>
                                <input v-model="order.name" required class="form-control" type="text" id="checkout-fn">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-email">E-mail Address</label>
                                <input v-model="order.email" required class="form-control" type="email" id="checkout-email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-phone">Phone Number</label>
                                <input v-model="order.phone" required class="form-control" type="text" id="checkout-phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-country">Country</label>
                                <select v-model="order.country"  @change="setDeliveryAmount" required class="form-control" id="checkout-country">
                                    <option value="">Select country</option>
                                    <option :value="country.name" v-for="country in countries">{{ country.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-city">State</label>
                                <select v-if="isNigeria" v-model="state" required class="form-control" id="checkout-city">
                                    <option value="">Select State</option>
                                    <option :value="state" v-for="state in states">{{ state.name }}</option>
                                </select>
                                <input v-else v-model="order.state" required class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div v-if="isNigeria" class="form-group">
                                <label for="checkout-lg">Local Government</label>
                                <select  v-model="order.lga"  @change="setDeliveryAmount" required class="form-control" id="checkout-lg">
                                    <option value="">Select LGA</option>
                                    <option v-show="LGA.length > 0" :value="lga.name" v-for="lga in LGA">{{ lga.name }}</option>
                                </select>
                            </div>
                            <div v-else class="form-group">
                                <label for="checkout-lg">City</label>
                                <input v-model="order.lga" required class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row padding-bottom-1x">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="checkout-address1">Address</label>
                                <input v-model="order.address"  required class="form-control" type="text" id="checkout-address1">
                            </div>
                        </div>
                    </div>
                    <div class="checkout-footer">
                        <div class="column"><a class="btn btn-outline-secondary" href="/cart"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back To Cart</span></a></div>
                        <div class="column">
                            <button type="submit" class="btn btn-primary">
                                <span class="">Pay&nbsp;</span>
                                <i class="icon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <p class="f-17" v-else>No items in your cart. Go to the <a href="/shop">shop</a> to add items to the cart.</p>

            </div>
            <div class="col-xl-3 col-lg-4">
                <aside class="sidebar">
                    <div class="padding-top-2x hidden-lg-up"></div>
                    <!-- Order Summary Widget-->
                    <section v-if="isCart"  class="widget widget-order-summary">
                        <h3 class="widget-title">Order Summary</h3>
                        <table class="table">
                            <tr>
                                <td>Cart Subtotal:</td>
                                <td class="text-medium">N{{subTotalAmount | formatMoney}}</td>
                            </tr>
                            <tr>
                                <td>Delivery Fee:</td>
                                <td v-if="deliveryFee" class="text-small">N{{deliveryFee | formatMoney}}</td>
                                <td v-else class="text-small">To be Calculated</td>
                            </tr>
                            <tr v-if="validCoupon">
                                <td>Discount:</td>
                                <td class="text-small text-danger">N{{couponDiscount | formatMoney}} off</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-lg text-medium">N{{totalFee | formatMoney}}</td>
                            </tr>
                        </table>
                    </section>
                    <!-- Featured Products Widget-->
                    <product-widget :title="'TOP SELLERS'" :products="topSellingProducts"></product-widget>

                    <!-- Promo Banner-->
                    <section class="promo-box" style="background-image: url(img/banners/02.jpg);"><span class="overlay-dark" style="opacity: .4;"></span>
                        <div class="promo-box-content text-center padding-top-2x padding-bottom-2x">
                            <h4 class="text-light text-thin text-shadow">New Collection of</h4>
                            <h3 class="text-bold text-light text-shadow">Sunglasses</h3><a class="btn btn-outline-white btn-sm" href="shop-grid-ls.html">Shop Now</a>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
        <paystack
            @payment-successful="completeOrder"
            @go-back="goBack"
            @payment-failed="paymentFailed"
            ref="paystackPayment"
            :user="order"
            id="paystack"
            :amount="totalFee"
            :paystack_pk="paystack_pk"
        />
<!--        <pay :amount="totalFee" :paystack_pk="paystack_pk" :user="order"></pay>-->
    </div>
</template>

<script>
import {mapGetters, mapActions, mapMutations} from "vuex";
import store from "../../../store";
import Paystack from "../Paystack";
import ProductWidget from "./ProductWidget";
class Order {

    constructor(order) {

        this.name = order.name || ''
        this.email = order.email || ''
        this.phone = order.phone || '2349021333232'
        this.country = order.country || 'Nigeria'
        this.state = order.state || 'Lagos'
        this.lga = order.lga || 'Shomolu'
        this.address = order.address || 'Bajlulaiye'

    }
}

export default {
    name: "Checkout",

    props: ['raw_user', 'paystack_pk'],

    components: {Paystack, ProductWidget},

    data(){

        return {

            user: this.raw_user ? JSON.parse(this.raw_user) : null,
            order: new Order({}),
            state: '',
            lga: '',
            LGA: []

        }

    },

    mounted() {

        this.getCountries({})
        this.getNigerianStates({})
        this.setDeliveryFee(0)
        this.setTotalFee(this.subTotalAmount - this.couponDiscount)
        if (this.user) Object.assign(this.order, this.user)
        this.getTopSellingProducts({num: 5})

    },

    watch: {

        'state': function (state){
            this.order.lga = ''
            if(state.name && state.locals){
                this.order.state = state.name
                this.LGA = state.locals
            }
            this.setDeliveryAmount()
        },
        'order.country': function (){
            this.order.state = ''
            this.order.lga = ''
            this.LGA = []
        }

    },

    computed: {

        ...mapGetters({
            cartItems: 'cart/items',
            subTotalAmount: 'cart/subTotalAmount',
            totalFee: 'cart/totalFee',
            validCoupon: 'cart/validCoupon',
            couponDiscount: 'cart/couponDiscount',
            deliveryFee: 'cart/deliveryFee',
            payBeforePercentage: 'cart/payBeforePercentage',
            states: 'locality/states',
            countries: 'locality/countries',
            topSellingProducts: 'shop/topSellingProducts',
        }),

        isCart(){
            return this.cartItems.length > 0
        },

        isNigeria(){

            if (!this.order.country) return true
            return this.order.country && this.order.country === 'Nigeria'
        },

        minAmountToPay(){
            return Math.round((this.payBeforePercentage / 100) * this.totalFee);
        },

        isOrderFilled(){
            if (this.order.name && this.order.email && this.order.phone && this.order.lga
                && this.order.country && this.order.state && this.order.address){
                return true
            }
            return false
        }

    },

    methods: {

        ...mapActions({
            getCountries: 'locality/getCountries',
            getNigerianStates: 'locality/getNigerianStates',
            resetAllShoppingMutations: 'cart/resetAllShoppingMutations',
            getTopSellingProducts: 'shop/getTopSellingProducts',

        }),

        ...mapMutations({
            setTotalFee: 'cart/setTotalFee',
            setDeliveryFee: 'cart/setDeliveryFee',
        }),

        initiateCheckout(){

            this.$refs.paystackPayment.makePayment()

        },

        completeOrder(response){

            this.$http.post('/orders/create', {
                order: {
                    ...this.order,
                    ref: response.reference,
                    sub_total_amount: this.subTotalAmount,
                    total_amount: this.totalFee,
                    delivery_fee: this.deliveryFee,
                    number_of_items: this.cartItems.length,
                    coupon_discount: this.couponDiscount,
                    coupon_id:  this.validCoupon ? this.validCoupon.id : null,
                },
                items: this.cartItems,

            }).then(async (res) => {
                await this.resetAllShoppingMutations()
                await this.notifSuceess('Your order has been initiated successfully!');
                console.log(res)
                window.location = '/shop'

            }).catch(err => {

                console.log(err)
            })

        },
        paymentFailed(response){

            console.log(response)

        },
        goBack(){


        },

        setDeliveryAmount(){

            if(this.order.country !== 'Nigeria'){
                this.setDeliveryFee(5000)
            }
            if (this.order.country === 'Nigeria' && this.order.state !== 'Lagos'){
                this.setDeliveryFee(3000)
            }
            const fartherLagosLGA = ["Ikorodu", "Ikeja", "green"];

            if (this.order.state === 'Lagos' && fartherLagosLGA.indexOf(this.order.lga) !== -1){
                this.setDeliveryFee(2000)
            }
            if (this.order.state === 'Lagos' && fartherLagosLGA.indexOf(this.order.lga) === -1){
                this.setDeliveryFee(1500)
            }
            this.setTotalFee((this.subTotalAmount + this.deliveryFee) - this.couponDiscount)

        },

        validateCoupon(){
            this.couponValidate({code: this.coupon_code, total_amount: this.subTotalAmount}).then((data) => {
                console.log(data)
                this.coupon_data = data.coupon_data
                if(data.coupon_data.valid) store.commit('cart/setTotalFee', this.totalFee)
                this.notifSuceess(this.coupon_data.message);
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })

        },

    }


}
</script>

<style scoped>

</style>
