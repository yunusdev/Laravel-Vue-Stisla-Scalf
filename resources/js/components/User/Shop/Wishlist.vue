<template>
    <button @click="addOrRemoveWishlist"  :class="{'active': product.is_wishlisted }" data-toggle="tooltip"
            class="btn btn-outline-secondary btn-sm btn-wishlist" data-original-title="Whishlist">
        <i class="icon-heart"></i>
    </button>
</template>

<script>
export default {
    name: "WishList",

    props: ['product'],

    methods: {

        addOrRemoveWishlist(){

            // if (!this.user){
            //     this.notifError('You need to sign in before adding to your wishlist')
            //     return;
            // }

            const wishlist = !this.product.is_wishlisted

            this.$http.put(`/account/wishlist/product/${this.product.id}`, {wishlist}).then(async (res) => {
                this.product.is_wishlisted = !this.product.is_wishlisted

                if (wishlist){
                    this.notifSuceess('Product added to your wishlist')
                }else{
                    this.notifSuceess('Product removed from your wishlist')
                }

            }).catch(err => {
                this.notifError('You need to sign in before adding to your wishlist')
                // this.notifError( err.message || 'An error occurred')
            })


        }
    }
}
</script>

<style scoped>

</style>
