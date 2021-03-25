<template>
    <div class="container padding-bottom-3x mb-1">
        <!-- Alert-->
<!--        <div class="alert alert-info alert-dismissible fade show text-center" style="margin-bottom: 30px;"><span class="alert-close" data-dismiss="alert"></span><img class="d-inline align-center" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuMDAzIDUxMi4wMDMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMi4wMDMgNTEyLjAwMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8Zz4KCTxnPgoJCTxnPgoJCQk8cGF0aCBkPSJNMjU2LjAwMSw2NGMtNzAuNTkyLDAtMTI4LDU3LjQwOC0xMjgsMTI4czU3LjQwOCwxMjgsMTI4LDEyOHMxMjgtNTcuNDA4LDEyOC0xMjhTMzI2LjU5Myw2NCwyNTYuMDAxLDY0eiAgICAgIE0yNTYuMDAxLDI5OC42NjdjLTU4LjgxNiwwLTEwNi42NjctNDcuODUxLTEwNi42NjctMTA2LjY2N1MxOTcuMTg1LDg1LjMzMywyNTYuMDAxLDg1LjMzM1MzNjIuNjY4LDEzMy4xODQsMzYyLjY2OCwxOTIgICAgIFMzMTQuODE3LDI5OC42NjcsMjU2LjAwMSwyOTguNjY3eiIgZmlsbD0iIzUwYzZlOSIvPgoJCQk8cGF0aCBkPSJNMzg1LjY0NCwzMzMuMjA1YzM4LjIyOS0zNS4xMzYsNjIuMzU3LTg1LjMzMyw2Mi4zNTctMTQxLjIwNWMwLTEwNS44NTYtODYuMTIzLTE5Mi0xOTItMTkycy0xOTIsODYuMTQ0LTE5MiwxOTIgICAgIGMwLDU1Ljg1MSwyNC4xMjgsMTA2LjA2OSw2Mi4zMzYsMTQxLjE4NEw2NC42ODQsNDk3LjZjLTEuNTM2LDQuMTE3LTAuNDA1LDguNzI1LDIuODM3LDExLjY2OSAgICAgYzIuMDI3LDEuNzkyLDQuNTY1LDIuNzMxLDcuMTQ3LDIuNzMxYzEuNjIxLDAsMy4yNDMtMC4zNjMsNC43NzktMS4xMDlsNzkuNzg3LTM5Ljg5M2w1OC44NTksMzkuMjMyICAgICBjMi42ODgsMS43OTIsNi4xMDEsMi4yNCw5LjE5NSwxLjI4YzMuMDkzLTEuMDAzLDUuNTY4LTMuMzQ5LDYuNjk5LTYuNGwyMy4yOTYtNjIuMTQ0bDIwLjU4Nyw2MS43MzkgICAgIGMxLjA2NywzLjE1NywzLjU0MSw1LjYzMiw2LjY3Nyw2LjcyYzMuMTM2LDEuMDY3LDYuNTkyLDAuNjQsOS4zNjUtMS4yMTZsNTguODU5LTM5LjIzMmw3OS43ODcsMzkuODkzICAgICBjMS41MzYsMC43NjgsMy4xNTcsMS4xMzEsNC43NzksMS4xMzFjMi41ODEsMCw1LjEyLTAuOTM5LDcuMTI1LTIuNzUyYzMuMjY0LTIuOTIzLDQuMzczLTcuNTUyLDIuODM3LTExLjY2OUwzODUuNjQ0LDMzMy4yMDV6ICAgICAgTTI0Ni4wMTcsNDEyLjI2N2wtMjcuMjg1LDcyLjc0N2wtNTIuODIxLTM1LjJjLTMuMi0yLjExMi03LjMxNy0yLjM4OS0xMC42ODgtMC42NjFMOTQuMTg4LDQ3OS42OGw0OS41NzktMTMyLjIyNCAgICAgYzI2Ljg1OSwxOS40MzUsNTguNzk1LDMyLjIxMyw5My41NDcsMzUuNjA1TDI0Ni43LDQxMS4yQzI0Ni40ODcsNDExLjU2MywyNDYuMTY3LDQxMS44NCwyNDYuMDE3LDQxMi4yNjd6IE0yNTYuMDAxLDM2Mi42NjcgICAgIEMxNjEuOSwzNjIuNjY3LDg1LjMzNSwyODYuMTAxLDg1LjMzNSwxOTJTMTYxLjksMjEuMzMzLDI1Ni4wMDEsMjEuMzMzUzQyNi42NjgsOTcuODk5LDQyNi42NjgsMTkyICAgICBTMzUwLjEwMywzNjIuNjY3LDI1Ni4wMDEsMzYyLjY2N3ogTTM1Ni43NTksNDQ5LjEzMWMtMy40MTMtMS43MjgtNy41MDktMS40NzItMTAuNjg4LDAuNjYxbC01Mi4zNzMsMzQuOTIzbC0zMy42NDMtMTAwLjkyOCAgICAgYzQwLjM0MS0wLjg1Myw3Ny41ODktMTQuMTg3LDEwOC4xNi0zNi4zMzFsNDkuNTc5LDEzMi4yMDNMMzU2Ljc1OSw0NDkuMTMxeiIgZmlsbD0iIzUwYzZlOSIvPgoJCTwvZz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="18" height="18" alt="Medal icon">&nbsp;&nbsp;With this purchase you will earn <strong>290</strong> Reward Points.</div>-->
        <!-- Shopping Cart-->
        <div v-if="cartItems.length > 0">
            <div class="table-responsive shopping-cart">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center"><a class="btn btn-sm btn-outline-danger cursor" @click="emptyCart" href="#">Clear Cart</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in cartItems">
                        <td>
                            <div class="product-item"><a class="product-thumb" :href="'/product/' + item.product.slug"><img class="cart-item-image" :src="item.product.front_image" alt="Product"></a>
                                <div class="product-info">
                                    <h4 class="product-title"><a :href="'/product/' + item.product.slug">{{item.product.name}}</a></h4><span><em>Size:</em> {{item.size}}</span><span><em>Color:</em> {{item.color}}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">N{{item.product_price | formatMoney}}</td>
                        <td class="text-center">
                            <div class="count-input">
                                <select @change="updateCartItemQty(item)" v-model="item.quantity" class="form-control">
                                    <option :value="index" v-for="index in 11" :key="index" >{{index}}</option>
                                </select>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">N{{item.amount | formatMoney}}</td>
                        <td class="text-center">
                            <a class="remove-from-cart cursor" @click="removeItem(item)" data-toggle="tooltip" title="Remove item">
                                <i class="icon-cross"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="shopping-cart-footer">
                <div class="column">
                    <form @submit.prevent="validateCoupon()" class="coupon-form">
                        <input v-model="coupon_code" class="form-control text-uppercase" type="text" placeholder="Coupon code" required>
                        <button class="btn btn-outline-primary" type="submit">Apply Coupon</button>
                        <div class="coupon" :class="!coupon_data.valid ? 'text-danger' : 'text-success'" v-if="coupon_data" >
                            {{isValidCoupon ? 'Coupon Applied successfully!' : coupon_data.message}}
                        </div>
                    </form>
                </div>
                <div class="column text-lg">
                    Subtotal: <span class="text-medium">N{{subTotalAmount | formatMoney}}</span>
                    <div class="mt-2 mb-2" v-if="validCoupon">
                    <span class="">Discount:
                        <span v-if="validCoupon.type === 'Price'" class="text-small text-danger">
                            N{{validCoupon.discount | formatMoney}} off
                        </span>
                        <span v-else class="text-small text-danger">
                            {{validCoupon.discount}}% off
                        </span>
                    </span>
                    </div>
                    <span class="" v-if="validCoupon">
                    Total Price: <span class="text-medium">N{{totalFee | formatMoney}}</span>
                </span>
                </div>

            </div>
            <div class="shopping-cart-footer">
                <div class="column"><a class="btn btn-outline-secondary" href="/shop"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
                <div class="column">
                    <a class="btn btn-success" href="/checkout">Checkout</a></div>
            </div>
        </div>

        <p class="f-17" v-else>No items in your cart. Go to the <a href="/shop">shop</a> to add items to the cart.</p>
        <!-- Related Products Carousel-->
        <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
        <!-- Carousel-->
        <carousel-products :products="trendingProducts"></carousel-products>
    </div>

