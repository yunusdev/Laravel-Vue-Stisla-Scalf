<template>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account></nav-account>
            <div class="col-lg-8">
                <h4>Wishlist</h4>
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div v-if="userWishlist.length > 0"  class="table-responsive wishlist-table margin-bottom-none">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th @click="clearUserWishList" class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Wishlist</a></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product, key in userWishlist">
                            <td>
                                <div class="product-item"><a class="product-thumb" target="_blank" :href="'/product/' + product.slug">
                                    <img :src="product.front_image" class="cart-item-image" :alt="product.name"></a>
                                    <div class="product-info">
                                        <h4 class="product-title mb-0 pb-0"><a target="_blank" :href="'/product/' + product.slug">{{product.name}}</a></h4>
                                        <div class="text-lg mt-0 pt-0 text-medium">N{{product.price | formatMoney}}</div>
<!--                                        <div>Availability:-->
<!--                                            <div :class="product.available ? 'text-success' : 'text-danger'" class="d-inline text-success">-->
<!--                                                {{ product.available ?  'In Stock' : 'Out of stock' }}</div>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><a @click="removeItemFromWishlist(product.id, key)" class="remove-from-cart" href="#" data-toggle="tooltip" title="Remove item"><i class="icon-cross"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p v-else>No products in your wishlists.</p>

            </div>
        </div>
    </div>
</template>

<script>
import NavAccount from "./NavAccount";
import ErrorBag from "../../error_bag";
import {mapActions, mapMutations, mapGetters} from "vuex";

class Address{

    constructor(address) {

        this.country = address.country || 'Nigeria'
        this.state = address.state || ''
        this.lga = address.lga || ''
        this.address = address.address || ''

    }

}
export default {
    name: "UserAddress",

    props: ['raw_user'],

    components: {NavAccount},

    data(){

        return {

            user: JSON.parse(this.raw_user),
            userAddress: null,
            errors: new ErrorBag,
            state: '',
            lga: '',
            LGA: []

        }

    },

    async mounted() {
        // if (this.userOrders.length === 0){
            await this.getUserWishlist({reset: true})
        // }
    },

    computed: {

        ...mapGetters({
            userWishlist: 'account/userWishlist'
        }),

    },

    methods: {
        ...mapActions({
            getUserWishlist: 'account/getUserWishlist'

        }),
        ...mapMutations({
            setUserWishlist: 'account/setUserWishlist'
        }),

        clearUserWishList(){

            this.$http.delete(`/account/wishlist/clear`).then(async (res) => {

                this.setUserWishlist([])
                this.notifSuceess('Wishlist cleared!')

            }).catch(err => {
                this.notifError( err.message || 'An error occurred')
            })

        },

        removeItemFromWishlist(productId, index){

            this.$http.delete(`/account/wishlist/product/${productId}/remove`).then(async (res) => {

                this.userWishlist.splice(index, 1);
                this.setUserWishlist(this.userWishlist)

                this.notifSuceess('Product removed from your wishlist!')

            }).catch(err => {
                this.notifError( err.message || 'An error occurred')
            })

        }

    }

}
</script>

<style scoped>

</style>