</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import store from '../../../store/index'


export default {
    name: "Cart",

    props: ['raw_trending_products'],

    data(){

        return {

            cart_items:[],
            coupon_code: null,
            coupon_data: null

        }

    },

    async mounted() {

        store.commit('cart/setCouponData', null)
        store.commit('cart/setTotalFee', null)
        await this.getUserCartItems()
        await this.getTrendingProducts({})

    },

    computed: {
        ...mapGetters({
            cartItems: 'cart/items',
            subTotalAmount: 'cart/subTotalAmount',
            validCoupon: 'cart/validCoupon',
            couponDiscount: 'cart/couponDiscount',
            trendingProducts: 'shop/trendingProducts',
            totalQty: 'cart/totalQty'
            // totalFee: 'cart/totalFee',
        }),

        totalFee(){
            if (this.validCoupon){
                return Math.ceil(this.subTotalAmount - this.couponDiscount );
            }
            return this.subTotalAmount
        },

        getCouponDiscount(){
            if (this.isValidCoupon){
                if (this.coupon.type === 'Price'){
                    return this.coupon.discount;
                }else if (this.coupon.type === 'Percentage'){
                    return Math.round((this.coupon.discount / 100) * this.subTotalAmount);
                }else{
                    return 0;
                }
            }
            return 0;
        },
        isValidCoupon(){
            return this.coupon_data && this.coupon_data.valid && this.coupon_data.coupon
        },
        coupon(){
            return this.coupon_data.coupon
        }

    },

    methods: {

        ...mapMutations({
            setTotalFee: 'cart/setTotalFee',
            setDeliveryFee: 'cart/setDeliveryFee',
            setSubTotalAmount: 'cart/setSubTotalAmount',
            setValidCoupon: 'cart/setValidCoupon',
            setCouponDiscount: 'cart/setCouponDiscount',
        }),

        ...mapActions({
            getUserCartItems: 'cart/getUserCartItems',
            addItemsToCart: 'cart/addItemsToCart',
            removeItemFromCart: 'cart/removeItemFromCart',
            clearCart: 'cart/clearCart',
            couponValidate: 'cart/couponValidate',
            resetAllShoppingMutations: 'cart/resetAllShoppingMutations',
            getTrendingProducts: 'shop/getTrendingProducts',
        }),

        updateCartItemQty(item){

            this.addItemsToCart([item]).then((data) => {
                this.notifSuceess('Cart Updated successfully');
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })

        },

        removeItem(item){
            this.removeItemFromCart(item.id).then((data) => {
                this.notifSuceess('Item Deleted successfully');
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })
        },

        validateCoupon(){
            this.couponValidate({code: this.coupon_code, total_amount: this.subTotalAmount}).then((data) => {
                console.log(data)
                this.coupon_data = data.coupon_data
                if(data.coupon_data.valid) {
                    this.setTotalFee(this.totalFee)
                    this.setValidCoupon(this.isValidCoupon)
                    this.setCouponDiscount(this.getCouponDiscount)
                }
                this.notifSuceess(data.coupon_data.message);
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })

        },

        emptyCart(item){
            this.clearCart().then((data) => {
                this.resetAllShoppingMutations()
                this.notifSuceess('Cart cleared successfully');
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })
        }

    }
}
</script>

<style scoped>

.coupon{

    margin-top: -5px;
    font-weight: bold;
    /*font-size: 15px;*/
}



</style>
